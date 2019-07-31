<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Helpers\DataStoreHelper;
use DB;
use Log;

class APIController extends Controller
{
    protected $dataStoreHelper;
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

          $this->dataStoreHelper = new dataStoreHelper();
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
            $results = $this->dataStoreHelper->getSubmittedFormData($formid);
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
          $results = $this->dataStoreHelper->getLookupTable($formid);
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
        $results = $this->dataStoreHelper->getFormTableColumns($formid);
      }
      else{
        $results = ['status' => 0, 'message' => 'Form ID is missing'];
      }
      return response()->json($results);
    }

}
