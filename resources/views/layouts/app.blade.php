<!DOCTYPE html>
<html>
	<head>
		<title>CCSF Webform Builder</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="" />
		<meta name="keywords" content="Modified Bootstrap 3 Form Builder" />
		
		<!--<link rel="stylesheet" href="/assets/css/toolkit.css">-->
		<link href="/assets/js/bootstrap.min.css" rel="stylesheet">
		<link href="/assets/js/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="/assets/js/bootstrap-tagsinput.css" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->		
		
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
      #SFDSWFB-components{
        min-height: 600px;
        margin-top: 5px;
      }
      #SFDSWFB-target{
        min-height: 200px;
        border: 1px solid #ccc;
        padding: 5px;
		transition: height .3s;
		overflow: hidden;
      }
	  #SFDSWFB-target .form-group {
		width:100%;
		margin-left:0;
	  }
      #SFDSWFB-target .component{
        border: 1px solid #fff;
      }
      #SFDSWFB-target .floatleft, #SFDSWFB-target .floatright{
		width:45%;
	  }
      #SFDSWFB-temp{
        width: 500px;
        background: white;
        border: 1px dotted #ccc;
        border-radius: 10px;
      }
	  .popover {
		  min-width:245px;
	  }
      .popover-content form {
        margin: 0 auto;
        width: 213px;
      }
      .popover-content form .btn{
        margin-right: 10px
      }
	  .popover-content select {
		border: 1px solid #ccc;
		height: 34px;
		padding: 6px 12px;
		width: 100%;
		border-radius:3px;
		margin-bottom: 1em;
	  }

	  .popover-content select.showHide {
		width: 50%;
	  }

      #SFDSWFB-snippet{
        min-height: 250px;
      }

      #SFDSWFB-source{
        min-height: 100px;
      }
	  
	  .form-horizontal .component {
	    padding:0 17px
	  }
	  
	  .form-horizontal .control-label {
	    text-align:left;
		padding-bottom:5px;
	  }

	  .tabbable li.active a:focus {
	    outline: none;
	  }
	  
	  .form-section {
		padding-bottom: 1em;
		margin-bottom: 1em;
		border-bottom: 1px solid #aaa;
	  }
	  hr.and:before {
		content: "&";
		position: relative;
		left: calc(45%);
		top: -12px;
		background: #fff;
		width: 24px;
		color:#bbb;
		display:block;
		text-align:center;
	  }
	  .accordion-header {
		font-size:1.5em;
		border-bottom:1px solid #eee;
		margin:1em 0;
	  }
	  .clickMenu {
		display:block;
		float:right;
		width:auto;
		text-align:left;
		margin-top:20px;
		position:relative;
	  }
	  .clickMenu ul {
		display:none;
		position:absolute;
		top:2.5em;
		right:0;
		padding:1em 0;
		background:#fff;
		border:1px solid #ddd;
		list-style-type:none;
		box-shadow:0 0 5px #ddd;
		border-radius:3px;
	  }
	  .clickMenu li {
		display:block;
		padding:.5em 2em;
		color:#428bca;
		cursor:pointer;
	  }
	  .clickMenu li:hover {
		background:#eee;
		color:#2a6496;
	  }
.tt-query, /* UPDATE: newer versions use tt-input instead of tt-query */
	     .tt-hint {
	   width: 396px;
	   height: 30px;
	   padding: 8px 12px;
	     font-size: 24px;
	     line-height: 30px;
	   border: 2px solid #ccc;
	       border-radius: 8px;
	   outline: none;
 }

.tt-query { /* UPDATE: newer versions use tt-input instead of tt-query */
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
 }

.tt-hint {
	   color:#999;
 }

.tt-menu { /* UPDATE: newer versions use tt-menu instead of tt-dropdown-menu */
	   width: 422px;
  margin-top: 12px;
	   padding: 8px 0;
	     background-color: #fff;
	     border: 1px solid #ccc;
	       border: 1px solid rgba(0, 0, 0, 0.2);
	     border-radius: 8px;
	     box-shadow: 0 5px 10px rgba(0,0,0,.2);
 }

.tt-suggestion {
	   padding: 3px 20px;
  font-size: 18px;
	     line-height: 24px;
 }

.tt-suggestion.tt-cursor, .tt-suggestion:hover { /* UPDATE: newer versions use .tt-suggestion.tt-cursor */
	   color: #fff;
  background-color: #0097cf;
  cursor: pointer;
 }

.tt-suggestion p {
	   margin: 0;
 }
	.condition, .calculation {
		position:relative;
	}
	.fa-minus-circle.conditionIcon {
		position:absolute;
		right:-1.2em;
		font-size:1.5em;
		color:#eee;
		cursor:pointer;
	}
	.fa-minus-circle.conditionIcon:hover {
		color:#aaa;
	}
	.condition, .calculation {
		border-bottom:1px solid transparent;
	}
	.condition:hover, .calculation:hover {
		border-bottom:1px solid #000;
	}
		  
		</style>
		<!-- Sentyr.io javascript integration -->
		<script src="https://js.sentry-cdn.com/b53658ff4ec749719da39905217d41e0.min.js" crossorigin="anonymous">
			Sentry.init({ dsn: 'https://b53658ff4ec749719da39905217d41e0@sentry.io/1366253' });
		</script> 

		<script type="text/javascript" language="Javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript" language="Javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js"></script>
		<!--<script type="text/javascript" language="Javascript" src="/assets/js/toolkit.js"></script>-->
		<script src="/assets/js/bootstrap.min.js"></script>
		<script src="/assets/js/bootstrap-tagsinput.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
		<script src="/assets/js/login.js"></script>
		<script src="/assets/js/fb.js"></script>
	</head>
	<body>
		<content>
			@yield("content")
		</content>
	</body>
</html>