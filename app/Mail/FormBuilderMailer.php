<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FormBuilderMailer extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    private $emailInfo;

    public function __construct($data)
    {
        $this->data = $data['body'];
        $this->emailInfo = $data['emailInfo'];
    }

    public function build()
    {
        $from_address = $this->emailInfo['from_address'];
        $replyto_address = $this->emailInfo['replyto_address'];
        $subject = $this->emailInfo['subject'];
        $name = $this->emailInfo['name'];
        $file = isset($this->emailInfo['file']) ? $this->emailInfo['file'] : '';

        $headerData = [
            //Categories in SendGrid allow you to split your statistics into sections. For example,
            //if you have a Whitelabeled service, you can split your statistics by the user login.
            'category' => 'category',
            'unique_args' => [
                'variable_1' => 'as needed'
            ]
        ];

        $header = $this->asString($headerData);

        $this->withSwiftMessage(function ($message) use ($header) {
            $message->getHeaders()
                    ->addTextHeader('X-SMTPAPI', $header);
        });
        if ($file) {
            return $this->view($this->emailInfo['template'])
                    ->from($from_address, $name)
                    ->replyTo($replyto_address, $name)
                    ->subject($subject)
                    ->attach(
                        $file,
                        [
                        'as' => 'csvExport.xlsx'
                      ]
                    );
        }

        return $this->view($this->emailInfo['template'])
                    ->from($from_address, $name)
                    ->replyTo($replyto_address, $name)
                    ->subject($subject);
    }

    private function asJSON($data)
    {
        $json = json_encode($data);
        $json = preg_replace('/(["\]}])([,:])(["\[{])/', '$1$2 $3', $json);

        return $json;
    }


    private function asString($data)
    {
        $json = $this->asJSON($data);

        return wordwrap($json, 76, "\n   ");
    }
}
