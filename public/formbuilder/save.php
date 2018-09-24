<?php

session_start();

//load db
require("db.inc");

if (!isset($_SESSION['id']) || !isset($_SESSION['email'])) {
  print "Permission Denied. Please make sure you're logged in to view this page";
  die;
}

  //check POST
  $post = file_get_contents('php://input');
  parse_str($post, $form);
  $form['content'] = str_replace('\"','\\\\\"', $form['content']);
  $form['content'] = str_replace("'","&apos;", $form['content']);
  $form['content'] = str_replace("<","&lt;",$form['content']);
  $form['content'] = str_replace(">","&gt;",$form['content']);
  $form['content'] = json_decode($form['content']);

  //make sure this form has an id
  if (isset($form['id'])) {
    if ($form['id'] != 0) {
      //todo check permission
      //update existing form
      $newForm = updateForm($form, $_SESSION['id']);
    } else {
      //create new form
      $newForm = createForm($form, $_SESSION['id']);
    }
  }

print json_encode($newForm);

?>