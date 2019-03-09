<?php
use App\Helpers\DataStoreHelper;

class DataStoreHelperTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $dataStoreHelperTester;
    protected $definitions;

    protected function _before()
    {
        Schema::dropIfExists('forms_form1');
        Schema::dropIfExists('forms_form2');
        Schema::dropIfExists('forms_form3');

        //$this->expectOutputString('');
        $this->dataStoreHelperTester = new DataStoreHelper();

        $this->definitions = array(
            array('type' => 'text', 'field' => 'firstname'),
            array('type' => 'text', 'field' => 'lastname'),
            array('type' => 'email', 'field' => 'email'),
            array('type' => 'password', 'field'=> 'password'),
            array('type' => 'tel', 'field' => 'phonenumber'),
            array('type' => 'date', 'field' => 'date_created'),
            array('type' => 'url', 'field' => 'url'),
        );
    }

    /**
    *  Testing App\Http\Controllers\FormController printFormTypeStart
    **/
    public function testCreateFormTable()
    {
        $table= 'forms_form1';
        $this->dataStoreHelperTester::createFormTable($table, $this->definitions);
        $this->assertTrue(Schema::hasTable($table));
        $columns = array();
        foreach($this->definitions as $definition){
            array_push($columns, $definition['field']);
        }
        $this->assertTrue(Schema::hasColumns($table, $columns));
    }

    public function testAddFormTableColumn() {

    }

	public function testChangeFormTableColumn() {

    }

	public function testRenameFormTableColumn() {

    }

	public function testDropFormTableColumn() {

    }

	public function testCheckExistsFormTable() {

    }

    public function testCheckExistsFormTableColumn() {

    }

    protected function _after()
    {
        Schema::dropIfExists('forms_form1');
        Schema::dropIfExists('forms_form2');
        Schema::dropIfExists('forms_form3');

    }

}