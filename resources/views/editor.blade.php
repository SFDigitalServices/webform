@extends('layouts.app')
@section('content')

<script>
		  //GLOBALS for now
		  var user_id = '<?php echo $user_id;?>';
		  var api_token = '<?php echo $api_token;?>';

		  $(document).ready(function(){
			  $(".content").show(1500);

			  callAPI("/form/getForms", {}, loadHome);
			});

			//$(window).unload(function(){});

			window.onpopstate = function (event) {
				$('.container').hide('fast');
				if (event.state) {
					if (event.state.formId) {
						loadContent(event.state.formId);
					} else {
						loadContent();
					}
				} else {
					goHome(true);
				}
			}		
</script>


		<div class="header">
			<div>
				<a href="/home"><img src="/assets/images/SF_Digital_Services-logo.png"/></a>
				SAN FRANCISCO <b>DIGITAL SERVICES</b> WEBFORM BUILDER
			</div>
		</div>

		<div class="content" style="display:none">
            <div class="hidden-xs col-sm-1 col-md-2 col-lg-3">&nbsp;</div>
			<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
				<h1 class="welcomeBack">Welcome back <?php print $name; ?>!</h1>
				<div class="welcomeBox">
					<div>
						<a href="javascript:void(0)" onclick="loadContent()" class="btn btn-info btn-lg btn-block">Create a New Form</a>
					</div>
                    <div class="text-muted">or load an existing form</div>
					<div class="forms"><i class="fas fa-circle-notch fa-spin"></i></div>
                </div>
            </div>
			<div class="hidden-xs col-sm-1 col-md-2 col-lg-3">&nbsp;</div> 
        </div>  

    <div style="display:none" class="container">
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
									<label class='control-label'>Label Text</label> <input class='form-control' type='text' data-toggle='tooltip' title='This text will appear before the input field' name='label' id='label'>
									<label class='control-label'>Placeholder</label> <input type='text' data-toggle='tooltip' title='This text will appear inside the input before a user types into it, we recommend leaving this blank' name='placeholder' id='placeholder' class='form-control'>
									<label class='control-label'>Help Text</label> <input type='text' data-toggle='tooltip' title='This is helper text that will appear after the input field' name='help' id='help' class='form-control'>
								</div>
							</div>
							<hr/>
							<button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
							<button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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

<!-- hide for now
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >
-->
					  
                      <!-- Prepended text-->
<!--
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >
-->
					  
                      <!-- Appended input-->
<!--
                      <label class=" control-label valtype" data-valtype="label">Appended text</label>
                      <div class="">
                        <div class="input-group">
                          <input name="appendedtext" class="form-control valtype" data-valtype="placeholder" placeholder="placeholder" type="text">
                          <span class="input-group-addon valtype" data-valtype="append">^_^</span>
                        </div>
                        <p class="help-block valtype" data-valtype="help">Supporting help text</p>
                      </div>


                    </div>

                    <div class="form-group component" data-formtype="i10" rel="popover" data-required="true" title="Prepended Checkbox" trigger="manual"
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >
-->
                      <!-- Prepended checkbox -->
<!--
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

                    <div class="form-group component" data-formtype="i12" rel="popover" data-required="true" title="Append Checkbox" trigger="manual"
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >
-->
                      <!-- Appended checkbox -->
<!--					  
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
-->					

                    <div class="form-group component" data-formtype="i14" rel="popover" data-required="true" title="Textarea" trigger="manual"
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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

                    <div class="form-group component" data-formtype="s02" rel="popover" data-required="true" data-choose="true" title="Select Dropdown" trigger="manual"
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true"
                      >

                      <!-- Select Basic -->
                      <label class=" control-label valtype" data-valtype="label">Select - Basic</label>
                      <div class=""><select class="form-control input-md valtype" data-valtype="option"><option>Enter</option>
<option>Your</option>
<option>Options</option>
<option>Here!</option></select></div>

                    </div>

					<!-- hide multi select for now
                    <div class="form-group component" data-formtype="s04" data-choose="true" rel="popover" title="Multi Select" trigger="manual"
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true"
                      >
					  -->

                      <!-- Select Multiple -->
					  <!--
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
					-->

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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true"
                      >
                      <label class=" control-label valtype" data-valtype="label">Checkboxes</label>
                      <div class=" valtype" data-valtype="checkboxes"><!-- Multiple Checkboxes --><label class="checkbox"><input type="checkbox" value="Option one"/>Option one</label>
<label class="checkbox"><input type="checkbox" value="Option two"/>Option two</label></div>

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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true"
                      >
                      <label class=" control-label valtype" data-valtype="label">Radio buttons</label>
                      <div class=" valtype" data-valtype="radios"><!-- Multiple Radios --><label class="radio"><input type="radio" value="Option one" name="group" checked="checked">Option one</label>
<label class="radio"><input type="radio" value="Option two" name="group">Option two</label></div>

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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
						  <label class='control-label'>Name Attribute</label> <input class='form-control' type='text' name='name' id='name'>
                          <label class='control-label'>Unique ID</label> <input class='form-control' type='text' name='id' id='id'>
                          <hr/>
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

                      <!-- hidden input-->
                      <label class=" control-label valtype" data-valtype='label'>[Hidden Form Element]</label>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true"
                      >
                      <label class="col-md-12 control-label valtype" data-valtype="label">File Button</label>

                      <!-- File Upload -->
                      <div class="">
                        <input class="input-file" id="fileInput" type="file">
                      </div>
                    </div>

                    <div class="form-group component" data-formtype="m14" rel="popover" title="Button" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
                          <label class='control-label'>Button Text</label> <input class='form-control' type='text' name='label' id='button'>
                          <label class='control-label' id=''>Type: </label>
                          <select class='form-control input-md' id='color'>
                            <option value='btn-default'>Default</option>
                            <option value='btn-primary'>Primary</option>
                            <option value='btn-info'>Info</option>
                            <option value='btn-success'>Success</option>
                            <option value='btn-warning'>Warning</option>
                            <option value='btn-danger'>Danger</option>
								<option value='btn-inverse'>Inverse</option>
                          </select>
                          <label class='control-label'>Unique ID</label> <input class='form-control' type='text' name='id' id='id'>
                          <label class='control-label'>Class Attribute</label> <input class='form-control' type='text' name='class' id='class'>
                          <hr/>
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true"
                      >

                      <!-- Button -->
					  <div class="">
						  <div class="valtype" data-valtype="button">
							<button class='btn btn-success'>Submit</button>
						  </div>
					  </div>
                    </div>
					
                    <div class="form-group component" data-formtype="m16" data-type="text" rel="popover" title="Page Separator" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
                          <label class='control-label'>New Section Title</label> <input class='form-control' type='text' name='label' id='label'>
                          <hr/>
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
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
					<h4>Embed Code</h4>
					<p>Copy and paste the following code into your page.</p>
					<textarea id="SFDSWFB-snippet" class="col-md-12">Save your form to get embed code</textarea>&nbsp;
					<br/>
					<div class="btn btn-info" onclick="$(this).hide();$('#SFDSWFB-debug').slideDown()">Show Debug Info</div>
					<div id="SFDSWFB-debug" style="display:none">
						<h4>Source Code</h4>
						<textarea id="SFDSWFB-source" class="col-md-12"></textarea>
						&nbsp;
						<br/>
						<h4>JSON Save Object</h4>
						<textarea id="SFDSWFB-save" class="col-md-12">{"settings":{"action":"","method":"POST","name":"My Form"},"data":[]}</textarea>
					</div>
                  </div>
				  <div class="tab-pane" id="SFDSWFB-7">
					<h3>Settings</h3>
					<div class='form-group col-md-12'>
                        <label class="radio">
                          <input type="radio" value="db" name="backend" checked="checked">
                          I have a database and submission endpoint
                        </label>
                        <label class="radio">
                          <input type="radio" value="csv" name="backend">
                          I want to create a Webform Buider CSV database
                        </label>
						<!--<input type="hidden" name="hash"/>-->
					</div>
					<div class='form-group col-md-12 csvFile' style="display:none">
						<a href="javascript:void(0)" class="btn btn-info">Open CSV File</a>
					</div>
					<div class='form-group col-md-12'>
						<label class="control-label">Form Action</label>
						<input class="col-md-12 form-control" type="text" name="action"/>
					</div>
					<div class='form-group col-md-12 confirmPage' style="display:none">
						<label class="control-label">Confirmation Page</label>
						<input class="col-md-12 form-control" type="text" name="confirmation"/>
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
						<label class="control-label">Co-Authors</label><br/>
						<span id="SFDSWFB-existingAuthors"></span> <a href="javascript:void(0)" onclick="$('#SFDSWFB-authors').slideDown()">+Add Author</a>
						<div id="SFDSWFB-authors" style="display:none">
							<label class="control-label">Co-Author's Email</label><br/>
							<input class="form-control" style="width:50%;display:inline-block" type="text"/> <a href="javascript:void(0)" onclick="share()" class="btn btn-info">Add</a>
						</div>
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
						<textarea class="form-control" id="SFDSWFB-load"></textarea>
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
				<div class="clickMenu">
					<ul>
						<span class="saveStatus"></span> 
						<i class="fas fa-circle-notch fa-spin saveSpinner" style="display:none;color:#aaa"></i>
						<li onclick="javascript:confirmAction('clone','doAction.php?action=clone')" data-toggle="tooltip" title="Clone"><i class="fas fa-clone"></i></li>
						<li onclick="javascript:confirmAction('delete','doAction.php?action=delete')" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i></li>
						<li onclick="javascript:confirmAction('exit','editor.php')" data-toggle="tooltip" title="Exit"><i class="fas fa-sign-out-alt"></i></li>
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
						<button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
					  </div>
					</form>" data-html="true"
					>
					<legend class="valtype" data-valtype="text">My Form</legend>
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
	
	
	<div class="hidden clonable addConditionalContainer">
		<div class="addConditional" style="">
			<a href="javascript:void(0)" onclick="javascript:addConditional()">+Add A Condition</a>
		</div>
	</div>
	<div class="hidden clonable firstConditional">
		<select class="showHide">
			<option>Show</option>
			<option>Hide</option>
		</select>
	</div>
	<div class="hidden clonable multipleConditionals">
		<select class="allAny">
			<option>All</option>
			<option>Any</option>
		</select>
	</div>
	<div class="hidden clonable conditional">
		<div class="condition">
			<i class="fas fa-minus-circle conditionIcon" onclick="javascript:removeConditional(this)"></i>
			<span class="conditionalLabel"></span>
			<select class="allIds conditionalId">
			</select>
			<select class="conditionalOperator" onchange="javascript:conditionalSelect(this)">
				<option>matches</option>
				<option>doesn't match</option>
				<option>is less than</option>
				<option>is more than</option>
				<option>contains</option>
				<option>doesn't contain</option>
				<option>contains anything</option>
				<option>is blank</option>
			</select>
			<input type="text" class="form-control conditionalValue" />
		</div>
	</div>
	<div class="hidden cloneable addCalculationContainer">
		<div class="addCalculation">
			<a href="javascript:void(0)" onclick="javascript:addCalculation()">+Add A Calculation</a>
		</div>
	</div>
	<div class="hidden clonable firstCalculation">
	    <label class="control-label calculationLabel">Calculation</label>
		<select class="allMathIds calculationId"></select>
	</div>
	<div class="hidden clonable calculationContainer">
		<div class="calculation">
			<i class="fas fa-minus-circle conditionIcon" onclick="javascript:removeCalculation(this)"></i>
			<select class="calculationOperator">
				<option>Plus</option>
				<option>Minus</option>
				<option>Multiplied by</option>
				<option>Divided by</option>
			</select>
			<select class="allMathIds calculationId"></select>
		</div>
	</div>
	<div class="hidden clonable accordion-attributes">
		<div class='accordion-section attributes'>
			<div class='accordion-header'>Attributes</div>
			<div class='accordion' style='display:none'>
			  <label class='control-label'>Default Value</label> <input data-toggle='tooltip' title='Use this to prefill this field with a value, otherwise this should be left blank' class='form-control' type='text' name='value' id='value'>
			  <label class='control-label'>Name Attribute</label> <input data-toggle='tooltip' title='You must set a unique machine name for this field' class='form-control' type='text' name='name' id='name'>
			  <label class='control-label'>Unique ID</label> <input data-toggle='tooltip' title='Use this to set the unique id of this field, it is good practice to use the same value as the name' class='form-control' type='text' name='id' id='id'>
			  <label class='control-label'>Class Attribute</label> <input data-toggle='tooltip' title='Use this to set the css identifier, it is not required unless needed for styling' class='form-control' type='text' name='class' id='class'>
			</div>
		</div>
	</div>
	<div class="hidden clonable accordion-validation">
		<div class='accordion-section validation'>
			<div class='accordion-header'>Validation</div>
			<div class='accordion' style='display:none'>
			  <div class="validate-required" data-toggle="tooltip" title="Check this to indicate the user must fill out this field">
				<label class='control-label' for="required">Required</label> &nbsp;<input class='' type='checkbox' name='required' id='required'><br/>
			  </div>
			  <div class="validate-type" data-toggle="tooltip" title="This is to make sure the user response fits the field type">
				<label class='control-label'>Type</label> <select class='form-control' name='type' id='type'><option value='text'>Text</option><option value='email'>Email</option><option value='tel'>Phone</option><option value='url'>URL</option><option value='number'>Number</option><option value='date'>Date</option><option value='search'>Search</option><option value='password'>Password</option><option value='match'>Match</option><option value='regex'>Custom</option></select>
			  </div>
			  <div class='validate-regex' style='display:none' data-toggle="tooltip" title="For advanced users only">
				<label class='control-label'>Regular Expression</label> <input class='form-control' type='text' name='regex' id='regex'>
			  </div>
			  <div class='validate-minmax' style='display:none'>
				  <div class='floatleft' data-toggle="tooltip" title="The lowest acceptable numerical value, leave blank if there is none">
					<label class='control-label'>Min Value</label> <input class='form-control' type='text' name='min' id='min'>
				  </div>
				  <div class='floatright' data-toggle="tooltip" title="The highest acceptable numerical value, leave blank if there is none">
					<label class='control-label'>Max Value</label> <input class='form-control' type='text' name='max' id='max'>
				  </div>
				  <div class='clear'></div>
			  </div>
			  <div class="validate-match" style="display:none" data-toggle="tooltip" title="Use this to only accept a user response if the value matches a different field that you specify">
				<label class='control-label' style='display:none'>Match Another</label> <select class='form-control' name='match' id='match'><option value=''></option></select>
			  </div>
			  <div class='floatleft' data-toggle="tooltip" title="The minimum amount of characters allowed, leave blank if there is none">
				<label class='control-label'>Min Length</label> <input class='form-control' type='text' name='minlength' id='minlength'>
			  </div>
			  <div class='floatright' data-toggle="tooltip" title="The maximum amount of charcaters allowed, leave blank if there is none">
				<label class='control-label'>Max Length</label> <input class='form-control' type='text' name='maxlength' id='maxlength'>
			  </div>
			  <div class='clear'></div>
			</div>
		</div>
	</div>
	<div class="hidden clonable accordion-conditionals">
		<div class='accordion-section conditionals'>
			<div class='accordion-header'>Conditionals</div>
			<div class='accordion' style='display:none'>
			</div>
		</div>
	</div>

	<div class="modal" id="modal-dialog" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title"></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<p></p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button>
		  </div>
		</div>
	  </div>
	</div>

	<div class="modal" id="modal-confirm" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title"></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<p></p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" data-dismiss="modal">Do It</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="modal" id="welcome" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Welcome to Webform Builder!</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<p>Let us help you get started creating your new form.</p>
			<p>Would you like to view the introduction tutorial?</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="$('#tutorial').modal()">Yes Please</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">No Thanks</button>
		  </div>
		</div>
	  </div>
	</div>

	<div class="modal" id="tutorial" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">How to get the most out of Webform Builder</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<p>Start by dragging components (name, email, phone, etc.) from the left side into the form box on the right.</p>
			<ul>
				<li>Click on the tabs (Contact, Data, etc.) to change the list of components.</li>
				<li>Click the Rendered tab to get code to embed your form on your website.</li>
				<li>Click the Settings tab to setup your database or share your form with others.</li>
			</ul>
			<br/>
			<p>Modify your components by clicking them after dragging them into the form box.</p>
			<ul>
				<li>Be sure to rename your form by clicking "My Form" and typing in a new title.</li>
				<li>Click each dragged component in the right to change the labeling, html attributes and more.</li>
			</ul>
			<br/>
			<p>Perform advanced features like validation, conditionals, and calculations.</p>
			<ul>
				<li>Set form validation by clicking your component and mousing over "Validation".</li>
				<li>Conditionals can show or hide components based on respondents' previous answers.</li>
				<li>Totals can be tallied by choosing a "Numbers" component and adding a calculation.</li>
			</ul>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Got It</button>
		  </div>
		</div>
	  </div>
	</div>
	
@endsection