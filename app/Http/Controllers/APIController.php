<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Form;
use DB;
use Log;

class APIController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // defines operations that need to be protected
        $this->middleware('auth', ['only' =>
          [
            'getFormData',
            'getFormSchema',
            'getLookupTable'
          ]]);
    }

    /**
     * Get all data from form.
     *
     * @param $request
     *
     * @return JSON response
     */
    public function getFormData(Request $request)
    {
        $formid = $request->input('formid');
        $results = array();
        if ($formid) {
            try {
                $tablename = "forms_" . $formid;
                $results = DB::table($tablename)
                              ->orderBy($tablename.'.id', 'asc')
                              ->get();
            } catch (\Illuminate\Database\QueryException $ex) {
                $results = ['status' => 0, 'message' => $ex->getMessage()];
            }
        }
        else{
          $results = ['status' => 0, 'message' => 'Form ID is missing'];
        }
        return response()->json($results);
    }

     /**
     * Get lookup values for the given form table.
     *
     * @param $request
     *
     * @return JSON response
     */
    public function getLookupTable(Request $request)
    {
        $formid = $request->input('formid');
        $results = array();
        if ($formid) {
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
        }
        else{
          $results = ['status' => 0, 'message' => 'Form ID is missing'];
        }
        return response()->json($results);
    }
    /**
     * Prints form table schema.
     *
     * @param $request
     *
     * @return JSON response
     */
    public function getFormSchema(Request $request)
    {
      $formid = $request->input('formid');
      $results = array();
      if ($formid) {
          $tablename = "forms_" . $formid;
          try {
              $results = DB::select('SHOW COLUMNS FROM '. $tablename);
              $columns = $this->transformColumns($results);
          }
          catch(\Illuminate\Database\QueryException $ex){
            $results = ['status' => 0, 'message' => $ex->getMessage()];
          }
      }
      else{
        $results = ['status' => 0, 'message' => 'Form ID is missing'];
      }
      return response()->json($results);
    }

    /**
     * Transform columns
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
}
