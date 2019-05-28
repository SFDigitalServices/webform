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
  }
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

                    {{-- Numbers --}}
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

                    {{-- Password input --}}
                    @include('partials.editor.form-component', [
                      'formtype' => 'd12',
                      'required' => true,
                      'name' => 'password',
                      'type' => 'password',
                      'title' => 'Password',
                      'minlength' => '6',
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

                    {{-- Search --}}
                    @include('partials.editor.form-component', [
                      'formtype' => 'i04',
                      'required' => true,
                      'type' => 'search',
                      'title' => 'Search input',
                      'placeholder' => true,
                      'partial' => 'partials.fields.search'
                    ])

                    {{-- Prepended text --}}
                    @include('partials.editor.form-component', [
                      'formtype' => 'i06',
                      'required' => true,
                      'type' => 'prep-text',
                      'title' => 'Prepended Text Input',
                      'placeholder' => true,
                      'partial' => 'partials.fields.prep-text'
                    ])

                    {{-- Appended text --}}
                    @include('partials.editor.form-component', [
                      'formtype' => 'i08',
                      'required' => true,
                      'type' => 'app-text',
                      'title' => 'Appended Text Input',
                      'placeholder' => true,
                      'partial' => 'partials.fields.app-text'
                    ])

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
            <li onclick="javascript:confirmAction('delete')">Delete</li>
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


  @include('partials.editor.conditionals')
  @include('partials.editor.calculation')
  @include('partials.editor.validation')


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
