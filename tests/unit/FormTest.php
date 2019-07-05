<?php 
use App\Http\Controllers\FormController;
class FormTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $formTester;
	protected $attributes;
    
    protected function _before()
    {
        $this->formTester = new FormController();

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
        $emptyIsSectional = $this->formTester->isSectional($this->emptyFormAttributes['content']);
        $expected = false;
        $this->assertSame($expected, $emptyIsSectional);

        $simpleIsSectional = $this->formTester->isSectional($this->simpleFormAttributes['content']);
        $expected = false;
        $this->assertEquals($expected, $simpleIsSectional);
		
        $complexIsSectional = $this->formTester->isSectional($this->complexFormAttributes['content']);
        $expected = false;
        $this->assertEquals($expected, $complexIsSectional);

        $sectionalIsSectional = $this->formTester->isSectional($this->sectionalFormAttributes['content']);
        $expected = true;
        $this->assertEquals($expected, $sectionalIsSectional);
	}
	
	public function testFormGetInputSelector()
    {
		$testId = "";
		$this->attributes = array();
		$checked = false;
		
        $emptyGetInputSelector = $this->formTester->getInputSelector($testId, $this->attributes, $checked);
        $expected = '';
        $this->assertSame($expected, $emptyGetInputSelector);

		$testId = "name";
		$this->attributes = array(
								"name" => "c02",
								"submit" => "m14"
							);
		$checked = false;
		
        $simpleGetInputSelector = $this->formTester->getInputSelector($testId, $this->attributes, $checked);
        $expected = '#name';
        $this->assertEquals($expected, $simpleGetInputSelector);

		$testId = "address";
		$this->attributes = array(
								"name" => "c02",
								"address" => "s06",
								"submit" => "m14"
							);
		$checked = false;
		
        $checkboxGetInputSelector = $this->formTester->getInputSelector($testId, $this->attributes, $checked);
        $expected = 'input[name="address[]"]';
        $this->assertEquals($expected, $checkboxGetInputSelector);

		$testId = "address";
		$this->attributes = array(
								"name" => "c02",
								"address" => "s08",
								"submit" => "m14"
							);
		$checked = true;
		
        $checkedRadioGetInputSelector = $this->formTester->getInputSelector($testId, $this->attributes, $checked);
        $expected = 'input[name=address]:checked';
        $this->assertEquals($expected, $checkedRadioGetInputSelector);
	}
	
	public function testFormGetOp()
    {
        $emptyGetOp = $this->formTester->getOp("");
        $expected = '';
        $this->assertSame($expected, $emptyGetOp);

        $anyGetOp = $this->formTester->getOp("Any");
        $expected = '||';
        $this->assertEquals($expected, $anyGetOp);
		
        $allGetOp = $this->formTester->getOp("All");
        $expected = '&&';
        $this->assertEquals($expected, $allGetOp);

        $matchesGetOp = $this->formTester->getOp("matches");
        $expected = '==';
        $this->assertEquals($expected, $matchesGetOp);

        $notMatchGetOp = $this->formTester->getOp("doesn't match");
        $expected = '!=';
        $this->assertEquals($expected, $notMatchGetOp);

        $lessThanGetOp = $this->formTester->getOp("is less than");
        $expected = '<';
        $this->assertEquals($expected, $lessThanGetOp);

        $moreThanGetOp = $this->formTester->getOp("is more than");
        $expected = '>';
        $this->assertEquals($expected, $moreThanGetOp);

        $anythingGetOp = $this->formTester->getOp("contains anything");
        $expected = '!=';
        $this->assertEquals($expected, $anythingGetOp);

        $blankGetOp = $this->formTester->getOp("is blank");
        $expected = '==';
        $this->assertEquals($expected, $blankGetOp);

        $containsGetOp = $this->formTester->getOp("contains");
        $expected = 'contains';
        $this->assertEquals($expected, $containsGetOp);

        $notContainGetOp = $this->formTester->getOp("doesn't contain");
        $expected = "doesn't contain";
        $this->assertEquals($expected, $notContainGetOp);
	}		
	
	public function testFormGetConditionalStatement()
    {
		$foo = "foo";
		
        $emptyGetConditionalStatement = $this->formTester->getConditionalStatement($foo, "", "bar");
        $expected = "";
        $this->assertSame($expected, $emptyGetConditionalStatement);

        $anyGetConditionalStatement = $this->formTester->getConditionalStatement($foo, "||", "bar");
        $expected = "foo || 'bar'";
        $this->assertEquals($expected, $anyGetConditionalStatement);
		
        $allGetConditionalStatement = $this->formTester->getConditionalStatement($foo, "&&", "bar");
        $expected = "foo && 'bar'";
        $this->assertEquals($expected, $allGetConditionalStatement);

        $matchesGetConditionalStatement = $this->formTester->getConditionalStatement($foo, "==", "bar");
        $expected = "foo == 'bar'";
        $this->assertEquals($expected, $matchesGetConditionalStatement);

        $notMatchGetConditionalStatement = $this->formTester->getConditionalStatement($foo, "!=", "bar");
        $expected = "foo != 'bar'";
        $this->assertEquals($expected, $notMatchGetConditionalStatement);

        $lessThanGetConditionalStatement = $this->formTester->getConditionalStatement($foo, "<", "bar");
        $expected = "foo < 'bar'";
        $this->assertEquals($expected, $lessThanGetConditionalStatement);

        $moreThanGetConditionalStatement = $this->formTester->getConditionalStatement($foo, ">", "bar");
        $expected = "foo > 'bar'";
        $this->assertEquals($expected, $moreThanGetConditionalStatement);

        $anythingGetConditionalStatement = $this->formTester->getConditionalStatement($foo, "!=", "");
        $expected = "foo != ''";
        $this->assertEquals($expected, $anythingGetConditionalStatement);

        $blankGetConditionalStatement = $this->formTester->getConditionalStatement($foo, "==", "");
        $expected = "foo == ''";
        $this->assertEquals($expected, $blankGetConditionalStatement);

        $containsGetConditionalStatement = $this->formTester->getConditionalStatement($foo, "contains", "bar");
        $expected = "(foo).search(/bar/i) != -1";
        $this->assertEquals($expected, $containsGetConditionalStatement);

        $notContainGetConditionalStatement = $this->formTester->getConditionalStatement($foo, "doesn't contain", "bar");
        $expected = "(foo).search(/bar/i) == -1";
        $this->assertEquals($expected, $notContainGetConditionalStatement);
	}
	
	public function testFormGetHTML()
    {
        $emptyGetHTML = $this->formTester->getHTML($this->emptyFormAttributes);
        $expected = '<form class="form-horizontal" action="" method="POST" ><fieldset><div id="SFDSWFB-legend"><legend></legend></div></fieldset></form>';
        $this->assertSame($expected, $emptyGetHTML);

        $simpleGetHTML = $this->formTester->getHTML($this->simpleFormAttributes);
        $expected = '<form class="form-horizontal" action="http://somewhere.com/post" method="POST" ><fieldset><div id="SFDSWFB-legend"><legend>Test Form</legend></div><div class="form-group" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" formtype="c02" name="name" type="text" required/><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="submit"><label for="submit" class="control-label"></label><div class="field-wrapper"><button id="submit" formtype="m14" class=" btn-primary">Submit</button><p class="help-block with-errors"></p></div></div></fieldset></form>';
        $this->assertEquals($expected, $simpleGetHTML);
		
        $complexGetHTML = $this->formTester->getHTML($this->complexFormAttributes);
        $expected = '<form class="form-horizontal" action="http://somewhere.com/post" method="POST" ><fieldset><div id="SFDSWFB-legend"><legend>Test Form</legend></div><div class="form-group" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" formtype="c02" name="name" type="text" required/><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="select_dropdown"><label for="select_dropdown" class="control-label">Select - Basic</label><div class="field-wrapper"><select id="select_dropdown" formtype="s02" required><option value="Enter">Enter</option><option value="Your">Your</option><option value="Options">Options</option><option value="Here!">Here!</option></select><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="checkboxId[]"><legend class="control-label">Checkboxes</legend><div class="field-legend"><div class="cb-input-group"><input type="checkbox" id="checkboxId[]_Option_one" value="Option one" formtype="s06" name="checkboxName[]"/><label for="checkboxId[]_Option_one" class="checkbox">Option one</label></div><div class="cb-input-group"><input type="checkbox" id="checkboxId[]_Option_two" value="Option two" formtype="s06" name="checkboxName[]"/><label for="checkboxId[]_Option_two" class="checkbox">Option two</label></div><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="multiple_radios"><label for="multiple_radios" class="control-label">Radio buttons</label><div class="field-wrapper"><div class="rb-input-group"><input type="radio" id="multiple_radios_Option_one" value="Option one" formtype="s08" name="multiple_radios" required/><label for="multiple_radios_Option_one" class="radio">Option one</label></div><div class="rb-input-group"><input type="radio" id="multiple_radios_Option_two" value="Option two" formtype="s08" name="multiple_radios" required/><label for="multiple_radios_Option_two" class="radio">Option two</label></div><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="submit"><label for="submit" class="control-label"></label><div class="field-wrapper"><button id="submit" formtype="m14" class=" btn-primary">Submit</button><p class="help-block with-errors"></p></div></div></fieldset></form>';
        $this->assertEquals($expected, $complexGetHTML);

        $sectionalGetHTML = $this->formTester->getHTML($this->sectionalFormAttributes);
        $expected = '<ul class="form-section-nav"><li class="active">Test Form</li><li>Page Separator</li></ul><form class="form-horizontal" action="http://somewhere.com/post" method="POST" ><fieldset><div id="SFDSWFB-legend"><legend>Test Form</legend></div><div class="sections-container"><div class="form-section-header active">Test Form</div><div class="form-section active"><div class="form-group" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" formtype="c02" name="name" type="text" required/><p class="help-block with-errors"></p></div></div><div class="form-group"><a class="btn btn-lg form-section-prev" href="javascript:void(0)">Previous</a><a class="btn btn-lg form-section-next" href="javascript:void(0)">Next</a></div></div><div class="form-section-header" data-id="page_separator">Page Separator</div><div class="form-section" data-id="page_separator"><div class="form-group" data-id="address"><label for="address" class="control-label">Address</label><div class="field-wrapper"><div class="rb-input-group"><input type="radio" id="address_test" value="test" formtype="s08" name="address" required/><label for="address_test" class="radio">test</label></div><p class="help-block with-errors"></p></div></div><div class="form-group"><a class="btn btn-lg form-section-prev" href="javascript:void(0)">Previous</a><button id="submit" class="btn btn-lg submit">Submit</button></div></div></div></fieldset></form>';
        $this->assertEquals($expected, $sectionalGetHTML);
	}
	
	public function testFormWrapJS()
    {
        $emptyWrapJS = $this->formTester->wrapJS($this->emptyFormAttributes);
		$expected = 'var script = document.createElement(\'script\');script.onload = function () {document.getElementById(\'SFDSWF-Container\').innerHTML = \'<form class="form-horizontal" action="" method="POST" ><fieldset><div id="SFDSWFB-legend"><legend></legend></div></fieldset></form>\';if (typeof SFDSerrorMsgs != \'undefined\') { SFDSerrorMsgs(); } else { jQuery(\'#SFDSWF-Container form\').validator(); }};script.src = \'/assets/js/embed.js\';document.head.appendChild(script);';
        $this->assertSame($expected, $emptyWrapJS);

        $simpleWrapJS = $this->formTester->wrapJS($this->simpleFormAttributes);
        $expected = 'var script = document.createElement(\'script\');script.onload = function () {document.getElementById(\'SFDSWF-Container\').innerHTML = \'<form class="form-horizontal" action="http://somewhere.com/post" method="POST" ><fieldset><div id="SFDSWFB-legend"><legend>Test Form</legend></div><div class="form-group" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" formtype="c02" name="name" type="text" required/><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="submit"><label for="submit" class="control-label"></label><div class="field-wrapper"><button id="submit" formtype="m14" class=" btn-primary">Submit</button><p class="help-block with-errors"></p></div></div></fieldset></form>\';if (typeof SFDSerrorMsgs != \'undefined\') { SFDSerrorMsgs(); } else { jQuery(\'#SFDSWF-Container form\').validator(); }};script.src = \'/assets/js/embed.js\';document.head.appendChild(script);';
        $this->assertEquals($expected, $simpleWrapJS);
		
        $complexWrapJS = $this->formTester->wrapJS($this->complexFormAttributes);
        $expected = 'var script = document.createElement(\'script\');script.onload = function () {document.getElementById(\'SFDSWF-Container\').innerHTML = \'<form class="form-horizontal" action="http://somewhere.com/post" method="POST" ><fieldset><div id="SFDSWFB-legend"><legend>Test Form</legend></div><div class="form-group" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" formtype="c02" name="name" type="text" required/><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="select_dropdown"><label for="select_dropdown" class="control-label">Select - Basic</label><div class="field-wrapper"><select id="select_dropdown" formtype="s02" required><option value="Enter">Enter</option><option value="Your">Your</option><option value="Options">Options</option><option value="Here!">Here!</option></select><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="checkboxId[]"><legend class="control-label">Checkboxes</legend><div class="field-legend"><div class="cb-input-group"><input type="checkbox" id="checkboxId[]_Option_one" value="Option one" formtype="s06" name="checkboxName[]"/><label for="checkboxId[]_Option_one" class="checkbox">Option one</label></div><div class="cb-input-group"><input type="checkbox" id="checkboxId[]_Option_two" value="Option two" formtype="s06" name="checkboxName[]"/><label for="checkboxId[]_Option_two" class="checkbox">Option two</label></div><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="multiple_radios"><label for="multiple_radios" class="control-label">Radio buttons</label><div class="field-wrapper"><div class="rb-input-group"><input type="radio" id="multiple_radios_Option_one" value="Option one" formtype="s08" name="multiple_radios" required/><label for="multiple_radios_Option_one" class="radio">Option one</label></div><div class="rb-input-group"><input type="radio" id="multiple_radios_Option_two" value="Option two" formtype="s08" name="multiple_radios" required/><label for="multiple_radios_Option_two" class="radio">Option two</label></div><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="submit"><label for="submit" class="control-label"></label><div class="field-wrapper"><button id="submit" formtype="m14" class=" btn-primary">Submit</button><p class="help-block with-errors"></p></div></div></fieldset></form>\';if (typeof SFDSerrorMsgs != \'undefined\') { SFDSerrorMsgs(); } else { jQuery(\'#SFDSWF-Container form\').validator(); }};script.src = \'/assets/js/embed.js\';document.head.appendChild(script);';
        $this->assertEquals($expected, $complexWrapJS);

        $sectionalWrapJS = $this->formTester->wrapJS($this->sectionalFormAttributes);
        $expected = 'var script = document.createElement(\'script\');script.onload = function () {document.getElementById(\'SFDSWF-Container\').innerHTML = \'<ul class="form-section-nav"><li class="active">Test Form</li><li>Page Separator</li></ul><form class="form-horizontal" action="http://somewhere.com/post" method="POST" ><fieldset><div id="SFDSWFB-legend"><legend>Test Form</legend></div><div class="sections-container"><div class="form-section-header active">Test Form</div><div class="form-section active"><div class="form-group" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" formtype="c02" name="name" type="text" required/><p class="help-block with-errors"></p></div></div><div class="form-group"><a class="btn btn-lg form-section-prev" href="javascript:void(0)">Previous</a><a class="btn btn-lg form-section-next" href="javascript:void(0)">Next</a></div></div><div class="form-section-header" data-id="page_separator">Page Separator</div><div class="form-section" data-id="page_separator"><div class="form-group" data-id="address"><label for="address" class="control-label">Address</label><div class="field-wrapper"><div class="rb-input-group"><input type="radio" id="address_test" value="test" formtype="s08" name="address" required/><label for="address_test" class="radio">test</label></div><p class="help-block with-errors"></p></div></div><div class="form-group"><a class="btn btn-lg form-section-prev" href="javascript:void(0)">Previous</a><button id="submit" class="btn btn-lg submit">Submit</button></div></div></div></fieldset></form>\';if (typeof SFDSerrorMsgs != \'undefined\') { SFDSerrorMsgs(); } else { jQuery(\'#SFDSWF-Container form\').validator(); }initSectional();};script.src = \'/assets/js/embed.js\';document.head.appendChild(script);';
        $this->assertEquals($expected, $sectionalWrapJS);
		
		//todo calculation and conditional tests
		
        $this->webhookSingleAttributes = array(
            "id" => "",
			"content" => json_decode('{"settings":{"action":"http://somewhere.com/post","method":"POST","name":"Test Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"label":"BAN Number","placeholder":"","help":"","id":"BAN","formtype":"d06","type":"number","required":"true","name":"BAN"},{"label":"Address","radios":["test"],"id":"address","formtype":"s08","name":"address","required":"true","webhooks":{"ids":["BAN"],"endpoint":"http:\/\/apps.sfgov.org\/bpdev\/sites\/all\/modules\/ccsf_api\/TTX\/BAN.php?type=OOC","responseIndex":"StreetAddress","method":"json","optionsArray":"false","delimiter":"","responseOptionsIndex":""}},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}', true)
        );
		
        $webhookSingleWrapJS = $this->formTester->wrapJS($this->webhookSingleAttributes);
        $expected = 'var script = document.createElement(\'script\');script.onload = function () {document.getElementById(\'SFDSWF-Container\').innerHTML = \'<form class="form-horizontal" action="http://somewhere.com/post" method="POST" ><fieldset><div id="SFDSWFB-legend"><legend>Test Form</legend></div><div class="form-group" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" formtype="c02" name="name" type="text" required/><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="BAN"><label for="BAN" class="control-label">BAN Number</label><div class="field-wrapper"><input id="BAN" formtype="d06" type="number" required name="BAN" step="any"/><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="address"><label for="address" class="control-label">Address</label><div class="field-wrapper"><div class="rb-input-group"><input type="radio" id="address_test" value="test" formtype="s08" name="address" required/><label for="address_test" class="radio">test</label></div><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="submit"><label for="submit" class="control-label"></label><div class="field-wrapper"><button id="submit" formtype="m14" class=" btn-primary">Submit</button><p class="help-block with-errors"></p></div></div></fieldset></form>\';if (typeof SFDSerrorMsgs != \'undefined\') { SFDSerrorMsgs(); } else { jQuery(\'#SFDSWF-Container form\').validator(); }jQuery(\'#BAN\').on(\'change\',function(){if (jQuery(\'#BAN\').val() != \'\') callWebhook(\'address\', \'http://apps.sfgov.org/bpdev/sites/all/modules/ccsf_api/TTX/BAN.php?type=OOC\', Array(\'BAN\'), \'StreetAddress\', \'json\', false, null, null);});};script.src = \'/assets/js/embed.js\';document.head.appendChild(script);';
        $this->assertEquals($expected, $webhookSingleWrapJS);
		
        $this->webhookOptionsAttributes = array(
            "id" => "",
			"content" => json_decode('{"settings":{"action":"http://somewhere.com/post","method":"POST","name":"Test Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"label":"BAN Number","placeholder":"","help":"","id":"BAN","formtype":"d06","type":"number","required":"true","name":"BAN"},{"label":"Address","radios":["test"],"id":"address","formtype":"s08","name":"address","required":"true","webhooks":{"ids":["BAN"],"endpoint":"http:\/\/apps.sfgov.org\/bpdev\/sites\/all\/modules\/ccsf_api\/TTX\/BAN.php?type=OOC","responseIndex":"StreetAddress","method":"json","optionsArray":"true","delimiter":"","responseOptionsIndex":""}},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}', true)
        );

        $webhookOptionsWrapJS = $this->formTester->wrapJS($this->webhookOptionsAttributes);
        $expected = 'var script = document.createElement(\'script\');script.onload = function () {document.getElementById(\'SFDSWF-Container\').innerHTML = \'<form class="form-horizontal" action="http://somewhere.com/post" method="POST" ><fieldset><div id="SFDSWFB-legend"><legend>Test Form</legend></div><div class="form-group" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" formtype="c02" name="name" type="text" required/><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="BAN"><label for="BAN" class="control-label">BAN Number</label><div class="field-wrapper"><input id="BAN" formtype="d06" type="number" required name="BAN" step="any"/><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="address"><label for="address" class="control-label">Address</label><div class="field-wrapper"><div class="rb-input-group"><input type="radio" id="address_test" value="test" formtype="s08" name="address" required/><label for="address_test" class="radio">test</label></div><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="submit"><label for="submit" class="control-label"></label><div class="field-wrapper"><button id="submit" formtype="m14" class=" btn-primary">Submit</button><p class="help-block with-errors"></p></div></div></fieldset></form>\';if (typeof SFDSerrorMsgs != \'undefined\') { SFDSerrorMsgs(); } else { jQuery(\'#SFDSWF-Container form\').validator(); }jQuery(\'#BAN\').on(\'change\',function(){if (jQuery(\'#BAN\').val() != \'\') callWebhook(\'address\', \'http://apps.sfgov.org/bpdev/sites/all/modules/ccsf_api/TTX/BAN.php?type=OOC\', Array(\'BAN\'), \'StreetAddress\', \'json\', true, null, null);});};script.src = \'/assets/js/embed.js\';document.head.appendChild(script);';
        $this->assertEquals($expected, $webhookOptionsWrapJS);
		
        $this->webhookDelimiterAttributes = array(
            "id" => "",
			"content" => json_decode('{"settings":{"action":"http://somewhere.com/post","method":"POST","name":"Test Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"label":"BAN Number","placeholder":"","help":"","id":"BAN","formtype":"d06","type":"number","required":"true","name":"BAN"},{"label":"Address","radios":["test"],"id":"address","formtype":"s08","name":"address","required":"true","webhooks":{"ids":["BAN"],"endpoint":"http:\/\/apps.sfgov.org\/bpdev\/sites\/all\/modules\/ccsf_api\/TTX\/BAN.php?type=OOC","responseIndex":"StreetAddress","method":"json","optionsArray":"true","delimiter":",","responseOptionsIndex":""}},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}', true)
        );    
		
        $webhookDelimiterWrapJS = $this->formTester->wrapJS($this->webhookDelimiterAttributes);
        $expected = 'var script = document.createElement(\'script\');script.onload = function () {document.getElementById(\'SFDSWF-Container\').innerHTML = \'<form class="form-horizontal" action="http://somewhere.com/post" method="POST" ><fieldset><div id="SFDSWFB-legend"><legend>Test Form</legend></div><div class="form-group" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" formtype="c02" name="name" type="text" required/><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="BAN"><label for="BAN" class="control-label">BAN Number</label><div class="field-wrapper"><input id="BAN" formtype="d06" type="number" required name="BAN" step="any"/><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="address"><label for="address" class="control-label">Address</label><div class="field-wrapper"><div class="rb-input-group"><input type="radio" id="address_test" value="test" formtype="s08" name="address" required/><label for="address_test" class="radio">test</label></div><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="submit"><label for="submit" class="control-label"></label><div class="field-wrapper"><button id="submit" formtype="m14" class=" btn-primary">Submit</button><p class="help-block with-errors"></p></div></div></fieldset></form>\';if (typeof SFDSerrorMsgs != \'undefined\') { SFDSerrorMsgs(); } else { jQuery(\'#SFDSWF-Container form\').validator(); }jQuery(\'#BAN\').on(\'change\',function(){if (jQuery(\'#BAN\').val() != \'\') callWebhook(\'address\', \'http://apps.sfgov.org/bpdev/sites/all/modules/ccsf_api/TTX/BAN.php?type=OOC\', Array(\'BAN\'), \'StreetAddress\', \'json\', true, \',\', null);});};script.src = \'/assets/js/embed.js\';document.head.appendChild(script);';
        $this->assertEquals($expected, $webhookDelimiterWrapJS);
		
        $this->webhookFullAttributes = array(
            "id" => "",
			"content" => json_decode('{"settings":{"action":"http://somewhere.com/post","method":"POST","name":"Test Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"label":"BAN Number","placeholder":"","help":"","id":"BAN","formtype":"d06","type":"number","required":"true","name":"BAN"},{"label":"Address","radios":["test"],"id":"address","formtype":"s08","name":"address","required":"true","webhooks":{"ids":["BAN"],"endpoint":"http:\/\/apps.sfgov.org\/bpdev\/sites\/all\/modules\/ccsf_api\/TTX\/BAN.php?type=OOC","responseIndex":"StreetAddress","method":"json","optionsArray":"true","delimiter":"","responseOptionsIndex":"data"}},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}', true)
        );    
		
        $webhookFullWrapJS = $this->formTester->wrapJS($this->webhookFullAttributes);
        $expected = 'var script = document.createElement(\'script\');script.onload = function () {document.getElementById(\'SFDSWF-Container\').innerHTML = \'<form class="form-horizontal" action="http://somewhere.com/post" method="POST" ><fieldset><div id="SFDSWFB-legend"><legend>Test Form</legend></div><div class="form-group" data-id="name"><label for="name" class="control-label">Name</label><div class="field-wrapper"><input id="name" formtype="c02" name="name" type="text" required/><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="BAN"><label for="BAN" class="control-label">BAN Number</label><div class="field-wrapper"><input id="BAN" formtype="d06" type="number" required name="BAN" step="any"/><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="address"><label for="address" class="control-label">Address</label><div class="field-wrapper"><div class="rb-input-group"><input type="radio" id="address_test" value="test" formtype="s08" name="address" required/><label for="address_test" class="radio">test</label></div><p class="help-block with-errors"></p></div></div><div class="form-group" data-id="submit"><label for="submit" class="control-label"></label><div class="field-wrapper"><button id="submit" formtype="m14" class=" btn-primary">Submit</button><p class="help-block with-errors"></p></div></div></fieldset></form>\';if (typeof SFDSerrorMsgs != \'undefined\') { SFDSerrorMsgs(); } else { jQuery(\'#SFDSWF-Container form\').validator(); }jQuery(\'#BAN\').on(\'change\',function(){if (jQuery(\'#BAN\').val() != \'\') callWebhook(\'address\', \'http://apps.sfgov.org/bpdev/sites/all/modules/ccsf_api/TTX/BAN.php?type=OOC\', Array(\'BAN\'), \'StreetAddress\', \'json\', true, null, \'data\');});};script.src = \'/assets/js/embed.js\';document.head.appendChild(script);';
        $this->assertEquals($expected, $webhookFullWrapJS);		
	}
	
    protected function _after()
    {
    }
}