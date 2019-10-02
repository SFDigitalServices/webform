describe("HTML templates", function() {
	var fb = new Fb()

  beforeEach(function() {
  });

  it("should spit out validation html", function() {
    expect(fb.view.validation).toEqual("\
	<div class='accordion-validation'> \
		<div class='accordion-section validation'> \
			<div class='accordion-header'>Validation</div> \
			<div class='accordion'> \
			  <div class='validate-required' data-toggle='tooltip' title='Check this to indicate the user must fill out this field'> \
				<label class='control-label' for='required'>Required</label> &nbsp;<input class='' type='checkbox' id='required'><br/>  \
			  </div> \
			  <div class='validate-type' data-toggle='tooltip' title='This is to make sure the user response fits the field type'> \
				<label class='control-label'>Type</label> <select class='form-control' name='type' id='type'><option value='text'>Text</option><option value='email'>Email</option><option value='tel'>Phone</option><option value='url'>URL</option><option value='number'>Number</option><option value='date'>Date</option><option value='search'>Search</option><option value='password'>Password</option><option value='match'>Match</option><option value='regex'>Custom</option></select> \
			  </div> \
			  <div class='clear'></div> \
			</div> \
		</div> \
	</div>");
  });

  it("should spit out conditionals html", function() {
    expect(fb.view.conditionals).toEqual("\
	<div class='accordion-conditionals'> \
		<div class='accordion-section conditionals'> \
			<div class='accordion-header'>Conditionals</div> \
			<div class='accordion'> \
				<div class='clonable addConditionalContainer'> \
					<div class='addConditional' style=''> \
						<a href='javascript:void(0)' onclick='javascript:addConditional()'>+Add A Condition</a> \
					</div> \
				</div> \
			</div> \
		</div> \
	</div>");
  });

  it("should spit out calculations html", function() {
    expect(fb.view.calculations).toEqual("\
	<div class='accordion-calculations'> \
		<div class='accordion-section calculations'> \
			<div class='accordion-header'>Calculations</div> \
			<div class='accordion'> \
				<div class='addCalculationContainer'> \
					<div class='addCalculation'> \
						<a href='javascript:void(0)' onclick='javascript:addCalculation()'>+Add A Calculation</a> \
					</div> \
				</div> \
			</div> \
		</div> \
	</div>");
  });

  it("should spit out webhooks html", function() {
    expect(fb.view.webhooks).toEqual("\
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
					<select class='webhookMethod'> \
						<option>json</option> \
						<option>xml</option> \
						<option>html</option> \
						<option>script</option> \
						<option>jsonp</option> \
						<option>text</option> \
					</select> \
					<div data-toggle='tooltip' title='' data-original-title='The data index or path to retrieve from the response object, slashes / can be used for traversing hierarchies'> \
						<label class='control-label' save_image_to_download='true'>Response Index/Path</label> \
					</div>				 \
					<input type='text' class='form-control webhookResponseIndex' /> \
					<div data-toggle='tooltip' title='' data-original-title='The data response that is received. A single value option or an array of options'> \
						<label class='control-label' save_image_to_download='true'>Response Type</label> \
					</div>				 \
					<select class='webhookOptionsArray' onchange='javascript:webhookOptions(this)'> \
						<option>Single Response</option> \
						<option>Will Contain Many Options</option> <!--only valid if using checkbox, radio or select--> \
					</select> \
					<div class='webhookOptionsEditor'> \
						<div data-toggle='tooltip' title='' data-original-title='When parsing an array of options to populate your question field, is it from a delimited string or data constructed as siblings of a parent'> \
							<label class='control-label' save_image_to_download='true'>Array Split Method</label> \
						</div>				 \
						<select class='webhookResponseOptionType' onchange='javascript:webhookResponseOptionType(this)'> \
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
	</div>");
  });

  it("should spit out apply and revert buttons html", function() {
    expect(fb.view.applyRevertButtons).toEqual("\
	<button class='apply-button btn btn-md btn-primary'>Apply</button> \
	<button class='revert-button btn btn-md btn-secondary'>Revert</button>");
  });

  it("should spit out edit item html", function() {
    expect(fb.view.editItem).toEqual("\
	<div class='accordion-attributes'> \
		<div class='accordion-section attributes'> \
			<div class='accordion-header'>Attributes</div> \
			<div class='accordion'> \
				<input type='hidden' name='formtype' id='formtype'/>\
				<label class='control-label label-attribute'>Label Text</label> <input class='form-control label-attribute' type='text' name='label' id='label'> \
				<label class='control-label placeholder-attribute'>Placeholder</label> <input type='text' name='placeholder' id='placeholder' class='form-control placeholder-attribute'> \
				<label class='control-label help-attribute'>Help Text</label> <input type='text' name='help' id='help' class='form-control help-attribute'> \
				<label class='control-label option-attribute'>Options</label> <textarea class='form-control option-attribute' name='option' id='option'> </textarea> \
				<label class='control-label checkboxes-attribute'>Checkboxes</label> <textarea class='form-control checkboxes-attribute' name='checkboxes' id='checkboxes'> </textarea> \
				<label class='control-label radios-attribute'>Radios</label> <textarea class='form-control radios-attribute' name='radios' id='radios'></textarea> \
				<label class='control-label textarea-attribute'>Text Area</label> <textarea class='form-control textarea-attribute' name='textarea' id='textarea'></textarea> \
				<label class='control-label codearea-attribute'>Text Area</label> <textarea class='form-control codearea-attribute' name='codearea' id='codearea'></textarea> \
				<label class='control-label value-attribute'>Default Value</label> <input data-toggle='tooltip' title='Use this to prefill this field with a value, otherwise this should be left blank' class='form-control value-attribute' type='text' name='value' id='value'> \
				<label class='control-label name-attribute'>Name Attribute</label> <input data-toggle='tooltip' title='You must set a unique machine name for this field' class='form-control name-attribute' type='text' name='name' id='name'> \
				<label class='control-label id-attribute'>Unique ID</label> <input data-toggle='tooltip' title='Use this to set the unique id of this field, it is good practice to use the same value as the name' class='form-control id-attribute' type='text' name='id' id='id'> \
				<label class='control-label class-attribute'>Class Attribute</label> <input data-toggle='tooltip' title='Use this to set the css identifier, it is not required unless needed for styling' class='form-control class-attribute' type='text' name='class' id='class'> \
			</div> \
		</div> \
	</div>" +
	fb.view.validation +
	fb.view.conditionals +
	fb.view.calculations +
	fb.view.webhooks +
	fb.view.applyRevertButtons);
  });

  it("should spit out add conditional html", function() {
    expect(fb.view.addConditional()).toEqual("<div class='clonable conditional'> \
					<div class='condition'> \
						<i class='fas fa-minus-circle conditionIcon' onclick='javascript:removeConditional(this)'></i> \
						<span class='conditionalLabel'></span> \
						<select class='allIds conditionalId'> \
						</select> \
						<select class='conditionalOperator' onchange='javascript:conditionalSelect(this)'> \
							<option>matches</option> \
							<option>doesn't match</option> \
							<option>is less than</option> \
							<option>is more than</option> \
							<option>contains</option> \
							<option>doesn't contain</option> \
							<option>contains anything</option> \
							<option>is blank</option> \
						</select> \
						<input type='text' class='conditionalValue' /> \
					</div> \
				</div>");
  });

  it("should spit out min max validation html", function() {
    expect(fb.view.validateMinMax()).toEqual("<div class='validate-minmax'> \
				  <div class='floatleft' data-toggle='tooltip' title='The lowest acceptable numerical value, leave blank if there is none'> \
					<label class='control-label'>Min Value</label> <input class='form-control' type='text' name='min' id='min'> \
				  </div> \
				  <div class='floatright' data-toggle='tooltip' title='The highest acceptable numerical value, leave blank if there is none'> \
					<label class='control-label'>Max Value</label> <input class='form-control' type='text' name='max' id='max'> \
				  </div> \
				  <div class='clear'></div> \
			  </div>");
  });

  it("should spit out regex validation html", function() {
    expect(fb.view.validateRegex()).toEqual("<div class='validate-regex' data-toggle='tooltip' title='For advanced users only'> \
				<label class='control-label'>Regular Expression</label> <input class='form-control' type='text' name='regex' id='regex'> \
			</div>");
  });

  it("should spit out match validation html", function() {
    expect(fb.view.validateMatch()).toEqual("<div class='validate-match' data-toggle='tooltip' title='Use this to only accept a user response if the value matches a different field that you specify'> \
				<label class='control-label'>Match Another</label> <select class='form-control' name='match' id='match'><option value=''></option></select> \
			</div>");
  });

  it("should spit out length validation html", function() {
    expect(fb.view.validateLength()).toEqual("<div class='floatleft' data-toggle='tooltip' title='The minimum amount of characters allowed, leave blank if there is none'> \
				<label class='control-label'>Min Length</label> <input class='form-control' type='text' name='minlength' id='minlength'> \
			</div> \
			<div class='floatright' data-toggle='tooltip' title='The maximum amount of characters allowed, leave blank if there is none'> \
				<label class='control-label'>Max Length</label> <input class='form-control' type='text' name='maxlength' id='maxlength'> \
			</div>");
  });

  it("should spit out first conditional html", function() {
    expect(fb.view.firstConditional()).toEqual("<div class='clonable firstConditional'> \
					<select class='showHide'> \
						<option>Show</option> \
						<option>Hide</option> \
					</select> \
				</div>");
  });

  it("should spit out multiple conditionals html", function() {
    expect(fb.view.multipleConditionals()).toEqual("<div class='clonable multipleConditionals'> \
					<select class='allAny'> \
						<option>All</option> \
						<option>Any</option> \
					</select> \
				</div>");
  });

  it("should spit out first calculation html", function() {
    expect(fb.view.firstCalculation()).toEqual("<div class='firstCalculation'> \
					<label class='control-label calculationLabel'>Calculation</label> \
					<select class='allMathIds calculationId'></select> \
				</div>");
  });

  it("should spit out calculation html", function() {
    expect(fb.view.calculationContainer()).toEqual("<div class='calculationContainer'> \
					<div class='calculation'> \
						<i class='fas fa-minus-circle conditionIcon' onclick='javascript:removeCalculation(this)'></i> \
						<select class='calculationOperator'> \
							<option>Plus</option> \
							<option>Minus</option> \
							<option>Multiplied by</option> \
							<option>Divided by</option> \
						</select> \
						<select class='allMathIds calculationId'></select> \
					</div> \
				</div>");
  });

  it("should spit out form links html", function() {
    expect(fb.view.formLink({id:'a',updated_at:'c',content:{settings:{name:'b'}}})).toEqual('<a href="javascript:void(0)" data-id="a" class="start-form recent btn btn-default btn-md btn-block">b <span style="color:green">Last updated: c</span></a>');
  });

  it("should spit out preview iframe html", function() {
    expect(fb.view.previewIframe('a', 'b')).toEqual('<iframe src="/form/preview/?id=ab">Your browser does not support iframes, <a href="/form/preview/?id=a" target="_blank">click here</a> to a view a preview.</iframe>');
  });

  it("should spit out list item html", function() {
    expect(fb.view.listItem('a', 1, 'b')).toEqual('<div><a href="javascript:void(0)" class="spacer item insert add move" data-index="1" data-id="a">insert item</a></div><div><a href="javascript:void(0)" class="item field" data-index="1" data-id="a"><span class="itemCount">b</span>a</a><a href="javascript:void(0)" data-index="1" class="fa fa-sort"></a><a href="javascript:void(0)" data-index="1" class="fa fa-times"></a></div>');
  });

  it("should spit out list spacer html", function() {
    expect(fb.view.listSpacer(1)).toEqual('<div><a href="javascript:void(0)" class="spacer item insert add move" data-index="1">insert item</a></div>');
  });

  it("should spit out embed code html", function() {
    expect(fb.view.embedCode('a','b','//')).toEqual('<!-- If possible, place the following in your <head> tag. -->' +
	'\n' +
	'<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />\n' +
	'<link rel="stylesheet" href="//css/form-base.css" />\n' +
	'\n' +
	'<!-- Insert the following in the <body>, wherever\n' +
	'you would like the form to appear. -->' +
	'\n' +
	'<script src="b?id=a"></script>\n' +
	'<noscript>This form requires JavaScript. Please reload the page, or enable JavaScript in your browser.</noscript>\n' +
	'<div id="SFDSWF-Container"></div>');
  });

})