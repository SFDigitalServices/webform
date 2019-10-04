<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\FormBuilderMailer;

use Log;

class EmailController extends Controller
{
    public function sendEmail($data, $template)
    {
        if ( ! isset($data['emailInfo'])) {
            $data['emailInfo']['template'] = $template;
            $data['emailInfo']['address'] = 'henry.jiang@sfgov.org';
            $data['emailInfo']['subject'] = 'Form submissions status';
            $data['emailInfo']['name'] = 'DS Formbuilder';
        }
        try {
            Mail::to($data['emailInfo']['address'])->send(new FormBuilderMailer($data));
        }
        catch(\Swift_TransportException $e){
            Log::info(print_r($e->getMessage(),1));
        }
    }
}
