<?php

session_start();

//load db
require("db.inc");

if (!isset($_SESSION['id']) || !isset($_SESSION['email'])) {
  print "Permission denied. Please make sure you are logged in.";
  die;
}

if (isset($_GET['action'])) {

  $form = false;
  $id = false;

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //todo check permissions
    
  }

  if ($_GET['action'] == "clone") {

    $newForm = cloneForm($id, $_SESSION['id']);
    header("Location: http://10.250.60.236/webform/create.php?id=".$newForm['id']);
    die;

  } else if ($_GET['action'] == "delete") {

    $deleted_id = deleteForm($id);
    header("Location: http://10.250.60.236/webform/editor.php");
    die;

  }


}

?>