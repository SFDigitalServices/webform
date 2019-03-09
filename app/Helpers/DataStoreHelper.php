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
            Schema::create($tablename, function($table) use ($definitions)
            {
                $table->increments('id');
                // loop through $definition to create columns, should zipcode == number type?
                foreach($definitions as $definition){
                    switch($definition['type']){
                        case 'text':
                        case 'email':
                        case 'password':
                        case 'search':
                        case 'url':
                        case 'tel': $table->text($definition['field']);
                            break;
                        case 'file': $table->binary($definition['field']);
                            break;
                        case 'radio': $table->enum($definition['field']);
                            break;
                        case 'checkbox': $table->boolean($definition['field']);
                            break;
                        case 's02': $table->enum($definition['field']);//formtype = s02
                            break;
                        case 'i14': $table->longtext($definition['field']); //formtype = i14, textarea
                            break;
                        case 'number': $table->mediumInteger($definition['field']);
                            break;
                        case 'time': $table->time($definition['field']);
                            break;
                        case 'date':  $table->date($definition['field']);
                            break;
                        default: $table->text($definition['field']);
                            break;
                    }
                }
            });
        }
    }

    /**
     * Adding form table columns
     *
     * @returns bool
     */
	public static function addFormTableColumn($tablename, $definitions) {

	}
     /**
     * Changing form table columns
     *
     * @returns bool
     */
	public static function changeFormTableColumn($tablename, $definitions) {

    }
     /**
     * Renaming form table columns
     *
     * @returns bool
     */
	public static function renameFormTableColumn($tablename, $definitions) {

    }
     /**
     * Dropping form table columns
     *
     * @returns bool
     */
	public static function dropFormTableColumn($tablename, $definitions) {

    }

    /**
     * Check existence of form table
     *
     * @returns bool
     */
	public static function checkExistsFormTable($tablename) {

	}
     /**
     * Check existence of form table columns
     *
     * @returns bool
     */
	public static function checkExistsFormTableColumn($tablename, $definitions) {

	}
}