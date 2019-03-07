<?php 
use App\Http\Controllers\FormController;
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

    protected function _after()
    {
    }

    /**
    *  Testing App\Http\Controllers\FormController printFormTypeStart
    **/
    public function testPrintFormTypeStart()
    {
        $response = $this->formTester->printFormTypeStart('i14');
        $this->assertEquals($response, '<textarea ');
    }
}