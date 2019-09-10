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
        $address = $this->emailInfo['address'];
        $subject = $this->emailInfo['subject'];
        $name = $this->emailInfo['name'];

        $headerData = [
            //Categories in SendGrid allow you to split your statistics into sections. For example,
            //if you have a Whitelabeled service, you can split your statistics by the user login.
            'category' => 'category',
            'unique_args' => [
                'variable_1' => 'abc'
            ]
        ];

        $header = $this->asString($headerData);

        $this->withSwiftMessage(function ($message) use ($header) {
            $message->getHeaders()
                    ->addTextHeader('X-SMTPAPI', $header);
        });

        return $this->view($this->emailInfo['template'])
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->bcc($address, $name)
                    ->replyTo($address, $name)
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
