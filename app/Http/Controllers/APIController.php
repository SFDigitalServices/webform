<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Application;
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
      $formid = $request->input('formid');;
      if ($formid) {
          $tablename = "forms_" . $formid;
          $results = DB::table($tablename)
          ->join('enum_mappings', function ($join) use($tablename){
            $join->on('enum_mappings.form_table_id', '=', $tablename.'.id');
          })
          ->select('enum_mappings.value', $tablename.'.*')
          ->get();

          foreach ($results as $result) {
            Log::info(print_r($result,1));
          }
      }
    }
}
