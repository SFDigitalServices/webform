<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
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
            'getFormSchema'
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
      if ($formid) {
          $tablename = "forms_" . $formid;
          $results = DB::table($tablename)
          ->orderBy($tablename.'.id', 'asc')
          ->get();

          foreach ($results as $result) {
            //Log::info(print_r($result,1));
          }
          return response()->json($results);
      }
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
      if ($formid) {
          $tablename = "forms_" . $formid;
          $results = DB::select('SHOW COLUMNS FROM '. $tablename);

          $columns = $this->transformColumns($results);
          return response()->json($columns);
      }
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
