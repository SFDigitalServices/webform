<?php
use App\Http\Controllers\FormController;
use Illuminate\Http\Request;
class User_FormTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $formTester;

    protected function _before()
    {
        $this->formTester = new FormController();
    }

	public function testPreviewSubmitted()
    {
        $request = new Request;
        $request->request->set('form_id', '123');
        $request->request->set('phone', '(234) 234-2421');
        $request->request->set('name', 'joe bob');
        $request->request->set('AUTOMATED', 'test@sf.gov');
        $request->request->set('radio', 'Choice 2');
        $request->request->set('checkboxes', 'Choice 2');
        $request->request->set('date', '1111-11-11');
        $request->request->set('id', '123');

        $previewSubmitted = $this->formTester->previewSubmitted($request);
        $expected = "<div style='padding:3em 4.5em'><h2>Please set a Form Action before trying to embed your form.</h2><h3>Below is a summary of what you just submitted:</h3>form_id = 123<br/>phone = (234) 234-2421<br/>name = joe bob<br/>AUTOMATED = test@sf.gov<br/>radio = Choice 2<br/>checkboxes = Choice 2<br/>date = 1111-11-11<br/>id = 123<br/></div>";
        $this->assertSame($expected, $previewSubmitted);
	}



    protected function _after()
    {
    }
}