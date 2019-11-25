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
        $expected = '<label for="foo_option_one"><input type="checkbox" id="foo_option_one" value="option one" name="bar[]" data-formtype="s06" required class="large rounded"/><span class="inline-label">option one</span></label>';
        $expected .= '<label for="foo_option_two"><input type="checkbox" id="foo_option_two" value="option two" name="bar[]" data-formtype="s06" required class="large rounded"/><span class="inline-label">option two</span></label>';
        $this->assertEquals($expected, $notEmptyCheckBox);
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
		$this->attributes['regex'] = 'invalid';
		$this->attributes['match'] = 'invalid';
		$this->attributes['minlength'] = '3';
		$this->attributes['maxlength'] = '9';
		$this->attributes['min'] = '10';
		$this->attributes['max'] = '20';
        $this->attributes['formtype'] = 'd06';
        $notEmptyText = HTMLHelper::formText($this->attributes);
        $expected = '<input id="foo" name="bar" type="number" data-formtype="d06" required minlength="3" maxlength="9" min="10" max="20" class="large rounded" step="any"/>';
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
        $expected = '<button></button>';
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
        $expected = '<button data-formtype="m14">Submit</button>';
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
        $expected = '<button id="foo" name="bar" data-formtype="m14" class="large rounded success">Submit</button>';
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
        $emptySection = HTMLHelper::formSection($this->attributes);
        $expected = '<div class="form-group"><a class="btn btn-lg form-section-prev" href="javascript:void(0)">Previous</a><a class="btn btn-lg form-section-next" href="javascript:void(0)">Next</a></div></div><div class="form-section-header" data-id=""></div><div class="form-section" data-id="">';

        $this->assertSame($expected, $emptySection);

        $this->attributes['id'] = 'section_id';
        $this->attributes['label'] = "section_label";
        $notEmptySection = HTMLHelper::formSection($this->attributes);
        $expected = '<div class="form-group"><a class="btn btn-lg form-section-prev" href="javascript:void(0)">Previous</a><a class="btn btn-lg form-section-next" href="javascript:void(0)">Next</a></div></div><div class="form-section-header" data-id="section_id">section_label</div><div class="form-section" data-id="section_id">';

        $this->assertEquals($expected, $notEmptySection);


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

    }
    public function testHelpBlock(){
        $emptyBlock = HTMLHelper::helpBlock($this->attributes);
        $expected = '<div class="help-block with-errors"></div></div>';

        $this->assertSame($expected, $emptyBlock);

        $this->attributes['help'] = 'help block';
        $notEmptyBlock = HTMLHelper::helpBlock($this->attributes);
        $expected = '<div class="help-block with-errors"></div><p class="help-text">help block</p></div>';
        $this->assertEquals($expected, $notEmptyBlock);
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


}