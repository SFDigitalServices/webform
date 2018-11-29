<!DOCTYPE html>
<html>
	<head>
		<title>CCSF Webform Builder</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="" />
		<meta name="keywords" content="Modified Bootstrap 3 Form Builder" />
		
		<link href="/assets/js/bootstrap.min.css" rel="stylesheet">
		<link href="/assets/js/bootstrap-responsive.min.css" rel="stylesheet">

		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->		
		
		<link rel="stylesheet" href="/assets/css/toolkit.css"> 
		<style>
		  body {
			//padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
			padding-bottom: 10px;
		  }
			.hero-header {
				background: url(/assets/images/bg4.jpg) no-repeat center center / auto 100%;
			}
			@media only screen and (min-width: 64.063em) {
				.hero-header {
					background: url(/assets/images/bg4.jpg) no-repeat center center / 100% auto;
				}
			}
			h1 {
				color:#333;
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
		<script type="text/javascript" language="Javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript" language="Javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js"></script>
		<script type="text/javascript" language="Javascript" src="/assets/js/toolkit.js"></script>
		<script src="/assets/js/bootstrap.min.js"></script>
		<script src="/assets/js/fb.js"></script>
	</head>
	<body>
		<content>
			@yield("content")
		</content>
	</body>
</html>