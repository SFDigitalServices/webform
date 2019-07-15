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
              @include('partials.form-nav', ['href' => '1', 'title' => 'Contact', 'class' => 'active'])
              @include('partials.form-nav', ['href' => '2', 'title' => 'Data'])
              @include('partials.form-nav', ['href' => '3', 'title' => 'Input'])
              @include('partials.form-nav', ['href' => '4', 'title' => 'Select'])
              @include('partials.form-nav', ['href' => '5', 'title' => 'Misc'])
              @include('partials.form-nav', ['href' => '6', 'title' => 'Rendered', 'id' => 'SFDSWFB-sourcetab'])
              @include('partials.form-nav', ['href' => '7', 'title' => 'Settings'])
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
                      'defaultvalue' => true,
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
                      'defaultvalue' => true,
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
                      'defaultvalue' => true,
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
                      'defaultvalue' => true,
                      'placeholder' => true,
                      'partial' => 'partials.fields.city'
                    ])

                    {{-- ZIP Code input --}}
                    @include('partials.editor.form-component', [
                      'formtype' => 'c14',
                      'required' => true,
                      'type' => 'text',
                      'name' => 'zip',
                      'title' => 'Zip',
                      'minlength' => '5',
                      'maxlength' => '5',
                      'defaultvalue' => true,
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
                    'name' => 'date',
                    'defaultvalue' => true,
                    'placeholder' => true,
                    'partial' => 'partials.fields.date'
                  ])

                  {{-- Time input --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'd04',
                    'required' => true,
                    'type' => 'time',
                    'title' => 'Time',
                    'name' => 'time',
                    'defaultvalue' => true,
                    'placeholder' => true,
                    'partial' => 'partials.fields.time'
                  ])

                 {{-- Numbers input --}}
                 @include('partials.editor.form-component', [
                    'formtype' => 'd06',
                    'required' => true,
                    'type' => 'number',
                    'title' => 'Numbers',
                    'name' => 'number',
                    'defaultvalue' => true,
                    'placeholder' => true,
                    'partial' => 'partials.fields.numbers'
                  ])

                  {{-- Price --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'd08',
                    'required' => true,
                    'type' => 'number',
                    'title' => 'Price',
                    'name' => 'price',
                    'defaultvalue' => true,
                    'placeholder' => true,
                    'partial' => 'partials.fields.price'
                  ])

                  {{-- URL input --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'd10',
                    'required' => true,
                    'type' => 'url',
                    'title' => 'URL',
                    'name' => 'url',
                    'defaultvalue' => true,
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
                    'name' => 'text',
                    'defaultvalue' => true,
                    'placeholder' => true,
                    'partial' => 'partials.fields.text'
                  ])

                  {{-- Textarea --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'i14',
                    'required' => true,
                    'title' => 'Textarea',
                    'name' => 'textarea',
                    'defaultvalue' => true,
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
                    'name' => 'select_dropdown',
                    'defaultvalue' => true,
                    'partial' => 'partials.fields.select-basic',
                    'options' => 'option'
                  ])

                  {{-- Multiple checkboxes --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 's06',
                    'required' => true,
                    'choose' => true,
                    'title' => 'Multiple checkboxes',
                    'name' => 'multiple_checkboxes',
                    'defaultvalue' => true,
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
                    'defaultvalue' => true,
                    'partial' => 'partials.fields.radios',
                    'options' => 'radios'
                  ])

                  {{-- State full names --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 's14',
                    'type' => 'text',
                    'name' => 'state_full_names',
                    'title' => 'State',
                    'choose' => true,
                    'required' => true,
                    'defaultvalue' => true,
                    'placeholder' => true,
                    'partial' => 'partials.fields.state-full-names'
                  ])

                  {{-- State full names, abbreviated values --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 's15',
                    'type' => 'text',
                    'name' => 'state_abbr_value',
                    'title' => 'State',
                    'choose' => true,
                    'required' => true,
                    'defaultvalue' => true,
                    'placeholder' => true,
                    'partial' => 'partials.fields.state-abbr-value'
                  ])

                  {{-- State abbreviated --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 's16',
                    'type' => 'text',
                    'name' => 'state_abbr',
                    'title' => 'State',
                    'choose' => true,
                    'required' => true,
                    'defaultvalue' => true,
                    'placeholder' => true,
                    'partial' => 'partials.fields.state-abbr'
                  ])

                </div>

                <div class="tab-pane" id="SFDSWFB-5">

                  {{-- H1 --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'm02',
                    'type' => 'text',
                    'title' => 'Name',
                    'text' => 'H1',
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
                    'name' => 'hidden',
                    'defaultvalue' => true,
                    'partial' => 'partials.fields.hidden'
                  ])

                  {{-- File Upload --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'm13',
                    'type' => 'file',
                    'title' => 'File Upload',
                    'name' => 'file_upload',
                    'required' => true,
                    'defaultvalue' => true,
                    'partial' => 'partials.fields.file-upload'
                  ])

                  {{-- Button --}}
                  @include('partials.editor.form-component', [
                    'formtype' => 'm14',
                    'title' => 'Button',
                    'text' => 'Button',
                    'partial' => 'partials.fields.button'
                  ])

                  @include('partials.editor.form-component', [
                    'formtype' => 'm16',
                    'type' => 'text',
                    'title' => 'Page Separator',
                    'text' => 'New Section Title',
                    'partial' => 'partials.fields.page-separator'
                  ])

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


      </div> {{--  /.row --}}
      <div class="row clearfix">
        <div class="col-md-12"></div>
      </div>
    </div> {{--  /.container --}}

  @include('partials.editor.conditionals')
  @include('partials.editor.calculations')
  @include('partials.editor.validation')

  <div class="hidden clonable accordion-conditionals">
    <div class='accordion-section conditionals'>
      <div class='accordion-header'>Conditionals</div>
      <div class='accordion' style='display:none'>
      </div>
    </div>
  </div>

  @include('partials.editor.webhooks')

	@include('modal', [
    "id" => "modal-dialog",
    "secondary" => "Okay"
  ])

  @include('modal', [
    "id" => "modal-confirm",
    "primary" => "Do It",
    "secondary" => "Cancel"
  ])

  @component('modal', [
    "id" => "welcome",
    "primary" => "Yes Please",
    "primaryattrs" => "onclick='$('#tutorial').modal()'",
    "secondary" => "No Thanks"
  ])

    @slot('title')
      Welcome to Webform Builder!
    @endslot

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