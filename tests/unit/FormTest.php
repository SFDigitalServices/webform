<?php 
use App\Form;
use Log;

class FormTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $formTester;
	protected $attributes;
    
    protected function _before()
    {
        $this->formTester = new Form();

		$this->attributes = array(
            "id" => "",
			"content" => ""
        );
		
		$this->simpleFormAttributes = array(
            "id" => "",
			"content" => '{"settings":{"action":"","method":"POST","name":"Webhook Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}'
        );

		$this->complexFormAttributes = array(
            "id" => "",
			"content" => '{"settings":{"action":"","method":"POST","name":"Webhook Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}'
        );

		$this->sectionalFormAttributes = array(
            "id" => "",
			"content" => '{"settings":{"action":"","method":"POST","name":"Webhook Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}'
        );
		
        $this->webhookSingleAttributes = array(
            "id" => "",
			"content" => '{"settings":{"action":"","method":"POST","name":"Webhook Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"label":"BAN Number","placeholder":"","help":"","id":"BAN","formtype":"d06","type":"number","required":"true","name":"BAN"},{"label":"Address","radios":["test"],"id":"address","formtype":"s08","name":"address","required":"true","webhooks":{"ids":["BAN"],"endpoint":"http:\/\/apps.sfgov.org\/bpdev\/sites\/all\/modules\/ccsf_api\/TTX\/BAN.php?type=OOC","responseIndex":"StreetAddress","method":"json","optionsArray":"false","delimiter":"","responseOptionsIndex":""}},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}'
        );
		
        $this->webhookOptionsAttributes = array(
            "id" => "",
			"content" => '{"settings":{"action":"","method":"POST","name":"Webhook Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"label":"BAN Number","placeholder":"","help":"","id":"BAN","formtype":"d06","type":"number","required":"true","name":"BAN"},{"label":"Address","radios":["test"],"id":"address","formtype":"s08","name":"address","required":"true","webhooks":{"ids":["BAN"],"endpoint":"http:\/\/apps.sfgov.org\/bpdev\/sites\/all\/modules\/ccsf_api\/TTX\/BAN.php?type=OOC","responseIndex":"StreetAddress","method":"json","optionsArray":"true","delimiter":"","responseOptionsIndex":""}},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}'
        );
		
        $this->webhookDelimiterAttributes = array(
            "id" => "",
			"content" => '{"settings":{"action":"","method":"POST","name":"Webhook Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"label":"BAN Number","placeholder":"","help":"","id":"BAN","formtype":"d06","type":"number","required":"true","name":"BAN"},{"label":"Address","radios":["test"],"id":"address","formtype":"s08","name":"address","required":"true","webhooks":{"ids":["BAN"],"endpoint":"http:\/\/apps.sfgov.org\/bpdev\/sites\/all\/modules\/ccsf_api\/TTX\/BAN.php?type=OOC","responseIndex":"StreetAddress","method":"json","optionsArray":"true","delimiter":",","responseOptionsIndex":""}},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}'
        );    
		
        $this->webhookFullAttributes = array(
            "id" => "",
			"content" => '{"settings":{"action":"","method":"POST","name":"Webhook Form"},"data":[{"label":"Name","placeholder":"","help":"","id":"name","formtype":"c02","name":"name","type":"text","required":"true"},{"label":"BAN Number","placeholder":"","help":"","id":"BAN","formtype":"d06","type":"number","required":"true","name":"BAN"},{"label":"Address","radios":["test"],"id":"address","formtype":"s08","name":"address","required":"true","webhooks":{"ids":["BAN"],"endpoint":"http:\/\/apps.sfgov.org\/bpdev\/sites\/all\/modules\/ccsf_api\/TTX\/BAN.php?type=OOC","responseIndex":"StreetAddress","method":"json","optionsArray":"true","delimiter":"","responseOptionsIndex":"data"}},{"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"}]}'
        );    
	}
/*
	public function testFormGetHTML()
    {
        $emptyGetHTML = Form::getHTML($this->attributes);
        $expected = '';
        $this->assertSame($expected, $emptyGetHTML);

        $simpleGetHTML = Form::getHTML($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $simpleGetHTML);
		
        $complexGetHTML = Form::getHTML($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $complexGetHTML);

        $sectionalGetHTML = Form::getHTML($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $sectionalGetHTML);
	}
	
	public function testFormGenerate()
    {
        $emptyGenerate = Form::generate($this->attributes);
        $expected = '';
        $this->assertSame($expected, $emptyGenerate);

        $simpleGenerate = Form::generate($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $simpleGenerate);
		
        $complexGenerate = Form::generate($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $complexGenerate);

        $sectionalGenerate = Form::generate($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $sectionalGenerate);
	}
	
	public function testFormGetInputSelector()
    {
        $emptyGetInputSelector = Form::getInputSelector($this->attributes);
        $expected = '';
        $this->assertSame($expected, $emptyGetInputSelector);

        $simpleGetInputSelector = Form::getInputSelector($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $simpleGetInputSelector);
		
        $complexGetInputSelector = Form::getInputSelector($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $complexGetInputSelector);

        $sectionalGetInputSelector = Form::getInputSelector($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $sectionalGetInputSelector);
	}
	
	public function testFormGetConditionalStatement()
    {
        $emptyGetConditionalStatement = Form::getConditionalStatement($this->attributes);
        $expected = '';
        $this->assertSame($expected, $emptyGetConditionalStatement);

        $simpleGetConditionalStatement = Form::getConditionalStatement($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $simpleGetConditionalStatement);
		
        $complexGetConditionalStatement = Form::getConditionalStatement($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $complexGetConditionalStatement);

        $sectionalGetConditionalStatement = Form::getConditionalStatement($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $sectionalGetConditionalStatement);
	}
	
	public function testFormGetOp()
    {
        $emptyGetOp = Form::getOp($this->attributes);
        $expected = '';
        $this->assertSame($expected, $emptyGetOp);

        $simpleGetOp = Form::getOp($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $simpleGetOp);
		
        $complexGetOp = Form::getOp($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $complexGetOp);

        $sectionalGetOp = Form::getOp($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $sectionalGetOp);
	}
	
	public function testFormWrapJS()
    {
        $emptyWrapJS = Form::wrapJS($this->attributes);
        $expected = '';
        $this->assertSame($expected, $emptyWrapJS);

        $simpleWrapJS = Form::wrapJS($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $simpleWrapJS);
		
        $complexWrapJS = Form::wrapJS($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $complexWrapJS);

        $sectionalWrapJS = Form::wrapJS($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $sectionalWrapJS);
	}
	
	public function testFormIsSectional()
    {
        $emptyIsSectional = Form::isSectional($this->attributes);
        $expected = '';
        $this->assertSame($expected, $emptyPreview);

        $simpleIsSectional = Form::isSectional($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $simplePreview);
		
        $complexIsSectional = Form::isSectional($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $complexPreview);

        $sectionalIsSectional = Form::isSectional($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $sectionalIsSectional);
	}
	
	public function testFormEmbedJS()
    {
        $emptyEmbedJS = Form::embedJS($this->attributes);
        $expected = '';
        $this->assertSame($expected, $emptyEmbedJS);

        $simpleEmbedJS = Form::embedJS($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $simpleEmbedJS);
		
        $complexEmbedJS = Form::embedJS($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $complexEmbedJS);

        $sectionalEmbedJS = Form::embedJS($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $sectionalEmbedJS);
	}
	
    /**
    *  Testing App\Form\Preview
    **/
	/*
    public function testFormPreview()
    {
        $emptyPreview = Form::preview($this->attributes);
        $expected = '';
        $this->assertSame($expected, $emptyPreview);

        $simplePreview = Form::preview($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $simplePreview);
		
        $complexPreview = Form::preview($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $complexPreview);

        $sectionalPreview = Form::preview($this->attributes);
        $expected = '';
        $this->assertEquals($expected, $sectionalPreview);
	}
*/
	
    protected function _after()
    {
    }
}