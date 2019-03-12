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
        $this->dataStoreHelperTester = new DataStoreHelper();

        $this->definitions = array(
            array('type' => 'text', 'field' => 'firstname'),
            array('type' => 'text', 'field' => 'lastname'),
            array('type' => 'email', 'field' => 'email', 'attributes' => array('25')),
            array('type' => 'password', 'field'=> 'password'),
            array('type' => 'tel', 'field' => 'phonenumber'),
            array('type' => 'date', 'field' => 'date_created'),
            array('type' => 'url', 'field' => 'url'),
        );
    }

    /**
    *  Testing App\Helpers\DataStoreHelper
    **/
    public function testCreateFormTable()
    {
        $tablename= 'forms_form1';
        $this->dataStoreHelperTester::createFormTable($tablename, $this->definitions);
        $this->assertTrue(Schema::hasTable($tablename));
        $columns = array();
        foreach($this->definitions as $definition){
            array_push($columns, $definition['field']);
        }
        $this->assertTrue(Schema::hasColumns($tablename, $columns));
    }

    public function testAddFormTableColumn() {
        $tablename= 'forms_form2';
        $this->dataStoreHelperTester::createFormTable($tablename, $this->definitions);
        $this->assertTrue(Schema::hasTable($tablename));

        $definition = array(array('type' => 'date', 'field' => 'published_date'));
        $this->dataStoreHelperTester::addFormTableColumn($tablename, $definition);

        $this->assertTrue(Schema::hasColumns($tablename, array('published_date')));
        $this->assertNotTrue(Schema::hasColumns($tablename, array('some_random_stuff')));
    }

	public function testChangeFormTableColumn() {
        $tablename = 'forms_form3';
        $this->dataStoreHelperTester::createFormTable($tablename, $this->definitions);
        $this->assertTrue(Schema::hasTable($tablename));

        $definition = array(
            array(
                'type' => 'email', 'field' => 'email', 'attributes' => array('40')
            ),
            array(
                'type' => 'text', 'field' => 'lastname', 'attributes' => array('90')
            )
        );
        $changedColumns = $this->dataStoreHelperTester::changeFormTableColumn($tablename, $definition);

        // email length should = 40
        $this->assertEquals($changedColumns[0]['length'], 40);
        // lastname length should = 90
        $this->assertEquals($changedColumns[1]['length'], 90);
    }

	public function testRenameFormTableColumn() {
        $tablename= 'forms_form4';
        $this->dataStoreHelperTester::createFormTable($tablename, $this->definitions);
        $this->assertTrue(Schema::hasTable($tablename));

        $definition = array(array('from' => 'email', 'to' => 'customer_email'));
        $_fluents = $this->dataStoreHelperTester::renameFormTableColumn($tablename, $definition);

        $this->assertTrue(Schema::hasColumns($tablename, array('customer_email')));
        $this->assertNotTrue(Schema::hasColumns($tablename, array('email')));
    }

	public function testDropFormTableColumn() {
        $tablename= 'forms_form5';
        $this->dataStoreHelperTester::createFormTable($tablename, $this->definitions);
        $this->assertTrue(Schema::hasTable($tablename));

        $definition = array('email', 'firstname');
        $_fluent = $this->dataStoreHelperTester::dropFormTableColumn($tablename, $definition);

        $this->assertNotTrue(Schema::hasColumns($tablename, array('email')));
        $this->assertNotTrue(Schema::hasColumns($tablename, array('firstname')));
        $this->assertTrue(Schema::hasColumns($tablename, array('lastname')));

    }

    protected function _after()
    {
        Schema::dropIfExists('forms_form1');
        Schema::dropIfExists('forms_form2');
        Schema::dropIfExists('forms_form3');
        Schema::dropIfExists('forms_form4');
        Schema::dropIfExists('forms_form5');
    }

}