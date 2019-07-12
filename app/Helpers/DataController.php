<?php
namespace App\Http\Controllers;

use App\Form;
use Auth;
use Log;
use App\User;
use App\User_Form;
use Illuminate\Http\Request;

class FormController extends Controller
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
            'purgeCSV'
          ]]);
    }


}
