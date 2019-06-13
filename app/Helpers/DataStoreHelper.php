<?php
namespace App\Helpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Log;

class DataStoreHelper
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
                $class->upsertFields($table, $definitions, 'create');
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
     * Adding form table columns
     *
     * @returns bool
     */
    public static function addFormTableColumn($tablename, $definitions)
    {
        if ($definitions) {
            $class = new DataStoreHelper();
            $columns = array();
            Schema::table($tablename, function ($table) use ($definitions, $class, &$columns) {
                $class->upsertFields($table, $definitions, 'create');
                $columns = $table->getAddedColumns();
            });
            return $columns;
        }
    }
    /**
    * Changing form table columns
    *
    * @returns bool
    */
    public static function changeFormTableColumn($tablename, $definitions)
    {
        if ($definitions) {
            $class = new DataStoreHelper();
            $columns = array();
            Schema::table($tablename, function ($table) use ($definitions, $class, &$columns) {
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
    public static function renameFormTableColumn($tablename, $definitions)
    {
        if ($definitions) {
            $_fluents = array();
            Schema::table($tablename, function ($table) use ($definitions, &$_fluents) {
                foreach ($definitions as $definition) {
                    $_fluent = $table->renameColumn($definition['from'], $definition['to']);
                    if ($_fluent) {
                        array_push($_fluents, $_fluent);
                    }
                }
            });
            return $_fluents;
        }
        return null;
    }
    /**
    * Dropping form table columns
    *
    * @returns bool
    */
    public static function dropFormTableColumn($tablename, $definitions)
    {
        if ($definitions) {
            $_fluent = '';
            Schema::table($tablename, function ($table) use ($definitions, &$_fluent) {
                $_fluent = $table->dropColumn($definitions);
            });
            return $_fluent;
        }
        return null;
    }

    /**
     * Check existence of form table
     *
     * @returns bool
     */
    public static function checkExistsFormTable($tablename)
    {
        return Schema::hasTable($tablename);
    }
    /**
    * Check existence of form table columns
    *
    * @returns bool
    */
    public static function checkExistsFormTableColumn($tablename, $definitions)
    {
        return Schema::hasColumns($tablename, $definitions);
    }

    /*
    * Insert or update table definition.
    * Each case may need a mapper function. Reference: https://laravel.com/docs/5.8/migrations#creating-columns
    */
    private function upsertFields(&$table, $definitions, $operation = '')
    {
        if ($definitions) {
            $class = new DataStoreHelper();
            //mapDefinitions($definitions);
            foreach ($definitions as $definition) {
                $type = isset($definition['type']) ? $definition['type'] : $definition['formtype'];
                switch ($type) {
                    case 'text':
                    case 'email':
                    case 'password':
                    case 'search':
                    case 'url':
                    case 'tel':
                        $class->mapTextField($table, $definition, $operation);
                        break;
                    case 'file':
                    $class->mapFileField($table, $definition, $operation);
                        break;
                    case 'radio':
                    case 'checkbox':
                        $class->mapEnumField($table, $definition, $operation);
                        break;
                    case 'number':
                        $class->mapNumberField($table, $definition, $operation);
                        break;
                    case 'date':
                        $class->mapDateField($table, $definition, $operation);
                        break;
                    case 'i14':
                        $class->mapTextAreaField($table, $definition, $operation);
                        break;
                    case 'd04': // Time
                        $class->mapTimeField($table, $definition, $operation);
                        break;
                    default:
                        break;
                }
            }
        }
    }

    /*
    * Set of mapping functions
    *
    */
    private function mapFileField($table, $definition, $operation)
    {
        if ($operation == 'create') {
            $table->binary($definition['id']);
        }

        if (isset($definition['required'])) {
            if ($definition['required'] == 'true') {
                $table->binary($definition['id'])->nullable(false)->change();
            } else {
                $table->binary($definition['id'])->nullable(true)->change();
            }
        }
    }
    private function mapTimeField($table, $definition, $operation)
    {
        if ($operation == 'create') {
            $table->time($definition['id']);
        }

        if (isset($definition['value'])) {
            $table->time($definition['id'])->default($definition['value'])->change();
        }
        if (isset($definition['required'])) {
            if ($definition['required'] == 'true') {
                $table->time($definition['id'])->nullable(false)->change();
            } else {
                $table->time($definition['id'])->nullable(true)->change();
            }
        }
    }

    private function mapTextAreaField(&$table, $definition, $operation)
    {
        if ($operation == 'create') {
            $table->longtext($definition['id']);
        }
        if (isset($definition['value'])) {
            $table->longtext($definition['id'])->default($definition['value'])->change();
        }
        if (isset($definition['required'])) {
            if ($definition['required'] == 'true') {
                $table->longtext($definition['id'])->nullable(false)->change();
            } else {
                $table->longtext($definition['id'])->nullable(true)->change();
            }
        }
    }
    private function mapDateField(&$table, $definition, $operation)
    {
        if ($operation == 'create') {
            $table->date($definition['id']);
        }
        if (isset($definition['value'])) {
            $table->date($definition['id'])->default($definition['value'])->change();
        }
        if (isset($definition['required'])) {
            if ($definition['required'] == 'true') {
                $table->date($definition['id'])->nullable(false)->change();
            } else {
                $table->date($definition['id'])->nullable(true)->change();
            }
        }
    }

    private function mapNumberField(&$table, $definition, $operation)
    {
        if ($operation == 'create') {
            $table->mediumInteger($definition['id']);
        }
        if (isset($definition['required'])) {
            if ($definition['required'] == 'true') {
                $table->mediumInteger($definition['id'])->nullable(false)->change();
            } else {
                $table->mediumInteger($definition['id'])->nullable(true)->change();
            }
        }
        if (isset($definition['value'])) {
            $table->mediumInteger($definition['id'])->default($definition['value'])->change();
        }
    }
    private function mapEnumField(&$table, $definition, $operation)
    {
        if ($definition['type'] == 'radio') {
            $definition['options'] = explode("\n", $definition['radios']);
        } else {
            $definition['options'] = explode("\n", $definition['checkboxes']);
        }
        if ($operation == 'create') {
            $table->enum($definition['id'], ['']);
        }
        if (!empty($definition['options'])) {
            $table->enum($definition['id'], $definition['options'])->change();
        }
        if (isset($definition['value'])) {
            $table->enum($definition['id'])->default($definition['value'])->change();
        }
        if (isset($definition['required'])) {
            if ($definition['required'] == 'true') {
                $table->enum($definition['id'])->nullable(false)->change();
            } else {
                $table->enum($definition['id'])->nullable(true)->change();
            }
        }
    }

    private function mapTextField(&$table, $definition, $operation = '')
    {
        if ($operation == 'create') {
            $table->string($definition['id']);
        }

        if (isset($definition['required'])) {
            if ($definition['required'] == 'true') {
                $table->string($definition['id'])->nullable(false)->change();
            } else {
                $table->string($definition['id'])->nullable(true)->change();
            }
        }
        if (isset($definition['maxlength']) && intval($definition['maxlength']) > 0) {
            $table->string($definition['id'], intval($definition['maxlength']))->change();
        }
        if (isset($definition['value'])) {
            $table->string($definition['id'])->default($definition['value'])->change();
        }

        $columns = $table->getAddedColumns();
        //Log::info(print_r($columns,1));
    }
}
