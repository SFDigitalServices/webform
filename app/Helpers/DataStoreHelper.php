<?php
namespace App\Helpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Log;
use DB;
use App\Helpers\ControllerHelper;

class DataStoreHelper extends Migration
{
  protected $controllerHelper;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->controllerHelper = new ControllerHelper();
    }
    /**
     * Creates database table for created form
     *
     * @param $tablename
     * @param $definitions
     *
     * @return Blueprint
     */
    public static function createFormTable($tablename, $definitions = null)
    {
        $class = new DataStoreHelper();
        $object = null;
        Schema::create($tablename, function ($table) use ($tablename, $definitions, $class, &$object) {
            $table->increments('id');
            if ($definitions) {
                $class->upsertFields($table, $definitions);
            }
            $object = $table;
        });
        return $object;
    }

    /**
    * Deletes database table for deleted form
    *
    * @param $tablename
    *
    * @return string
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
     * @param $tablename
     * @param $definitions
     *
     * @return bool
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
     * @param @tablename
     * @param $definitions
     *
     * @return bool
     */
    public static function saveFormTableColumn($tablename, $definitions)
    {
        if ($definitions) {
            $class = new DataStoreHelper();
            $columns = array();
            if (! Schema::hasTable($tablename)) {
              $class->createFormTable($tablename, $definitions);
            }
            else{
                Schema::table($tablename, function ($table) use ($definitions, $class, &$columns) {
                    $ret = $class->upsertFields($table, $definitions);
                    if (!$ret) {
                        $columns = $ret;
                    } // exception, return custom message
                });
                return $columns;
            }
        }
    }

    /**
    * Reads CSV file from S3
    *
    * @param $filename
    * @param $arr
    *
    * @return void
    */
    public function readCSV($filename)
    {
        //$csv = array_map('str_getcsv', file('/var/www/html/public/csv/'.$filename , FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
        $csv = array();
        $read = $this->controllerHelper->readS3($filename);
        if ($read) {
            $rows = str_getcsv($read, "\n");
            foreach ($rows as $row) {
                $csv[] = str_getcsv($row);
            }
        }
        return $csv;
    }
    /**
    * Writes data to CSV file on S3
    *
    * @param $filename
    * @param $body
    *
    * @return void
    */
    public function writeCSV($filename, $body)
    {
        //file_put_contents('/var/www/html/public/csv/'.$filename, implode(",",$write)."\n");
        return $this->controllerHelper->writeS3($filename, $body);
    }

    /**
    * Prepare write data
    *
    * @param $content
    * @param $filename
    *
    * @return void
    */
    public function rewriteCSV($content, $filename)
    {
        $column = 0;
        $write = array();
        foreach ($content->data as $field) {
            $nonInputs = array("m02", "m04", "m06", "m08", "m10", "m13", "m14", "m16");
            $multipleInputs = array("s02", "s04", "s06", "s08");
            if (in_array($field->formtype, $multipleInputs)) {
                if ($field->formtype == "s02" || $field->formtype == "s04") {
										$options = $field->option;
                } elseif ($field->formtype == "s06") {
                    $options = $field->checkboxes;
                } elseif ($field->formtype == "s08") {
                    $options = $field->radios;
                }
                foreach ($options as $option) {
                    $write[$column] = isset($field->name) ? $field->name." ".$option : $option;
                    $column++;
                }
            } elseif (!in_array($field->formtype, $nonInputs)) { // catch all for everything except multiple and non-inputs
                $write[$column] = isset($field->name) ? $field->name : '';
                $column++;
            }
        }
        // write data to csv file
        $this->writeCSV($filename, implode(",", $write)."\n");
    }
    /**
    * Add submitted form data to CSV file on S3
    *
    * @param $filename
    * @param $arr
    *
    * @return void
    */
    public function appendCSV($filename, $arr)
    {
        $csv = $this->readCSV($filename);
        array_push($csv, $arr);
        $output = "";
        foreach ($csv as $row) {
            $output .= implode(",", $row)."\n";
        }
        $this->writeCSV($filename, $output);
    }

    /**
    * Determine a form is published or not.
    *
    * @param $filename
    *
    * @return boolean
    */
    public function isCSVPublished($filename)
    {
        $csv = $this->readCSV($filename);
        return count($csv) > 1 ? true : false;
    }

    /**
    * Handles form submission
    *
    * @param $form
    * @param $request
    *
    * @return boolean
    */
    public function submitCSV($form, $request)
    {
        $write = $this->parseSubmittedFormData($form, $request);
        if ($write) {
            $this->appendCSV($this->controllerHelper->generateFilename($form['id']), $write['csv']);
            $this->insertFormData($write['db'], $form['id']);
            return true;
        }
        return false;
    }

    /**
    * Inserts submitted form data into the form table
    *
    * @param $content
    * @param $formid
    *
    * @return void
    */
    public static function insertFormData($content, $formid){
        $tablename = "forms_".$formid;
        if (Schema::hasTable($tablename)) {
            Log::info(print_r($content,1));
            //checkboxes, radio buttons, dropdowns are stored in the lookup table
            foreach($content as $key => $value){
              if( ! Schema::hasColumn($tablename, $key)){
                unset($content[$key]);
              }
            }
            DB::table($tablename)->insert($content);
        }
    }

    /**
    * Parses submitted form data
    *
    * @param $content
    * @param $request
    *
    * @return array
    */
    private function parseSubmittedFormData($content, $request){
      $write = array();
      $column = 0;
      //Log::info(print_r($request->all(),1));
      if (! empty($content['content']['data'])) {
          foreach ($content['content']['data'] as $field) {
            if ($this->controllerHelper->isNonInputField($field['formtype'])){
              continue;
            }
            if ($field['formtype'] == "s02" || $field['formtype'] == "s04" || $field['formtype'] == "s06" || $field['formtype'] == "s08") { //multiple options
                if ($field['formtype'] == "s02" || $field['formtype'] == "s04") {
                    $options = $field['option'];
                } elseif ($field['formtype'] == "s06") {
                    $options = $field['checkboxes'];
                } elseif ($field['formtype'] == "s08") {
                    $options = $field['radios'];
                }
                foreach ($options as $option) {
                  $field['name'] = isset($field['name']) ? $field['name'] : $field['id'];
                  if (is_array($request->input($field['name']))) {
                      $write['csv'][$column] = in_array($option, $request->input($field['name'])) ? 1 : 0;
                      //$write['db'][$field['name']] = $write['csv'][$column];
                  } else {
                      $write['csv'][$column] = $request->input($field['name']) == $option ? 1 : 0;
                      //$write['db'][$field['name']] = $write['csv'][$column];
                  }
                  $column++;
                }
            }
            elseif ($field['formtype'] == "m13" && isset($field['name'])) { //for file uploads, checks if field has a name
              if ($request->file($field['name']) != null && $request->file($field['name'])->isValid()) { //checks if field is populated with an acceptable value
                  $file = $request->file($field['name']);
                  $newFilename = $this->controllerHelper->generateUploadedFilename($content['id'], $field['name'], $file->getClientOriginalName());
                  $this->controllerHelper->writeS3($newFilename, file_get_contents($file));
                  $write['db'][$field['name']] = $write['csv'][$column] = $this->controllerHelper->getBucketPath().$newFilename;
                }
                $column++;
              }
            else {
                  // fixed bug: if 'name' attribute was not set, exception is thrown here.
                  if (isset($field['name'])) {
                    $write['db'][$field['name']] = $write['csv'][$column] = $request->input($field['name']);
                  }
                  $column++;
              }
          }
      }
      return $write;
    }

    /**
    * Insert or update table definition.
    *
    * @param $table
    * @param definitions
    *
    * @return array
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

    /**
    * Mapping functions for form fields to database columns.
    *
    * @param $table
    * @param definition
    * @param $fieldType
    *
    * @return array
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

    /**
    * Map Radio buttons and Checkboxes to Database column.
    * Opted to use a lookup table instead of the data type enum due to DBAL's defect.
    *
    * @param $table
    * @param $definition
    *
    * @return array
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
                    $ret = array();
                }
                catch(\Illuminate\Database\QueryException $ex){
                    $ret = array("status" => 0, "message" => "Failed to update database column " . $definition['name']);
                }
            }
        }
        return $ret;
    }

    /**
    * Lookup table to mimic enum data type, sort of like Drupal's Taxonomy.
    *
    * @param $definition
    * @param $form_id
    *
    * @return void
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