@extends('layouts.app')
@section('content')

<script>
		  //GLOBALS for now
		  var user_id = '<?php echo $user_id;?>';
		  var api_token = '<?php echo $api_token;?>';

		  $(document).ready(function(){
			  $(".content").show();

			  callAPI("/form/getForms", {}, loadHome);
			});

			//$(window).unload(function(){});

			window.onpopstate = function (event) {
				$('.container').hide();
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
      <div class="header-container">
  			<div class="logo">
  				<a href="#" onclick="javascript:event.preventDefault(); confirmAction('exit','editor.php')">
            <img src="/assets/images/SF_Digital_Services-logo.png" alt="SF Digital Services Logo" />
          </a>
        </div>
  				Webform Builder
          <a href="/home" class="header-sign-out btn btn-default">Sign Out</a>
      </div>
		</div>

		<div class="content" style="display:none">
            <div class="hidden-xs col-sm-1 col-md-2 col-lg-3">&nbsp;</div>
			<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
				<h1 class="welcomeBack text-center">Welcome back, <?php print $name; ?>!</h1>
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

                    {{-- Name field --}}
                    @include('partials.editor.form-component', [
                      'formtype' => 'c02',
                      'required' => true,
                      'type' => 'text',
                      'name' => 'name',
                      'title' => 'Name',
                      'placeholder' => true,
                      'partial' => 'partials.fields.name'
                    ])

                    {{-- Email field --}}
                    @include('partials.editor.form-component', [
                      'formtype' => 'c04',
                      'required' => true,
                      'type' => 'email',
                      'name' => 'email',
                      'title' => 'Email',
                      'placeholder' => true,
                      'partial' => 'partials.fields.email'
                    ])

                    {{-- Phone input --}}
                    @include('partials.editor.form-component', [
                      'formtype' => 'c06',
                      'required' => true,
                      'type' => 'tel',
                      'name' => 'phone',
                      'title' => 'Phone',
                      'minlength' => '10',
                      'placeholder' => true,
                      'partial' => 'partials.fields.phone'
                    ])

                    {{-- Address input --}}
                    @include('partials.editor.form-component', [
                      'formtype' => 'c08',
                      'required' => true,
                      'type' => 'text',
                      'name' => 'address',
                      'title' => 'Address',
                      'partial' => 'partials.fields.address'
                    ])

                    {{-- City input --}}
                    @include('partials.editor.form-component', [
                      'formtype' => 'c10',
                      'required' => true,
                      'type' => 'text',
                      'name' => 'city',
                      'title' => 'City',
                      'placeholder' => true,
                      'partial' => 'partials.fields.city'
                    ])

                     {{-- ZIP Code input --}}
                    @include('partials.editor.form-component', [
                      'formtype' => 'c14',
                      'required' => true,
                      'type' => 'number',
                      'name' => 'zip',
                      'title' => 'Zip',
                      'minlength' => '5',
                      'maxlength' => '5',
                      'placeholder' => true,
                      'partial' => 'partials.fields.zip'
                    ])
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
                        <input type="text" placeholder="" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'></p>
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
                        <input type="text" placeholder="" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'></p>
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
                        <input type="text" placeholder="" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'></p>
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
                        <div class="prepended dollar">$</div><input type="text" placeholder="" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'></p>
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
                        <input type="text" placeholder="" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'></p>
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
                        <input type="text" placeholder="" class="form-control input-md valtype" data-valtype="placeholder" >
                        <p class="help-block valtype" data-valtype='help'></p>
                      </div>
                    </div>


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

					<!-- must preserve whitespace formatting between options! -->
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

					<!-- must preserve whitespace formatting between options! -->
                    <div class="form-group component" data-formtype="s08" rel="popover" data-required="true" data-choose="true" data-name="multiple_radios" title="multiple radios" trigger="manual"
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
							<select placeholder="" class="form-control input-md valtype" data-valtype="placeholder">
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
							<select placeholder="" class="form-control input-md valtype" data-valtype="placeholder">
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
							<select placeholder="" class="form-control input-md valtype" data-valtype="placeholder">
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

                    <div class="form-group component" data-formtype="m08" rel="popover" title="Paragraph_text" trigger="manual"
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

                    <div class="form-group component" data-formtype="m10" rel="popover" title="Paragraph_html" trigger="manual"
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

                    <div class="form-group component" data-formtype="m11" data-type="hidden" rel="popover" title="Hidden" trigger="manual"
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


                    <div class="form-group component" data-formtype="m13" data-type="file" data-name="file_upload" data-required="true" rel="popover" title="File Upload" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
                          <label class='control-label'>Label Text</label> <input class='form-control' type='text' name='label' id='label'>
                          <label class='control-label'>Name Attribute</label> <input class='form-control' type='text' name='name' id='name'>
                          <label class='control-label'>Unique ID</label> <input class='form-control' type='text' name='id' id='id'>
                          <label class='control-label' for='required'>Required</label> &nbsp;<input class='' type='checkbox' name='required' id='required'>
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

					<!-- button group must remain here but stay invisible -->
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
					           @include('partials.embed-code')
                  </div>
				          <div class="tab-pane" id="SFDSWFB-7">
                    @include('partials.settings')
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
				@include('partials.form-actions')
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


  @include('partials.editor.conditionals')
  @include('partials.editor.calculations')

  @include('partials.editor.attributes')
  @include('partials.editor.validation')

  @include('partials.editor.webhooks')

  <div class="hidden clonable accordion-conditionals">
    <div class='accordion-section conditionals'>
      <div class='accordion-header'>Conditionals</div>
      <div class='accordion' style='display:none'>
      </div>
    </div>
  </div>

	@component('modal', [
    "id" => "modal-dialog",
    "secondary" => "Okay"
  ])
  @endcomponent

  @component('modal', [
    "id" => "modal-confirm",
    "primary" => "Do It",
    "secondary" => "Cancel"]
  )
  @endcomponent

  @component('modal', [
    "id" => "welcome",
    "primary" => "Yes Please",
    "primaryattrs" => "onclick='$('#tutorial').modal()'",
    "secondary" => "No Thanks"
  ])
    <p>Let us help you get started creating your new form.</p>
    <p>Would you like to view the introduction tutorial?</p>
  @endcomponent

  @component('modal', [
    "id" => "tutorial",
    "secondary" => "Got It"
  ])

    @slot('title')
      How to get the most out of Webform Builder
    @endslot

    @include('partials.tutorial')
  @endcomponent

@endsection