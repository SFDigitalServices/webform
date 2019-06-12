<?php
namespace App\Helpers;
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
            array('type' => 'text', 'id' => 'firstname'),
            array('type' => 'text', 'id' => 'lastname'),
            array('type' => 'email', 'id' => 'email', 'maxlength' => '25', 'required' => 'true'),
            array('type' => 'password', 'id'=> 'password'),
            array('type' => 'tel', 'id' => 'phonenumber', 'required' => 'false'),
            array('type' => 'date', 'id' => 'date_created'),
            array('type' => 'url', 'id' => 'url'),
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
            array_push($columns, $definition['id']);
        }
        $this->assertTrue(Schema::hasColumns($tablename, $columns));
    }

    public function testTextFieldMapping(){
        $tablename= 'textfield_mapping';
        $definition = array(
            array('type' => 'email', 'id' => 'my_email')
        );
        $this->dataStoreHelperTester::createFormTable($tablename, $definition);
        $this->assertTrue(Schema::hasTable($tablename));
    }

    public function testTextAreaFieldMapping(){
        $tablename= 'textareafield_mapping';
        $definition = array(
            array('type' => 'textarea', 'formtype' => 'i14', 'id' => 'my_textarea')
        );
        $this->dataStoreHelperTester::createFormTable($tablename, $definition);
        $this->assertTrue(Schema::hasTable($tablename));
    }
    public function testTimeFieldMapping(){
        $tablename= 'filefield_mapping';
        $definition = array(
            array('type' => 'file', 'id' => 'my_file')
        );
        $this->dataStoreHelperTester::createFormTable($tablename, $definition);
        $this->assertTrue(Schema::hasTable($tablename));
    }
    public function testDateFieldMapping(){
        $tablename= 'datefield_mapping';
        $definition = array(
            array('type' => 'date', 'id' => 'my_date')
        );

        $this->dataStoreHelperTester::createFormTable($tablename, $definition);
        $this->assertTrue(Schema::hasTable($tablename));
    }
    public function testNumberFieldMapping(){
        $tablename= 'numberfield_mapping';
        $definition = array(
            array('type' => 'number', 'id' => 'my_number', 'value' => '10')
        );
        $this->dataStoreHelperTester::createFormTable($tablename, $definition);
        $this->assertTrue(Schema::hasTable($tablename));
    }
    public function testEnumFieldMapping(){
        $tablename= 'enumfield_mapping';
        $definition = array(
            array('type' => 'radio', 'id' => 'my_radio', 'radios' => "option 1 \n option 2")
        );
        $this->dataStoreHelperTester::createFormTable($tablename, $definition);
        $this->assertTrue(Schema::hasTable($tablename));
    }
    public function testFileFieldMapping(){
        $tablename= 'timefield_mapping';
        $definition = array(
            array('type' => 'file', 'id' => 'my_file')
        );
        $this->dataStoreHelperTester::createFormTable($tablename, $definition);
        $this->assertTrue(Schema::hasTable($tablename));
    }
    public function testAddFormTableColumn() {
        $tablename= 'forms_form2';
        $this->dataStoreHelperTester::createFormTable($tablename, $this->definitions);
        $this->assertTrue(Schema::hasTable($tablename));

        $definition = array(array('type' => 'date', 'id' => 'published_date'));
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
                'type' => 'email', 'id' => 'email', 'maxlength' => '40'
            ),
            array(
                'type' => 'text', 'id' => 'lastname', 'maxlength' => '90'
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
        Schema::dropIfExists('textfield_mapping');
        Schema::dropIfExists('filefield_mapping');
        Schema::dropIfExists('textareafield_mapping');
        Schema::dropIfExists('numberfield_mapping');
        Schema::dropIfExists('enumfield_mapping');
        Schema::dropIfExists('datefield_mapping');
        Schema::dropIfExists('timefield_mapping');
    }

}