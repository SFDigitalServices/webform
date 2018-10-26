<?php
namespace App\Http\Controllers;

use App\Form;
use Auth;
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
        $this->middleware('auth');
    }

    public function getIndex(Request $request){
        return response()->json('all');
    }
    public function getEditor(Request $request){
        $user_id = $request->input('user_id');
        $user = Auth::user()->where('id', $user_id)->get();

        $user_forms = User_Form::where('user_id', $user_id)->get();
        $forms = array();
        foreach($user_forms as $form){
            array_push($forms, Form::where('id', $form['form_id'])->get()->first());
        }
        return response()->json($forms);
        //return view('editor', ['name' => $user->name, 'forms' => $user_forms]);
    }
    public function saveForm(Request $request){
            return 'save';
    }
    public function createForm(Request $request) {
        $form = Form::create($request->all());
        return response()->json($form);        
    }
    public function embedJS(Request $request){
        return 'hi';
    }
    public function update(Request $request, $id) {
        $form = Form::find($id);
        $updated = $form->update($request->all());
        
        return response()->json(['updated' => $updated]);        
    }
    public function delete($id) {
        $count = Form::destroy($id);
        return response()->json(['deleted' => $count == 1]);      
    }
}
