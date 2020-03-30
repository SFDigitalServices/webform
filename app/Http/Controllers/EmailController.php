<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\FormBuilderMailer;

use Log;

class EmailController extends Controller
{
    public function sendEmail($data, $template)
    {
        $data['emailInfo']['template'] = isset($data['emailInfo']['template']) ? $data['emailInfo']['template'] : $template;
        $data['emailInfo']['from_address'] = isset($data['emailInfo']['from_address']) ? $data['emailInfo']['from_address'] : getenv("MAIL_FROM_ADDRESS");
        $data['emailInfo']['replyto_address'] = isset($data['emailInfo']['replyto_address']) ? $data['emailInfo']['replyto_address'] : getenv("MAIL_REPLYTO_ADDRESS");
        $data['emailInfo']['subject'] = isset($data['emailInfo']['subject']) ? $data['emailInfo']['subject'] : 'Form submissions status';
        $data['emailInfo']['name'] = isset($data['emailInfo']['name']) ? $data['emailInfo']['name'] : 'City and County of San Francisco';
        if ($data['emailInfo']['address'] !== '') {
            try {
                Mail::to($data['emailInfo']['address'])->send(new FormBuilderMailer($data));
            } catch (\Swift_TransportException $e) {
                Log::info(print_r($e->getMessage(), 1));
            }
        }
    }
}