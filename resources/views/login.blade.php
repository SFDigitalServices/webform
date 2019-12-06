@extends('layouts.app')
@section('body-class', 'login')
@section('content')
	<div class="container container-fluid container-login">
		<div class="row">
			<header class="col-xs-12 col-sm-6 col-sm-offset-3">
				<h1 class="text-center">Webform Builder</h1>

				<p class="text-center">City and County of San Francisco</p>
				<p class="text-center">Digital Services</p>
			</div>
		</header>

		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel">
					<form class="panel-body" id="login-form" action="<?php if ((!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on") && (substr($_SERVER["HTTP_HOST"], 0, 9) != "localhost" && $_SERVER["HTTP_HOST"] != "webform.test")) print ("https://" . $_SERVER["HTTP_HOST"]); ?>/home" method="POST">
						<h2>Login</h2>

						<div class="form-group">
							<label for="email">Email Address</label>
							<input name="email" type="email" placeholder="first.last@sfgov.org" class="form-control input-lg" />
						</div>

						<div class="form-group">
							<label for="password">Password</label>
							<input name="password" type="password" placeholder="Password" class="form-control input-lg" />
						</div>

						<button class="btn btn-primary btn-lg">Continue</button>
					</form>
				</div>
			</div>
		</div>
</header>
@endsection