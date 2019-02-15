<?php
namespace App\Helpers;

use App\Form;
use App\User_Form;
use App\User;

class UserHelper
{

     /**
     * Gets a user
     *
     * @return user object
     */
    public static function getUser(Request $request){
		if ($request->input('id')) {
			$key = "id";
			$value = $request->input('id');
		} else if ($request->input('email')) {
			$key = "email";
			$value = $request->input('email');
		}
        $user = User::where($key, $value)->first();
        return $user ? $user : false;
		//return $user ? response()->json($user) : false;
    }

     /**
     * Gets a user
     *
     * @return user object
     */
    public static function getUserByEmail($email){
        $user = User::where('email', $email)->first();
        return $user ? $user : false;
    }

     /**
     * Gets all users of a given form
     *
     * @return array of emails
     */
	public static function getFormUsers($id) {
		$emails = [];
        $user_forms = User_Form::where('form_id', $id)->get();
		foreach ($user_forms as $user_form) {
			$user = User::where('id', $user_form->user_id)->first();
			$emails[] = $user->email;
		}
		return $emails;
	}
	
     /**
     * Formats emails array
     *
     * @return a comma separated string of emails
     */
	public static function formatAuthors($arr) {
		return implode(", ", $arr);
	}
}