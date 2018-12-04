<?php
namespace App\Http\Controllers;

use App\Form;
use Auth;
use App\User_Form;
use Validator;

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
            ['create',
            'save',
            'clone',
            'embedJS',
            'getUserForms',
            'getForm'
            ]]);
    }

    public function getIndex(Request $request){
        return response()->json('all');
    }

     /**
     * Gets all the forms for the current logged in user.
     *
     * @return json object
     */
    public function getUserForms(Request $request){
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
     /**
     * Gets a form for the current logged in user.
     *
     * @return json object
     */
    public function getForm(Request $request){
        $form_id = $request->input('form_id');
        $form = Form::where('id', $form_id)->first();
        
        return response()->json($form);
    }

     /**
     * Saves the edited form for the current logged in user.
     *
     * @return bool 
     */
    public function save(Request $request){
        //$post = file_get_contents('php://input');
        $post = $request->input('content');

        parse_str($post, $form);
        $form['content'] = str_replace('\"','\\\\\"', $form['content']);
        $form['content'] = str_replace("'","&apos;", $form['content']);
        $form['content'] = str_replace("<","&lt;",$form['content']);
        $form['content'] = str_replace(">","&gt;",$form['content']);
        $form['content'] = json_decode($form['content']);

        $form_id = $request->input('form_id');

        if(!$form_id)
        {
            create($request);
            return;
        }
        $form = Form::where('id', $form_id)->first();
        if($form){
            $form->content = $request->input('content');
            return response()->json(['status' => 1, 'data' => $form->save()]);
        }
        return response()->json(['status' => 0, 'message' => 'Failed to save form']); 
    }

     /**
     * Clone from an existing form.
     *
     * @return json object
     */
    public function clone(Request $request){
        $form_id = $request->input('form_id');
        $form = Form::where('id', $form_id)->first();
        
        if($form){
            $content = json_decode($form['content']);
            //return $content->settings->name;
            $content->settings->name = "Clone of ".$content->settings->name;
            $cloned_form = Form::create(['content' => json_encode($content)] );

            if( $cloned_form ){
                // create entry in user_form
                $user_id = $request->input('user_id');
                $user_form = User_Form::create(['user_id' => $user_id, 'form_id' => $cloned_form->id]);
                if($user_form){
                    return response()->json(['status' => 1, 'data' => $user_form]);  
                }
            }
            return response()->json(['status' => 0, 'message' => 'Failed to clone form']); 
        }
        return response()->json(['status' => 0, 'message' => 'Form doesn\'t exist']); 
    }
     /**
     * Creates a new form for the current logged in user.
     *
     * @return json object
     */
    public function create(Request $request) {
        // validate form data
        if( $this->validateForm($request) ) {
            $form = Form::create(['content' => $request->input('content')] );
            
            if( $form ){
                // create entry in user_form
                $user_id = $request->input('user_id');
                $user_form = User_Form::create(['user_id' => $user_id, 'form_id' => $form->id]);
                if($user_form){
                    return response()->json(['status' => 1, 'data' => $user_form]);  
                }
            }
            return response()->json(['status' => 0, 'message' => 'Failed to create form']);  
        }      
    }

     /**
     * Creates an embed JS for the form
     *
     * @return json object
     */
    public function embedJS(Request $request){
        return 'hi';
    }

     /**
     * Deletes a form
     *
     * @return json object
     */
    public function delete(Request $request) {
        $user_id = $request->input('user_id');
        $form_id = $request->input('form_id');

        // soft deletes
        $user_form_delete = User_Form::where([['user_id','=', $user_id], ['form_id', '=', $form_id]])->delete();
        if( $user_form_delete ){
            $form_delete = Form::where([['id', $form_id]])->delete();
            if( $form_delete ){
                 return response()->json(['status' => 1, 'message' => 'Deleted form from user']); 
            }
        }
       return response()->json(['status' => 0, 'message' => 'Failed to delete form']);      
    }

     /**
     * validates form data
     *
     * @return json object
     */
    protected function validateForm(Request $request){
        $validator = Validator::make($request->all(), [
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return false;
        }
        return true;
    }
}
