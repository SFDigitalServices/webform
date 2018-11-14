@extends('layouts.app')
@section('content')
<style>
			body {background:#222}
			.hero-header {
				background: url(/assets/images/bg4.jpg) no-repeat center center / auto 100%;
			}
			@media only screen and (min-width: 64.063em) {
				.hero-header {
					background: url(/assets/images/bg4.jpg) no-repeat center center / 100% auto;
				}
			}
		</style>
<header class="hero-header text-center">
	<h1 class="hero-title c-white t-shadow">Webform Builder</h1>

	<div class="row">
		<div class="medium-9 medium-centered columns">
			<p class="delta t-sans t-shadow c-white">City and County of San Francisco - Digital Services.</p>
			<br/><br/><br/>

			<section class="row margin-bottom--2x">
				<div-- class="medium-10 medium-centered columns">
					
				<form class="form-card margin-bottom--2x" id="login-form" action="/home" method="POST">
						<div class="row">
							<div class="medium-12 columns padding-left padding-right padding-top padding-bottom">
								<header class="margin-bottom">
									<h3 class="t-serif gamma">Login</h3>
								</header>

								<div class="form-email">
									<label for="email" class="">Email Address</label>
									<input name="email" type="email" placeholder="first.last@sfgov.org" class="" />
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

					<!--div class="note text-center bg-smoke padding margin-top">
						<p class="t-small no-margin">Forgot your email or password?
							<a target="_blank" href="https://bifrost.sfgov.org/" class="button-link t-small">DT IAM Support</a>
						</p>
					</div-->
				</div>
			</section>

		</div>
	</div>
</header>


@endsection