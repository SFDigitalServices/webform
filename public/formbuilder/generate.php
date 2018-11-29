<?php

//load dependencies
require("env.inc");
require("db.inc");

//check GET
if (!isset($_GET['id'])) {
    print "Error. This form does not exist.";
    die;
}

//todo make sure this form is public

//get form
$form = getForm($_GET['id']);;
$sections = array();

$content = json_decode($form['content'], true);

print generateHTML($content);


?>