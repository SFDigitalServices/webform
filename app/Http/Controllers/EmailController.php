<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\FormBuilderMailer;

use Log;

class EmailController extends Controller
{
    public function sendEmail($data, $template)
    {
        $message = [
          'message' => 'This is a test!',
          'magiclink' => $data['magiclink']
        ];
        $data['body'] = $message;
        $data['emailInfo']['template'] = $template;
        $data['emailInfo']['address'] = 'henry.jiang@sfgov.org';
        $data['emailInfo']['subject'] = 'Form submissions status';
        $data['emailInfo']['name'] = 'DS Formbuilder';

        Mail::to($data['emailInfo']['address'])->send(new FormBuilderMailer($data));
    }
}
