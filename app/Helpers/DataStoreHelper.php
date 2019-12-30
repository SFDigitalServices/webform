<?php
namespace App\Helpers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Migrations\Migration;
use GuzzleHttp;
use Log;
use DB;
use App\Form;
use Exception;
use App\Helpers\ControllerHelper;
use Illuminate\Support\Facades\Validator;

class DataStoreHelper extends Migration
{
    protected $controllerHelper;

    /** Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->controllerHelper = new ControllerHelper();
    }

    /** Creates database table for created form
      *
      * @param $tablename
      * @param $definitions
      *
      * @return Blueprint
      */
    public function createFormTable($tablename, $definitions = null)
    {
        $class = new DataStoreHelper();
        $object = null;
        Schema::create($tablename, function ($table) use ($tablename, $definitions, $class, &$object) {
            $table->increments('id');
            if ($definitions) {
                $class->upsertFields($table, $definitions);
            }
            // add field for ADU dispatcher status
            $table->boolean('ADU_POST');
            // add timestamps
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP(0)'));
            $object = $table;
        });
        // create archive table
        if (Schema::hasTable($tablename)) {
            Schema::create($tablename.'_archive', function ($table) {
                $table->increments('id');
                $table->integer('record_id');
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP(0)'));
            });
        }

        return $object;
    }

    /** Clone database table
    *
    * @param $tablename
    * @param $cloned
    *
    * @return bool
    */

    public function cloneFormTable($tablename, $cloned)
    {
        if ($tablename !== '' && $cloned !== '') {
            try {
                DB::transaction(function () use ($cloned, $tablename) {
                    $statement = "CREATE TABLE ". $cloned ." LIKE ". $tablename;
                    DB::statement($statement);
                    $indexes = "INSERT $cloned SELECT * FROM $tablename";
                    DB::statement($indexes);

                    Schema::create($cloned .'_archive', function ($table) {
                        $table->increments('id');
                        $table->integer('record_id');
                        $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
                        $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP(0)'));
                    });
                });
            } catch (\Illuminate\Database\QueryException $ex) {
                return false;
            }
            return true;
        }
        return false;
    }

    /** Deletes database table for deleted form
     *
     * @param $formId
     *
     * @return string
     */

    public function deleteFormTable($formId)
    {
        $tablename = "forms_".$formId;
        if ($this->archiveFormTable($formId)) {
            Schema::dropIfExists($tablename);
            if (! Schema::hasTable($tablename)) {
                // remove entries in enum_mappings
                return $tablename;
            } else {
                return '';
            }
        }
    }

    /** Dropping form table columns
     *
     * @param $tablename
     * @param $columns
     *
     * @return bool
     */
    public function dropFormTableColumn($tablename, $columns)
    {
        if ($columns) {
            $_fluent = '';
            Schema::table($tablename, function ($table) use ($columns, &$_fluent, $tablename) {
                if (Schema::hasColumns($tablename, $columns)) {
                    $formId= str_replace('forms_', '', $tablename);
                    //move deleted column and data to archive
                    $this->archiveFormTableColumn($formId, $columns);
                    $_fluent = $table->dropColumn($columns);
                    // remove lookup table entries
                    if ($_fluent) {
                        DB::table('enum_mappings')->where('form_table_id', '=', $formId)->where('form_field_name', '=', $_fluent['columns'][0])->delete();
                        return $_fluent;
                    }
                }
            });
        }
        return null;
    }

    /** Adding form table columns
      *
      * @param @tablename
      * @param $definitions
      *
      * @return bool
      */
    public function saveFormTableColumn($tablename, $definitions)
    {
        if ($definitions) {
            $class = new DataStoreHelper();
            $columns = array();
            if (! Schema::hasTable($tablename)) {
                $class->createFormTable($tablename, $definitions);
            } else {
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

    /** Retrieve form draft
    *
    * @param $formid
    * @param $draft
    *
    * @return JSON
    */
    public function retrieveFormDraft($formid, $draft = '')
    {
        $data = array();
        if ($formid > 0 && $draft !== '') {
            try {
                $form_draft = DB::table('form_table_drafts')
                ->select()
                ->where('magiclink', $draft)
                ->first();

                if ($form_draft) {
                    $results = DB::table('forms_'.$formid)
                    ->select()
                    ->where('id', $form_draft->form_record_id)
                    ->first();

                    $data = (array) $results;
                    $data['formid'] = $formid;
                    $data['magiclink'] = $draft;
                    $lookups = $this->getLookupTable($formid);
                    foreach ($lookups as $lookup) {
                        $ids = explode(',', $data[$lookup['form_field_name']]);
                        if (isset($data[$lookup['form_field_name']]) && in_array($lookup['id'], $ids)) {
                            if ($lookup['type'] === 's06') {
                                if (! isset($data[$lookup['form_field_name']."[]"])) {
                                    $data[$lookup['form_field_name']."[]"] = array();
                                }
                                array_push($data[$lookup['form_field_name']."[]"], $lookup['value']);
                            } else {
                                $data[$lookup['form_field_name']] = $lookup['value'];
                            }
                        }
                    }
                }
            } catch (\Illuminate\Database\QueryException $ex) {
                $results = ['status' => 0, 'message' => $ex->getMessage()];
                return null;
            }
        }
        return $data;
    }
    /** Retrieve form draft
    *
    * @param $formid
    * @param $draft
    *
    * @return Array
    */
    public function getFormDraftList($hash)
    {
        $list = array();
        try {
            $results = DB::table('form_table_drafts')
                  ->select()
                  ->where('email', $hash)
                  ->get();

            foreach ($results as $result) {
                $list[] = ['host' => $result->host, 'magiclink' => urlencode($result->magiclink), 'form_id' => $result->form_table_id];
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            $ret = ['status' => 0, 'message' => $ex->getMessage()];
            return $ret;
        }
        return $list;
    }

    /** Handles form submission
     *
     * @param $form
     * @param $requestData
     * @param $status
     *
     * @return Array
     */
    public function submitForm($form, $requestData, $status = 'complete')
    {
        $ret = array();
        if ($ret = $this->validateFormRequest($requestData, $form['content']['data'])) {
            return $ret;
        }

        $write = $this->parseSubmittedFormData($form, $requestData);
        if ($write) {
            // if the magic link is clicked for the partially completed form, remove the record first.
            if (isset($requestData['magiclink'])) {
                try {
                    $record = DB::table('form_table_drafts')->where('magiclink', '=', $requestData['magiclink'])->first();
                    if ($record) {
                        DB::table('form_table_drafts')->where('id', '=', $record->id)->delete();
                        DB::table('forms_'.$form['id'])->where('id', '=', $record->form_record_id)->delete();
                    }
                } catch (\Illuminate\Database\QueryException $ex) {
                    $ret = array("status" => 0, "message" => "Failed to delete form draft " . $form['id']);
                    return $ret;
                }
            }
            $id = $this->insertFormData($write['db'], $form['id']);
            // update status if form is partially completed
            if ($id) {
                $ret = array("status" => 1, "message" => 'success' );
                try {
                    if ($status != 'complete') {
                        $email = isset($write['db']['email_save_for_later']) ? $write['db']['email_save_for_later'] : '';
                        $magiclink = Hash::make(time());
                        DB::table('form_table_drafts')->insert(['form_table_id' => $form['id'], 'magiclink' => $magiclink, 'email' => $email, 'host' => $form['host'], 'form_record_id' => $id]);
                        $ret = array("status" => 1, 'data' => $this->constructResumeDraftEmailData($form, $magiclink, $email) );
                    } else {
                        $ret = $this->pushDataToADU($requestData);
                        if ($ret['status'] == 1 && Schema::hasColumn('forms_'.$form['id'], 'ADU_POST')) {
                            DB::table('forms_'.$form['id'])->where('id', '=', $id)->update(array("ADU_POST" => 1));
                        }
                    }
                } catch (\Illuminate\Database\QueryException $ex) {
                    $ret = array("status" => 0, "message" => "Failed to update status " . $form['id']);
                }
                return $ret;
            }
        }
        return $ret;
    }

    /** Inserts submitted form data into the form table
     *
     * @param $content
     * @param $formid
     *
     * @return integer
     */
    public function insertFormData($content, $formid)
    {
        $id = 0;
        $tablename = "forms_".$formid;
        if (Schema::hasTable($tablename)) {
            foreach ($content as $key => $value) {
                if (! Schema::hasColumn($tablename, $key)) {
                    // if submitted data doesn't have a corresponding table column, don't insert.
                    unset($content[$key]);
                    continue;
                }
                //checkboxes, radio buttons, dropdowns are stored in the lookup table
                if (is_array($value)) {
                    $content[$key] = $this->findLookupID($key, $formid, $value);
                }
            }
            try {
                $id = DB::table($tablename)->insertGetId($content);
            } catch (\Illuminate\Database\QueryException $ex) {
                $ret = array("status" => 0, "message" => "Failed to insert data " . $formid);
                Log::info(print_r($ex->getMessage(), 1));
                return 0;
            } catch (PDOException $e) {
                Log::info(print_r($e->getMessage(), 1));
            }
        }
        return $id;
    }

    /** get submitted form data
      *
      * @param $formid
      *
      * @return array
      */
    public function getSubmittedFormData($formid)
    {
        try {
            $tablename = "forms_" . $formid;
            $results = DB::table($tablename)
                      ->orderBy($tablename.'.id', 'asc')
                      ->get();
        } catch (\Illuminate\Database\QueryException $ex) {
            $results = ['status' => 0, 'message' => $ex->getMessage()];
        }
        return $results;
    }

    /** get archived form data
    *
    * @param $formid
    *
    * @return array
    */
    public function getArchivedFormData($formid)
    {
        try {
            $tablename = "forms_" . $formid. "_archive";
            $results = DB::table($tablename)
                      ->orderBy($tablename.'.id', 'asc')
                      ->get();
        } catch (\Illuminate\Database\QueryException $ex) {
            $results = ['status' => 0, 'message' => $ex->getMessage()];
        }
        return $results;
    }

    /** get submitted form column names
    *
    * @param $formid
    *
    * @return array
    */
    public function getFormTableColumns($formid)
    {
        $tablename = "forms_" . $formid;
        try {
            $results = DB::select('SHOW COLUMNS FROM '. $tablename);
            $columns = $this->transformColumns($results);
        } catch (\Illuminate\Database\QueryException $ex) {
            $results = ['status' => 0, 'message' => $ex->getMessage()];
        }
        return $results;
    }

    /** get submitted form column names
    *
    * @param $formid
    *
    * @return array
    */

    public function getLookupTable($formid)
    {
        $results = array();
        $form = Form::where('id', $formid)->first();
        if ($form) {
            $form['content'] = json_decode($form['content'], true);
            try {
                foreach ($form['content']['data'] as $field) {
                    if (isset($field['formtype']) && ($field['formtype'] == 's06' || $field['formtype'] == 's08')) {
                        $options = DB::table('enum_mappings')
                            ->where([
                              ['form_table_id', '=', $formid],
                              ['form_field_name', '=', $field['name'] ]
                              ])
                            ->get();
                        foreach ($options as $op) {
                            array_push($results, (array)$op);
                        }
                    }
                }
            } catch (\Illuminate\Database\QueryException $ex) {
                $results = ['status' => 0, 'message' => $ex->getMessage()];
            }
        }
        return $results;
    }

    /** Archive a form table
     *
     * @param @formId
     *
     * @return bool
     */
    private function archiveFormTable($formId)
    {
        // archive array of column names
        $columns = Schema::getColumnListing("forms_".$formId);
        if (count($columns) > 2) {
            return $this->archiveFormTableColumn($formId, $columns);
        }
        return false;
    }
    /** Archive a form table column
    *
    * @param @formId
    * @param $columns
    *
    * @return bool
    */
    private function archiveFormTableColumn($formId, $columns)
    {
        $tableName = "forms_".$formId;
        $archiveTableName = $tableName."_archive";
        // if archive form table exist.
        if (! Schema::hasTable($archiveTableName)) {
            // create archive table
            if (Schema::hasTable($tableName)) {
                Schema::create($tableName.'_archive', function ($table, $formId) {
                    $table->increments('id');
                    $table->integer('record_id');
                    $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
                    $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP(0)'));
                });
            }
        }
        $archiveColumns = array();
        foreach ($columns as $column) {
            // skip id and timestamps
            if (in_array($column, array('id', 'created_at', 'updated_at'))) {
                continue;
            }
            $columnType = DB::getSchemaBuilder()->getColumnType($tableName, $column);
            if (! Schema::hasColumn($archiveTableName, $column)) {
                Schema::table($archiveTableName, function ($table) use ($column, $columnType) {
                    $table->$columnType($column);
                });
            }
            $archiveColumns[] = $column;
        }
        try {
            //get data from forms_$formId
            $statement = 'INSERT INTO '. $archiveTableName .' ('.implode(',', $archiveColumns) .', record_id) SELECT '. implode(',', $archiveColumns) .', id FROM '.$tableName;
            $where = ' WHERE ';
            foreach ($archiveColumns as $w) {
                $where .= $w . " != '' AND ";
            }
            $where = preg_replace('/AND\s$/', '', $where);
            $statement .= $where;
            $data = DB::statement($statement);
        } catch (\Illuminate\Database\QueryException $ex) {
            Log::info(print_r($ex->getSql(), 1));
            return false;
        }
        return true;
    }

    /** Rename a form table column and lookup table field name
    *
    * @param $tablename
    * @param $definition
    *
    * @return array
    */
    private function renameFormTableColumn($tablename, $definition)
    {
        $form_id = str_replace('forms_', '', $tablename);
        try {
            Schema::table($tablename, function (Blueprint $table) use ($definition, $form_id) {
                $_fluent = $table->renameColumn($definition['from'], $definition['to']);
                // update form field name in lookup table
                if ($_fluent) {
                    try {
                        DB::table('enum_mappings')
                    ->where([
                      ['form_table_id', $form_id],
                      ['form_field_name', $definition['from']]
                    ])
                    ->update(['form_field_name' => $definition['to']]);
                    } catch (\Illuminate\Database\QueryException $ex) {
                        //$ret = array("status" => 0, "message" => "Failed to update database column " . $definition['name']);
                        return null;
                    }
                }
            });
            return (array) $definition['add'];
        } catch (\Doctrine\DBAL\Schema\SchemaException $ex) {
            return null;
        }
    }

    /** Insert or update table definition.
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
                // filter out non-inputs
                if (isset($definition['formtype']) && $this->controllerHelper->isNonInputField($definition['formtype'])) {
                    continue;
                }
                if (strcmp($key, 'rename') == 0) { //rename the column, $definition holds any additional updates
                    $definition = $class->renameFormTableColumn($table->getTable(), $definition);
                } elseif (strcmp($key, 'remove') == 0) {
                    $ret[] = $class->dropFormTableColumn($table->getTable(), array($definition['name']));
                    continue;
                }
                // if $definition is alter because of renaming the column
                if ($definition) {
                    if (isset($definition['formtype']) && ($definition['formtype'] == 's06' || $definition['formtype'] == 's08')) {
                        $type = $definition['formtype'];
                    } else {
                        $type = isset($definition['type']) ? $definition['type'] : $definition['formtype'];
                    }
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

    /** Mapping functions for form fields to database columns.
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
        if (! Schema::hasColumn($tablename, $definition['name'])) {
            $table->$fieldType($definition['name']);
        } else {
            if (Schema::hasColumn($tablename, $definition['name'])) {
                switch ($fieldType) {
                    case 'string': $dataType = "varchar(255)"; break;
                    case 'number': $dataType = "Decimal(10,2)"; break;
                    case 'longText': $dataType = "Text"; break;
                    case 'time': $dataType = "Time"; break;
                    case 'date': $dataType = "Date"; break;
                    default: $dataType = "varchar(100)"; break;
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
                } catch (\Illuminate\Database\QueryException $ex) {
                    $ret = array("status" => 0, "message" => "Failed to update database column " . $definition['name']);
                }
            }
        }
        return $ret;
    }

    /** Map Radio buttons and Checkboxes to Database column.
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
        if (!is_array($definition['options'])) {
            $definition['options'] = json_decode($definition['options'], true);
        }

        $form_id = str_replace('forms_', '', $table->getTable());
        $tablename = $table->getTable();
        if (! Schema::hasColumn($tablename, $definition['name'])) {
            foreach ($definition['options'] as $key => $value) {
                $inserted_id = DB::table('enum_mappings')->insertGetId([
                    'form_table_id' => $form_id,
                    'form_field_name' => $definition['name'],
                    'value' => $value,
                    'type' => $definition['formtype'],
                ]);
            }
            $table->string($definition['name'], 50)->default($inserted_id);
        } else {
            //check column, rename not allowed
            if (Schema::hasColumn($tablename, $definition['name'])) {
                $raw_statement = "ALTER TABLE ". $tablename .
                    " MODIFY ". $definition['name'] . " varchar(50) ";
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
                    $ret = $this->updateLookupTable($definition, $form_id);
                } catch (\Illuminate\Database\QueryException $ex) {
                    $ret = array("status" => 0, "message" => "Failed to update database column " . $definition['name']);
                }
            }
        }
        return $ret;
    }

    /** Lookup table to mimic enum data type, sort of like Drupal's Taxonomy.
     *
     * @param $definition
     * @param $form_id
     *
     * @return array
     */
    private function updateLookupTable($definition, $form_id)
    {
        $ret = array();
        if ($form_id && $definition) {
            $results = DB::select('select * from enum_mappings where form_table_id = ? AND form_field_name = ? ', array($form_id, $definition['name']));
            foreach ($results as $result) {
                if (!in_array($result->value, $definition['options'])) {
                    try {
                        DB::delete('delete from enum_mappings where id = ?', array($result->id));
                    } catch (\Illuminate\Database\QueryException $ex) {
                        $ret = array("status" => 0, "message" => "Failed to update database column " . $definition['name']);
                    }
                } else { //if enum_mapping records is in $definitions['options], remove from $definition['option']
                    if (($key = array_search($result->value, $definition['options'])) !== false) {
                        unset($definition['options'][$key]);
                    }
                }
            }
            if (! empty($definition['options'])) {
                // add record to enum_mappings one at a time, can we batch this?
                try {
                    foreach ($definition['options'] as $option) {
                        if (trim($option) != '') {
                            DB::insert('insert into enum_mappings (form_table_id, form_field_name, value) values (?, ?, ?)', array($form_id, $definition['name'], $option));
                        }
                    }
                } catch (\Illuminate\Database\QueryException $ex) {
                    $ret = array("status" => 0, "message" => "Failed to update database column " . $definition['name']);
                }
            }
        }
    }

    /** Find a list of lookup table IDs for a given form
    *
    * @param $key
    * @param $formid
    * @param $value
    *
    * @return string
    */
    private function findLookupID($key, $formid, $value)
    {
        $selected = array();
        $options = DB::table('enum_mappings')
      ->where([
          ['form_field_name', '=', "$key"],
          ['form_table_id', '=', "$formid"]
      ])->get();
        foreach ($options as $option) {
            if (in_array($option->value, $value)) {
                $selected[] = $option->id;
            }
        }
        return implode(',', $selected);
    }
    /** Transform columns
     *
     * @param $columns
     * @return array
     */
    private function transformColumns($columns)
    {
        return array_map(function ($column) {
            return [
                'Field' => $column->Field,
                'Type' => $column->Type,
                'Null' => $column->Null,
                'Key' => $column->Key,
                'Default' => $column->Default,
                'Extra' => $column->Extra
            ];
        }, $columns);
    }
    /** Parses submitted form data
     *
     * @param $content
     * @param $request
     *
     * @return array
     */
    private function parseSubmittedFormData($content, $request)
    {
        $write = array();
        $column = 0;
        if (! empty($content['content']['data'])) {
            foreach ($content['content']['data'] as $field) {
                if ($this->controllerHelper->isNonInputField($field['formtype'])) {
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
                        if (isset($request[$field['name']])) {
                            if (is_array($request[$field['name']])) {
                                $write['db'][$field['name']] = $request[$field['name']];
                            } else {
                                $write['db'][$field['name']] = ($field['formtype'] == 's06' || $field['formtype'] == 's08') ?
                        array($request[$field['name']]) : $request[$field['name']];
                            }
                            $column++;
                        }
                    }
                } elseif ($field['formtype'] == "m13" && isset($field['name'])) { //for file uploads, checks if field has a name
              if (isset($request['file']) && $request['file'][$field['name']] != null && $request['file'][$field['name']]->isValid()) { //checks if field is populated with an acceptable value
                  $file = $request['file'][$field['name']];
                  $newFilename = $this->controllerHelper->generateUploadedFilename($content['id'], $field['name'], $file->getClientOriginalName());
                  $this->controllerHelper->writeS3($newFilename, file_get_contents($file));
                  $write['db'][$field['name']] = $this->controllerHelper->getBucketPath().$newFilename;
              }
                    $column++;
                } else {
                    // fixed bug: if 'name' attribute was not set, exception is thrown here.
                    if (isset($field['name']) && isset($request[$field['name']])) {
                        $write['db'][$field['name']] = $write['csv'][$column] = $request[$field['name']];
                        if ($field['formtype'] === 'c04') {
                            $write['db']['email_save_for_later'] = $request[$field['name']];
                        }
                    }
                    $column++;
                }
            }
        }
        return $write;
    }

    /** Push data to the ADU Dispatcher
    *
    * @param $formdata
    *
    * @return array
    */
    private function pushDataToADU($formdata)
    {
        $ret = array();

        if ($formdata) {
            $api_key = getenv("ADU_DISPATCHER_KEY");
            $endpoint = getenv("ADU_DISPATCHER_ENDPOINT");
            $client = new GuzzleHttp\Client(['base_uri' => $endpoint]);

            $res = $client->request('POST', '/adu/submissions', [
          'headers' => [
            'Accept-Encoding' => 'gzip'
          ],
          'query' => ['apikey' => $api_key],
          'json' => $formdata,
          'decode_content' => false
        ]);
            if ($res->getStatusCode() != 200) {
                $ret = array("status" => 0, "message" => "Failed to push data to ADU, form -- " . $form['id']);
            } else {
                $ret = array("status" => 1, "message" => "Successful", "data "=> $res->getBody()->getContents());
            }
        }
        return $ret;
    }
    /** Get form data for email templates
    *
    * @param $form
    * @param @magiclink
    * @param @email
    *
    * @return Array
    */
    private function constructResumeDraftEmailData($form, $magiclink, $email)
    {
        $ret = array();
        if ($form) {
            $data['body'] = array();
            // Set email body variables
            $ret['body']['formname'] = $form['content']['settings']['name'];
            $ret['body']['message'] = 'To go back to your draft, visit the link below.';
            $ret['body']['host'] = $form['host'] . "?draft=".urlencode($magiclink)."&form_id=".$form['id'];
            // Set email header
            $ret['emailInfo'] = array();
            $ret['emailInfo']['address'] = $email;
            //$data['emailInfo']['from_address'];
            //$data['emailInfo']['replyto_address'];
            $data['emailInfo']['subject'] = "Form submissions status";
            $data['emailInfo']['name'] = 'City and County of San Francisco';
        }
        return $ret;
    }

    /** Validates form input against form definition
    *
    * @param $request
    * @param @formdefintion
    *
    * @return Array
    */
    private function validateFormRequest($inputs, $definitions)
    {
        $ret = array();
        $validation_rules = array();

        foreach ($definitions as $key => $definition) {
            if ($definition) {
                $definition['name'] = isset($definition['name']) ? $definition['name'] : $definition['id'];

                $validation_rules[] = array($definition['name'] => $this->ValidationRules($definition, $inputs[$field['name']]));
            }
        }

        $validator = \Validator::make($inputs, $validation_rules);

        if ($validator->fails()) {
            $ret = array("status" => 0, "message" => "Failed to validate form inputes");
            //return $validator->errors();
        }

        return $ret;
    }

    /** sets validation rules for all input types
    *
    * @param $definition
    * @param @field
    *
    * @return Array
    */
    private function setValidationRules($definition, $field)
    {
        $rules = array();
        foreach ($definition as $key => $value) {
            switch ($key) {
                case "required": $rules[] = "required";
                    break;
                case "maxlength": $rules[] = "max:".$value;
                    break;
                case "minlength": $rules[] = "min:".$value;
                    break;
                case "maxlength": $rules[] = "max:".$value;
                    break;
                case "option": $rules[] = "Array";
                    break;
                case "type":
                    if ($value === 'email') {
                        $rules[] = "email";
                    } elseif ($value === 'url') {
                        $rules[] = "url";
                    } elseif ($value == 'number') {
                        $rules[] = "numeric";
                    } elseif ($value == 'date') {
                        $rules[] = "date";
                    } elseif ($value == 'time') {
                        $rules[] = "date";
                    }elseif ($value == 'tel') {
                        //$rules[] = "phone"; // telephone validation(not enabled for now), requireds 3rd party library.
                    }
                    break;
                case "formtype":
                    if ($value === 'i14') { //textarea
                        $rules[] = "string";
                    } elseif($value === 'm10'){ //HTML code
                        $rules[] = "string";
                    }
                    break;
                default:
                    break;
            }
        }
        return $rules;
    }
}