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
				  

                    <!-- Name field -->
                    @component('partials/editor/form-component', [
                      'formtype' => 'c02',
                      'type' => 'name',
                      'name' => 'name',
                      'title' => 'Name'
                    ])

                      @slot('popover')
                        @component('partials/editor/general', [
                          'placeholder' => true
                        ])
                        @endcomponent
                      @endslot

                      @component('partials/fields/name')
                      @endcomponent

                    @endcomponent


                    <!-- Email field -->

                    @component('partials/editor/form-component', [
                      'formtype' => 'c04',
                      'type' => 'email',
                      'name' => 'email',
                      'title' => 'Email'
                    ])

                      @slot('popover')
                        @component('partials/editor/general', [
                          'placeholder' => true
                        ])
                        @endcomponent
                      @endslot

                      @component('partials/fields/email')
                      @endcomponent

                    @endcomponent
					
                    <div class="form-group component" data-formtype="c06" data-type="tel" data-name="phone" data-minlength="10" data-required="true" rel="popover" title="Phone" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
            							@component('partials/editor/general', [
                            'placeholder' => true
                          ])
                          @endcomponent
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
            							@component('partials/editor/general')
                          @endcomponent
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
            							@component('partials/editor/general', [
                            'placeholder' => true
                          ])
                          @endcomponent
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
					
                    <div class="form-group component" data-formtype="c14" data-type="text" data-name="zip" data-minlength="5" data-maxlength="5" data-required="true" rel="popover" title="Zip" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
            							@component('partials/editor/general', [
                            'placeholder' => true
                          ])
                          @endcomponent
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
            							@component('partials/editor/general', [
                            'placeholder' => true
                          ])
                          @endcomponent
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
            							@component('partials/editor/general', [
                            'placeholder' => true
                          ])
                          @endcomponent
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
            							@component('partials/editor/general', [
                            'placeholder' => true
                          ])
                          @endcomponent
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
            							@component('partials/editor/general', [
                            'placeholder' => true
                          ])
                          @endcomponent
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
            							@component('partials/editor/general', [
                            'placeholder' => true
                          ])
                          @endcomponent
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

				  </div>
				  
                  <div class="tab-pane" id="SFDSWFB-3">

                    <div class="form-group component" data-formtype="i02" data-type="text" data-required="true" rel="popover" title="Text Input" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
            							@component('partials/editor/general', [
                            'placeholder' => true
                          ])
                          @endcomponent
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
                          @component('partials/editor/general', [
                            'required' => true,
                            'options' => 'option'
                          ])
                          @endcomponent
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
          								@component('partials/editor/general', [
                            'required' => true,
                            'options' => 'checkboxes'
                          ])
                          @endcomponent						
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
                          @component('partials/editor/general', [
                            'required' => true, 
                            'options' => 'radios'
                          ])
                          @endcomponent
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
            							@component('partials/editor/general', [
                            'required' => true,
                            'placeholder' => true
                          ])
                          @endcomponent
                          <hr/>
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >
					

					  <!-- State input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>State</label>
                      <div class="">
                        @component("partials/fields/state-full-names")
                        @endcomponent
                        <p class="help-block valtype" data-valtype='help'>Full names</p>
                      </div>
                    </div>

                    <div class="form-group component" data-formtype="s15" data-type="text" data-name="state" data-required="true" data-choose="true" rel="popover" title="State" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
            							@component('partials/editor/general', [
                            'required' => true,
                            'placeholder' => true]
                          )
                          @endcomponent
                          <hr/>
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

					  <!-- State input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>State</label>
                      <div class="">
							         @component("partials/fields/state-abbr-value")
                       @endcomponent
                        <p class="help-block valtype" data-valtype='help'>Full names, abbr value</p>
                      </div>
                    </div>

                    <div class="form-group component" data-formtype="s16" data-type="text" data-name="state" data-required="true" data-choose="true" rel="popover" title="State" trigger="manual"
                      data-content="
                      <form class='form'>
                        <div class='form-group col-md-12'>
            							@component('partials/editor/general', [
                            'placeholder' => true,
                            'required' => true
                          ])
                          @endcomponent
                          <hr/>
                          <button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
                        </div>
                      </form>" data-html="true" 
                      >

					  <!-- State input-->
                      <label class=" control-label valtype" for="input01" data-valtype='label'>State</label>
                      <div class="">
							         @component("partials/fields/state-abbr")
                       @endcomponent
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
					<h4>Embed Code</h4>
					<p>Copy and paste the following code into your page.</p>
					<pre id="SFDSWFB-snippet" class="col-md-12">Save your form to get embed code</pre>&nbsp;
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
						<li onkeydown="if(event.keyCode == 13) confirmAction('clone','doAction.php?action=clone')" onclick="javascript:confirmAction('clone','doAction.php?action=clone')" tabindex="0" data-toggle="tooltip" title="Clone"><i class="fas fa-clone"></i></li>
						<li onkeydown="if(event.keyCode == 13) confirmAction('delete','doAction.php?action=delete')" onclick="javascript:confirmAction('delete','doAction.php?action=delete')" tabindex="0" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i></li>
						<li onkeydown="if(event.keyCode == 13) confirmAction('exit','editor.php')" onclick="javascript:confirmAction('exit','editor.php')" data-toggle="tooltip" tabindex="0" title="Exit"><i class="fas fa-sign-out-alt"></i></li>
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

  @component('partials/editor/attributes')
  @endcomponent

	@component('partials/editor/validation')
  @endcomponent

	<div class="hidden clonable accordion-conditionals">
		<div class='accordion-section conditionals'>
			<div class='accordion-header'>Conditionals</div>
			<div class='accordion' style='display:none'>
			</div>
		</div>
	</div>

  @component('partials/modal', [
    "id" => "modal-dialog",
    "secondary" => "Okay"
  ])
  @endcomponent

  @component('partials/modal', [
    "id" => "modal-confirm",
    "primary" => "Do It",
    "secondary" => "Cancel"]
  )
  @endcomponent

  @component('partials/modal', [
    "id" => "welcome",
    "primary" => "Yes Please",
    "primaryattrs" => "onclick='$('#tutorial').modal()'",
    "secondary" => "No Thanks"
  ])
    <p>Let us help you get started creating your new form.</p>
    <p>Would you like to view the introduction tutorial?</p>
  @endcomponent

  @component('partials/modal', [
    "id" => "tutorial",
    "secondary" => "Got It"
  ])

    @slot('title')
      How to get the most out of Webform Builder
    @endslot

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
  @endcomponent	
@endsection