<h4>Settings</h4>

<div class='form-group'>
  <label class="control-label" for="name">Form Name</label>
  <input class="form-control" type="text" id="name" name="name"/>
</div>

<div class='form-group'>
	<label class="control-label" for="backend">Backend</label>
	<select class="form-control" id="backend" name="backend">
		<option value="db">I have a database and submission endpoint</option>
		<option value="csv">I want to create a Webform Buider CSV database</option>
	</select>
</div>

<div class='form-group csvFile' style="display:none">
  <a href="javascript:void(0)" class="btn btn-info">Open CSV File</a>
</div>

<div class='form-group'>
  <label class="control-label" for="action">Form Action</label>
  <input class="form-control" type="text" id="action" name="action"/>
</div>

<div class='form-group confirmPage' style="display:none">
  <label class="control-label" for="confirmation">Confirmation Page</label>
  <input class="form-control" type="text" id="confirmation" name="confirmation"/>
</div>

{{--
<div class='form-group'>
  <label class="control-label" for="success">Success URL</label>
  <input class="form-control" type="text" id="success" name="success"/>
</div>
--}}

<input type="hidden" name="method" value="POST"/>

<div class='form-group'>
  <label class="control-label">Co-Authors</label>
  <br/>

  <span id="SFDSWFB-existingAuthors"></span>
  <a href="javascript:void(0)" onclick="$('#SFDSWFB-authors').slideDown()">+Add Author</a>

  <div id="SFDSWFB-authors" style="display:none">
    <label class="control-label" for="coauthors">Co-Author's Email</label><br/>
    <input class="form-control" style="width:50%;display:inline-block" id="coauthors" type="text"/>
    <a href="javascript:void(0)" onclick="share()" class="btn btn-info">Add</a>
  </div>
</div>

<div class='form-group'>
  <label class="control-label" for="SFDSWFB-section1">First Section Label</label>
  <input class="form-control" id="SFDSWFB-section1" name="section1" type="text"/>
</div>

<div class='form-group'>
  <label class="control-label" for="SFDSWFB-names">Autofill Name Attribute</label>
  <select class="form-control" id="SFDSWFB-names">
    <option value="0">Off</option>
    <option value="permit-application">Salesforce Permit Application</option>
  </select>
</div>

<button class='apply-button btn btn-md btn-primary'>Apply</button>
<button class='revert-button btn btn-md btn-secondary'>Revert</button>