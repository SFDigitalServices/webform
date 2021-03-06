<?php

//resets session
session_start();
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
session_regenerate_id(true);
	
//load dependencies
require("env.inc");
require("db.inc");
?>
<!DOCTYPE html>
<html>
<head>
<title>CCSF Webform Builder</title>
<!--
<script type="text/javascript" language="Javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" language="Javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js"></script>
-->
<script type="text/javascript" language="Javascript" src="<?php print ASSETS; ?>js/toolkit.js"></script>
<link rel="stylesheet" href="<?php print ASSETS; ?>css/toolkit.css"> 
<style>
	body {background:#222}
	.hero-header {
		background: url(<?php print ASSETS; ?>images/bg4.jpg) no-repeat center center / auto 100%;
	}
	@media only screen and (min-width: 64.063em) {
		.hero-header {
			background: url(<?php print ASSETS; ?>images/bg4.jpg) no-repeat center center / 100% auto;
		}
	}
</style>
</head>
<body>

<header class="hero-header text-center">
	<h1 class="hero-title c-white t-shadow">Webform Builder</h1>

	<div class="row">
		<div class="medium-9 medium-centered columns">
			<p class="delta t-sans t-shadow c-white">City and County of San Francisco - Digital Services.</p>
			<br/><br/><br/>

			<section class="row margin-bottom--2x">
				<div class="medium-10 medium-centered columns">
					<form class="form-card margin-bottom--2x" action="editor.php" method="POST">
						<div class="row">
							<div class="medium-12 columns padding-left padding-right padding-top padding-bottom">
								<header class="margin-bottom">
									<h3 class="t-serif gamma">Login</h3>
								</header>

								<div class="form-email">
									<label for="email" class="">Email Address</label>
									<input name="username" type="email" placeholder="first.last@sfgov.org" class="" />
								</div>

								<div class="form-password">
									<label for="password" class="">Password</label>
									<input name="password" type="password" placeholder="Password" class="" />
								</div>

								<div class="form-submit">
									<button class="button primary expand-small">Continue</button>
								</div>
							</div>
						</div>

					</form>

					<div class="note text-center bg-smoke padding margin-top">
						<p class="t-small no-margin">Forgot your email or password?
							<a target="_blank" href="https://bifrost.sfgov.org/" class="button-link t-small">DT IAM Support</a>
						</p>
					</div>
				</div>
			</section>

		</div>
	</div>
</header>

</body>
</html> 