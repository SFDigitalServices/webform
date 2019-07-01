<?php
namespace App\Helpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Log;
use DB;

class DataStoreHelper extends Migration
{
    /**
     * Creates database table for created form
     *
     * @returns the created table
     */
    public static function createFormTable($tablename, $definitions = null)
    {
        if ($definitions) {
            $class = new DataStoreHelper();
            $object = null;
            Schema::create($tablename, function ($table) use ($tablename, $definitions, $class, &$object) {
                $table->increments('id');
                $class->upsertFields($table, $definitions);
                $object = $table;
            });
            return $object;
        }
    }

    /**
    * Deletes database table for deleted form
    *
    * @returns name of the deleted table
    */
    public static function deleteFormTable($tablename)
    {
        Schema::dropIfExists($tablename);
        if (! Schema::hasTable($tablename)) {
            return $tablename;
        } else {
            return '';
        }
    }

     /**
     * Dropping form table columns
     *
     * @returns bool
     */
    public static function dropFormTableColumn($tablename, $definitions) {
        if($definitions){
            $_fluent = '';
            Schema::table($tablename, function($table) use ($definitions, &$_fluent)
            {
                if (Schema::hasColumns($table->getTable(), $definitions)) {
                    $_fluent = $table->dropColumn($definitions);
                    return $_fluent;
                }
            });
        }
        return null;
    }

    /**
     * Adding form table columns
     *
     * @returns bool
     */
    public static function saveFormTableColumn($tablename, $definitions)
    {
        if ($definitions) {
            $class = new DataStoreHelper();
            $columns = array();
            Schema::table($tablename, function ($table) use ($definitions, $class, &$columns) {
                $ret = $class->upsertFields($table, $definitions);
                if(!$ret)
                    $columns = $ret; // exception, return custom message
                $columns = $table->getAddedColumns();
            });
            return $columns;
        }
    }

    /*
    * Insert or update table definition.
    * Each case may need a mapper function. Reference: https://laravel.com/docs/5.8/migrations#creating-columns
    */
    private function upsertFields(&$table, $definitions)
    {
        $ret = array();
        if ($definitions) {
            $class = new DataStoreHelper();
            foreach ($definitions as $key => $definition) {
                if ( strcmp($key, 'remove') == 0 ) {
                    $ret[] = $class->dropFormTableColumn($table->getTable(), array($definition['name']));
                } else {
                    $type = isset($definition['type']) ? $definition['type'] : $definition['formtype'];
                    $definition['name'] = isset($definition['name']) ? $definition['name'] : $definition['id'];
                    switch ($type) {
                    case 'text':
                    case 'email':
                    case 'password':
                    case 'search':
                    case 'url':
                    case 'tel':
                    case 's02':  //state dropdown
                    case 's14':  //state dropdown
                    case 's15':  //state dropdown
                    case 's16':  //state dropdown
                    case 'file': //store file path only
                        $ret[] = $class->createDatabaseFields($table, $definition);
                        break;
                    case 'file':
                    case 's08': //radios
                    case 's06': //checkbox
                        $ret[] = $class->createDatabaseEnumFields($table, $definition);
                        break;
                    case 'number':
                        $ret[] = $class->createDatabaseFields($table, $definition, 'decimal');
                        break;
                    case 'date':
                        $ret[] = $class->createDatabaseFields($table, $definition, 'date');
                        break;
                    case 'i14':
                        $ret[] = $class->createDatabaseFields($table, $definition, 'longText');
                        break;
                    case 'd04': // Time
                    case 'time':
                        $ret[] = $class->createDatabaseFields($table, $definition, 'time');
                        break;
                    default:
                        break;
                }
                }
            }
        }
        return $ret;
    }

    /*
    * Mapping functions for form fields to database columns.
    *
    */
    private function createDatabaseFields(&$table, $definition, $fieldType = 'string')
    {
        $ret = array();
        $tablename = $table->getTable();
        if ( ! Schema::hasColumn($tablename, $definition['name'])) {
            $table->$fieldType($definition['name']);
        }
        else{
            if (Schema::hasColumn($tablename, $definition['name'])) {
                switch($fieldType){
                    case 'string': $dataType = "varchar(255)"; break;
                    case 'number': $dataType = "Decimal(10,2)"; break;
                    case 'longText': $dataType = "LongText"; break;
                    case 'time': $dataType = "Time"; break;
                    case 'date': $dataType = "Date"; break;
                    default: $dataType = "varchar(255)"; break;
                }
                $raw_statement = "ALTER TABLE ". $tablename .
                    " MODIFY ". $definition['name'] . " $dataType ";
                if (isset($definition['value'])) {
                    $raw_statement .= " DEFAULT '" . $definition['value'] . "'";
                }
                if (isset($definition['required'])) {
                    if ($definition['required'] == 'true') {
                        $raw_statement .= " NOT NULL";
                    } else {
                        $raw_statement .= " NULL";
                    }
                }
                try {
                    DB::statement($raw_statement);
                }
                catch(\Illuminate\Database\QueryException $ex){
                    $ret = array("status" => 0, "message" => "Failed to update database column " . $definition['name']);
                }
            }
        }
        return $ret;
    }

    /*
    * Map Radio buttons and Checkboxes to Database column.
    * Opted to use a lookup table instead of the data type enum due to DBAL's defect.
    *
    */

    private function createDatabaseEnumFields(&$table, $definition)
    {
        $ret = array();
        $definition['options'] = ($definition['formtype'] == 's08') ? ($definition['radios']) : ($definition['checkboxes']);
        $definition['options'] = json_decode($definition['options'], true);
        $form_id = str_replace('forms_','', $table->getTable());
        $tablename = $table->getTable();
        if ( ! Schema::hasColumn($tablename, $definition['name'])) {
           foreach ($definition['options'] as $key => $value) {
                $inserted_id = DB::table('enum_mappings')->insertGetId([
                    'form_table_id' => $form_id,
                    'form_field_name' => $definition['name'],
                    'value' => $value,
                ]);
            }
            $table->Integer($definition['name'])->default($inserted_id);
        }
        else{
            //check column, rename not allowed
            if (Schema::hasColumn($tablename, $definition['name'])) {
                $raw_statement = "ALTER TABLE ". $tablename .
                    " MODIFY ". $definition['name'] . " int(11) ";
                if (isset($definition['value'])) { // need to get reference id from lookup table.
                    $raw_statement .= " DEFAULT '" . $definition['value'] . "'";
                }
                if (isset($definition['required'])) {
                    if ($definition['required'] == 'true') {
                        $raw_statement .= " NOT NULL";
                    } else {
                        $raw_statement .= " NULL";
                    }
                }
                try {
                    DB::statement($raw_statement);
                    //update the options lookup table
                    $this->updateLookupTable($definition, $form_id);
                }
                catch(\Illuminate\Database\QueryException $ex){
                    $ret = array("status" => 0, "message" => "Failed to update database column " . $definition['name']);
                }
            }
        }
        return $ret;
    }

    /*
    * Lookup table to mimic enum data type, sort of like Drupal's Taxonomy.
    *
    */
    private function updateLookupTable($definition, $form_id){
        if($form_id && $definition){
            $results = DB::select('select * from enum_mappings where form_table_id = ? AND form_field_name = ? ', array($form_id, $definition['name']));
            foreach($results as $result){
                if(!in_array($result->value, $definition['options'])){
                    DB::delete('delete from enum_mappings where id = ?', array($result->id));
                }
                else{ //if enum_mapping records is in $definitions['options], remove from $definition['option']
                    if (($key = array_search($result->value, $definition['options'])) !== false) {
                        unset($definition['options'][$key]);
                    }
                }
            }
           if (! empty($definition['options'])) {
                // add record to enum_mappings one at a time, can we batch this?
                foreach ($definition['options'] as $option) {
                    if(trim($option) != '')
                        DB::insert('insert into enum_mappings (form_table_id, form_field_name, value) values (?, ?, ?)', array($form_id, $definition['name'], $option));
                }
            }
        }
    }
}