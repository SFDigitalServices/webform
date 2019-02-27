<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function createView(Request $request){
        //$form_id = $request->input('form_id');
        return view('create', ['user_id' => $request->input('user_id'), 'api_token' => $request->input('api_toekn')]);
    }

    public function login(Request $request){
      $hasher = app()->make('hash');
      $email = $request->input('email');
      $password = $request->input('password');
      $login = User::where('email', $email)->first();

      if ( ! $login) {
            $res['message'] = 'Your email or password incorrect!';
            return view('login',['email' => $request->input('email'), 'message' => $res['message']]);
      } else {
            if ($hasher->check($password, $login->password)) {
                $api_token = sha1(time());
                $create_token = User::where('id', $login->id)->update(['api_token' => $api_token]);
                if ($create_token) {
                    $res['success'] = true;
                    $res['api_token'] = $api_token;
                    $res['message'] = $login;
                }
            } else {
                $res['message'] = 'You email or password incorrect!';
                return view('login',['email' => $request->input('email'), 'message' => $res['message']]);
            }
      }
      return view('editor',['user_id' => $login['id'], 'api_token' => $api_token, 'name' => $login['name']]);
      //return redirect()->route('form.editor', ['user_id' => $login['id'], 'api_token' => $api_token, 'name' => $login['name']]);
    }
    public function logout(Request $request){
        //clears the user api_token
        User::where('api_token', $request->input('api_token'))->update(['api_token' => '']);
        return view('login','');
    }
	/*
    public function register(Request $request){
      if ($request->has('password') && $request->has('email')) {
        $user = new User;
        //$user->password=sha1($this->salt.$request->input('password'));
		$hasher = app()->make('hash');
        $user->password=$hasher->make($request->input('password'));
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->api_token=str_random(60);
        if($user->save()){
			print_r($user);
			return;
			//return view('login');
            //return view('dashboard',['username' => $user->name]);
        } else {
            return view('register',['email' => $request->input('email')]);
        }
      } else {
        return view('login');
      }
    }
	public function delete(Request $request) {
        $user_delete = User::where([['email', $request->input('email')]])->delete();
		return 'deleted';
	}
	public function debug(Request $request) {
		$login = User::where('email', $request->input('email'))->first();
		print_r($login);
		die;
	}
	*/
}