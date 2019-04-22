<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\FormBuilderMailer;

use Log;

class EmailController extends Controller
{
    public function sendEmail()
    {
        $data = ['message' => 'This is a test!'];
        Mail::to('henry.jiang@sfgov.org')->send(new FormBuilderMailer($data));
    }
}
