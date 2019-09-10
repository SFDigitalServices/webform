<?php

namespace tests;

use App\Http\Controllers\EmailController;
use Log;
class EmailControllerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    private $emailController;
    //private $requestMock;

    protected function _before()
    {
      $this->emailController = new EmailController();
      //$this->requestMock = \Mockery::mock(Request::class);
    }

    /**
    *  Testing App\Helpers\EmailController
    **/
    public function testSendEmail(){
      $emails = app()->make('swift.transport')->driver()->messages();
      $this->assertEmpty($emails);

      $data = array();
      $data['body']['magiclink'] = 'random stuff';
      $template = 'emails.saveForLater';
      $response = $this->emailController->sendEmail($data, $template);

      $emails = app()->make('swift.transport')->driver()->messages();
      $this->assertNotEmpty($emails);

      $this->assertContains('Form submissions status', $emails[0]->getSubject());
      $this->assertEquals('henry.jiang@sfgov.org', array_keys($emails[0]->getTo())[0]);
    }
    protected function _after()
    {
    }
  }
