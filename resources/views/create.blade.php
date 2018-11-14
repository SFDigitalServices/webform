<?php

session_start();

//load db
//require("db.inc");

/*if (!isset($_SESSION['id']) || !isset($_SESSION['email'])) {
  print "Permission denied. Please make sure you are logged in.";
  die;
}
*/
$form = false;

if (isset($_GET['id'])) {
    $form = getForm($_GET['id']);
  //todo check permissions
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SFDS Form Builder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="Modified Bootstrap 3 Form Builder" />

    <link href="js/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
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

      #SFDSWFB-source{
        min-height: 500px;
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
    </style>
    <link href="js/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="js/bootstrap-tagsinput.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script>
  $(document).ready(function(){
      $(".content").show(1500);

		var settings = {
			"async": true,
			"crossDomain": true,
			"url": "/form/getForm",
			"method": "POST",
			"headers": {
				"authorization": "Bearer <?php echo $api_token;?>",
				"content-type": "application/x-www-form-urlencoded",
				"cache-control": "no-cache"
			},
			"data": {
				"user_id": <?php echo $user_id;?>,
                "api_token": <?php echo $api_token;?>,
			}
		}
		$.ajax(settings).done(function (response) {
			$.each(response, function(index, element) {
				//console.log(element);
            	addedElement = $('.forms').append('<div>').append($('<a>', {
                	text: 'Form id = ' + element.id,
					id: 'form-' + element.id,
				}));
				
        	});
		});
        </script>
  </head>

  <body>



	<div class="header">
		<div style="display:block;max-width:1140px;text-align:right;margin:auto">
			<div style="background:#fff;width:232px;float:left;position:absolute;top:0px;box-shadow:0 0 10px #888"/><img src="SF_Digital_Services-logo.png"/></div>
			SAN FRANCISCO <b>DIGITAL SERVICES</b> WEBFORM BUILDER
		</div>
	</div>
  
    <div class="container">
		<div class="row clearfix">
        <div class="col-md-6">
            <h2>Drag & Drop Components</h2>
            <hr>
          <div class="tabbable">
            <ul class="nav nav-tabs" id="SFDSWFB-navtab">
              <li class="active"><a href="#SFDSWFB-1" data-toggle="tab">Contact</a></li>
              <li class><a href="#SFDSWFB-2" data-toggle="tab">Data</a></li>
              <li class><a href="#SFDSWFB-3" data-toggle="tab">Input</a></li>
              <li class><a href="#SFDSWFB-4" data-toggle="tab">Select</a></li>
              <li class><a href="#SFDSWFB-5" data-toggle="tab">Misc</a></li>
              <li class><a id="SFDSWFB-sourcetab" href="#SFDSWFB-6" data-toggle="tab">Rendered</a></li>
              <li class><a href="#SFDSWFB-7" data-toggle="tab">Settings</a></li>
            </ul>
            <form class="form-horizontal" id="SFDSWFB-components">
              <fieldset>
                <div class="tab-content">

                  <div class="tab-pane active" id="SFDSWFB-1">
				  
                    <div class="form-group component" data-formtype="c02" data-type="text" data-name="name" data-required="true" rel="popover" title="Name" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
							<div class='accordion-section general'>
								<div class='accordion-header'>General</div>
								<div class='accordion'>
									<label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
									<label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
									<label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
								</div>
							</div>
							<hr/>
							<button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- Name input-->
                      <label class="control-label valtype" for="input01" data-valtype='label'>Name</label>
                      <div class="">
                        <input type="text" placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'>Supporting help text</p>
                      </div>
                    </div>
					
                    <div class="form-group component" data-formtype="c04" data-type="email" data-name="email" data-required="true" rel="popover" title="Email" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- Email input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>Email</label>
                      <div class="">
                        <input type="text" placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'>Supporting help text</p>
                      </div>
                    </div>
					
                    <div class="form-group component" data-formtype="c06" data-type="tel" data-name="phone" data-minlength="10" data-required="true" rel="popover" title="Phone" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
 						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							 <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- Phone input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>Phone</label>
                      <div class="">
                        <input type="text" placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'>Supporting help text</p>
                      </div>
                    </div>

                    <div class="form-group component" data-formtype="c08" data-type="text" data-name="address" data-required="true" rel="popover" title="Address" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

					  <!-- Address input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>Address</label>
                      <div class="">
                        <input type="text" placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'>Supporting help text</p>
                      </div>
                    </div>
					
                    <div class="form-group component" data-formtype="c10" data-type="text" data-name="city" data-required="true" rel="popover" title="City" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
                          <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
                          <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
                          <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

					  <!-- City input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>City</label>
                      <div class="">
                        <input type="text" placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'>Supporting help text</p>
                      </div>
                    </div>
					
                    <div class="form-group component" data-formtype="c14" data-type="number" data-name="zip" data-minlength="5" data-maxlength="5" data-required="true" rel="popover" title="Zip" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							</div>
						  </div>
                           <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

					  <!-- Zip input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>Zip</label>
                      <div class="">
                        <input type="text" placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'>Supporting help text</p>
                      </div>
                    </div>					
					
				  </div>

                  <div class="tab-pane" id="SFDSWFB-2">
				  
                    <div class="form-group component" data-formtype="d02" data-type="date" data-required="true" rel="popover" title="Date" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

					  <!-- Date input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>Date</label>
                      <div class="">
                        <input type="text" placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'>Supporting help text</p>
                      </div>
                    </div>

                    <div class="form-group component" data-formtype="d04" data-type="time" data-required="true" rel="popover" title="Time" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >
					
					  <!-- Time input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>Time</label>
                      <div class="">
                        <input type="text" placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'>Supporting help text</p>
                      </div>
                    </div>
					  
                    <div class="form-group component" data-formtype="d06" data-type="number" data-required="true" rel="popover" title="Numbers" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >
					  
					  <!-- Numbers input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>Numbers</label>
                      <div class="">
                        <input type="text" placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'>Supporting help text</p>
                      </div>
                    </div>

                    <div class="form-group component" data-formtype="d08" data-type="number" data-required="true" rel="popover" title="Price" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

					  <!-- Price input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>Price</label>
                      <div class="">
                        <input type="text" placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'>Supporting help text</p>
                      </div>
                    </div>
					  
                    <div class="form-group component" data-formtype="d10" data-type="url" data-required="true" rel="popover" title="URL" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >
					  
					  <!-- URL input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>URL</label>
                      <div class="">
                        <input type="text" placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'>Supporting help text</p>
                      </div>
                    </div>

                    <div class="form-group component" data-formtype="d12" data-type="password" data-name="password" data-required="true" data-minlength="6" rel="popover" title="Password" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
							<div class='accordion-section general'>
								<div class='accordion-header'>General</div>
								<div class='accordion'>
									<label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
									<label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
									<label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
								</div>
							</div>
							<hr/>
							<button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- Password input-->
                      <label class="control-label valtype" for="input01" data-valtype='label'>Password</label>
                      <div class="">
                        <input type="text" placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'>Supporting help text</p>
                      </div>
                    </div>					
					
				  </div>
				  
                  <div class="tab-pane" id="SFDSWFB-3">

                    <div class="form-group component" data-formtype="i02" data-type="text" data-required="true" rel="popover" title="Text Input" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- Text input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>Text input</label>
                      <div class="">
                        <input type="text" placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'>Supporting help text</p>
                      </div>
                    </div>

                    <div class="form-group component" data-formtype="i04" data-type="search" data-required="true" rel="popover" title="Search Input" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- Search input-->
                      <label class=" control-label valtype" data-valtype="label">Search input</label>
                      <div class="">
                        <input type="text" placeholder="placeholder" class="form-control input-md search-query valtype" data-valtype="placeholder">
                        <p class="help-block valtype" data-valtype="help">Supporting help text</p>
                      </div>

                    </div>


                    <div class="form-group component" data-formtype="i06" data-type="prep-text" data-required="true" rel="popover" title="Prepended Text Input" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Prepend</label> <input type='text' name='prepend' id='prepend' class='form-control'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- Prepended text-->
                      <label class=" control-label valtype" data-valtype="label">Prepended text</label>
                      <div class="">
                        <div class="input-group">
                          <span class="input-group-addon valtype" data-valtype="prepend">^_^</span>
                          <input class="form-control valtype" placeholder="placeholder" id="prependedInput" type="text" data-valtype="placeholder">
                        </div>
                        <p class="help-block valtype" data-valtype="help">Supporting help text</p>
                      </div>

                    </div>

                    <div class="form-group component" data-formtype="i08" data-type="app-text" data-required="true" rel="popover" title="Appended Text Input" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Appepend</label> <input type='text' name='append' id='append' class='form-control'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- Appended input-->
                      <label class=" control-label valtype" data-valtype="label">Appended text</label>
                      <div class="">
                        <div class="input-group">
                          <input name="appendedtext" class="form-control valtype" data-valtype="placeholder" placeholder="placeholder" type="text">
                          <span class="input-group-addon valtype" data-valtype="append">^_^</span>
                        </div>
                        <p class="help-block valtype" data-valtype="help">Supporting help text</p>
                      </div>


                    </div>

                    <div class="form-group component" data-formtype="i10" rel="popover" data-required="true" title="Search Input" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							  <label class='checkbox'><input type='checkbox' class='input-inline' name='checked' id='checkbox'>Checked</label>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- Prepended checkbox -->
                      <label class=" control-label valtype" data-valtype="label">Prepended checkbox</label>
                      <div class="">
                        <div class="input-group">
                          <span class="input-group-addon">
                            <input type="checkbox" class="valtype" data-valtype="checkbox">
                          </span>
                          <input class="form-control valtype" placeholder="placeholder" type="text" data-valtype="placeholder">
                        </div>
                        <p class="help-block valtype" data-valtype="help">Supporting help text</p>
                      </div>

                    </div>

                    <div class="form-group component" data-formtype="i12" rel="popover" data-required="true" title="Search Input" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							  <label class='checkbox'><input type='checkbox' class='input-inline' name='checked' id='checkbox'>Checked</label>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- Appended checkbox -->
                      <label class=" control-label valtype" data-valtype="label">Append checkbox</label>
                      <div class="">
                        <div class="input-group">
                          <input class="form-control valtype" placeholder="placeholder" type="text" data-valtype="placeholder">
                          <span class="input-group-addon">
                            <input type="checkbox" class="valtype" data-valtype="checkbox">
                          </span>
                        </div>
                        <p class="help-block valtype" data-valtype="help">Supporting help text</p>
                      </div>
                    </div>

                    <div class="form-group component" data-formtype="i14" rel="popover" data-required="true" title="Search Input" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
								<label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
								<label class='control-label'>Default Value</label> <textarea class='form-control' name='textarea' id='textarea'></textarea>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- Textarea -->
                      <label class=" control-label valtype" data-valtype="label">Textarea</label>
                      <div class="">
                        <div class="textarea">
                              <textarea class="form-control valtype" data-valtype="textarea" /> </textarea>
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="tab-pane" id="SFDSWFB-4">

                    <div class="form-group component" data-formtype="s02" rel="popover" data-required="true" data-choose="true" title="Search Input" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
								<label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
								<label class='control-label'>Options: </label>
								<textarea class='form-control' style='min-height: 200px' id='option'> </textarea>
								<label class='control-label' for='required'>Required</label> &nbsp;<input class='' type='checkbox' name='required' id='required'>								
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true"
                      >

                      <!-- Select Basic -->
                      <label class=" control-label valtype" data-valtype="label">Select - Basic</label>
                      <div class="">
                        <select class="form-control input-md valtype" data-valtype="option">
                          <option>Enter</option>
                          <option>Your</option>
                          <option>Options</option>
                          <option>Here!</option>
                        </select>
                      </div>

                    </div>

                    <div class="form-group component" data-formtype="s04" data-choose="true" rel="popover" title="Search Input" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
								<label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							    <label class='control-label'>Options: </label>
							    <textarea class='form-control' style='min-height: 200px' id='option'></textarea>
								<label class='control-label' for='required'>Required</label> &nbsp;<input class='' type='checkbox' name='required' id='required'>								
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true"
                      >

                      <!-- Select Multiple -->
                      <label class=" control-label valtype" data-valtype="label">Select - Multiple</label>
                      <div class="">
                        <select class="form-control input-md valtype" multiple="multiple" data-valtype="option">
                          <option>Enter</option>
                          <option>Your</option>
                          <option>Options</option>
                          <option>Here!</option>
                        </select>
                      </div>
                    </div>

				<!--
                  </div>

                  <div class="tab-pane" id="4">
				-->

                    <div class="form-group component" data-formtype="s06" rel="popover" title="Multiple Checkboxes" data-choose="true" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
								<label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
								<label class='control-label'>Options: </label>
								<textarea class='form-control' style='min-height: 200px' id='checkboxes'> </textarea>
								<label class='control-label' for='required'>Required</label> &nbsp;<input class='' type='checkbox' name='required' id='required'>								
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true"
                      >
                      <label class=" control-label valtype" data-valtype="label">Checkboxes</label>
                      <div class=" valtype" data-valtype="checkboxes">

                        <!-- Multiple Checkboxes -->
                        <label class="checkbox">
                          <input type="checkbox" value="Option one"/>
                          Option one
                        </label>
                        <label class="checkbox">
                          <input type="checkbox" value="Option two"/>
                          Option two
                        </label>
                      </div>

                    </div>

                    <div class="form-group component" data-formtype="s08" rel="popover" data-required="true" data-choose="true" title="Multiple Radios" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Options: </label>
							  <textarea class='form-control' style='min-height: 200px' id='radios'></textarea>
							  <label class='control-label' for='required'>Required</label> &nbsp;<input class='' type='checkbox' name='required' id='required'>								
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true"
                      >
                      <label class=" control-label valtype" data-valtype="label">Radio buttons</label>
                      <div class=" valtype" data-valtype="radios">

                        <!-- Multiple Radios -->
                        <label class="radio">
                          <input type="radio" value="Option one" name="group" checked="checked">
                          Option one
                        </label>
                        <label class="radio">
                          <input type="radio" value="Option two" name="group">
                          Option two
                        </label>
                      </div>

                    </div>

					<!-- hiding these because they seem redundant
                    <div class="form-group component" data-formtype="s10" rel="popover" title="Inline Checkboxes" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
								<label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							</div>
						  </div>
                          <textarea class='form-control' style='min-height: 200px' id='inline-checkboxes'></textarea>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true"
                      >
                      <label class=" control-label valtype" data-valtype="label">Inline Checkboxes</label>
						-->

                      <!-- Multiple Checkboxes -->
						<!--
                      <div class="col-md-4 valtype" data-valtype="inline-checkboxes">
                        <label class="checkbox inline">
                          <input type="checkbox" value="1"> 1
                        </label>
                        <label class="checkbox inline">
                          <input type="checkbox" value="2"> 2
                        </label>
                        <label class="checkbox inline">
                          <input type="checkbox" value="3"> 3
                        </label>
                      </div>

                    </div>

                    <div class="form-group component" data-formtype="s12" rel="popover" data-required="true" title="Inline radioes" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <textarea class='form-control' style='min-height: 200px' id='inline-radios'></textarea>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true"
                      >
                      <label class=" control-label valtype" data-valtype="label">Inline radios</label>
                      <div class="col-md-4 valtype" data-valtype="inline-radios">
						-->

                        <!-- Inline Radios -->
						<!--
                        <label class="radio inline">
                          <input type="radio" value="1" checked="checked" name="group">
                          1
                        </label>
                        <label class="radio inline">
                          <input type="radio" value="2" name="group">
                          2
                        </label>
                        <label class="radio inline">
                          <input type="radio" value="3">
                          3
                        </label>
                      </div>
                    </div>
					-->

                    <div class="form-group component" data-formtype="s14" data-type="text" data-name="state" data-required="true" data-choose="true" rel="popover" title="State" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							  <label class='control-label' for='required'>Required</label> &nbsp;<input class='' type='checkbox' name='required' id='required'>								
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >
					

					  <!-- State input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>State</label>
                      <div class="">
							<select placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder">
							    <option value="">Select</option>
								<option value="alabama">Alabama</option>
								<option value="alaska">Alaska</option>
								<option value="arizona">Arizona</option>
								<option value="arkansas">Arkansas</option>
								<option value="california">California</option>
								<option value="colorado">Colorado</option>
								<option value="connecticut">Connecticut</option>
								<option value="delaware">Delaware</option>
								<option value="district-of-columbia">District Of Columbia</option>
								<option value="florida">Florida</option>
								<option value="georgia">Georgia</option>
								<option value="hawaii">Hawaii</option>
								<option value="idaho">Idaho</option>
								<option value="illinois">Illinois</option>
								<option value="indiana">Indiana</option>
								<option value="iowa">Iowa</option>
								<option value="kansas">Kansas</option>
								<option value="kentucky">Kentucky</option>
								<option value="louisiana">Louisiana</option>
								<option value="maine">Maine</option>
								<option value="maryland">Maryland</option>
								<option value="massachusetts">Massachusetts</option>
								<option value="michigan">Michigan</option>
								<option value="minnesota">Minnesota</option>
								<option value="mississippi">Mississippi</option>
								<option value="missouri">Missouri</option>
								<option value="montana">Montana</option>
								<option value="nebraska">Nebraska</option>
								<option value="nevada">Nevada</option>
								<option value="new-hampshire">New Hampshire</option>
								<option value="new-jersey">New Jersey</option>
								<option value="new-mexico">New Mexico</option>
								<option value="new-york">New York</option>
								<option value="north-carolina">North Carolina</option>
								<option value="north-dakota">North Dakota</option>
								<option value="ohio">Ohio</option>
								<option value="oklahoma">Oklahoma</option>
								<option value="oregon">Oregon</option>
								<option value="pennsylvania">Pennsylvania</option>
								<option value="rhode-island">Rhode Island</option>
								<option value="south-carolina">South Carolina</option>
								<option value="south-dakota">South Dakota</option>
								<option value="tennessee">Tennessee</option>
								<option value="texas">Texas</option>
								<option value="utah">Utah</option>
								<option value="vermont">Vermont</option>
								<option value="virginia">Virginia</option>
								<option value="washington">Washington</option>
								<option value="west-virginia">West Virginia</option>
								<option value="wisconsin">Wisconsin</option>
								<option value="wyoming">Wyoming</option>
							</select>
                        <p class="help-block valtype" data-valtype='help'>Full names</p>
                      </div>
                    </div>

                    <div class="form-group component" data-formtype="s15" data-type="text" data-name="state" data-required="true" data-choose="true" rel="popover" title="State" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							  <label class='control-label' for='required'>Required</label> &nbsp;<input class='' type='checkbox' name='required' id='required'>								
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

					  <!-- State input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>State</label>
                      <div class="">
							<select placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder">
							    <option value="">Select</option>
								<option value="AL">Alabama</option>
								<option value="AK">Alaska</option>
								<option value="AZ">Arizona</option>
								<option value="AR">Arkansas</option>
								<option value="CA">California</option>
								<option value="CO">Colorado</option>
								<option value="CT">Connecticut</option>
								<option value="DE">Delaware</option>
								<option value="DC">District Of Columbia</option>
								<option value="FL">Florida</option>
								<option value="GA">Georgia</option>
								<option value="HI">Hawaii</option>
								<option value="ID">Idaho</option>
								<option value="IL">Illinois</option>
								<option value="IN">Indiana</option>
								<option value="IA">Iowa</option>
								<option value="KS">Kansas</option>
								<option value="KY">Kentucky</option>
								<option value="LA">Louisiana</option>
								<option value="ME">Maine</option>
								<option value="MD">Maryland</option>
								<option value="MA">Massachusetts</option>
								<option value="MI">Michigan</option>
								<option value="MN">Minnesota</option>
								<option value="MS">Mississippi</option>
								<option value="MO">Missouri</option>
								<option value="MT">Montana</option>
								<option value="NE">Nebraska</option>
								<option value="NV">Nevada</option>
								<option value="NH">New Hampshire</option>
								<option value="NJ">New Jersey</option>
								<option value="NM">New Mexico</option>
								<option value="NY">New York</option>
								<option value="NC">North Carolina</option>
								<option value="ND">North Dakota</option>
								<option value="OH">Ohio</option>
								<option value="OK">Oklahoma</option>
								<option value="OR">Oregon</option>
								<option value="PA">Pennsylvania</option>
								<option value="RI">Rhode Island</option>
								<option value="SC">South Carolina</option>
								<option value="SD">South Dakota</option>
								<option value="TN">Tennessee</option>
								<option value="TX">Texas</option>
								<option value="UT">Utah</option>
								<option value="VT">Vermont</option>
								<option value="VA">Virginia</option>
								<option value="WA">Washington</option>
								<option value="WV">West Virginia</option>
								<option value="WI">Wisconsin</option>
								<option value="WY">Wyoming</option>
							</select>
                        <p class="help-block valtype" data-valtype='help'>Full names, abbr value</p>
                      </div>
                    </div>

                    <div class="form-group component" data-formtype="s16" data-type="text" data-name="state" data-required="true" data-choose="true" rel="popover" title="State" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
						  <div class='accordion-section general'>
							<div class='accordion-header'>General</div>
							<div class='accordion'>
							  <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							  <label class='control-label'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control'>
							  <label class='control-label'>Help Text</label> <input type='text' name='help' id='help' class='form-control'>
							  <label class='control-label' for='required'>Required</label> &nbsp;<input class='' type='checkbox' name='required' id='required'>								
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

					  <!-- State input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>State</label>
                      <div class="">
							<select placeholder="placeholder" class="form-control input-md valtype" data-valtype="placeholder">
							    <option value="">Select</option>
								<option value="AL">AL</option>
								<option value="AK">AK</option>
								<option value="AR">AR</option>	
								<option value="AZ">AZ</option>
								<option value="CA">CA</option>
								<option value="CO">CO</option>
								<option value="CT">CT</option>
								<option value="DC">DC</option>
								<option value="DE">DE</option>
								<option value="FL">FL</option>
								<option value="GA">GA</option>
								<option value="HI">HI</option>
								<option value="IA">IA</option>	
								<option value="ID">ID</option>
								<option value="IL">IL</option>
								<option value="IN">IN</option>
								<option value="KS">KS</option>
								<option value="KY">KY</option>
								<option value="LA">LA</option>
								<option value="MA">MA</option>
								<option value="MD">MD</option>
								<option value="ME">ME</option>
								<option value="MI">MI</option>
								<option value="MN">MN</option>
								<option value="MO">MO</option>	
								<option value="MS">MS</option>
								<option value="MT">MT</option>
								<option value="NC">NC</option>	
								<option value="NE">NE</option>
								<option value="NH">NH</option>
								<option value="NJ">NJ</option>
								<option value="NM">NM</option>			
								<option value="NV">NV</option>
								<option value="NY">NY</option>
								<option value="ND">ND</option>
								<option value="OH">OH</option>
								<option value="OK">OK</option>
								<option value="OR">OR</option>
								<option value="PA">PA</option>
								<option value="RI">RI</option>
								<option value="SC">SC</option>
								<option value="SD">SD</option>
								<option value="TN">TN</option>
								<option value="TX">TX</option>
								<option value="UT">UT</option>
								<option value="VT">VT</option>
								<option value="VA">VA</option>
								<option value="WA">WA</option>
								<option value="WI">WI</option>	
								<option value="WV">WV</option>
								<option value="WY">WY</option>
							</select>
                        <p class="help-block valtype" data-valtype='help'>Abbreviated</p>
                      </div>
                    </div>


                  </div>

                  <div class="tab-pane" id="SFDSWFB-5">

                    <div class="form-group component" data-formtype="m02" data-type="text" rel="popover" title="Name" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
                          <label class='control-label'>H1 Text</label> <textarea class='form-control' name='textarea' id='textarea'></textarea>
                          <label class='control-label'>Unique ID</label> <input class='form-control' type='text' name='id' id='id'>
                          <label class='control-label'>Class Attribute</label> <input class='form-control' type='text' name='class' id='class'>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- h1 input-->
                      <div class="">
						<h1 class="valtype" data-valtype="textarea">H1 Header Text</h1>
                      </div>
                    </div>

                    <div class="form-group component" data-formtype="m04" data-type="text" rel="popover" title="Name" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
                          <label class='control-label'>H2 Text</label> <textarea class='form-control' name='textarea' id='textarea'></textarea>
                          <label class='control-label'>Unique ID</label> <input class='form-control' type='text' name='id' id='id'>
                          <label class='control-label'>Class Attribute</label> <input class='form-control' type='text' name='class' id='class'>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- h2 input-->
                      <div class="">
						<h2 class="valtype" data-valtype="textarea">H2 Header Text</h2>
                      </div>
                    </div>

                    <div class="form-group component" data-formtype="m06" data-type="text" rel="popover" title="Name" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
                          <label class='control-label'>H3 Text</label> <textarea class='form-control' name='textarea' id='textarea'></textarea>
                          <label class='control-label'>Unique ID</label> <input class='form-control' type='text' name='id' id='id'>
                          <label class='control-label'>Class Attribute</label> <input class='form-control' type='text' name='class' id='class'>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- h3 input-->
                      <div class="">
						<h3 class="valtype" data-valtype="textarea">H3 Header Text</h3>
                      </div>
                    </div>
					
                    <div class="form-group component" data-formtype="m08" rel="popover" title="Paragraph" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
                          <label class='control-label'>Paragraph Text</label> <textarea class='form-control' name='textarea' id='textarea'></textarea>
                          <label class='control-label'>Unique ID</label> <input class='form-control' type='text' name='id' id='id'>
                          <label class='control-label'>Class Attribute</label> <input class='form-control' type='text' name='class' id='class'>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- Textarea -->
                      <div class="">
                        <div class="paragraph">
                              <p class="valtype" data-valtype="textarea">This is a block of text in a paragraph</p>
                        </div>
                      </div>
                    </div>

                    <div class="form-group component" data-formtype="m10" rel="popover" title="Paragraph" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
                          <label class='control-label'>Paragraph Text</label> <textarea class='form-control' name='codearea' id='codearea'></textarea>
                          <label class='control-label'>Unique ID</label> <input class='form-control' type='text' name='id' id='id'>
                          <label class='control-label'>Class Attribute</label> <input class='form-control' type='text' name='class' id='class'>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- Textarea -->
                      <div class="">
                        <div class="paragraph">
                              <p class="valtype" data-valtype="codearea">This is a block of text with HTML content</p>
                        </div>
                      </div>
                    </div>
					
                    <div class="form-group component" data-formtype="m11" data-type="text" rel="popover" title="Hidden" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
                          <label class='control-label'>Default Value</label> <input class='form-control' type='text' name='value' id='value'>
                          <label class='control-label'>Unique ID</label> <input class='form-control' type='text' name='id' id='id'>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- hidden input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>[Hidden Form Element]</label>
                      <div class="">
                        <input type="hidden" class="form-control valtype" data-valtype="hidden" >
                      </div>
                    </div>

					<!-- hide for now
                    <div class="form-group component" data-formtype="m12" data-type="text" rel="popover" title="Calculate" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
                          <label class='control-label'>Default Value</label> <input class='form-control' type='text' name='value' id='value'>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- calculation field-->
					<!--
                      <label class=" control-label valtype" for="input01" data-valtype='label'>Calculation</label>
                      <div class="">
                        <input type="text" class="form-control valtype" data-valtype="calculation" >
                      </div>
                    </div>
					-->

					
                    <div class="form-group component" data-formtype="m13" data-type="file" data-required="true" rel="popover" title="File Upload" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
                          <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
							</div>
						  </div>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true"
                      >
                      <label class="col-md-12 control-label valtype" data-valtype="label">File Button</label>

                      <!-- File Upload -->
                      <div class="">
                        <input class="input-file" id="fileInput" type="file">
                      </div>
                    </div>

                    <div class="form-group component" data-formtype="m14" rel="popover" title="Search Input" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
                          <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
                          <label class='control-label'>Button Text</label> <input class='form-control' type='text' name='label' id='button'>
                          <label class='control-label' id=''>Type: </label>
                          <select class='form-control input-md' id='color'>
                            <option id='btn-default'>Default</option>
                            <option id='btn-primary'>Primary</option>
                            <option id='btn-info'>Info</option>
                            <option id='btn-success'>Success</option>
                            <option id='btn-warning'>Warning</option>
                            <option id='btn-danger'>Danger</option>
								<option id='btn-inverse'>Inverse</option>
                          </select>
                          <label class='control-label'>Unique ID</label> <input class='form-control' type='text' name='id' id='id'>
                          <label class='control-label'>Class Attribute</label> <input class='form-control' type='text' name='class' id='class'>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true"
                      >
                      <label class="col-md-12 control-label valtype" data-valtype="label">Button</label>

                      <!-- Button -->
                      <div class="valtype"  data-valtype="button">
                        <button class='btn btn-success'>Button</button>
                      </div>
                    </div>
					
                    <div class="form-group component" data-formtype="m16" data-type="text" rel="popover" title="Page Separator" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
                          <label class='control-label'>New Section Title</label> <input class='form-control' type='text' name='label' id='label'>
                          <hr/>
                          <button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- Page Separator-->
                      <label class=" valtype" data-valtype='label'>Page Separator</label>
                      <div class="">
                        <hr class="pb"/>
                      </div>
                    </div>
					
                  </div>
                  <div class="tab-pane" id="SFDSWFB-6">
                    <textarea id="SFDSWFB-source" class="col-md-12"></textarea>
					&nbsp;
					<br/>
					<h4>JSON Save Object</h4>
					<textarea id="SFDSWFB-save" class="col-md-12">{"settings":{},"data":[]}</textarea>
                  </div>
				  <div class="tab-pane" id="SFDSWFB-7">
					<h3>Settings</h3>
					<div class='form-group col-md-12'>
						<label class="control-label">Form Action</label>
						<input class="col-md-12 form-control" type="text" name="action"/>
					</div>
	     <!--<div class='form-group col-md-12'>
	     <label class="control-label">Success URL</label>
	     <input class="col-md-12 form-control" type="text" name="success"/>
	     </div>-->
					<div class='form-group col-md-12'>
						<label class="control-label">Form Method</label>
                        <label class="radio">
                          <input type="radio" value="POST" name="method" checked="checked">
                          POST
                        </label>
                        <label class="radio">
                          <input type="radio" value="GET" name="method">
                          GET (not recommended)
                        </label>
					</div>
					<div class='form-group col-md-12'>
						<label class="control-label">Co-Authors (by email address)</label><br/>
						<input class="col-md-12 form-control" id="SFDSWFB-authors" type="text"/>
					</div>
					<div class='form-group col-md-12'>
						<label class="control-label">First Section Label</label>
						<input class="col-md-12 form-control" id="SFDSWFB-section1" name="section1" type="text"/>
					</div>
	                                <div class='form-group col-md-12'>
	                                        <label class="control-label">Autofill Name Attribute</label>
	                                        <select class="col-md-12 form-control" id="SFDSWFB-names" name="names" onchange="loadNames(this)"><option value="0">Off</option><option value="permit-application">Salesforce Permit Application</option></select>
	                                </div>
					<!--
					<div class='form-group col-md-12'>
						<label class="control-label">Layout</label>
                        <label class="radio">
                          <input type="radio" value="form" name="layout" checked="checked">
                          Just the form
                        </label>
                        <label class="radio">
                          <input type="radio" value="horizontal" name="layout">
                          Horizontal Nav
                        </label>
                        <label class="radio">
                          <input type="radio" value="vertical" name="layout">
                          Vertical Nav
                        </label>
					</div>
					<div class='form-group col-md-12'>
						<label class="control-label">Flow</label>
                        <label class="radio">
                          <input type="radio" value="nonlinear" name="flow" checked="checked">
                          Non-linear, access to any section, any time
                        </label>
                        <label class="radio">
                          <input type="radio" value="linear" name="flow">
                          Linear, can only go forward and backwards by one
                        </label>
                        <label class="radio">
                          <input type="radio" value="sectional" name="flow">
                          Sectional, can only go forward once everything is validated
                        </label>
					</div>
					<div class='form-group col-md-12'>
						<label class="control-label">Autosave</label>
                        <label class="checkbox inline">
                          <input type="checkbox" value="sectional" name="autosave"/>Every Section
                        </label>
                        <label class="checkbox inline">
                          <input type="checkbox" value="exit" name="autosave"/>Quit Button
                        </label>
					</div>
					<div class='form-group col-md-12'>
						<label class="control-label">Exit Confirmation</label>
                        <label class="checkbox inline">
                          <input type="checkbox" value="true" name="confirmation">Show Prompt
                        </label>
					</div>-->
					<div class='form-group col-md-12' style="visibility:hidden">
						<label class="control-label">Load Form</label>
						<textarea class="form-control" id="SFDSWFB-load"><?php if ($form) { print $form['content']; } else { ?>{"settings":{},"data":[{"textarea":"What to expect","formtype":"m02"},{"codearea":"You will need about 2 hours to fill the Cannabis Business Permit Applicant (part 1). You can save and come back to this form using your Business Portal log in.<br/>\\n<br/>\\nf you are a non-Equity applicant, you will commit to paying the $2,000 application fee once you submit this form. Before submitting, make sure that your business meets one of the criteria listed under <a href=\"https://officeofcannabis.sfgov.org/#who-can-apply\">Who Can Apply</a>.<br/>\\n<br/>\\nTo find out what documents you’ll need, see the <a href=\"https://officeofcannabis.sfgov.org/requirements/checklist\">Cannabis Business Permit (part 1) checklist</a>.<br/>\\n<br/>\\nFor help with this application, email <a href=\"mailto:officeofcannabis@sfgov.org\">officeofcannabis@sfgov.org</a>","formtype":"m10"},{"label":"Can you apply?","formtype":"m16"},{"label":"What is your authorization to apply? (Check all that apply)","checkboxes":"I am an Equity Applicant\\nMy business is an Equity Incubator \\nI registered my business with the Office of Cannabis and have signed an affidavit \\n I have a temporary cannabis permit\\n I have a temporary cannabis permit\\nI ran a cannabis business that was previously shut down by federal authorities","formtype":"s06"},{"label":"About you","formtype":"m16"},{"codearea":"You need to be an owner, which means one of the following:<br/>\\n<br/>\\n<ul>\\n<li>you own more than 20% of the business</li>\\n<li>you are the CEO of the business</li>\\n<li>you are on the board of directors if the business is a nonprofit</li>\\n<li>you otherwise participate in the direction, control, or management of the business</li>\\n</ul>","formtype":"m10"},{"label":"First name","placeholder":"","help":"","formtype":"c02"},{"label":"Last name","placeholder":"","help":"","formtype":"c02"},{"label":"Job title","placeholder":"","help":"Owner, CEO or similar","formtype":"i02"},{"label":"Email","placeholder":"","help":"","formtype":"c04"},{"label":"Phone","placeholder":"","help":"","formtype":"c06"},{"label":"Business Account Number","formtype":"m16"},{"codearea":"Your Business Account Number (BAN) is the 7-digit number on your Business Registration Certificate. If you do not have a BAN, <a href=\"http://sftreasurer.org/registration\">register your business</a>.<br/>\\n<br/>\\nIf you can not find the location to be inspected and permitted, <a href=\"http://sftreasurer.org/account-update\">update your Business Account with the Treasurer and Tax Collector</a>.","formtype":"m10"},{"label":"Enter your Business Account Number (BAN):","placeholder":"","help":"","formtype":"i02"},{"label":"Location","formtype":"m16"},{"label":"Parcel (Block/Lot)","placeholder":"","help":"","formtype":"i02"},{"codearea":"<a href=\"http://officeofcannabis.sfgov.org/themes/custom/cannabis/images/OOC-Parcels-instructions.gif\">Look up your parcel (block/lot) number<a/> on the <a href=\"http://propertymap.sfplanning.org/\">Property Information Map</a>.","formtype":"m10"},{"label":"Select - Basic","option":"\\n                          Enter\\n                          Your\\n                          Options\\n                          Here!\\n                        ","formtype":"s02"},{"label":"","checkboxes":"I have a letter of determination or another non-binding approval from SF Planning Department","formtype":"s06"}]}<?php } ?></textarea>
						<br/>
						<a class="btn btn-success" onclick="loadForm()" href="javascript:void(0)">Load</a>
					</div>
				       
					
				  </div>
                </div>
              </fieldset>
            </form>
		  </div>
	    </div>
			
		<div class="col-md-6">
		  <div class="clearfix" style="max-height:1000px;overflow-x:visible;overflow-y:auto;padding-right:10px">
			<div>
				<h2 style="display:block;float:left;width:auto;margin-bottom:0">Customize Form</h2>
				<div class="clickMenu"><i class="fas fa-circle-notch fa-spin saveSpinner" style="display:none;color:#aaa"></i>
					<button class="btn btn-info" style="border-radius:5px 0 0 5px;width:130px" onclick="javascript:saveForm()">Save Changes</button>
					<button class="btn btn-info" style="border-radius:0 5px 5px 0;margin-left:-3px" onclick="javascript:toggleClickMenu()"><i class="fas fa-caret-down"></i></button>
					<ul>
						<li onclick="javascript:confirmAction('clone','doAction.php?action=clone')">Clone</li>
						<li onclick="javascript:confirmAction('delete','doAction.php?action=delete')">Delete</li>
						<li onclick="javascript:confirmAction('exit','editor.php')">Exit</li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			<hr>
			<div id="SFDSWFB-build">
			  <form id="SFDSWFB-target" class="form-horizontal">
				<fieldset>
				  <div id="SFDSWFB-legend" class="component" rel="popover" title="Form Title" trigger="manual"
					data-content="
					<form class='form'>
					  <div class='form-group col-md-12'>
						<label class='control-label'>Title</label> <input class='form-control' type='text' name='title' id='text'>
						<hr/>
						<button class='btn btn-info'>Save</button><button class='btn btn-danger'>Cancel</button>
					  </div>
					</form>" data-html="true"
					>
					<legend class="valtype" data-valtype="text">Form Name</legend>
				  </div>
				</fieldset>
			  </form>
			</div>
		  </div>
		</div>

			
      </div> <!-- row -->
      <div class="row clearfix">
        <div class="col-md-12"></div>
      </div>
    </div><!-- /container -->
	
	
	<div class="hidden clonable conditionals">
		<div class="addConditional" style="padding-top:1em">
			<a href="#" onclick="javascript:addConditional()">+Add A Condition</a>
		</div>
	</div>
	<div class="hidden clonable firstConditional">
		<hr/>
		<select class="showHide">
			<option>Show</option>
			<option>Hide</option>
		</select>
	</div>
	<div class="hidden clonable multipleConditionals">
		<select>
			<option>All</option>
			<option>Any</option>
		</select>
	</div>
	<div class="hidden clonable conditional">
		<div style="padding-top:1em">
			<span class="conditionalLabel"></span>
			<select class="allIds">
			</select>
			<select>
				<option>matches</option>
				<option>contains</option>
				<option>doesn't match</option>
				<option>doesn't contain</option>
				<option>is less than</option>
				<option>is more than</option>
				<option>contains anything</option>
				<option>is blank</option>
			</select>
			<input type="text" class="form-control" />
		</div>
	</div>
	<div class="hidden clonable calculationType">
		<select>
			<option>Plus</option>
			<option>Minus</option>
			<option>Multiplied by</option>
			<option>Divided by</option>
		</select>
	</div>
	<div class="hidden clonable accordion-attributes">
		<div class='accordion-section attributes'>
			<div class='accordion-header'>Attributes</div>
			<div class='accordion' style='display:none'>
			  <label class='control-label'>Default Value</label> <input class='form-control' type='text' name='value' id='value'>
			  <label class='control-label'>Name Attribute</label> <input class='form-control' type='text' name='name' id='name'>
			  <label class='control-label'>Unique ID</label> <input class='form-control' type='text' name='id' id='id'>
			  <label class='control-label'>Class Attribute</label> <input class='form-control' type='text' name='class' id='class'>
			</div>
		</div>
	</div>
	<div class="hidden clonable accordion-validation">
		<div class='accordion-section validation'>
			<div class='accordion-header'>Validation</div>
			<div class='accordion' style='display:none'>
			  <div class="validate-required">
				<label class='control-label' for="required">Required</label> &nbsp;<input class='' type='checkbox' name='required' id='required'><br/>
			  </div>
			  <div class="validate-type">
				<label class='control-label'>Type</label> <select class='form-control' name='type' id='type'><option value='text'>Text</option><option value='email'>Email</option><option value='tel'>Phone</option><option value='url'>URL</option><option value='number'>Number</option><option value='date'>Date</option><option value='search'>Search</option><option value='password'>Password</option><option value='match'>Match</option><option value='regex'>Custom</option></select>
			  </div>
			  <div class='validate-regex' style='display:none'>
				<label class='control-label'>Regular Expression</label> <input class='form-control' type='text' name='regex' id='regex'>
			  </div>
			  <div class='validate-minmax' style='display:none'>
				  <div class='floatleft'>
					<label class='control-label'>Min Value</label> <input class='form-control' type='text' name='min' id='min'>
				  </div>
				  <div class='floatright'>
					<label class='control-label'>Max Value</label> <input class='form-control' type='text' name='max' id='max'>
				  </div>
				  <div class='clear'></div>
			  </div>
			  <div class="validate-match" style="display:none">
				<label class='control-label' style='display:none'>Match Another</label> <select class='form-control' name='match' id='match'><option value=''></option></select>
			  </div>
			  <div class='floatleft'>
				<label class='control-label'>Min Length</label> <input class='form-control' type='text' name='minlength' id='minlength'>
			  </div>
			  <div class='floatright'>
				<label class='control-label'>Max Length</label> <input class='form-control' type='text' name='maxlength' id='maxlength'>
			  </div>
			  <div class='clear'></div>
			</div>
		</div>
	</div>
	
	<!--
    <div id="site-navbar" style="position: absolute; top: -4px; right: -3px; border: 0; z-index: 2000;padding:0;margin:0;"><a href="http://github.com/aiopio/Bootstrap3-form-builder" title="在github关注我" style="background:none;"><img src="http://aral.github.io/fork-me-on-github-retina-ribbons/right-white@2x.png" style="padding:0;margin:0;border:0; -webkit-box-shadow: none;-moz-box-shadow: none;box-shadow: none;width:100px"></a></div>
	-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-tagsinput.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script src="js/fb.js"></script>
	     <?php if (isset($_GET['id'])) { print "<script>formId = ".$_GET['id'].";loadForm();</script>"; } ?>

  </body>
</html>
