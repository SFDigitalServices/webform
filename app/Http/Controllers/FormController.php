<?php
 
namespace App\Http\Controllers;
 
use App\People;
use App\Group;
use App\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class FormController extends Controller{

    public function getData($id){
        $product  = People::find($id);
        return response()->json($product); 
    }

    public function getOptions(){
        $data = Group::all(["id", "name as value"]);
        return response()->json($data);
    }

    public function saveData(Request $request){
        $prod = People::find($request->input("id"));
        $prod->fill($request->all());
        $prod->save();

        return response()->json(["status" => "ok"]);
    }
    public function doUpload(Request $request){
        //in a real app you will move file to the persistent storage here
        $upload = $request->file('upload');
        $path = md5(time()).".".$upload->getClientOriginalExtension();
        $upload->move("./storage", $path);

        $store = new File;
        $store->name = $upload->getClientOriginalName();
        $store->path = $path;
        $store->save();

        return response()->json([
            "status" => "server",
            "value" =>  $store["id"]
        ]);
    }

    public function getUserById($id){
        $user = User::find($id);
        return response()->json($user);
    }

    public function getUserByEmail($email){
        $user = User::find($email);
        return response()->json($user);
    }
    public function createUser(){
        DB::table('user')->insert([
            [ 'email' => 'janedoe'] ]);
    }
    public function getUserForms(){
    }
    public function getForm(){
    }
    public function createForm(){
    }
    public function updateForm(){
    }
    public function cloneForm(){
    }
    public function deleteForm(){
    }
    public function getFormUsers(){
    }
    public function listOtherAuthors(){
    }
    function jsonDecode($json, $assoc = false)
    {
        $ret = json_decode($json, $assoc);
        if ($error = json_last_error())
        {
            $errorReference = [
                JSON_ERROR_DEPTH => 'The maximum stack depth has been exceeded.',
                JSON_ERROR_STATE_MISMATCH => 'Invalid or malformed JSON.',
                JSON_ERROR_CTRL_CHAR => 'Control character error, possibly incorrectly encoded.',
                JSON_ERROR_SYNTAX => 'Syntax error.',
                JSON_ERROR_UTF8 => 'Malformed UTF-8 characters, possibly incorrectly encoded.',
                JSON_ERROR_RECURSION => 'One or more recursive references in the value to be encoded.',
                JSON_ERROR_INF_OR_NAN => 'One or more NAN or INF values in the value to be encoded.',
                JSON_ERROR_UNSUPPORTED_TYPE => 'A value of a type that cannot be encoded was given.',
            ];
            $errStr = isset($errorReference[$error]) ? $errorReference[$error] : "Unknown error ($error)";
            throw new \Exception("JSON decode error ($error): $errStr");
        }
        return $ret;
    }
}