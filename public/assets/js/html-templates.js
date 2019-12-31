Fb.prototype.view = {}

Fb.prototype.view.validation = "\
	<div class='accordion-validation'> \
    <div class='accordion-section'></div> \
	</div>"

Fb.prototype.view.conditionals = "\
	<div class='accordion-conditionals'> \
		<div class='accordion-section conditionals'> \
			<div class='accordion-header'>Conditionals</div> \
			<div class='accordion'> \
				<div class='clonable addConditionalContainer'> \
					<div class='addConditional' style=''> \
						<a href='javascript:void(0)' class='addConditionalButton btn btn-default btn-block'>Add a rule</a> \
					</div> \
				</div> \
			</div> \
		</div> \
	</div>"

Fb.prototype.view.calculations = "\
	<div class='accordion-calculations'> \
		<div class='accordion-section calculations'> \
			<div class='accordion-header'>Calculations</div> \
			<div class='accordion'> \
				<div class='addCalculationContainer'> \
					<div class='addCalculation'> \
						<a class='addCalculationButton btn btn-default btn-block'>Add a calculation</a> \
					</div> \
				</div> \
			</div> \
		</div> \
	</div>"

Fb.prototype.view.webhooks = "\
	<div class='accordion-webhooks'> \
		<div class='accordion-section webhooks'> \
			<div class='accordion-header'>Webhooks</div> \
			<div class='accordion'> \
				<select class='webhookSelect form-control' onchange='javascript:webhookSelect(this)'> \
					<option>No Webhooks</option> \
					<option>Use a Webhook</option> \
				</select> \
				<div class='webhookEditor' style='display:none'> \
					<div> \
						<label class='control-label' save_image_to_download='true'>Post Field Values</label> \
						<i data-toggle='tooltip' title='' data-original-title='Add another field and value to the POST' class='fas fa-plus-circle' onclick='javascript:addWebhook()'></i> \
					</div>				 \
					<select data-toggle='tooltip' title='' data-original-title='Select the variables that will be posted to the endpoint by id = value' class='allIds webhookId form-control'></select> \
					<div data-toggle='tooltip' title='' data-original-title='The URL endpoint that will be called in the POST'> \
						<label class='control-label' save_image_to_download='true'>Endpoint URL</label> \
					</div>				 \
					<input type='text' class='form-control webhookEndpoint' /> \
					<div data-toggle='tooltip' title='' data-original-title='The data format that will be transmitted and will also dictate the expected format for the response'> \
						<label class='control-label' save_image_to_download='true'>Data Format</label> \
					</div>				 \
					<select class='webhookMethod form-control'> \
						<option>json</option> \
						<option>xml</option> \
						<option>html</option> \
						<option>script</option> \
						<option>jsonp</option> \
						<option>text</option> \
						<option>get</option> \
					</select> \
					<div data-toggle='tooltip' title='' data-original-title='The data index or path to retrieve from the response object, slashes / can be used for traversing hierarchies'> \
						<label class='control-label' save_image_to_download='true'>Response Index/Path</label> \
					</div>				 \
					<input type='text' class='form-control webhookResponseIndex' /> \
					<div data-toggle='tooltip' title='' data-original-title='The data response that is received. A single value option or an array of options'> \
						<label class='control-label' save_image_to_download='true'>Response Type</label> \
					</div>				 \
					<select class='webhookOptionsArray form-control' onchange='javascript:webhookOptions(this)'> \
						<option>Single Response</option> \
						<option>Will Contain Many Options</option> <!--only valid if using checkbox, radio or select--> \
					</select> \
					<div class='webhookOptionsEditor'> \
						<div data-toggle='tooltip' title='' data-original-title='When parsing an array of options to populate your question field, is it from a delimited string or data constructed as siblings of a parent'> \
							<label class='control-label' save_image_to_download='true'>Array Split Method</label> \
						</div>				 \
						<select class='webhookResponseOptionType form-control' onchange='javascript:webhookResponseOptionType(this)'> \
							<option>Select</option> \
							<option>Delimiter</option> \
							<option>Index/Path</option> \
						</select> \
						<input type='text' class='form-control webhookDelimiter webhookResponseMethod' /> \
						<input type='text' class='form-control webhookIndex webhookResponseMethod' /> \
					</div> \
				</div> \
			</div> \
		</div> \
	</div>"

Fb.prototype.view.applyRevertButtons = "\
  <div class='save-buttons'> \
	  <button class='apply-button btn btn-md btn-primary'>Save</button> \
	  <button class='revert-button btn btn-md btn-secondary'>Cancel</button> \
  </div>"

Fb.prototype.view.editItem = "\
	<div class='accordion-attributes'> \
		<div class='accordion-section attributes'> \
			<div class='accordion'> \
				<input type='hidden' name='formtype' id='formtype'/>\
				<div class='form-group label-attribute'><label class='control-label'>Label</label> <input class='form-control' type='text' name='label' id='label'></div> \
        <div class='form-group textarea-attribute'><label class='control-label'>Content</label> <textarea class='form-control' name='textarea' id='textarea'></textarea></div> \
        <div class='form-group codearea-attribute'><label class='control-label'>Content</label> <textarea class='form-control' name='codearea' id='codearea'></textarea></div> \
        <div class='form-group required-attribute'><label class='checkbox-inline' for='required'><input class='' type='checkbox' id='required' name='required'>Required</label></div> \
        <div class='form-group type-attribute'><label class='control-label'>Type</label> <select class='form-control' name='type' id='type'><option value='text'>Text</option><option value='email'>Email</option><option value='tel'>Phone</option><option value='url'>URL</option><option value='number'>Number</option><option value='date'>Date</option><option value='search'>Search</option><option value='password'>Password</option><option value='match'>Match</option><option value='regex'>Custom</option></select></div> \
        <div class='form-group unit-attribute'><label class='control-label'>Units</label> <input type='text' name='unit' id='unit' placeholder='%, feet, etc.' class='form-control'></div> \
				<div class='form-group help-attribute'><label class='control-label'>Help text</label> <textarea class='form-control' name='help' id='help'></textarea> <p class='help-block'>Tell residents what they need to know to answer your question correctly.</p></div>\
				<div class='form-group option-attribute'><label class='control-label'>Options</label> <textarea class='form-control' name='option' id='option'> </textarea> <p class='help-block'>Enter one option per line.</p></div> \
				<div class='form-group checkboxes-attribute'><label class='control-label'>Options</label> <textarea class='form-control' name='checkboxes' id='checkboxes'> </textarea><p class='help-block'>Enter one option per line.</p></div> \
				<div class='form-group radios-attribute'><label class='control-label radios-attribute'>Options</label> <textarea class='form-control radios-attribute' name='radios' id='radios'></textarea><p class='help-block'>Enter one option per line.</p></div> \
      </div></div></div>" +
        fb.view.validation +
        fb.view.conditionals +
        fb.view.calculations +
        fb.view.webhooks +
      "<div class='accordion-markup'> \
        <div class='accordion-section markup'> \
          <div class='accordion-header'>Markup</div> \
          <div class='accordion'> \
				<div class='form-group name-attribute'><label class='control-label'>Name attribute</label> <input class='form-control' type='text' name='name' id='name'> <p class='help-block'>The field's label in your database. Residents will never see this.</p></div>\
				<div class='form-group id-attribute'><label class='control-label id-attribute'>ID attribute</label> <div class='input-group'><div class='input-group-addon'>#</div><input class='form-control id-attribute' type='text' name='id' id='id'></div></div> \
				<div class='form-group class-attribute'><label class='control-label'>CSS classes</label> <input class='form-control' type='text' name='class' id='class'> <p class='help-block'>Separate multiple CSS classes with spaces.</p></div>\
			</div> \
		</div> \
	</div>" +
	fb.view.applyRevertButtons

Fb.prototype.view.addConditional = function() {
		return	"<div class='clonable conditional'> \
					<div class='condition'> \
						<i class='fas fa-minus-circle conditionIcon' onclick='javascript:removeConditional(this)'></i> \
						<span class='conditionalLabel'></span> \
						<select class='allIds conditionalId form-control'> \
						</select> \
						<select class='conditionalOperator form-control' onchange='javascript:conditionalSelect(this)'> \
							<option>matches</option> \
							<option>doesn't match</option> \
							<option>is less than</option> \
							<option>is more than</option> \
							<option>contains</option> \
							<option>doesn't contain</option> \
							<option>contains anything</option> \
							<option>is blank</option> \
						</select> \
						<input type='text' class='conditionalValue form-control' /> \
					</div> \
				</div>"
}

Fb.prototype.view.validateMinMax = function() {
	return	"<fieldset class='validate-minmax'> \
          <legend class='accordion-header'>Allow numbers between&hellip;</legend> \
          <div class='accordion'>\
				  <div class='floatleft'> \
					<label class='control-label'>Minimum</label> <input class='form-control' type='text' name='min' id='min' placeholder='0'> \
				  </div> \
				  <div class='floatleft'> \
					<label class='control-label'>Maximum</label> <input class='form-control' type='text' name='max' id='max' placeholder='&infin;'> \
				  </div> \
          </div> \
			  </fieldset>"
}

Fb.prototype.view.validateRegex = function() {
	return	"<label class='accordion-header' for='regex'>Match the regular expression&hellip;</label> \
				<div class='accordion'><input class='form-control' type='text' name='regex' id='regex'></div> \
			</div>"
}

Fb.prototype.view.validateMatch = function() {
	return 	"<label class='accordion-header' for='match'>Match the answer to&hellip;</label> \
				    <div class='accordion'><select class='form-control' name='match' id='match'><option value=''></option></select></div> \
			     </div>"
}

Fb.prototype.view.validateLength = function() {
	return	"<fieldset> \
            <legend class='accordion-header'>Allow character lengths between&hellip;</legend>\
            <div class='accordion'> \
            <div class='floatleft'> \
    				<label class='control-label'>Minimum</label> <input class='form-control' type='text' name='minlength' id='minlength' placeholder='0'> \
    			</div> \
    			<div class='floatleft'> \
    				<label class='control-label'>Maximum</label> <input class='form-control' type='text' name='maxlength' id='maxlength' placeholder='&infin;'> \
    			</div> \
          </fieldset>"
}

Fb.prototype.view.firstConditional = function() {
		return	"<div class='clonable firstConditional form-inline'> \
    					<select class='showHide form-control'> \
    						<option>Show</option> \
    						<option>Hide</option> \
    					</select> \
              <span>this field if</span> \
              <select class='allAny form-control'> \
                <option>all</option> \
                <option>any</option> \
              </select> \
              <span>of the following apply:</span> \
            </div>"
}

Fb.prototype.view.firstCalculation = function() {
		return	"<div class='firstCalculation'> \
    					<label class='control-label calculationLabel'>Autofill this field with the answer to&hellip;</label> \
    					<select class='allMathIds calculationId form-control'></select> \
    				</div>"
    }

Fb.prototype.view.calculationContainer = function() {
		return "<div class='calculationContainer'> \
					<div class='calculation'> \
						<i class='fas fa-minus-circle conditionIcon' onclick='javascript:removeCalculation(this)'></i> \
						<select class='calculationOperator form-control'> \
							<option>Plus</option> \
							<option>Minus</option> \
							<option>Multiplied by</option> \
							<option>Divided by</option> \
						</select> \
            <span>the answer to</span>\
						<select class='allMathIds calculationId form-control'></select> \
					</div> \
				</div>"
}

Fb.prototype.view.formLink = function(formObj) {
	return '<a href="javascript:void(0)" data-id="' + formObj.id + '" class="start-form recent">' + formObj.content.settings.name + ' <span>Last updated: ' + formObj.updated_at + '</span></a>'
}

Fb.prototype.view.previewIframe = function(formId, scrollTo) {
	return '<iframe src="/form/preview?id=' + formId + scrollTo + '">Your browser does not support iframes, <a href="/form/preview?id=' + formId + '" target="_blank">click here</a> to a view a preview.</iframe>'
}

Fb.prototype.view.listItem = function(item, num, numStr) {
	return "<div> \
            <a href='javascript:void(0)' class='spacer item insert add move' data-index='" + num + "'' data-id='" + item.id + "'> \
              Click to add a field \
            </a> \
          </div> \
          <div" + (item.formtype == "m16" ? " class='page'" : "") + "> \
            <a href='javascript:void(0)' data-index='" + num + "' data-id='" + item.id + "' class='fa fa-sort'></a> \
            <a href='javascript:void(0)' class='item field' data-index='" + num + "' data-id='" + item.id + "'> \
              <span class='itemCount'>" + numStr + "</span>" + item.id + " \
            </a> \
            <a href='javascript:void(0)' data-index='" + num + "' data-id='" + item.id + "' class='fa fa-times'></a> \
          </div>"
}

Fb.prototype.view.listSpacer = function(num) {
	return '<div><a href="javascript:void(0)" class="spacer item insert add move" data-index="' + num + '">Click to add a field</a></div>'
}

Fb.prototype.view.embedCode = function(id, embedUrl, assetsUrl) {
	return '<!-- If possible, place the following in your <head> tag. -->' +
	'\n' +
	'<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />\n' +
	'<link rel="stylesheet" href="' + assetsUrl + 'css/form-base.css" />\n' +
  '<link rel="stylesheet" href="' + assetsUrl + 'css/form-branding.css" />\n' +
	'\n' +
	'<!-- Insert the following in the <body>, wherever\n' +
	'you would like the form to appear. -->' +
	'\n' +
	'<script src="' + embedUrl + '?id=' + id + '"></script>\n' +
	'<noscript>This form requires JavaScript. Please reload the page, or enable JavaScript in your browser.</noscript>\n' +
	'<div id="SFDSWF-Container"></div>'
}