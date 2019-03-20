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
            "id" => "",
            "name" => "",
            "type" => "",
            "formtype" => "",
            "required" => "",
            "class" => "",
        );
    }

    /**
    *  Testing App\Helpers\DataStoreHelper
    **/
    public function testFormRadio()
    {
        $emptyRadio = HTMLHelper::formRadio($this->attributes);
        $expected = '';

        $this->assertSame($emptyRadio, $expected);

        $this->attributes['radios'] = array("option one", "option two");
        $this->attributes['id'] = 'radio_id';
        $this->attributes['formtype'] = 's08';
        $notEmptyRadio = HTMLHelper::formRadio($this->attributes);

        $expected = '<label class="radio"><input type="radio" value="" formtype="s08" />option one</label>';
        $expected .= '<label class="radio"><input type="radio" value="" formtype="s08" />option two</label>';
        $this->assertEquals($notEmptyRadio, $expected);
    }

    public function testFormCheckbox(){

    }
    public function testFormText(){

    }
    public function testFormSelect(){

    }
    public function testFormButton(){

    }
    public function testFormParagraph(){

    }
    public function testFormHtag(){

    }
    public function testFormSection(){

    }
    public function testFormHidden(){

    }
    public function testFieldLabel(){

    }
    public function testHelpBlock(){

    }
}