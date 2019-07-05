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


		@include('partials.header')

    @include('partials.welcome')

    <div style="display:none" class="container">
		<div class="row clearfix">
        <div class="col-md-6">
          <h2>Drag & Drop Components</h2>
          <hr>
          <div class="tabbable">
            <ul class="nav nav-tabs" id="SFDSWFB-navtab">
              <li class="active">
                <a href="#SFDSWFB-1" data-toggle="tab">Contact</a>
              </li>
              <li class>
                <a href="#SFDSWFB-2" data-toggle="tab">Data</a>
              </li>
              <li class>
                <a href="#SFDSWFB-3" data-toggle="tab">Input</a>
              </li>
              <li class>
                <a href="#SFDSWFB-4" data-toggle="tab">Select</a>
              </li>
              <li class>
                <a href="#SFDSWFB-5" data-toggle="tab">Misc</a>
              </li>
              <li class>
                <a id="SFDSWFB-sourcetab" href="#SFDSWFB-6" data-toggle="tab">Rendered</a>
              </li>
              <li class>
                <a href="#SFDSWFB-7" data-toggle="tab">Settings</a>
              </li>
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

                  {{-- Date input --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'd02',
                    'required' => true,
                    'type' => 'date',
                    'title' => 'Date',
                    'placeholder' => true,
                    'partial' => 'partials.fields.date'
                  ])

                  {{-- Time input --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'd04',
                    'required' => true,
                    'type' => 'time',
                    'title' => 'Time',
                    'placeholder' => true,
                    'partial' => 'partials.fields.time'
                  ])

                 {{-- Numbers input --}}
                 @include('partials.editor.form-component', [
                    'formtype' => 'd06',
                    'required' => true,
                    'type' => 'number',
                    'title' => 'Numbers',
                    'placeholder' => true,
                    'partial' => 'partials.fields.numbers'
                  ])

                  {{-- Price --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'd08',
                    'required' => true,
                    'type' => 'number',
                    'title' => 'Price',
                    'placeholder' => true,
                    'partial' => 'partials.fields.price'
                  ])

                  {{-- URL input --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'd10',
                    'required' => true,
                    'type' => 'url',
                    'title' => 'URL',
                    'placeholder' => true,
                    'partial' => 'partials.fields.url'
                  ])

        				</div>

                <div class="tab-pane" id="SFDSWFB-3">

                  {{-- Text --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'i02',
                    'required' => true,
                    'type' => 'text',
                    'title' => 'Text input',
                    'placeholder' => true,
                    'partial' => 'partials.fields.text'
                  ])

                  {{-- Textarea --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'i14',
                    'required' => true,
                    'title' => 'Textarea',
                    'placeholder' => true,
                    'partial' => 'partials.fields.textarea'
                  ])

                </div>

                <div class="tab-pane" id="SFDSWFB-4">

				          {{-- Select Basic --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 's02',
                    'required' => true,
                    'choose' => true,
                    'title' => 'Select Dropdown',
                    'partial' => 'partials.fields.select-basic',
                    'options' => 'option'
                  ])

                  {{-- Multiple checkboxes --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 's06',
                    'required' => true,
                    'choose' => true,
                    'title' => 'Multiple checkboxes',
                    'partial' => 'partials.fields.checkboxes',
                    'options' => 'checkboxes'
                  ])

                  {{-- Multiple radios --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 's08',
                    'required' => true,
                    'choose' => true,
                    'name' => 'multiple_radios',
                    'title' => 'multiple radios',
                    'partial' => 'partials.fields.radios',
                    'options' => 'radios'
                  ])

                  {{-- State full names --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 's14',
                    'type' => 'text',
                    'name' => 'state',
                    'title' => 'State',
                    'choose' => true,
                    'required' => true,
                    'placeholder' => true,
                    'partial' => 'partials.fields.state-full-names'
                  ])

                  {{-- State full names, abbreviated values --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 's15',
                    'type' => 'text',
                    'name' => 'state',
                    'title' => 'State',
                    'choose' => true,
                    'required' => true,
                    'placeholder' => true,
                    'partial' => 'partials.fields.state-abbr-value'
                  ])

                  {{-- State abbreviated --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 's16',
                    'type' => 'text',
                    'name' => 'state',
                    'title' => 'State',
                    'choose' => true,
                    'required' => true,
                    'placeholder' => true,
                    'partial' => 'partials.fields.state-abbr-value'
                  ])

                </div>

                <div class="tab-pane" id="SFDSWFB-5">

                  {{-- H1 --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'm02',
                    'type' => 'text',
                    'title' => 'Name',
                    'text' => 'H3',
                    'partial' => 'partials.fields.h1'
                  ])

                  {{-- H2 --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'm04',
                    'type' => 'text',
                    'title' => 'Name',
                    'text' => 'H2',
                    'partial' => 'partials.fields.h2'
                  ])

                  {{-- H3 --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'm06',
                    'type' => 'text',
                    'title' => 'Name',
                    'text' => 'H3',
                    'partial' => 'partials.fields.h3'
                  ])

                  {{-- Paragraph --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'm08',
                    'title' => 'Paragraph_text',
                    'text' => 'Paragraph',
                    'partial' => 'partials.fields.paragraph'
                  ])

                  {{-- Paragraph HTML --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'm10',
                    'title' => 'Paragraph_html',
                    'text' => 'Paragraph',
                    'partial' => 'partials.fields.paragraph-html'
                  ])

                  {{-- Hidden --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'm11',
                    'type' => 'hidden',
                    'title' => 'Hidden',
                    'name_id' => true,
                    'partial' => 'partials.fields.hidden'
                  ])


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