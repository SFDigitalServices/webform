<?php
use App\Helpers\HTMLHelper;
use Log;

class HTMLHelperTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $htmlHelperTester;
    protected $attributes;

    protected function _before()
    {
      $this->htmlHelperTester = new HTMLHelper();

      $this->attributes = array(
        "label" => "",
        "id" => "",
        "name" => "",
        "type" => "",
        "formtype" => "",
        "regex" => "",
        "match" => "",
        "required" => "",
        "minlength" => "",
        "maxlength" => "",
        "min" => "",
        "max" => "",
        "class" => "",
        "codearea" => "",
      );

      $this->form = array(
        "id" => "1",
        "content" => array(
          "settings" => array(
            "action" => "",
            "method" => "POST",
            "name" => "Test",
            "backend" => "csv",
            "confirmation" => "",
            "section1" => ""
          ),
          "data" => array(
            0 => array(),
            1 => array(
              "button" => "Submit",
              "id" => "submit",
              "formtype" => "m14",
              "color" => "btn-primary",
              "class" => ""
            )
          )
        )
      );

      $this->formStart = '<form id="SFDSWFB_forms_1" class="form-horizontal" action="" method="POST" ><header class="hero-banner default"><div class="form-header-meta"><h2>Test</h2></div></header><input type="hidden" name="form_id" value="1"/>';
      $this->formStartFile = '<form id="SFDSWFB_forms_1" class="form-horizontal" action="" method="POST"  enctype="multipart/form-data"><header class="hero-banner default"><div class="form-header-meta"><h2>Test</h2></div></header><input type="hidden" name="form_id" value="1"/>';

      $this->formEnd = '<div class="form-group form-group-field field-m14" data-id="submit"><label for="submit" class="control-label"></label><div class="field-wrapper"><input type="submit" value="Submit" id="submit" data-formtype="m14" class=" btn-primary"/></div><div class="help-block with-errors"></div></div><div class="form-group" data-id="saveForLater"><label for="saveForLater" class="control-label"></label><div class="field-wrapper"><a href="javascript:submitPartial(1)" >Save For Later</a></div></div></form>';

    }

    /**
    *  Testing App\Helpers\DataStoreHelper
    **/
    public function testFormRadio()
    {
        $emptyRadio = HTMLHelper::formRadio($this->attributes);
        $expected = '';
        $this->assertSame($expected, $emptyRadio);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = '';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['radios'] = array("option one", "option two");
        $this->attributes['formtype'] = 's08';
        $notEmptyRadio = HTMLHelper::formRadio($this->attributes);
        $expected = '<label for="test_option_one"><input type="radio" id="test_option_one" value="option one" data-formtype="s08"/><span class="inline-label">option one</span></label>';
        $expected .= '<label for="test_option_two"><input type="radio" id="test_option_two" value="option two" data-formtype="s08"/><span class="inline-label">option two</span></label>';
        $this->assertEquals($expected, $notEmptyRadio);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'invalid';
        $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'invalid';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = 'invalid';
		$this->attributes['maxlength'] = 'invalid';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['radios'] = array("option one", "option two");
        $this->attributes['formtype'] = 's08';
        $notEmptyRadio = HTMLHelper::formRadio($this->attributes);
        $expected = '<label for="foo_option_one"><input type="radio" id="foo_option_one" value="option one" name="bar" data-formtype="s08" required class="large rounded"/><span class="inline-label">option one</span></label>';
        $expected .= '<label for="foo_option_two"><input type="radio" id="foo_option_two" value="option two" name="bar" data-formtype="s08" required class="large rounded"/><span class="inline-label">option two</span></label>';
        $this->assertEquals($expected, $notEmptyRadio);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'invalid';
        $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'invalid';
        $this->attributes['required'] = 'true';
        $this->attributes['regex'] = 'invalid';
        $this->attributes['match'] = 'invalid';
        $this->attributes['minlength'] = 'invalid';
        $this->attributes['maxlength'] = 'invalid';
        $this->attributes['min'] = 'invalid';
        $this->attributes['max'] = 'invalid';
        $this->attributes['radios'] = array("option one", "option two");
        $this->attributes['version'] = "other";
        $this->attributes['formtype'] = 's08';
        $otherRadio = HTMLHelper::formRadio($this->attributes);
        $expected = '<label for="foo_option_one"><input type="radio" id="foo_option_one" value="option one" name="bar" data-formtype="s08" required class="large rounded"/><span class="inline-label">option one</span></label>';
        $expected .= '<label for="foo_option_two"><input type="radio" id="foo_option_two" value="option two" name="bar" data-formtype="s08" required class="large rounded"/><span class="inline-label">option two</span></label>';
        $expected .= '<label class="other-label radio" for="foo_Other" onclick="insertOtherTextInput(this)"><input type="radio" value="Other" id="foo_Other" name="bar" data-formtype="s08"><span class="inline-label">Other</span></label>';
        $this->assertEquals($expected, $otherRadio);
    }

    public function testFormCheckbox(){
        $emptyCheckbox = HTMLHelper::formCheckbox($this->attributes);
        $expected = '';
        $this->assertSame($expected, $emptyCheckbox);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = '';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['checkboxes'] = array("option one", "option two");
        $this->attributes['formtype'] = 's06';
        $notEmptyCheckBox= HTMLHelper::formCheckbox($this->attributes);
        $expected = '<label for="test_option_one"><input type="checkbox" id="test_option_one" value="option one" data-formtype="s06"/><span class="inline-label">option one</span></label>';
        $expected .= '<label for="test_option_two"><input type="checkbox" id="test_option_two" value="option two" data-formtype="s06"/><span class="inline-label">option two</span></label>';
        $this->assertEquals($expected, $notEmptyCheckBox);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'invalid';
        $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'invalid';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = 'invalid';
		$this->attributes['maxlength'] = 'invalid';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['checkboxes'] = array("option one", "option two");
        $this->attributes['formtype'] = 's06';
        $notEmptyCheckBox= HTMLHelper::formCheckbox($this->attributes);
        $expected = '<label for="foo_option_one"><input type="checkbox" id="foo_option_one" value="option one" name="bar[]" data-formtype="s06" required class="large rounded" data-required="1"/><span class="inline-label">option one</span></label>';
        $expected .= '<label for="foo_option_two"><input type="checkbox" id="foo_option_two" value="option two" name="bar[]" data-formtype="s06" required class="large rounded" data-required="1"/><span class="inline-label">option two</span></label>';
        $this->assertEquals($expected, $notEmptyCheckBox);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'invalid';
        $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'invalid';
        $this->attributes['required'] = 'true';
        $this->attributes['regex'] = 'invalid';
        $this->attributes['match'] = 'invalid';
        $this->attributes['minlength'] = 'invalid';
        $this->attributes['maxlength'] = 'invalid';
        $this->attributes['min'] = 'invalid';
        $this->attributes['max'] = 'invalid';
        $this->attributes['checkboxes'] = array("option one", "option two");
        $this->attributes['version'] = 'other';
        $this->attributes['formtype'] = 's06';
        $otherCheckBox = HTMLHelper::formCheckbox($this->attributes);
        $expected = '<label for="foo_option_one"><input type="checkbox" id="foo_option_one" value="option one" name="bar[]" data-formtype="s06" required class="large rounded" data-required="1"/><span class="inline-label">option one</span></label>';
        $expected .= '<label for="foo_option_two"><input type="checkbox" id="foo_option_two" value="option two" name="bar[]" data-formtype="s06" required class="large rounded" data-required="1"/><span class="inline-label">option two</span></label>';
        $expected .= '<label class="other-label checkbox" for="foo_Other" onclick="insertOtherTextInput(this)"><input type="checkbox" value="Other" id="foo_Other" name="bar[]" data-formtype="s06" data-required="1" data-error="This field cannot be blank."><span class="inline-label">Other</span></label>';
        $this->assertEquals($expected, $otherCheckBox);
    }
    public function testFormText(){
        // test each type of text inputs: search, address, email...etc
        $emptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input/>';
        $this->assertSame($expected, $emptyText);

		// Name fields
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = '';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'c02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" data-formtype="c02"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'test';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = '';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'c02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" data-formtype="c02"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = 'test';
        $this->attributes['class'] = '';
        $this->attributes['type'] = '';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'c02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" name="test" data-formtype="c02"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = 'large';
        $this->attributes['type'] = '';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'c02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" data-formtype="c02" class="large"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = '';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'c02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" data-formtype="c02" class="large rounded"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = 'text';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'c02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" type="text" data-formtype="c02"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = '';
        $this->attributes['required'] = 'false';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'c02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" data-formtype="c02"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = '';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'c02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" data-formtype="c02" required/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = '';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '5';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'c02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" data-formtype="c02" minlength="5"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = '';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '5';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'c02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" data-formtype="c02" maxlength="5"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'test';
	    $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'text';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = '3';
		$this->attributes['maxlength'] = '9';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'c02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="foo" name="bar" type="text" data-formtype="c02" required minlength="3" maxlength="9" class="large rounded"/>';
        $this->assertEquals($expected, $notEmptyText);

        // Email fields
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = 'email';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'c04';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" type="email" data-formtype="c04"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'test';
	    $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'email';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = '3';
		$this->attributes['maxlength'] = '9';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'c04';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="foo" name="bar" type="email" data-formtype="c04" required minlength="3" maxlength="9" class="large rounded"/>';
        $this->assertEquals($expected, $notEmptyText);

		// Phone fields
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = 'tel';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'c06';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" type="tel" data-formtype="c06"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'test';
	    $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'tel';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = '3';
		$this->attributes['maxlength'] = '9';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'c06';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="foo" name="bar" type="tel" data-formtype="c06" required class="large rounded"/>';
        $this->assertEquals($expected, $notEmptyText);

        // Address fields
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = 'text';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'c08';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" type="text" data-formtype="c08"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'test';
	    $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'text';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = '3';
		$this->attributes['maxlength'] = '9';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'c08';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="foo" name="bar" type="text" data-formtype="c08" required minlength="3" maxlength="9" class="large rounded"/>';
        $this->assertEquals($expected, $notEmptyText);

        // City fields
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = 'text';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'c10';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" type="text" data-formtype="c10"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'test';
	    $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'text';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = '3';
		$this->attributes['maxlength'] = '9';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'c10';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="foo" name="bar" type="text" data-formtype="c10" required minlength="3" maxlength="9" class="large rounded"/>';
        $this->assertEquals($expected, $notEmptyText);

        // Zip fields
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = 'text';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'c14';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" type="text" data-formtype="c14"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'test';
	    $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'text';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = '3';
		$this->attributes['maxlength'] = '9';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'c14';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="foo" name="bar" type="text" data-formtype="c14" required minlength="3" maxlength="9" class="large rounded"/>';
        $this->assertEquals($expected, $notEmptyText);

        // Date fields
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = 'date';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'd02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" type="date" data-formtype="d02" step="any"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'test';
	    $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'date';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = '3';
		$this->attributes['maxlength'] = '9';
		$this->attributes['min'] = '19500101';
		$this->attributes['max'] = '20191231';
        $this->attributes['formtype'] = 'd02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="foo" name="bar" type="date" data-formtype="d02" required min="19500101" max="20191231" class="large rounded" step="any"/>';
        $this->assertEquals($expected, $notEmptyText);

        // Time fields
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = 'time';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'd04';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" type="time" data-formtype="d04"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'test';
	    $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'time';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = '3';
		$this->attributes['maxlength'] = '9';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'd04';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="foo" name="bar" type="time" data-formtype="d04" required minlength="3" maxlength="9" class="large rounded"/>';
        $this->assertEquals($expected, $notEmptyText);

        // Numbers fields
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = 'number';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'd06';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" type="number" data-formtype="d06" step="any"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = 'number';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '5';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'd06';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" type="number" data-formtype="d06" min="5" step="any"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = 'number';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '5';
        $this->attributes['formtype'] = 'd06';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" type="number" data-formtype="d06" max="5" step="any"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'test';
	    $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'number';
        $this->attributes['required'] = 'true';
        $this->attributes['unit'] = 'km';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = '3';
		$this->attributes['maxlength'] = '9';
		$this->attributes['min'] = '10';
		$this->attributes['max'] = '20';
        $this->attributes['formtype'] = 'd06';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="foo" name="bar" type="number" data-formtype="d06" required minlength="3" maxlength="9" min="10" max="20" class="large rounded" step="any"/><span class="units">km</span>';
        $this->assertEquals($expected, $notEmptyText);

        // Price fields
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = 'number';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'd08';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<div class="prepended dollar">$</div><input id="test" type="number" data-formtype="d08" step="0.01"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'test';
	    $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'number';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = '3';
		$this->attributes['maxlength'] = '9';
		$this->attributes['min'] = '10';
		$this->attributes['max'] = '20';
        $this->attributes['formtype'] = 'd08';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<div class="prepended dollar">$</div><input id="foo" name="bar" type="number" data-formtype="d08" required minlength="3" maxlength="9" min="10" max="20" class="large rounded" step="0.01"/>';
        $this->assertEquals($expected, $notEmptyText);

        // URL fields
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = 'url';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'd10';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" type="url" data-formtype="d10"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'test';
	    $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'url';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = '3';
		$this->attributes['maxlength'] = '9';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'd10';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="foo" name="bar" type="url" data-formtype="d10" required minlength="3" maxlength="9" class="large rounded"/>';
        $this->assertEquals($expected, $notEmptyText);

        // Text fields
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = 'text';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'i02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" type="text" data-formtype="i02"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'test';
	    $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'text';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = '3';
		$this->attributes['maxlength'] = '9';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'i02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="foo" name="bar" type="text" data-formtype="i02" required minlength="3" maxlength="9" class="large rounded"/>';
        $this->assertEquals($expected, $notEmptyText);

        // Regex Text fields
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = 'regex';
        $this->attributes['regex'] = '^[_A-z0-9]{1,}$';
        $this->attributes['required'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'i02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" type="text" data-formtype="i02" pattern="^[_A-z0-9]{1,}$"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'test';
	    $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'regex';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = '^[_A-z0-9]{1,}$';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = '3';
		$this->attributes['maxlength'] = '9';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'i02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="foo" name="bar" type="text" data-formtype="i02" pattern="^[_A-z0-9]{1,}$" required minlength="3" maxlength="9" class="large rounded"/>';
        $this->assertEquals($expected, $notEmptyText);

        // Match Text fields
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = 'match';
        $this->attributes['match'] = 'foo';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'i02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="test" type="text" data-formtype="i02" data-match="#foo"/>';
        $this->assertEquals($expected, $notEmptyText);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'test';
	    $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'match';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'world';
		$this->attributes['minlength'] = '3';
		$this->attributes['maxlength'] = '9';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'i02';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="foo" name="bar" type="text" data-formtype="i02" data-match="#world" required minlength="3" maxlength="9" class="large rounded"/>';
        $this->assertEquals($expected, $notEmptyText);
    }
    public function testFormSelect(){
        // test each type of drop downs
        $emptySelect = HTMLHelper::formSelect($this->attributes);
        $expected = '<select></select>';
        $this->assertSame($expected, $emptySelect);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = '';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['option'] = array("option one", "option two");
        $this->attributes['formtype'] = 's02';
        $notEmptySelect = HTMLHelper::formSelect($this->attributes);
        $expected = '<select id="test" data-formtype="s02"><option value="">Choose an option</option><option value="option one">option one</option><option value="option two">option two</option></select>';
        $this->assertEquals($expected, $notEmptySelect);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'invalid';
        $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'invalid';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = 'invalid';
		$this->attributes['maxlength'] = 'invalid';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['option'] = array("option one", "option two");
        $this->attributes['formtype'] = 's02';
        $notEmptySelect = HTMLHelper::formSelect($this->attributes);
        $expected = '<select id="foo" name="bar" data-formtype="s02" required class="large rounded"><option value="">Choose an option</option><option value="option one">option one</option><option value="option two">option two</option></select>';
        $this->assertEquals($expected, $notEmptySelect);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'invalid';
        $this->attributes['id'] = 'foo';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'invalid';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = 'invalid';
		$this->attributes['maxlength'] = 'invalid';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['name'] = 'states';
        $this->attributes['formtype'] = 's14';
        $notEmptySelect = HTMLHelper::formSelect($this->attributes);
        $expected = '<select id="foo" name="states" data-formtype="s14" required class="large rounded"><option value="">Choose an option</option><option value="alabama">Alabama</option><option value="alaska">Alaska</option><option value="arizona">Arizona</option><option value="arkansas">Arkansas</option><option value="california">California</option><option value="colorado">Colorado</option><option value="connecticut">Connecticut</option><option value="delaware">Delaware</option><option value="district-of-columbia">District Of Columbia</option><option value="florida">Florida</option><option value="georgia">Georgia</option><option value="hawaii">Hawaii</option><option value="idaho">Idaho</option><option value="illinois">Illinois</option><option value="indiana">Indiana</option><option value="iowa">Iowa</option><option value="kansas">Kansas</option><option value="kentucky">Kentucky</option><option value="louisiana">Louisiana</option><option value="maine">Maine</option><option value="maryland">Maryland</option><option value="massachusetts">Massachusetts</option><option value="michigan">Michigan</option><option value="minnesota">Minnesota</option><option value="mississippi">Mississippi</option><option value="missouri">Missouri</option><option value="montana">Montana</option><option value="nebraska">Nebraska</option><option value="nevada">Nevada</option><option value="new-hampshire">New Hampshire</option><option value="new-jersey">New Jersey</option><option value="new-mexico">New Mexico</option><option value="new-york">New York</option><option value="north-carolina">North Carolina</option><option value="north-dakota">North Dakota</option><option value="ohio">Ohio</option><option value="oklahoma">Oklahoma</option><option value="oregon">Oregon</option><option value="pennsylvania">Pennsylvania</option><option value="rhode-island">Rhode Island</option><option value="south-carolina">South Carolina</option><option value="south-dakota">South Dakota</option><option value="tennessee">Tennessee</option><option value="texas">Texas</option><option value="utah">Utah</option><option value="vermont">Vermont</option><option value="virginia">Virginia</option><option value="washington">Washington</option><option value="west-virginia">West Virginia</option><option value="wisconsin">Wisconsin</option><option value="wyoming">Wyoming</option></select>';
        $this->assertEquals($expected, $notEmptySelect);
    }
    public function testFormFile(){
        // test file uploads
        $emptyFile = HTMLHelper::formFile($this->attributes);
        $expected = '<label><span class="label"></span><input/><span class="file-custom" data-filename=""></span></label>';
        $this->assertSame($expected, $emptyFile);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = 'file';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'm13';
        $notEmptyFile = HTMLHelper::formFile($this->attributes);
        $expected = '<label><span class="label">test</span><input id="test" type="file" data-formtype="m13"/><span class="file-custom" data-filename=""></span></label>';
        $this->assertEquals($expected, $notEmptyFile);

        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'invalid';
        $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'file';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = 'invalid';
		$this->attributes['maxlength'] = 'invalid';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'm13';
        $notEmptyFile = HTMLHelper::formFile($this->attributes);
        $expected = '<label><span class="label">test</span><input id="foo" name="bar" type="file" data-formtype="m13" required class="large rounded"/><span class="file-custom" data-filename=""></span></label>';
        $this->assertEquals($expected, $notEmptyFile);
    }
    public function testFormButton(){
        $this->attributes['button'] = '';
        $emptyButton = HTMLHelper::formButton($this->attributes);
        $expected = '<input type="submit" value=""/>';
        $this->assertSame($expected, $emptyButton);

        $this->attributes['id'] = '';
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = '';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'm14';
        $this->attributes['button'] = 'Submit';
        $notEmptyButton = HTMLHelper::formButton($this->attributes);
        $expected = '<input type="submit" value="Submit" data-formtype="m14"/>';
        $this->assertEquals($expected, $notEmptyButton);

        $this->attributes['id'] = 'foo';
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'invalid';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['color'] = 'success';
        $this->attributes['type'] = 'button';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = 'invalid';
		$this->attributes['maxlength'] = 'invalid';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'm14';
        $this->attributes['button'] = 'Submit';
        $notEmptyButton = HTMLHelper::formButton($this->attributes);
        $expected = '<input type="submit" value="Submit" id="foo" name="bar" data-formtype="m14" class="large rounded success"/>';
        $this->assertEquals($expected, $notEmptyButton);
    }
    public function testFormParagraph(){
        $emptyParagraph = HTMLHelper::formParagraph($this->attributes);
        $expected = '<p></p>';
        $this->assertSame($expected, $emptyParagraph);

        $this->attributes['id'] = 'paragraph';
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = '';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'm08';
        $this->attributes['textarea'] = 'This is a paragraph';
        $notEmptyParagraph = HTMLHelper::formParagraph($this->attributes);
        $expected = '<p id="paragraph" data-formtype="m08">This is a paragraph</p>';
        $this->assertEquals($expected, $notEmptyParagraph);

        $this->attributes['id'] = 'foo';
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'invalid';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'invalid';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = 'invalid';
		$this->attributes['maxlength'] = 'invalid';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'm08';
        $this->attributes['textarea'] = 'This is a paragraph';
        $notEmptyParagraph = HTMLHelper::formParagraph($this->attributes);
        $expected = '<p id="foo" data-formtype="m08" class="large rounded">This is a paragraph</p>';
        $this->assertEquals($expected, $notEmptyParagraph);

        $this->attributes['id'] = 'foo';
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'invalid';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'invalid';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = 'invalid';
		$this->attributes['maxlength'] = 'invalid';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'm08';
        $this->attributes['textarea'] = 'This is Jim&apos;s &lt;b&gt;&quot;test&quot;&lt;/b&gt;';
        $entityParagraph = HTMLHelper::formParagraph($this->attributes);
        $expected = '<p id="foo" data-formtype="m08" class="large rounded">This is Jim&apos;s &lt;b&gt;&quot;test&quot;&lt;/b&gt;</p>';
        $this->assertEquals($expected, $entityParagraph);

        $this->attributes['id'] = 'paragraph';
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'This is a paragraph';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = '';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'm10';
        $this->attributes['textarea'] = '';
        $notEmptyParagraph = HTMLHelper::formParagraph($this->attributes);
        $expected = '<p id="paragraph" data-formtype="m10">This is a paragraph</p>';
        $this->assertEquals($expected, $notEmptyParagraph);

        $this->attributes['id'] = 'foo';
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'This is a paragraph';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'invalid';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = 'invalid';
		$this->attributes['maxlength'] = 'invalid';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'm10';
        $this->attributes['textarea'] = 'invalid';
        $notEmptyParagraph = HTMLHelper::formParagraph($this->attributes);
        $expected = '<p id="foo" data-formtype="m10" class="large rounded">This is a paragraph</p>';
        $this->assertEquals($expected, $notEmptyParagraph);

        $this->attributes['id'] = 'foo';
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'This is Jim&apos;s &lt;b&gt;&quot;test&quot;&lt;/b&gt;';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'invalid';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = 'invalid';
		$this->attributes['maxlength'] = 'invalid';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'm10';
        $this->attributes['textarea'] = 'invalid';
        $entityParagraph = HTMLHelper::formParagraph($this->attributes);
        $expected = '<p id="foo" data-formtype="m10" class="large rounded">This is Jim&apos;s <b>"test"</b></p>';
        $this->assertEquals($expected, $entityParagraph);

        $this->attributes['id'] = 'foo';
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = "<p>Here's a paragraph</p><ul><li>One</li>\n<br/><li>Two</li></ul>";
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'invalid';
        $this->attributes['required'] = 'true';
        $this->attributes['regex'] = 'invalid';
        $this->attributes['match'] = 'invalid';
        $this->attributes['minlength'] = 'invalid';
        $this->attributes['maxlength'] = 'invalid';
        $this->attributes['min'] = 'invalid';
        $this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'm10';
        $this->attributes['textarea'] = 'invalid';
        $newLinesParagraph = HTMLHelper::formParagraph($this->attributes);
        $expected = "<p id=\"foo\" data-formtype=\"m10\" class=\"large rounded\"><p>Here's a paragraph</p><ul><li>One</li>\n<br/><li>Two</li></ul></p>";
        $this->assertEquals($expected, $newLinesParagraph);
    }

    public function testFormTextArea(){
        $emptyParagraph = HTMLHelper::formTextArea($this->attributes);
        $expected = '<textarea></textarea>';
        $this->assertSame($expected, $emptyParagraph);

        $this->attributes['textarea'] = 'This is a minimum textarea';
        $this->attributes['id'] = 'paragraph';
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = '';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'i14';
        $notEmptyParagraph = HTMLHelper::formTextArea($this->attributes);
        $expected = '<textarea id="paragraph" data-formtype="i14">This is a minimum textarea</textarea>';
        $this->assertEquals($expected, $notEmptyParagraph);

        $this->attributes['textarea'] = 'This is a full textarea';
        $this->attributes['id'] = 'paragraph';
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'invalid';
        $this->attributes['name'] = 'paragraph';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'invalid';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = '5';
		$this->attributes['maxlength'] = '90';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'i14';
        $notEmptyParagraph = HTMLHelper::formTextArea($this->attributes);
        $expected = '<textarea id="paragraph" name="paragraph" data-formtype="i14" required minlength="5" maxlength="90" class="large rounded">This is a full textarea</textarea>';
        $this->assertEquals($expected, $notEmptyParagraph);
    }

    public function testFormHtag(){
        $this->attributes['formtype'] = 'm02';
        $emptyHtag = HTMLHelper::formHtag($this->attributes);
        $expected = '<h1 data-formtype="m02"></h1>';
        $this->assertSame($expected, $emptyHtag);

        $this->attributes['id'] = '';
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = '';
        $this->attributes['textarea'] = '';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['type'] = '';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'm02';
        $notEmptyHtag = HTMLHelper::formHtag($this->attributes);
        $expected = '<h1 data-formtype="m02"></h1>';
        $this->assertEquals($expected, $notEmptyHtag);

        $this->attributes['id'] = 'foo';
        $this->attributes['label'] = 'test';
        $this->attributes['codearea'] = 'invalid';
        $this->attributes['textarea'] = 'hello world';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'invalid';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = 'invalid';
		$this->attributes['maxlength'] = 'invalid';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'm02';
        $notEmptyHtag = HTMLHelper::formHtag($this->attributes);
        $expected = '<h1 id="foo" data-formtype="m02" class="large rounded">hello world</h1>';
        $this->assertEquals($expected, $notEmptyHtag);
    }

    public function testFormSection(){
        $this->attributes['formtype'] = "m02";
        $emptySection = HTMLHelper::formSection('My Form', $this->attributes, 2, 4);
        $expected = '<div class="form-group"><button class="btn btn-lg form-section-prev">Previous</button><button class="btn btn-lg form-section-next">Next</button></div></div></div><div class="form-section" data-id=""><header class="hero-banner default" id="form_page_3"><div class="form-header-meta"><h2>My Form</h2><div class="form-progress"><div class="form-progress-bubble">Page 3 of 4</div></div></div><h1 class="form-section-header" data-id=""></h1></header><div class="form-content">';

        $this->assertSame($expected, $emptySection);

        $this->attributes['id'] = 'section_id';
        $this->attributes['label'] = "section_label";
        $notEmptySection = HTMLHelper::formSection('My Form', $this->attributes, 3, 4);
        $expected = '<div class="form-group"><button class="btn btn-lg form-section-prev">Previous</button><button class="btn btn-lg form-section-next">Next</button></div></div></div><div class="form-section" data-id="section_id"><header class="hero-banner default" id="form_page_4"><div class="form-header-meta"><h2>My Form</h2><div class="form-progress"><div class="form-progress-bubble">Page 4 of 4</div></div></div><h1 class="form-section-header" data-id="section_id">section_label</h1></header><div class="form-content">';

        $this->assertEquals($expected, $notEmptySection);


    }

    public function testFormHeader() {
      $header = HTMLHelper::formHeader($this->form['content']['settings']['name']);
      $expected = '<header class="hero-banner default"><div class="form-header-meta"><h2>Test</h2></div></header>';
      $this->assertEquals($expected, $header);
    }

    public function testFormHidden(){
        $emptyHidden = HTMLHelper::formHidden($this->attributes);
        $expected =  '<input/>';
        $this->assertSame($expected, $emptyHidden);

		$this->attributes['label'] = '';
        $this->attributes['codearea'] = '';
        $this->attributes['id'] = 'test';
        $this->attributes['name'] = '';
        $this->attributes['class'] = '';
        $this->attributes['required'] = '';
		$this->attributes['regex'] = '';
		$this->attributes['match'] = '';
		$this->attributes['minlength'] = '';
		$this->attributes['maxlength'] = '5';
		$this->attributes['min'] = '';
		$this->attributes['max'] = '';
        $this->attributes['formtype'] = 'm11';
        $this->attributes['type'] = 'hidden';
        $notEmptyHidden = HTMLHelper::formHidden($this->attributes);
        $expected = '<input id="test" type="hidden" data-formtype="m11"/>';
        $this->assertEquals($expected, $notEmptyHidden);

        $this->attributes['label'] = 'invalid';
        $this->attributes['codearea'] = 'invalid';
	    $this->attributes['id'] = 'foo';
        $this->attributes['name'] = 'bar';
        $this->attributes['class'] = 'large rounded';
        $this->attributes['type'] = 'hidden';
        $this->attributes['required'] = 'true';
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = 'invalid';
		$this->attributes['maxlength'] = 'invalid';
		$this->attributes['min'] = 'invalid';
		$this->attributes['max'] = 'invalid';
        $this->attributes['formtype'] = 'm11';
        $this->attributes['value'] = '123';
        $notEmptyText = HTMLHelper::formHidden($this->attributes);
        $expected = '<input id="foo" name="bar" type="hidden" data-formtype="m11" value="123"/>';
        $this->assertEquals($expected, $notEmptyText);
    }
    public function testFieldLabel(){
        $emptyLabel = HTMLHelper::fieldLabel($this->attributes);
        $expected = '<label for="" class="control-label"> <span class="optional">(optional)</span></label>';

        $this->assertSame($expected, $emptyLabel);

        $this->attributes['name'] = 'form_name';
        $this->attributes['label'] = 'hello world';
        $this->attributes['formtype'] = 'c02';
        $notEmptyLabel = HTMLHelper::fieldLabel($this->attributes);
        $expected = '<label for="form_name" class="control-label">hello world <span class="optional">(optional)</span></label>';
        $this->assertEquals($expected, $notEmptyLabel);

        $this->attributes['id'] = 'form_id';
        $this->attributes['name'] = 'form_name';
        $this->attributes['label'] = 'hello world';
        $this->attributes['formtype'] = 'c02';
        $idLabel = HTMLHelper::fieldLabel($this->attributes);
        $expected = '<label for="form_id" class="control-label">hello world <span class="optional">(optional)</span></label>';
        $this->assertEquals($expected, $idLabel);

        $this->attributes['id'] = 'form_id';
        $this->attributes['name'] = 'form_name';
        $this->attributes['label'] = 'hello world';
        $this->attributes['formtype'] = 'c02';
        $this->attributes['required'] = 'true';
        $reqLabel = HTMLHelper::fieldLabel($this->attributes);
        $expected = '<label for="form_id" class="control-label">hello world</label>';
        $this->assertEquals($expected, $reqLabel);

        $this->attributes['id'] = 'form_id';
        $this->attributes['name'] = 'form_name';
        $this->attributes['label'] = 'hello world';
        $this->attributes['formtype'] = 's06';
        $this->attributes['required'] = 'true';
        $reqLabel = HTMLHelper::fieldLabel($this->attributes);
        $expected = '<legend class="control-label">hello world</legend>';
        $this->assertEquals($expected, $reqLabel);

        $this->attributes['id'] = 'form_id';
        $this->attributes['name'] = 'form_name';
        $this->attributes['label'] = "wayne's world";
        $this->attributes['formtype'] = 'c02';
        $this->attributes['required'] = 'true';
        $aposLabel = HTMLHelper::fieldLabel($this->attributes);
        $expected = '<label for="form_id" class="control-label">wayne\'s world</label>';
        $this->assertEquals($expected, $aposLabel);

        $this->attributes['id'] = 'form_id';
        $this->attributes['name'] = 'form_name';
        $this->attributes['label'] = 'wayne"s world';
        $this->attributes['formtype'] = 'c02';
        $this->attributes['required'] = 'true';
        $quotLabel = HTMLHelper::fieldLabel($this->attributes);
        $expected = '<label for="form_id" class="control-label">wayne"s world</label>';
        $this->assertEquals($expected, $quotLabel);
    }
    public function testHelpBlock(){
        $emptyBlock = HTMLHelper::helpBlock($this->attributes);
        $expected = '<div class="help-block with-errors"></div>';

        $this->assertSame($expected, $emptyBlock);

        $this->attributes['help'] = '';
        $emptyBlock2 = HTMLHelper::helpBlock($this->attributes);
        $expected = '<div class="help-block with-errors"></div>';

        $this->assertSame($expected, $emptyBlock2);

        $this->attributes['help'] = 'help block';
        $notEmptyBlock = HTMLHelper::helpBlock($this->attributes);
        $expected = '<div class="help-block with-errors"></div><p class="help-text">help block</p>';
        $this->assertEquals($expected, $notEmptyBlock);

        $this->attributes['help'] = 'help\nblock<br/>\nnew line';
        $newLineBlock = HTMLHelper::helpBlock($this->attributes);
        $expected = '<div class="help-block with-errors"></div><p class="help-text">help\nblock<br/>\nnew line</p>';
        $this->assertEquals($expected, $newLineBlock);

        $this->attributes['help'] = 'bob\'s block';
        $aposBlock = HTMLHelper::helpBlock($this->attributes);
        $expected = '<div class="help-block with-errors"></div><p class="help-text">bob\'s block</p>';
        $this->assertEquals($expected, $aposBlock);
    }

    public function testWebhook(){
        $emptyWebhooks = $this->htmlHelperTester->addWebhooks(array(), array());
        $expected = '';

        $this->assertSame($expected, $emptyWebhooks);

        $this->attributes['webhooks'] = array(
          "testid" => array(
            "ids" => array("address"),
            "endpoint" => "https://sfds-prod.apigee.net/v1/PIM/parcels",
            "responseIndex" => "data/parcels/0/attributes/blklot",
            "method" => "get",
            "optionsArray" => "false",
            "delimiter" => "",
            "responseOptionsIndex" => ""
          )
        );
        $singleWebhook = $this->htmlHelperTester->addWebhooks($this->attributes['webhooks'], array('address' => 'c08'));
        $expected = "jQuery('#address').on('change',function(){if (jQuery('#address').val() != '') callWebhook('testid', 'https://sfds-prod.apigee.net/v1/PIM/parcels', Array('address'), 'data/parcels/0/attributes/blklot', 'get', false, null, null);});";

        $this->assertSame($expected, $singleWebhook);

        $this->attributes['webhooks'] = array(
          "testid" => array(
            "ids" => array("address","apikey"),
            "endpoint" => "https://sfds-prod.apigee.net/v1/PIM/parcels",
            "responseIndex" => "data/parcels/0/attributes/blklot",
            "method" => "get",
            "optionsArray" => "false",
            "delimiter" => "",
            "responseOptionsIndex" => ""
          )
        );
        $multiWebhooks = $this->htmlHelperTester->addWebhooks($this->attributes['webhooks'], array('address' => 'c08', 'apikey' => 'm11'));
        $expected = "jQuery('#address, #apikey').on('change',function(){if (jQuery('#address').val() != '' && jQuery('#apikey').val() != '') callWebhook('testid', 'https://sfds-prod.apigee.net/v1/PIM/parcels', Array('address','apikey'), 'data/parcels/0/attributes/blklot', 'get', false, null, null);});";

        $this->assertSame($expected, $multiWebhooks);
    }

    /**
    * Testing App\Helpers\HTMLHelper\getHTML with different content
    */
    public function testGetHTMLFileUploads() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "m13",
        "class" => "",
        "label" => "Upload File",
        "id" => "upload_file",
        "name" => "upload_file",
        "type" => "file",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStartFile . '<div class="form-group form-group-field field-m13" data-id="upload_file"><div class="field-wrapper"><label><span class="label">Upload File</span><input data-formtype="m13" id="upload_file" name="upload_file" type="file"/><span class="file-custom" data-filename=""></span></label></div><div class="help-block with-errors"></div></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    /* something weird this is not working like it should?
    public function testGetHTMLRadio() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "s06",
        "class" => "",
        "label" => "Radio",
        "id" => "radio",
        "name" => "radio",
        "radios" => array("option one", "option two"),
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group form-group-field field-s06" data-id="radio"><fieldset><legend class="control-label">Radio</legend><div class="field-wrapper"><label for="radio_option_one"><input type="radio" id="radio_option_one" value="option one" data-formtype="s06"/><span class="inline-label">option one</span></label><label for="radio_option_two"><input type="radio" id="radio_option_two" value="option two" data-formtype="s06"/><span class="inline-label">option two</span></label></div><div class="help-block with-errors"></div></fieldset></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLCheckbox() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "s08",
        "class" => "",
        "label" => "Checkbox",
        "id" => "checkbox",
        "name" => "checkbox",
        "checkboxes" => array("option one", "option two"),
        "required" => "false"
      );

      $expected = $this->formStart . '<div class="form-group form-group-field field-s08" data-id="checkbox"><fieldset><legend class="control-label">Checkbox</legend><div class="field-wrapper"><label for="test_option_one"><input type="checkbox" id="checkbox_option_one" value="option one" data-formtype="s08"/><span class="inline-label">option one</span></label><label for="checkbox_option_two"><input type="checkbox" id="test_option_two" value="option two" data-formtype="s08"/><span class="inline-label">option two</span></label></div><div class="help-block with-errors"></div></fieldset></div>' . $this->formEnd;
      $getHTML = $this->htmlHelperTester->getHTML($this->form);

      $this->assertEquals($expected, $getHTML);
    }
    */

    public function testGetHTMLName() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "c02",
        "class" => "",
        "label" => "Name",
        "id" => "name",
        "name" => "name",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group form-group-field field-c02" data-id="name"><label for="name" class="control-label">Name <span class="optional">(optional)</span></label><div class="field-wrapper"><input data-formtype="c02" id="name" name="name"/></div><div class="help-block with-errors"></div></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLEmail() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "c04",
        "class" => "",
        "label" => "Email",
        "id" => "email",
        "name" => "email",
        "type" => "email",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group form-group-field field-c04" data-id="email"><label for="email" class="control-label">Email <span class="optional">(optional)</span></label><div class="field-wrapper"><input data-formtype="c04" id="email" name="email" type="email"/></div><div class="help-block with-errors"></div></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLPhone() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "c06",
        "class" => "",
        "label" => "Phone",
        "id" => "phone",
        "name" => "phone",
        "type" => "tel",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group form-group-field field-c06" data-id="phone"><label for="phone" class="control-label">Phone <span class="optional">(optional)</span></label><div class="field-wrapper"><input data-formtype="c06" id="phone" name="phone" type="tel"/></div><div class="help-block with-errors"></div></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLAddress() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "c08",
        "class" => "",
        "label" => "Address",
        "id" => "address",
        "name" => "address",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group form-group-field field-c08" data-id="address"><label for="address" class="control-label">Address <span class="optional">(optional)</span></label><div class="field-wrapper"><input data-formtype="c08" id="address" name="address"/></div><div class="help-block with-errors"></div></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLCity() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "c10",
        "class" => "",
        "label" => "City",
        "id" => "city",
        "name" => "city",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group form-group-field field-c10" data-id="city"><label for="city" class="control-label">City <span class="optional">(optional)</span></label><div class="field-wrapper"><input data-formtype="c10" id="city" name="city"/></div><div class="help-block with-errors"></div></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLZip() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "c14",
        "class" => "",
        "label" => "Zipcode",
        "id" => "zip",
        "name" => "zip",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group form-group-field field-c14" data-id="zip"><label for="zip" class="control-label">Zipcode <span class="optional">(optional)</span></label><div class="field-wrapper"><input data-formtype="c14" id="zip" name="zip"/></div><div class="help-block with-errors"></div></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLDate() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "d02",
        "class" => "",
        "label" => "Date",
        "id" => "date",
        "name" => "date",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group form-group-field field-d02" data-id="date"><label for="date" class="control-label">Date <span class="optional">(optional)</span></label><div class="field-wrapper"><input data-formtype="d02" id="date" name="date"/></div><div class="help-block with-errors"></div></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLTime() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "d04",
        "class" => "",
        "label" => "Time",
        "id" => "time",
        "name" => "time",
        "type" => "time",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group form-group-field field-d04" data-id="time"><label for="time" class="control-label">Time <span class="optional">(optional)</span></label><div class="field-wrapper"><input data-formtype="d04" id="time" name="time" type="time"/></div><div class="help-block with-errors"></div></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLNumber() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "d06",
        "class" => "",
        "label" => "Number",
        "id" => "number",
        "name" => "number",
        "type" => "number",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group form-group-field field-d06" data-id="number"><label for="number" class="control-label">Number <span class="optional">(optional)</span></label><div class="field-wrapper"><input data-formtype="d06" id="number" name="number" type="number" step="any"/></div><div class="help-block with-errors"></div></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLPrice() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "d08",
        "class" => "",
        "label" => "Price",
        "id" => "price",
        "name" => "price",
        "type" => "number",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group form-group-field field-d08" data-id="price"><label for="price" class="control-label">Price <span class="optional">(optional)</span></label><div class="field-wrapper"><div class="prepended dollar">$</div><input data-formtype="d08" id="price" name="price" type="number" step="0.01"/></div><div class="help-block with-errors"></div></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLURL() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "d10",
        "class" => "",
        "label" => "URL",
        "id" => "url",
        "name" => "url",
        "type" => "url",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group form-group-field field-d10" data-id="url"><label for="url" class="control-label">URL <span class="optional">(optional)</span></label><div class="field-wrapper"><input data-formtype="d10" id="url" name="url" type="url"/></div><div class="help-block with-errors"></div></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLText() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "i02",
        "class" => "",
        "label" => "Text",
        "id" => "text",
        "name" => "text",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group form-group-field field-i02" data-id="text"><label for="text" class="control-label">Text <span class="optional">(optional)</span></label><div class="field-wrapper"><input data-formtype="i02" id="text" name="text"/></div><div class="help-block with-errors"></div></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLTextArea() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "i14",
        "class" => "",
        "label" => "Text Area",
        "id" => "text_area",
        "name" => "text_area",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group form-group-field field-i14" data-id="text_area"><label for="text_area" class="control-label">Text Area <span class="optional">(optional)</span></label><div class="field-wrapper"><textarea data-formtype="i14" id="text_area" name="text_area"></textarea></div><div class="help-block with-errors"></div></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLSelect() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "s02",
        "class" => "",
        "label" => "Select",
        "id" => "select",
        "name" => "select",
        "option" => array("option one", "option two"),
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group form-group-field field-s02" data-id="select"><label for="select" class="control-label">Select <span class="optional">(optional)</span></label><div class="field-wrapper"><select data-formtype="s02" id="select" name="select"><option value="">Choose an option</option><option value="option one">option one</option><option value="option two">option two</option></select></div><div class="help-block with-errors"></div></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLHeader() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "m02",
        "class" => "",
        "label" => "H1",
        "id" => "h1",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group field-m02" data-id="h1"><h1 data-formtype="m02" id="h1"></h1></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLParagraph() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "m08",
        "class" => "",
        "label" => "Paragraph",
        "id" => "paragraph",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group field-m08" data-id="paragraph"><p data-formtype="m08" id="paragraph"></p></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLCode() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "m10",
        "class" => "",
        "label" => "Code Paragraph",
        "id" => "code",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group field-m10" data-id="code"><p data-formtype="m10" id="code"></p></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetHTMLHidden() {

      $this->form["content"]["data"][0] = array(
        "formtype" => "m11",
        "class" => "",
        "label" => "Hidden",
        "id" => "hidden",
        "name" => "hidden",
        "type" => "hidden",
        "required" => "false"
      );

      $getHTML = $this->htmlHelperTester->getHTML($this->form);
      $expected = $this->formStart . '<div class="form-group field-m11" data-id="hidden"><input data-formtype="m11" id="hidden" name="hidden" type="hidden"/></div>' . $this->formEnd;

      $this->assertEquals($expected, $getHTML);
    }

    public function testGetAdminTab() {
      $adminTab = $this->htmlHelperTester->adminTab();
      $expected = '<div id="SFDSWFB-admin">'.
          '<div class="header" onclick="toggleAdminTab()">Administrative Tools <i class="adminTabArrow fa fa-angle-up"></i></div>'.
          '<div class="content">'.
            'Show All Questions &nbsp; <input type="checkbox" onclick="toggleShowAllFields(this)"/><br/>'.
            'Show all Pages &nbsp; <input type="checkbox" onclick="toggleShowAllPages(this)"/>'.
          '</div>'.
        '</div>';
      $this->assertEquals($expected, $adminTab);
    }

    public function testGetConditionalStatement() {
      $contains = $this->htmlHelperTester->getConditionalStatement("jQuery('#foo').val()", "contains", "bar", false);
      $expected = '(jQuery(\'#foo\').val()).search(/bar/i) != -1';
      $this->assertEquals($expected, $contains);

      $doesnot = $this->htmlHelperTester->getConditionalStatement("jQuery('#foo').val()", "doesn't contain", "bar", false);
      $expected = '(jQuery(\'#foo\').val()).search(/bar/i) == -1';
      $this->assertEquals($expected, $doesnot);

      $matches = $this->htmlHelperTester->getConditionalStatement("jQuery('#foo').val()", "matches", "bar", false);
      $expected = "jQuery('#foo').val() == 'bar'";
      $this->assertEquals($expected, $matches);

      $number = $this->htmlHelperTester->getConditionalStatement("jQuery('#foo').val()", "greater than", 2, false);
      $expected = "jQuery('#foo').val() > 2";
      $this->assertEquals($expected, $number);
    }

    public function testGetCheckboxConditionalStatement() {
      $blank = $this->htmlHelperTester->getConditionalStatement($sel, $op, $value);

      $contains = $this->htmlHelperTester->getConditionalStatement("jQuery('#foo').val()", "contains", "bar");
      $expected = "(jQuery('#foo').val()).map(function() {return jQuery(this).val();}).get().join()).search(/bar/i) != -1";
      $this->assertEquals($expected, $contains);

      $doesnot = $this->htmlHelperTester->getConditionalStatement("jQuery('#foo').val()", "contains", "bar");
      $expected = "(jQuery('#foo').val()).map(function() {return jQuery(this).val();}).get().join()).search(/bar/i) == -1";
      $this->assertEquals($expected, $doesnot);

      $matches = $this->htmlHelperTester->getConditionalStatement("#foo", "matches", "bar", false);
      $expected = "jQuery('#foo[value=\"bar\"]').length";
      $this->assertEquals($expected, $matches);

      $spaces = $this->htmlHelperTester->getConditionalStatement("#foo", "matches", "this has spaces", false);
      $expected = "jQuery('#foo[value=\"this has spaces\"]').length";
      $this->assertEquals($expected, $spaces);
    }

}