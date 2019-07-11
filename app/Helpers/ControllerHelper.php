<?php
namespace App\Helpers;
use Aws\S3\S3Client;
use Aws\Credentials\CredentialProvider;
use Log;

// All helper functions should belong here, the controller should not contain any helper/utilty functions
class ControllerHelper
{
    public function parseOptionValues($content, $op = '')
    {
        if(isset($content['settings']))
            $ret['settings'] = $content['settings'];
        $ret['data'] = array();

        foreach ($content['data'] as $field) {
            if (array_key_exists('option', $field)) {
                if(!is_array($field['option']))
                    $field['option'] = explode("\n", $field['option']);
                if(strcmp($op, 'json') == 0)
                    $field['option'] = json_encode($field['option']);
            } elseif (array_key_exists('checkboxes', $field) ) {
                if(!is_array($field['checkboxes']))
                    $field['checkboxes'] = explode("\n", $field['checkboxes']);
                if(strcmp($op, 'json') == 0)
                    $field['checkboxes'] = json_encode($field['checkboxes']);
            } elseif (array_key_exists('radios', $field) ) {
                if(!is_array($field['radios']))
                    $field['radios'] = explode("\n", $field['radios']);
                if(strcmp($op, 'json') == 0)
                    $field['radios'] = json_encode($field['radios']);
            }
            $ret['data'][] = $field;
        }
        return $ret;
    }

    public function isNonInputField($formtype){
      $nonInputes = array('m02', 'm04', 'm06', 'm08','m10', 'm14','m16');
      if ( in_array($formtype, $nonInputes) ) {
        return true;
      }
      return false;
    }

    public function generateFilename($id)
    {
        $hash = substr(sha1($id.env('FILE_SALT')), 0, 8);
        return $id.'-'.$hash.'.csv';
    }
    public function hasFileUpload($data) {
        foreach ($data as $field) {
            if ($field['formtype'] == "m13") {
                return true;
            }
        }
        return false;
    }

    public function notifyUser(Request $request)
    {
        $form_id = $request->input('form_id');
        $started = false;
        $num = 0;

        header("Content-Type: text/event-stream");
        header("Cache-Control: no-store");
        header("Access-Control-Allow-Origin: *");

        while (1) {
            // 1 is always true, so repeat the while loop forever (aka event-loop)
            $num++;

            //todo make sure user has access to this form id
            $form = $this->getForm($request);
            if (!$form) {
                echo "Error, form does not exist.";
                return;
            }

            if (!$started) {
                $last_updated = $form->original['updated_at'];
                $started = true;
            } else {
                if ($form->original['updated_at'] > $last_updated) {
                    $formData = json_encode($form->original);
                    echo "data: {$formData}\n\n";
                    $last_updated = $form->original['updated_at'];
                }
            }

            // flush the output buffer and send echoed messages to the browser

            while (ob_get_level() > 0) {
                ob_end_flush();
            }
            flush();

            // break the loop if the client aborted the connection (closed the page)

            if (connection_aborted()) {
                break;
            }

            // sleep for 10 second before running the loop again

            sleep(10);
        }
    }

    public function getOp($str)
    {
        $output = "";
        switch ($str) {
            case "Any":
                $output = "||";
                break;
            case "All":
                $output = "&&";
                break;
            case "matches":
                $output = "==";
                break;
            case "doesn't match":
                $output = "!=";
                break;
            case "is less than":
                $output = "<";
                break;
            case "is more than":
                $output = ">";
                break;
            case "contains anything":
                $output = "!=";
                break;
            case "is blank":
                $output = "==";
                break;
            case "contains":
                $output = "contains";
                break;
            case "doesn't contain":
                $output = "doesn't contain";
                break;
        }
        return $output;
    }

    public function scrubString($str)
    {
        if (empty($str)) {
            return $str;
        }

        $scrubbed = htmlspecialchars($str, ENT_NOQUOTES);
        $scrubbed = str_replace("'", "&apos;", $scrubbed);
        $scrubbed = str_replace('\"', "", $scrubbed);
        $scrubbed = json_encode($this->parseOptionValues(json_decode($scrubbed, true)));
        return $scrubbed;
    }

    public function isCSVDatabase($formAction, $base_url = '')
    {
        $path = '//'. $base_url.'/form/submit';
        //if form action matches a csv transaction
        return substr($formAction, 0 - strlen($path)) == $path ? true : false;
    }

    public function writeS3($filename, $body)
    {
        $s3 = new S3Client([
            'region'      => env('BUCKETEER_AWS_REGION'),
            'version'     => 'latest',
            'credentials' => CredentialProvider::env()
        ]);

        $result = $s3->putObject([
            'Bucket' => env('BUCKETEER_BUCKET_NAME'),
            'Key' => 'public/'.$filename,
            'Body' => $body,
        ]);

        return $result;
    }

    public function readS3($filename)
    {
        $s3 = new S3Client([
            'region'      => env('BUCKETEER_AWS_REGION'),
            'version'     => 'latest',
            'credentials' => CredentialProvider::env()
        ]);

        if ($s3->doesObjectExist(env('BUCKETEER_BUCKET_NAME'), 'public/'.$filename)) {
            $result = $s3->getObject([
                'Bucket' => env('BUCKETEER_BUCKET_NAME'),
                'Key' => 'public/'.$filename
            ]);
            return $result['Body'];
        } else {
            return false;
        }
    }

    public function getBucketPath() {
        return 'https://'.env('BUCKETEER_BUCKET_NAME').'.s3.amazonaws.com/public/';
    }

    public function generateUploadedFilename($formId, $name, $filename) { //todo use responseId instead of time
        $time = time();
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $hash = substr(sha1($formId.$time.env('FILE_SALT')),0,8);
        //return 'https://'.env('BUCKETEER_BUCKET_NAME').'.s3.amazonaws.com/public/'.$formId.'-'.$time.'-'.$name.'-'.$hash.'.'.$ext;
        return $formId.'-'.$time.'-'.$name.'-'.$hash.'.'.$ext;
    }

    /*
    * @newFormData - form content data being submitted through saveForm
    * @originalFormData - form's original content data, passed through saveForm
    *
    * @retrun - array of fields that doesn't match up.
    */
    public function getFormColumnsToUpdate($newFormData, $originalFormData){
        $updates = array();
        $newFormData = $this->parseOptionValues($newFormData, 'json');
        if (!empty($originalFormData['data'])) {
            $originalFormData = $this->parseOptionValues($originalFormData);
            $originalFormData = $this->parseOptionValues($originalFormData, 'json');
            foreach ($newFormData['data'] as $key => $value) {
                foreach ($originalFormData['data'] as $originalKey => $originalValue) {
                    if (strcmp($value['name'], $originalValue['name']) == 0) {
                        $diff = array_diff($value, $originalValue);
                        if (count($diff) != 0) { // key and value matches
                        $updates['update'] = $value; // key found, value doesn't match, this is an update.
                        }
                        unset($originalFormData['data'][$originalKey]);
                        unset($newFormData['data'][$key]);
                        break;
                    }
                }
            }
        }
        //TODO: upgrade to bulk delete/add
        if( $originalFormData['data'] && count($originalFormData['data']) > 0){
            $updates['remove'] = reset($originalFormData['data']);
        }
        if($newFormData['data'] && count($newFormData['data']) > 0){
            $updates['add'] = reset($newFormData['data']);
        }

        //Log::info(print_r($updates,1));
        return $updates;
    }
}