<!DOCTYPE html>
<html>
	<head>
		<title>CCSF Webform Builder</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="" />
		<meta name="keywords" content="Modified Bootstrap 3 Form Builder" />
		
		<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="/assets/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="/assets/css/bootstrap-tagsinput.css" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
		<link href="/assets/css/app.css" rel="stylesheet">

		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->		
		
		<!-- Sentyr.io javascript integration -->
		<script src="https://js.sentry-cdn.com/b53658ff4ec749719da39905217d41e0.min.js" crossorigin="anonymous">
			Sentry.init({ dsn: 'https://b53658ff4ec749719da39905217d41e0@sentry.io/1366253' });
		</script> 

		<script type="text/javascript" language="Javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript" language="Javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js"></script>
		<script src="/assets/js/bootstrap.min.js"></script>
		<script src="/assets/js/popper.min.js"></script>
		<script src="/assets/js/bootstrap-tagsinput.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/event-source-polyfill/0.0.9/eventsource.min.js"></script>
		<script src="/assets/js/login.js"></script>
		<script src="/assets/js/fb.js"></script>
		<script src="/assets/js/item.js"></script>
		<script src="/assets/js/form.js"></script>
		<script src="/assets/js/forms-collection.js"></script>
		<script src="/assets/js/fb-view.js"></script>
		<script src="/assets/js/html-templates.js"></script>
	</head>
	<body @if('body-class')class="@yield('body-class')"@endif>
		@yield("content")
	</body>
</html>