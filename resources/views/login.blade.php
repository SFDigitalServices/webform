@extends('layouts.app')
@section('content')
<style>
	html,
	body {
		height: 100%;
	}

	body {
		background:#222 url(/assets/images/bg4.jpg) no-repeat center center;
		background-size: 100% 100%;
		min-height: 100%;
	}

	.row {
		margin-top: 6em;
	}

	header,
	h1 {
		font-size: 2em;
		color: #fff;
		text-shadow: 0 0 18px #000;
	}

	h2 {
		margin-top: 0;
	}

	.panel {
		padding: 2em;
	}
</style>
	<div class="container container-fluid">
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
					<form class="panel-body" id="login-form" action="/home" method="POST">
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