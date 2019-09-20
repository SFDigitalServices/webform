<h4>Settings</h4>

<div class='form-group'>
  <label class="control-label">Form Name</label>
  <input class="form-control" type="text" name="name"/>
</div>

<div class='form-group'>
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

<div class='form-group csvFile' style="display:none">
  <a href="javascript:void(0)" class="btn btn-info">Open CSV File</a>
</div>

<div class='form-group'>
  <label class="control-label">Form Action</label>
  <input class="form-control" type="text" name="action"/>
</div>

<div class='form-group confirmPage' style="display:none">
  <label class="control-label">Confirmation Page</label>
  <input class="form-control" type="text" name="confirmation"/>
</div>

{{-- 
<div class='form-group'>
  <label class="control-label">Success URL</label>
  <input class="form-control" type="text" name="success"/>
</div>
--}}

<div class='form-group'>
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

<div class='form-group'>
  <label class="control-label">Co-Authors</label>
  <br/>

  <span id="SFDSWFB-existingAuthors"></span>
  <a href="javascript:void(0)" onclick="$('#SFDSWFB-authors').slideDown()">+Add Author</a>

  <div id="SFDSWFB-authors" style="display:none">
    <label class="control-label">Co-Author's Email</label><br/>
    <input class="form-control" style="width:50%;display:inline-block" type="text"/>
    <a href="javascript:void(0)" onclick="share()" class="btn btn-info">Add</a>
  </div>
</div>

<div class='form-group'>
  <label class="control-label">First Section Label</label>
  <input class="form-control" id="SFDSWFB-section1" name="section1" type="text"/>
</div>

<div class='form-group'>
  <label class="control-label">Autofill Name Attribute</label>
  <select class="form-control" id="SFDSWFB-names">
    <option value="0">Off</option>
    <option value="permit-application">Salesforce Permit Application</option>
  </select>
</div>

{{-- 
<div class='form-group'>
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

<div class='form-group'>
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

<div class='form-group'>
  <label class="control-label">Autosave</label>
    <label class="checkbox inline">
      <input type="checkbox" value="sectional" name="autosave"/>Every Section
    </label>
    <label class="checkbox inline">
      <input type="checkbox" value="exit" name="autosave"/>Quit Button
    </label>
</div>

<div class='form-group'>
  <label class="control-label">Exit Confirmation</label>
    <label class="checkbox inline">
      <input type="checkbox" value="true" name="confirmation">Show Prompt
    </label>
</div>
--}}

<a href='javascript:void(0)' class='apply-button btn btn-md btn-primary'>Apply</a>
<a href='javascript:void(0)' class='revert-button btn btn-md btn-secondary'>Revert</a>