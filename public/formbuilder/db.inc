<?php
//all db stuff into this file

function openDB() {
	 // Create connection
	 $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
	 // Check connection
	 if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	 } 
	 return $conn;
}

function closeDB($conn) {
	 $conn->close();
}

function getUserById($id) {
	 $conn = openDB();
	 $sql = "SELECT * FROM users WHERE id=".$id;
	 $result = $conn->query($sql);

	 if ($result->num_rows > 0) {
	        // output data of each row
	        while($row = $result->fetch_assoc()) {
			closeDB($conn);
			return $row;
	 	}
	 } else {
                closeDB($conn);
   	   	return array();
	 }
}

function getUserByEmail($email) {
         $conn = openDB();
         $sql = "SELECT * FROM users WHERE email='".$email."'";
         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                        closeDB($conn);
                        return $row;
                }
         } else {
                closeDB($conn);
                return array();
         }
}

function createUser($email) {
	 $conn = openDB();
	 $sql = "INSERT INTO users (email) VALUES ('".$email."')";
	 if ($conn->query($sql) === TRUE) {
	   $last_id = $conn->insert_id;
	   //todo test by adding a new user to a form and then signing up
	   $sql = "UPDATE user_form SET user_id = '".$last_id."' WHERE user_id = '".$email."'";
	   $conn->query($sql);
           closeDB($conn);
	   return array('id' => $last_id, 'email' => $email);
	 } else {
	   print "Error: ".$sql."<br/>".$conn->error;
           closeDB($conn);
	 }
}

function getUserForms($user_id) { //todo needs testing
         $conn = openDB();
         $sql = "SELECT forms.*, user_form.* FROM forms RIGHT JOIN user_form ON forms.id = user_form.form_id WHERE user_form.user_id=".$user_id;
         $result = $conn->query($sql);

	 $forms = array();
         if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
			   $row['content'] = json_decode($row['content'], true);
			   $forms[] = $row;
                }
	 }
         closeDB($conn);
	 return $forms;
}

function getForm($id) {
         $conn = openDB();
         $sql = "SELECT * FROM forms WHERE id=".$id;
         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                        closeDB($conn);
                        return $row;
                }
         } else {
                closeDB($conn);
                return array();
         }
}

function createForm($form, $user_id) {
         $conn = openDB();
         $sql = "INSERT INTO forms (content) VALUES ('".json_encode($form['content'])."')";
         if ($conn->query($sql) === TRUE) {
           $last_id = $conn->insert_id;
	   //create new join
           $sql = "INSERT INTO user_form (user_id, form_id) VALUES (".$user_id.", ".$last_id.")";
           $conn->query($sql);
	   $newForm = getForm($last_id);
           closeDB($conn);
           return $newForm;
         } else {
           print "Error: ".$sql."<br/>".$conn->error;
           closeDB($conn);
         }
}

function updateForm($form, $user_id) {
	 //todo parse authors


         $conn = openDB();
         $sql = "UPDATE forms SET content='".json_encode($form['content'])."' WHERE id=".$form['id'];
         if ($conn->query($sql) === TRUE) {
           closeDB($conn);
           return $form;
         } else {
           print "Error: ".$sql."<br/>".$conn->error;
           closeDB($conn);
         }
}

function cloneForm($form_id, $user_id) {
	 $form = getForm($form_id);
	 $content = json_decode($form['content']);
	 $content->settings->name = "Clone of ".$content->settings->name;
	 $form['content'] = $content;
	 //$form['content'] = json_encode($content);
	 unset($form['id']);
	 return createForm($form, $user_id);
}

function deleteForm($id) {
	 //todo check if you're the only author


         $conn = openDB();
         $sql = "DELETE FROM forms WHERE id=".$id;
         if ($conn->query($sql) === TRUE) {
	   $sql = "DELETE FROM user_form WHERE form_id=".$id;
	   if ($conn->query($sql) === TRUE) {
	              closeDB($conn);
          	       return $id;
	   } else {
	     print "Error: ".$sql."<br/>".$conn->error;
	     closeDB($conn);
	   }
         } else {
           print "Error: ".$sql."<br/>".$conn->error;
           closeDB($conn);
	 }
}

function getFormUsers($form_id) { //todo needs testing
         $conn = openDB();
         $sql = "SELECT users.*, user_form.* FROM users RIGHT JOIN user_form ON users.id = user_form.user_id WHERE user_form.form_id=".$form_id;
         //$sql = "SELECT forms.*, user_form.* FROM forms RIGHT JOIN user_form ON forms.id = user_form.form_id WHERE user_form.user_id=".$user_id;
         //$sql = "SELECT users.*, user_form.user_id, user_form.form_id FROM users, INNER JOIN user_form ON users.id = user_form.user_id WHERE user_form.form_id=".$form_id;
         $result = $conn->query($sql);

	 $users = array();
         if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
			$users[] = $row;
                }
	}
	closeDB($conn);
	return $users;
}

function listOtherAuthors($form_id, $email) {
	 $users = getFormUsers($form_id);
	 $trim = false;
	 $output = '';
	 foreach ($users as $user) {
	     if ($user['email'] != $email) {
	     	$output .= $user['email'].", ";
		$trim = true;
	     }
	 }
	 $output = $trim ? substr($output, 0, -2) : $output;
	 return $output;
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
?>
