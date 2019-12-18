<?php
use App\Http\Controllers\FormController;
use App\Helpers\ControllerHelper;
use App\Helpers\HTMLHelper;
class FormTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $formTester;
    protected $controllerHelper;
    protected $htmlHelper;
    protected $attributes;

    protected function _before()
    {
        $this->formTester = new FormController();
        $this->controllerHelper = new ControllerHelper();
        $this->htmlHelper = new HTMLHelper();

		$this->emptyFormAttributes = array(
            "id" => "",
			"content" => json_decode('{"settings":{"action":"","method":"POST","name":""},"data":[]}', true)
        );

		$this->simpleFormAttributes = array(
            "id" => "",
			"content" => json_decode('{"settings":{"action":"http://somewhere.com/post","method":"POST","name":"Test Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}', true)
        );

		$this->complexFormAttributes = array(
            "id" => "",
			"content" => json_decode('{"settings":{"action":"http://somewhere.com/post","method":"POST","name":"Test Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"label":"Select - Basic","option":["Enter","Your","Options","Here!"],"id":"select_dropdown","formtype":"s02","required":"true"},{"label":"Checkboxes","checkboxes":["Option one","Option two"],"id":"checkboxId[]","formtype":"s06","required":"false","name":"checkboxName"},{"label":"Radio buttons","radios":["Option one","Option two"],"id":"multiple_radios","formtype":"s08","name":"multiple_radios","required":"true"},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}', true)
        );

		$this->sectionalFormAttributes = array(
            "id" => "",
			"content" => json_decode('{"settings":{"action":"http://somewhere.com/post","method":"POST","name":"Test Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"label":"Page Separator","id":"page_separator","formtype":"m16","type":"text"},{"label":"Address","radios":["test"],"id":"address","formtype":"s08","name":"address","required":"true"},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}', true)
        );

	}

	public function testFormIsSectional()
    {
        $emptyIsSectional = $this->htmlHelper->isSectional($this->emptyFormAttributes['content']);
        $expected = false;
        $this->assertSame($expected, $emptyIsSectional);

        $simpleIsSectional = $this->htmlHelper->isSectional($this->simpleFormAttributes['content']);
        $expected = false;
        $this->assertEquals($expected, $simpleIsSectional);

        $complexIsSectional = $this->htmlHelper->isSectional($this->complexFormAttributes['content']);
        $expected = false;
        $this->assertEquals($expected, $complexIsSectional);

        $sectionalIsSectional = $this->htmlHelper->isSectional($this->sectionalFormAttributes['content']);
        $expected = true;
        $this->assertEquals($expected, $sectionalIsSectional);
	}

	public function testFormGetInputSelector()
    {
		$testId = "";
		$this->attributes = array();
		$checked = false;

        $emptyGetInputSelector = $this->htmlHelper->getInputSelector($testId, $this->attributes, $checked);
        $expected = '';
        $this->assertSame($expected, $emptyGetInputSelector);

		$testId = "name";
		$this->attributes = array(
								"name" => "c02",
								"submit" => "m14"
							);
		$checked = false;

        $simpleGetInputSelector = $this->htmlHelper->getInputSelector($testId, $this->attributes, $checked);
        $expected = '#name';
        $this->assertEquals($expected, $simpleGetInputSelector);

		$testId = "address";
		$this->attributes = array(
								"name" => "c02",
								"address" => "s06",
								"submit" => "m14"
							);
		$checked = false;

        $checkboxGetInputSelector = $this->htmlHelper->getInputSelector($testId, $this->attributes, $checked);
        $expected = 'input[name="address[]"]';
        $this->assertEquals($expected, $checkboxGetInputSelector);

		$testId = "address";
		$this->attributes = array(
								"name" => "c02",
								"address" => "s08",
								"submit" => "m14"
							);
		$checked = true;

        $checkedRadioGetInputSelector = $this->htmlHelper->getInputSelector($testId, $this->attributes, $checked);
        $expected = 'input[name=address]:checked';
        $this->assertEquals($expected, $checkedRadioGetInputSelector);
	}

	public function testFormGetOp()
    {
        $emptyGetOp = $this->controllerHelper->getOp("");
        $expected = '';
        $this->assertSame($expected, $emptyGetOp);

        $anyGetOp = $this->controllerHelper->getOp("Any");
        $expected = '||';
        $this->assertEquals($expected, $anyGetOp);

        $allGetOp = $this->controllerHelper->getOp("All");
        $expected = '&&';
        $this->assertEquals($expected, $allGetOp);

        $matchesGetOp = $this->controllerHelper->getOp("matches");
        $expected = '==';
        $this->assertEquals($expected, $matchesGetOp);

        $notMatchGetOp = $this->controllerHelper->getOp("doesn't match");
        $expected = '!=';
        $this->assertEquals($expected, $notMatchGetOp);

        $lessThanGetOp = $this->controllerHelper->getOp("is less than");
        $expected = '<';
        $this->assertEquals($expected, $lessThanGetOp);

        $moreThanGetOp = $this->controllerHelper->getOp("is more than");
        $expected = '>';
        $this->assertEquals($expected, $moreThanGetOp);

        $anythingGetOp = $this->controllerHelper->getOp("contains anything");
        $expected = '!=';
        $this->assertEquals($expected, $anythingGetOp);

        $blankGetOp = $this->controllerHelper->getOp("is blank");
        $expected = '==';
        $this->assertEquals($expected, $blankGetOp);

        $containsGetOp = $this->controllerHelper->getOp("contains");
        $expected = 'contains';
        $this->assertEquals($expected, $containsGetOp);

        $notContainGetOp = $this->controllerHelper->getOp("doesn't contain");
        $expected = "doesn't contain";
        $this->assertEquals($expected, $notContainGetOp);
	}

	public function testFormGetConditionalStatement()
    {
		$foo = "foo";

        $emptyGetConditionalStatement = $this->htmlHelper->getConditionalStatement($foo, "", "bar");
        $expected = "";
        $this->assertSame($expected, $emptyGetConditionalStatement);

        $anyGetConditionalStatement = $this->htmlHelper->getConditionalStatement($foo, "||", "bar");
        $expected = "foo || 'bar'";
        $this->assertEquals($expected, $anyGetConditionalStatement);

        $allGetConditionalStatement = $this->htmlHelper->getConditionalStatement($foo, "&&", "bar");
        $expected = "foo && 'bar'";
        $this->assertEquals($expected, $allGetConditionalStatement);

        $matchesGetConditionalStatement = $this->htmlHelper->getConditionalStatement($foo, "==", "bar");
        $expected = "foo == 'bar'";
        $this->assertEquals($expected, $matchesGetConditionalStatement);

        $notMatchGetConditionalStatement = $this->htmlHelper->getConditionalStatement($foo, "!=", "bar");
        $expected = "foo != 'bar'";
        $this->assertEquals($expected, $notMatchGetConditionalStatement);

        $lessThanGetConditionalStatement = $this->htmlHelper->getConditionalStatement($foo, "<", "bar");
        $expected = "foo < 'bar'";
        $this->assertEquals($expected, $lessThanGetConditionalStatement);

        $moreThanGetConditionalStatement = $this->htmlHelper->getConditionalStatement($foo, ">", "bar");
        $expected = "foo > 'bar'";
        $this->assertEquals($expected, $moreThanGetConditionalStatement);

        $anythingGetConditionalStatement = $this->htmlHelper->getConditionalStatement($foo, "!=", "");
        $expected = "foo != ''";
        $this->assertEquals($expected, $anythingGetConditionalStatement);

        $blankGetConditionalStatement = $this->htmlHelper->getConditionalStatement($foo, "==", "");
        $expected = "foo == ''";
        $this->assertEquals($expected, $blankGetConditionalStatement);

        $containsGetConditionalStatement = $this->htmlHelper->getConditionalStatement($foo, "contains", "bar");
        $expected = "(foo).search(/bar/i) != -1";
        $this->assertEquals($expected, $containsGetConditionalStatement);

        $notContainGetConditionalStatement = $this->htmlHelper->getConditionalStatement($foo, "doesn't contain", "bar");
        $expected = "(foo).search(/bar/i) == -1";
        $this->assertEquals($expected, $notContainGetConditionalStatement);
	}

	public function testFormGetHTML()
    {
        $emptyGetHTML = $this->htmlHelper->getHTML($this->emptyFormAttributes);
        $expected = '<form id="SFDSWFB_forms_" class="form-horizontal" action="" method="POST" ></form>';
        $this->assertSame($expected, $emptyGetHTML);

        $simpleGetHTML = $this->htmlHelper->getHTML($this->simpleFormAttributes);
        $expected = '<form id="SFDSWFB_forms_" class="form-horizontal" action="http://somewhere.com/post" method="POST" ><div class="form-group form-group-field field-c02" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" data-formtype="c02" name="name" type="text" required/></div><div class="help-block with-errors"></div><p class="help-text"></p></div><div class="form-group form-group-field field-m14" data-id="submit"><label for="submit" class="control-label"></label><div class="field-wrapper"><input type="submit" value="Submit" id="submit" data-formtype="m14" class=" btn-primary"/></div><div class="help-block with-errors"></div></div></form>';
        $this->assertEquals($expected, $simpleGetHTML);

        $complexGetHTML = $this->htmlHelper->getHTML($this->complexFormAttributes);
        $expected = '<form id="SFDSWFB_forms_" class="form-horizontal" action="http://somewhere.com/post" method="POST" ><div class="form-group form-group-field field-c02" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" data-formtype="c02" name="name" type="text" required/></div><div class="help-block with-errors"></div><p class="help-text"></p></div><div class="form-group form-group-field field-s02" data-id="select_dropdown"><label for="select_dropdown" class="control-label">Select - Basic</label><div class="field-wrapper"><select id="select_dropdown" data-formtype="s02" required><option value="">Choose an option</option><option value="Enter">Enter</option><option value="Your">Your</option><option value="Options">Options</option><option value="Here!">Here!</option></select></div><div class="help-block with-errors"></div></div><div class="form-group form-group-field field-s06" data-id="checkboxId[]"><fieldset><legend class="control-label">Checkboxes</legend><div class="field-wrapper"><label for="checkboxId[]_Option_one"><input type="checkbox" id="checkboxId[]_Option_one" value="Option one" data-formtype="s06" name="checkboxName[]"/><span class="inline-label">Option one</span></label><label for="checkboxId[]_Option_two"><input type="checkbox" id="checkboxId[]_Option_two" value="Option two" data-formtype="s06" name="checkboxName[]"/><span class="inline-label">Option two</span></label></div><div class="help-block with-errors"></div></fieldset></div><div class="form-group form-group-field field-s08" data-id="multiple_radios"><fieldset><legend class="control-label">Radio buttons</legend><div class="field-wrapper"><label for="multiple_radios_Option_one"><input type="radio" id="multiple_radios_Option_one" value="Option one" data-formtype="s08" name="multiple_radios" required/><span class="inline-label">Option one</span></label><label for="multiple_radios_Option_two"><input type="radio" id="multiple_radios_Option_two" value="Option two" data-formtype="s08" name="multiple_radios" required/><span class="inline-label">Option two</span></label></div><div class="help-block with-errors"></div></fieldset></div><div class="form-group form-group-field field-m14" data-id="submit"><label for="submit" class="control-label"></label><div class="field-wrapper"><input type="submit" value="Submit" id="submit" data-formtype="m14" class=" btn-primary"/></div><div class="help-block with-errors"></div></div></form>';
        $this->assertEquals($expected, $complexGetHTML);

        $sectionalGetHTML = $this->htmlHelper->getHTML($this->sectionalFormAttributes);
        $expected = '<form id="SFDSWFB_forms_" class="form-horizontal" action="http://somewhere.com/post" method="POST" ><div class="sections-container"><div class="form-section active"><header class="hero-banner default" id="form_page_1"><div class="form-header-meta"><h2>Test Form</h2><div class="form-progress"><div class="form-progress-bubble">Page 1 of 2</div></div></div><h1 class="form-section-header" data-id="1">Test Form</h1></header><div class="form-content"><div class="form-group form-group-field field-c02" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" data-formtype="c02" name="name" type="text" required/></div><div class="help-block with-errors"></div><p class="help-text"></p></div><div class="form-group"><button class="btn btn-lg form-section-next">Next</button></div></div></div><div class="form-section" data-id="page_separator"><header class="hero-banner default" id="form_page_2"><div class="form-header-meta"><h2>Test Form</h2><div class="form-progress"><div class="form-progress-bubble">Page 2 of 2</div></div></div><h1 class="form-section-header" data-id="page_separator">Page Separator</h1></header><div class="form-content"><div class="form-group form-group-field field-s08" data-id="address"><fieldset><legend class="control-label">Address</legend><div class="field-wrapper"><label for="address_test"><input type="radio" id="address_test" value="test" data-formtype="s08" name="address" required/><span class="inline-label">test</span></label></div><div class="help-block with-errors"></div></fieldset></div><div class="form-group"><button class="btn btn-lg form-section-prev">Previous</button><input type="submit" id="submit" value="Submit" class="btn btn-lg form-section-submit"/></div></div></div></form>';
        $this->assertEquals($expected, $sectionalGetHTML);
	}

	public function testFormWrapJS()
    {
        $emptyWrapJS = $this->htmlHelper->wrapJS($this->emptyFormAttributes);
		    $expected = 'var SFDSWFB = {};SFDSWFB.preRenderScripts = [\'//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js\', \'///assets/js/validator.js\\', \'///assets/js/error-msgs.js\'];SFDSWFB.postRenderScripts = [\'//unpkg.com/libphonenumber-js@1.7.21/bundle/libphonenumber-min.js\'];var script = document.createElement(\'script\'); SFDSWFB.formRender = function() {document.getElementById(\'SFDSWF-Container\').innerHTML = \'<form id="SFDSWFB_forms_" class="form-horizontal" action="" method="POST" ></form>\';if (typeof SFDSerrorMsgs != \'undefined\') { SFDSerrorMsgs(); } else { jQuery(\'#SFDSWF-Container form\').validator(); }};script.src = \'///assets/js/embed.js\';var s = document.createElement(\'script\');s.setAttribute(\'type\', \'text/javascript\'); s.text=\'\';document.head.append(s);document.head.appendChild(script);';
        $this->assertSame($expected, $emptyWrapJS);

        $simpleWrapJS = $this->htmlHelper->wrapJS($this->simpleFormAttributes);
        $expected = 'var SFDSWFB = {};SFDSWFB.preRenderScripts = [\'//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js\', \'///assets/js/validator.js\\', \'///assets/js/error-msgs.js\'];SFDSWFB.postRenderScripts = [\'//unpkg.com/libphonenumber-js@1.7.21/bundle/libphonenumber-min.js\'];var script = document.createElement(\'script\'); SFDSWFB.formRender = function() {document.getElementById(\'SFDSWF-Container\').innerHTML = \'<form id="SFDSWFB_forms_" class="form-horizontal" action="http://somewhere.com/post" method="POST" ><div class="form-group form-group-field field-c02" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" data-formtype="c02" name="name" type="text" required/></div><div class="help-block with-errors"></div><p class="help-text"></p></div><div class="form-group form-group-field field-m14" data-id="submit"><label for="submit" class="control-label"></label><div class="field-wrapper"><input type="submit" value="Submit" id="submit" data-formtype="m14" class=" btn-primary"/></div><div class="help-block with-errors"></div></div></form>\';if (typeof SFDSerrorMsgs != \'undefined\') { SFDSerrorMsgs(); } else { jQuery(\'#SFDSWF-Container form\').validator(); }};script.src = \'///assets/js/embed.js\';var s = document.createElement(\'script\');s.setAttribute(\'type\', \'text/javascript\'); s.text=\'\';document.head.append(s);document.head.appendChild(script);';
        $this->assertEquals($expected, $simpleWrapJS);

        $complexWrapJS = $this->htmlHelper->wrapJS($this->complexFormAttributes);
        $expected = 'var SFDSWFB = {};SFDSWFB.preRenderScripts = [\'//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js\', \'///assets/js/validator.js\\', \'///assets/js/error-msgs.js\'];SFDSWFB.postRenderScripts = [\'//unpkg.com/libphonenumber-js@1.7.21/bundle/libphonenumber-min.js\'];var script = document.createElement(\'script\'); SFDSWFB.formRender = function() {document.getElementById(\'SFDSWF-Container\').innerHTML = \'<form id="SFDSWFB_forms_" class="form-horizontal" action="http://somewhere.com/post" method="POST" ><div class="form-group form-group-field field-c02" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" data-formtype="c02" name="name" type="text" required/></div><div class="help-block with-errors"></div><p class="help-text"></p></div><div class="form-group form-group-field field-s02" data-id="select_dropdown"><label for="select_dropdown" class="control-label">Select - Basic</label><div class="field-wrapper"><select id="select_dropdown" data-formtype="s02" required><option value="">Choose an option</option><option value="Enter">Enter</option><option value="Your">Your</option><option value="Options">Options</option><option value="Here!">Here!</option></select></div><div class="help-block with-errors"></div></div><div class="form-group form-group-field field-s06" data-id="checkboxId[]"><fieldset><legend class="control-label">Checkboxes</legend><div class="field-wrapper"><label for="checkboxId[]_Option_one"><input type="checkbox" id="checkboxId[]_Option_one" value="Option one" data-formtype="s06" name="checkboxName[]"/><span class="inline-label">Option one</span></label><label for="checkboxId[]_Option_two"><input type="checkbox" id="checkboxId[]_Option_two" value="Option two" data-formtype="s06" name="checkboxName[]"/><span class="inline-label">Option two</span></label></div><div class="help-block with-errors"></div></fieldset></div><div class="form-group form-group-field field-s08" data-id="multiple_radios"><fieldset><legend class="control-label">Radio buttons</legend><div class="field-wrapper"><label for="multiple_radios_Option_one"><input type="radio" id="multiple_radios_Option_one" value="Option one" data-formtype="s08" name="multiple_radios" required/><span class="inline-label">Option one</span></label><label for="multiple_radios_Option_two"><input type="radio" id="multiple_radios_Option_two" value="Option two" data-formtype="s08" name="multiple_radios" required/><span class="inline-label">Option two</span></label></div><div class="help-block with-errors"></div></fieldset></div><div class="form-group form-group-field field-m14" data-id="submit"><label for="submit" class="control-label"></label><div class="field-wrapper"><input type="submit" value="Submit" id="submit" data-formtype="m14" class=" btn-primary"/></div><div class="help-block with-errors"></div></div></form>\';if (typeof SFDSerrorMsgs != \'undefined\') { SFDSerrorMsgs(); } else { jQuery(\'#SFDSWF-Container form\').validator(); }};script.src = \'///assets/js/embed.js\';var s = document.createElement(\'script\');s.setAttribute(\'type\', \'text/javascript\'); s.text=\'\';document.head.append(s);document.head.appendChild(script);';
        $this->assertEquals($expected, $complexWrapJS);

        $sectionalWrapJS = $this->htmlHelper->wrapJS($this->sectionalFormAttributes);
        $expected = 'var SFDSWFB = {};SFDSWFB.preRenderScripts = [\'//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js\', \'///assets/js/validator.js\\', \'///assets/js/error-msgs.js\'];SFDSWFB.postRenderScripts = [\'//unpkg.com/libphonenumber-js@1.7.21/bundle/libphonenumber-min.js\'];var script = document.createElement(\'script\'); SFDSWFB.formRender = function() {document.getElementById(\'SFDSWF-Container\').innerHTML = \'<form id="SFDSWFB_forms_" class="form-horizontal" action="http://somewhere.com/post" method="POST" ><div class="sections-container"><div class="form-section active"><header class="hero-banner default" id="form_page_1"><div class="form-header-meta"><h2>Test Form</h2><div class="form-progress"><div class="form-progress-bubble">Page 1 of 2</div></div></div><h1 class="form-section-header" data-id="1">Test Form</h1></header><div class="form-content"><div class="form-group form-group-field field-c02" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" data-formtype="c02" name="name" type="text" required/></div><div class="help-block with-errors"></div><p class="help-text"></p></div><div class="form-group"><button class="btn btn-lg form-section-next">Next</button></div></div></div><div class="form-section" data-id="page_separator"><header class="hero-banner default" id="form_page_2"><div class="form-header-meta"><h2>Test Form</h2><div class="form-progress"><div class="form-progress-bubble">Page 2 of 2</div></div></div><h1 class="form-section-header" data-id="page_separator">Page Separator</h1></header><div class="form-content"><div class="form-group form-group-field field-s08" data-id="address"><fieldset><legend class="control-label">Address</legend><div class="field-wrapper"><label for="address_test"><input type="radio" id="address_test" value="test" data-formtype="s08" name="address" required/><span class="inline-label">test</span></label></div><div class="help-block with-errors"></div></fieldset></div><div class="form-group"><button class="btn btn-lg form-section-prev">Previous</button><input type="submit" id="submit" value="Submit" class="btn btn-lg form-section-submit"/></div></div></div></form>\';if (typeof SFDSerrorMsgs != \'undefined\') { SFDSerrorMsgs(); } else { jQuery(\'#SFDSWF-Container form\').validator(); }initSectional();};script.src = \'///assets/js/embed.js\';var s = document.createElement(\'script\');s.setAttribute(\'type\', \'text/javascript\'); s.text=\'\';document.head.append(s);document.head.appendChild(script);';
        $this->assertEquals($expected, $sectionalWrapJS);

		//todo calculation and conditional tests

        $this->webhookSingleAttributes = array(
            "id" => "",
			"content" => json_decode('{"settings":{"action":"http://somewhere.com/post","method":"POST","name":"Test Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"label":"BAN Number","placeholder":"","help":"","id":"BAN","formtype":"d06","type":"number","required":"true","name":"BAN"},{"label":"Address","radios":["test"],"id":"address","formtype":"s08","name":"address","required":"true","webhooks":{"ids":["BAN"],"endpoint":"http:\/\/apps.sfgov.org\/bpdev\/sites\/all\/modules\/ccsf_api\/TTX\/BAN.php?type=OOC","responseIndex":"StreetAddress","method":"json","optionsArray":"false","delimiter":"","responseOptionsIndex":""}},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}', true)
        );

        $webhookSingleWrapJS = $this->htmlHelper->wrapJS($this->webhookSingleAttributes);
        $expected = 'var SFDSWFB = {};SFDSWFB.preRenderScripts = [\'//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js\', \'///assets/js/validator.js\\', \'///assets/js/error-msgs.js\'];SFDSWFB.postRenderScripts = [\'//unpkg.com/libphonenumber-js@1.7.21/bundle/libphonenumber-min.js\'];var script = document.createElement(\'script\'); SFDSWFB.formRender = function() {document.getElementById(\'SFDSWF-Container\').innerHTML = \'<form id="SFDSWFB_forms_" class="form-horizontal" action="http://somewhere.com/post" method="POST" ><div class="form-group form-group-field field-c02" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" data-formtype="c02" name="name" type="text" required/></div><div class="help-block with-errors"></div><p class="help-text"></p></div><div class="form-group form-group-field field-d06" data-id="BAN"><label for="BAN" class="control-label">BAN Number</label><div class="field-wrapper"><input id="BAN" data-formtype="d06" type="number" required name="BAN" step="any"/></div><div class="help-block with-errors"></div><p class="help-text"></p></div><div class="form-group form-group-field field-s08" data-id="address"><fieldset><legend class="control-label">Address</legend><div class="field-wrapper"><label for="address_test"><input type="radio" id="address_test" value="test" data-formtype="s08" name="address" required/><span class="inline-label">test</span></label></div><div class="help-block with-errors"></div></fieldset></div><div class="form-group form-group-field field-m14" data-id="submit"><label for="submit" class="control-label"></label><div class="field-wrapper"><input type="submit" value="Submit" id="submit" data-formtype="m14" class=" btn-primary"/></div><div class="help-block with-errors"></div></div></form>\';if (typeof SFDSerrorMsgs != \'undefined\') { SFDSerrorMsgs(); } else { jQuery(\'#SFDSWF-Container form\').validator(); }jQuery(\'#BAN\').on(\'change\',function(){if (jQuery(\'#BAN\').val() != \'\') callWebhook(\'address\', \'http://apps.sfgov.org/bpdev/sites/all/modules/ccsf_api/TTX/BAN.php?type=OOC\', Array(\'BAN\'), \'StreetAddress\', \'json\', false, null, null);});};script.src = \'///assets/js/embed.js\';var s = document.createElement(\'script\');s.setAttribute(\'type\', \'text/javascript\'); s.text=\'\';document.head.append(s);document.head.appendChild(script);';
        $this->assertEquals($expected, $webhookSingleWrapJS);

        $this->webhookOptionsAttributes = array(
            "id" => "",
			"content" => json_decode('{"settings":{"action":"http://somewhere.com/post","method":"POST","name":"Test Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"label":"BAN Number","placeholder":"","help":"","id":"BAN","formtype":"d06","type":"number","required":"true","name":"BAN"},{"label":"Address","radios":["test"],"id":"address","formtype":"s08","name":"address","required":"true","webhooks":{"ids":["BAN"],"endpoint":"http:\/\/apps.sfgov.org\/bpdev\/sites\/all\/modules\/ccsf_api\/TTX\/BAN.php?type=OOC","responseIndex":"StreetAddress","method":"json","optionsArray":"true","delimiter":"","responseOptionsIndex":""}},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}', true)
        );

        $webhookOptionsWrapJS = $this->htmlHelper->wrapJS($this->webhookOptionsAttributes);

        $expected = 'var SFDSWFB = {};SFDSWFB.preRenderScripts = [\'//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js\', \'///assets/js/validator.js\\', \'///assets/js/error-msgs.js\'];SFDSWFB.postRenderScripts = [\'//unpkg.com/libphonenumber-js@1.7.21/bundle/libphonenumber-min.js\'];var script = document.createElement(\'script\'); SFDSWFB.formRender = function() {document.getElementById(\'SFDSWF-Container\').innerHTML = \'<form id="SFDSWFB_forms_" class="form-horizontal" action="http://somewhere.com/post" method="POST" ><div class="form-group form-group-field field-c02" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" data-formtype="c02" name="name" type="text" required/></div><div class="help-block with-errors"></div><p class="help-text"></p></div><div class="form-group form-group-field field-d06" data-id="BAN"><label for="BAN" class="control-label">BAN Number</label><div class="field-wrapper"><input id="BAN" data-formtype="d06" type="number" required name="BAN" step="any"/></div><div class="help-block with-errors"></div><p class="help-text"></p></div><div class="form-group form-group-field field-s08" data-id="address"><fieldset><legend class="control-label">Address</legend><div class="field-wrapper"><label for="address_test"><input type="radio" id="address_test" value="test" data-formtype="s08" name="address" required/><span class="inline-label">test</span></label></div><div class="help-block with-errors"></div></fieldset></div><div class="form-group form-group-field field-m14" data-id="submit"><label for="submit" class="control-label"></label><div class="field-wrapper"><input type="submit" value="Submit" id="submit" data-formtype="m14" class=" btn-primary"/></div><div class="help-block with-errors"></div></div></form>\';if (typeof SFDSerrorMsgs != \'undefined\') { SFDSerrorMsgs(); } else { jQuery(\'#SFDSWF-Container form\').validator(); }jQuery(\'#BAN\').on(\'change\',function(){if (jQuery(\'#BAN\').val() != \'\') callWebhook(\'address\', \'http://apps.sfgov.org/bpdev/sites/all/modules/ccsf_api/TTX/BAN.php?type=OOC\', Array(\'BAN\'), \'StreetAddress\', \'json\', true, null, null);});};script.src = \'///assets/js/embed.js\';var s = document.createElement(\'script\');s.setAttribute(\'type\', \'text/javascript\'); s.text=\'\';document.head.append(s);document.head.appendChild(script);';

        $this->assertEquals($expected, $webhookOptionsWrapJS);

        $this->webhookDelimiterAttributes = array(
            "id" => "",
			"content" => json_decode('{"settings":{"action":"http://somewhere.com/post","method":"POST","name":"Test Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"label":"BAN Number","placeholder":"","help":"","id":"BAN","formtype":"d06","type":"number","required":"true","name":"BAN"},{"label":"Address","radios":["test"],"id":"address","formtype":"s08","name":"address","required":"true","webhooks":{"ids":["BAN"],"endpoint":"http:\/\/apps.sfgov.org\/bpdev\/sites\/all\/modules\/ccsf_api\/TTX\/BAN.php?type=OOC","responseIndex":"StreetAddress","method":"json","optionsArray":"true","delimiter":",","responseOptionsIndex":""}},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}', true)
        );

        $webhookDelimiterWrapJS = $this->htmlHelper->wrapJS($this->webhookDelimiterAttributes);

        $expected = 'var SFDSWFB = {};SFDSWFB.preRenderScripts = [\'//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js\', \'///assets/js/validator.js\\', \'///assets/js/error-msgs.js\'];SFDSWFB.postRenderScripts = [\'//unpkg.com/libphonenumber-js@1.7.21/bundle/libphonenumber-min.js\'];var script = document.createElement(\'script\'); SFDSWFB.formRender = function() {document.getElementById(\'SFDSWF-Container\').innerHTML = \'<form id="SFDSWFB_forms_" class="form-horizontal" action="http://somewhere.com/post" method="POST" ><div class="form-group form-group-field field-c02" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" data-formtype="c02" name="name" type="text" required/></div><div class="help-block with-errors"></div><p class="help-text"></p></div><div class="form-group form-group-field field-d06" data-id="BAN"><label for="BAN" class="control-label">BAN Number</label><div class="field-wrapper"><input id="BAN" data-formtype="d06" type="number" required name="BAN" step="any"/></div><div class="help-block with-errors"></div><p class="help-text"></p></div><div class="form-group form-group-field field-s08" data-id="address"><fieldset><legend class="control-label">Address</legend><div class="field-wrapper"><label for="address_test"><input type="radio" id="address_test" value="test" data-formtype="s08" name="address" required/><span class="inline-label">test</span></label></div><div class="help-block with-errors"></div></fieldset></div><div class="form-group form-group-field field-m14" data-id="submit"><label for="submit" class="control-label"></label><div class="field-wrapper"><input type="submit" value="Submit" id="submit" data-formtype="m14" class=" btn-primary"/></div><div class="help-block with-errors"></div></div></form>\';if (typeof SFDSerrorMsgs != \'undefined\') { SFDSerrorMsgs(); } else { jQuery(\'#SFDSWF-Container form\').validator(); }jQuery(\'#BAN\').on(\'change\',function(){if (jQuery(\'#BAN\').val() != \'\') callWebhook(\'address\', \'http://apps.sfgov.org/bpdev/sites/all/modules/ccsf_api/TTX/BAN.php?type=OOC\', Array(\'BAN\'), \'StreetAddress\', \'json\', true, \',\', null);});};script.src = \'///assets/js/embed.js\';var s = document.createElement(\'script\');s.setAttribute(\'type\', \'text/javascript\'); s.text=\'\';document.head.append(s);document.head.appendChild(script);';

        $this->assertEquals($expected, $webhookDelimiterWrapJS);

        $this->webhookFullAttributes = array(
            "id" => "",
			"content" => json_decode('{"settings":{"action":"http://somewhere.com/post","method":"POST","name":"Test Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"label":"BAN Number","placeholder":"","help":"","id":"BAN","formtype":"d06","type":"number","required":"true","name":"BAN"},{"label":"Address","radios":["test"],"id":"address","formtype":"s08","name":"address","required":"true","webhooks":{"ids":["BAN"],"endpoint":"http:\/\/apps.sfgov.org\/bpdev\/sites\/all\/modules\/ccsf_api\/TTX\/BAN.php?type=OOC","responseIndex":"StreetAddress","method":"json","optionsArray":"true","delimiter":"","responseOptionsIndex":"data"}},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}', true)
        );

        $webhookFullWrapJS = $this->htmlHelper->wrapJS($this->webhookFullAttributes);

        $expected = 'var SFDSWFB = {};SFDSWFB.preRenderScripts = [\'//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js\', \'///assets/js/validator.js\\', \'///assets/js/error-msgs.js\'];SFDSWFB.postRenderScripts = [\'//unpkg.com/libphonenumber-js@1.7.21/bundle/libphonenumber-min.js\'];var script = document.createElement(\'script\'); SFDSWFB.formRender = function() {document.getElementById(\'SFDSWF-Container\').innerHTML = \'<form id="SFDSWFB_forms_" class="form-horizontal" action="http://somewhere.com/post" method="POST" ><div class="form-group form-group-field field-c02" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" data-formtype="c02" name="name" type="text" required/></div><div class="help-block with-errors"></div><p class="help-text"></p></div><div class="form-group form-group-field field-d06" data-id="BAN"><label for="BAN" class="control-label">BAN Number</label><div class="field-wrapper"><input id="BAN" data-formtype="d06" type="number" required name="BAN" step="any"/></div><div class="help-block with-errors"></div><p class="help-text"></p></div><div class="form-group form-group-field field-s08" data-id="address"><fieldset><legend class="control-label">Address</legend><div class="field-wrapper"><label for="address_test"><input type="radio" id="address_test" value="test" data-formtype="s08" name="address" required/><span class="inline-label">test</span></label></div><div class="help-block with-errors"></div></fieldset></div><div class="form-group form-group-field field-m14" data-id="submit"><label for="submit" class="control-label"></label><div class="field-wrapper"><input type="submit" value="Submit" id="submit" data-formtype="m14" class=" btn-primary"/></div><div class="help-block with-errors"></div></div></form>\';if (typeof SFDSerrorMsgs != \'undefined\') { SFDSerrorMsgs(); } else { jQuery(\'#SFDSWF-Container form\').validator(); }jQuery(\'#BAN\').on(\'change\',function(){if (jQuery(\'#BAN\').val() != \'\') callWebhook(\'address\', \'http://apps.sfgov.org/bpdev/sites/all/modules/ccsf_api/TTX/BAN.php?type=OOC\', Array(\'BAN\'), \'StreetAddress\', \'json\', true, null, \'data\');});};script.src = \'///assets/js/embed.js\';var s = document.createElement(\'script\');s.setAttribute(\'type\', \'text/javascript\'); s.text=\'\';document.head.append(s);document.head.appendChild(script);';

        $this->assertEquals($expected, $webhookFullWrapJS);
	}

    protected function _after()
    {
    }
}