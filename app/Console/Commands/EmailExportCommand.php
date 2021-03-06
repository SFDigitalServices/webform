<?php
/**
 *
 * PHP version >= 7.0
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */

namespace App\Console\Commands;
use App\Helpers\DataStoreHelper;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\EmailController;

/**
 * Class deletePostsCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class EmailExportCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "email:exports { formid : ID of the form to export }
                                          { email : email address to send the export to }
                                          { --fields=* : fields to export }";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Email CSV exports";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $formId = $this->argument('formid');
      $email = $this->argument('email');
      $fields = $this->option('fields');
      if ($formId) {
          try {
              // get formid from command line, get form data, email it out.
              $dataStoreHelper = new DataStoreHelper();
              $results = $dataStoreHelper->getSubmittedFormData($formId);
              $columns = $fields;
              $file = fopen('php://memory', 'r+');
              fputcsv($file, $columns);

              foreach($results as $result) {
                  $line = array();
                  foreach($fields as $field){
                    if($result[$field])
                      array_push($line, $result[$field]);
                    else
                      array_push($line, '');
                  }
                  fputcsv($file, $line);
              }
              $filename = "csv_export_$formId";
              rewind($file);
              $csv_line = stream_get_contents($file);
              if( Storage::put("$filename", $csv_line) )
                fclose($file);
              else
                return false;

              //email out attachment
              $emailController = new EmailController();
              $data['body'] = array();
              $data['body']['message'] = 'Please see attachment';
              $data['emailInfo'] = array();
              $data['emailInfo']['address'] = $email;
              $data['emailInfo']['subject'] = 'Daily csv file export';
              $data['emailInfo']['name'] = 'DS Formbuilder';
              $data['emailInfo']['file'] = storage_path('app') .'/'. $filename;
              $data['emailInfo']['template'] = 'emails.csvExport';

              $emailController->sendEmail($data, '');

          } catch (Exception $e) {
              $this->error($e);
          }
      }
    }
}
