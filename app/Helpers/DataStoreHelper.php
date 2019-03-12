<?php
namespace App\Helpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
class DataStoreHelper
{
    /**
     * Creates database table for created form
     *
     * @returns name of the created table
     */
	public static function createFormTable($tablename, $definitions = null) {
        if($definitions){
            $class = new DataStoreHelper();
            Schema::create($tablename, function($table) use ($tablename, $definitions, $class)
            {
                $table->increments('id');
                $class->upsertFields($table, $definitions);
            });
        }
    }

    /**
     * Adding form table columns
     *
     * @returns bool
     */
	public static function addFormTableColumn($tablename, $definitions) {
        if($definitions){
            $class = new DataStoreHelper();
            Schema::table($tablename, function($table) use ($tablename, $definitions, $class)
            {
                $class->upsertFields($table, $definitions);
            });
        }
	}
     /**
     * Changing form table columns
     *
     * @returns bool
     */
	public static function changeFormTableColumn($tablename, $definitions) {
        if($definitions){
            $class = new DataStoreHelper();
            $columns = array();
            Schema::table($tablename, function($table) use ($definitions, $class, &$columns)
            {
                $class->upsertFields($table, $definitions, 'change');
                $columns = $table->getChangedColumns();
            });
            return $columns;
        }
    }
     /**
     * Renaming form table columns
     *
     * @returns bool
     */
	public static function renameFormTableColumn($tablename, $definitions) {
        if($definitions){
            $_fluents = array();
            Schema::table($tablename, function($table) use ($definitions, &$_fluents)
            {
                foreach($definitions as $definition){
                    $_fluent = $table->renameColumn($definition['from'], $definition['to']);
                    if($_fluent){
                        array_push($_fluents, $_fluent);
                    }
                }
            });
            return $_fluents;
        }
        return NULL;
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
                $_fluent = $table->dropColumn($definitions);
            });
            return $_fluent;
        }
        return NULL;
    }

    /**
     * Check existence of form table
     *
     * @returns bool
     */
	public static function checkExistsFormTable($tablename) {
        return Schema::hasTable($tablename);
	}
     /**
     * Check existence of form table columns
     *
     * @returns bool
     */
	public static function checkExistsFormTableColumn($tablename, $definitions) {
        return Schema::hasColumns($tablename, $definitions);
    }
    /*
    * Insert or update table definition.
    * Each case may need a mapper function
    */
    private function upsertFields(&$table, $definitions, $operation = ''){
        if($definitions){
            foreach($definitions as $definition){
                switch($definition['type']){
                    case 'text':
                    case 'email':
                    case 'password':
                    case 'search':
                    case 'url':
                    case 'tel':
                        if($operation == 'change')
                            $table->string($definition['field'], isset($definition['attributes']) ? implode(',', $definition['attributes']) : '')->change();
                        else
                            $table->string($definition['field'], isset($definition['attributes']) ? implode(',', $definition['attributes']) : '');
                        break;
                    case 'file':
                        $table->binary($definition['field']);
                        break;
                    case 'radio':
                        if($operation == 'change')
                            $table->enum($definition['field'], $definition['options'])->change();
                        else
                            $table->enum($definition['field'], $definition['options']);
                        break;
                    case 'checkbox':
                        $table->boolean($definition['field']);
                        break;
                    case 'number':
                        $table->mediumInteger($definition['field']);
                        break;
                    case 'time':
                        $table->time($definition['field']);
                        break;
                    case 'date':
                        $table->date($definition['field']);
                        break;
                    default:
                        switch($definition['formtype']){
                            case 's02': $table->enum($definition['field'], $definition['options']); //formtype = s02
                                break;
                            case 'i14': $table->longtext($definition['field']); //formtype = i14, textarea
                                break;
                            default:
                                break;
                        }
                        break;
                }
            }
        }
    }
}