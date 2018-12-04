<?php

session_start();

//load dependencies
require("env.inc");
require("db.inc");

if (!isset($_SESSION['id']) || !isset($_SESSION['email'])) {
  
	$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : "-";
	$username = $username ? $username : "-";
	$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : "-";
	$password = $password ? $password : "-";

	//conditional for local development, assumes all usernames and passwords exist and does not call ldap
	if ($_SERVER['SERVER_NAME'] != "localhost") { 
		
		$ldaphost = "ad.sfgov.org";

		$ldap = ldap_connect($ldaphost) or die ("Could not connect to $ldaphost");

		if (!$bind = ldap_bind($ldap, $username, $password)) {
			print "Incorrect username or password. Please also make sure you're logged into the city network (VPN).";
			die;
		}
		
	}

    //see if user exists
    $user = getUserByEmail($username);

    //create a record if email does not exist in the system
    if (empty($user)) {
      $user = createUser($username);
	}

    //create session
    $_SESSION['id'] = $user['id'];
    $_SESSION['email'] = $user['email'];

} else {
  $user = array('id' => $_SESSION['id'], 'email' => $_SESSION['email']);
  $username = $_SESSION['email'];
}

//parse name
$names = explode('.', $username);
$fname = ucfirst($names[0]);

//get all the forms authored by this user
$forms = getUserForms($user['id']);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SFDS Form Builder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="Modified Bootstrap 3 Form Builder" />

    <link href="<?php print ASSETS; ?>js/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        //padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        padding-bottom: 10px;
      }
	  .header {
		background:#428bca;
		color:#fff;
		text-align:center;
		font-size:24px;
		padding:1em 0;
		margin-bottom:1em;
	  }
	  .floatleft {
		float:left;
	  }
	  .floatright {
		float:right;
	  }
	  .clear {
		clear:both;
	  }
    </style>
    <link href="<?php print ASSETS; ?>js/bootstrap-responsive.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script src="<?php print ASSETS; ?>js/jquery.min.js"></script>

    <script>
  $(document).ready(function(){
      $(".content").show(1500);

      $("a").on("click",function(){
	  $(".content").hide("fast");
	});
    });

$(window).unload(function(){});

$(window).focus(
				   function() {
				     $(".content").show(1500);      
				   }
				   );
    </script>
  </head>

  <body>



	<div class="header">
		<div style="display:block;max-width:1140px;text-align:right;margin:auto">
			<div style="background:#fff;width:232px;float:left;position:absolute;top:0px;box-shadow:0 0 10px #888"/><img src="<?php print ASSETS; ?>images/SF_Digital_Services-logo.png"/></div>
			SAN FRANCISCO <b>DIGITAL SERVICES</b> WEBFORM BUILDER
		</div>
	</div>

	<div class="content" style="display:none">
             <div class="hidden-xs col-sm-1 col-md-2 col-lg-3">&nbsp;</div>
	     <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
               <h1 style="margin-top:15vh">Welcome back <?php print $fname; ?>,</h1>
               <div style="text-align:center;padding:4em;margin:2em;border:1px solid #ddd;border-radius:5px">
                 <div>
                     <a href="create.php" class="btn btn-info btn-lg btn-block">Create a New Form</a>
                 </div>
                 <?php if (!empty($forms)) { ?>
                     <div class="text-muted" style="padding:2em 0">or load an existing form</div>
	             <div>
	                 <?php foreach ($forms as $form) { ?>
		             <a href="create.php?id=<?php print $form['id'];?>" class="recent btn btn-default btn-md btn-block"><?php print $form['content']['settings']['name'];?></a>
		         <?php } ?>
	             </div>
		 <?php } ?>
               </div>
             </div>
	     <div class="hidden-xs col-sm-1 col-md-2 col-lg-3">&nbsp;</div> 
        </div>  

    <script src="<?php print ASSETS; ?>js/jquery.min.js"></script>
    <script src="<?php print ASSETS; ?>js/bootstrap.min.js"></script>
    <script src="<?php print ASSETS; ?>js/fb.js"></script>
  </body>
</html>
