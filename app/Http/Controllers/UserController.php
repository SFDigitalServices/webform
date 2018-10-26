<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    private $salt;
    public function __construct()
    {
        $this->salt="userloginregister";
    }
    public function login(Request $request){
      $hasher = app()->make('hash');
      $email = $request->input('email');
      $password = $request->input('password');
      $login = User::where('email', $email)->first();

      if ( ! $login) {
            $res['success'] = false;
            $res['message'] = 'Your email or password incorrect!';
            //return response($res);
            //return view('login',['email' => $request->input('email')]);
      } else {
            if ($hasher->check($password, $login->password)) {
                $api_token = sha1(time());
                $create_token = User::where('id', $login->id)->update(['api_token' => $api_token]);
                if ($create_token) {
                    $res['success'] = true;
                    $res['api_token'] = $api_token;
                    $res['message'] = $login;
                    //return view('dashboard',['username' => $email]);
                    //return response()->json($res);
                }
            } else {
                $res['success'] = false;
                $res['message'] = 'You email or password incorrect!';
                //return view('register',['email' => $request->input('email')]);
                //return response($res);
            }
      }
      return response()->json($res);    
    }
    public function logout(Request $request){
        //clears the user api_token
        User::where('api_token', $request->input('api_token'))->update(['api_token' => '']);
        return view('login','');
    }
    public function register(Request $request){
      if ($request->has('username') && $request->has('password') && $request->has('email')) {
        $user = new User;
        $user->username=$request->input('username');
        $user->password=sha1($this->salt.$request->input('password'));
        $user->email=$request->input('email');
        $user->api_token=str_random(60);
        if($user->save()){
            return view('dashboard',['username' => $user->name]);
        } else {
            return view('register',['email' => $request->input('email')]);
        }
      } else {
        return view('login');
      }
    }
   
}