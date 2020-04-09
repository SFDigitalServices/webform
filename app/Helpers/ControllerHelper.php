<?php
namespace App\Helpers;
use Aws\S3\S3Client;
use Aws\Credentials\CredentialProvider;
use Log;

// All helper functions should belong here, the controller should not contain any helper/utilty functions
class ControllerHelper
{

  /** Parse checkboxes and radio options into array
    *
    * @param $content
    * @param $op
    *
    * @return array
    */
    public function parseOptionValues($content, $op = '')
    {
        if(isset($content['settings']))
            $ret['settings'] = $content['settings'];
        $ret['data'] = array();
        if (!empty($content['data'])) {
            foreach ($content['data'] as $field) {
                if (array_key_exists('option', $field)) {
                    if (!is_array($field['option'])) {
                        $field['option'] = $this->sanitizeOptions($field, 'option');
                    }
                    if (strcmp($op, 'json') == 0) {
                        $field['option'] = json_encode($field['option']);
                    }
                } elseif (array_key_exists('checkboxes', $field)) {
                    if (!is_array($field['checkboxes'])) {
                        $field['checkboxes'] = $this->sanitizeOptions($field, 'checkboxes');
                    }
                    if (strcmp($op, 'json') == 0) {
                        $field['checkboxes'] = json_encode($field['checkboxes']);
                    }
                } elseif (array_key_exists('radios', $field)) {
                    if (!is_array($field['radios'])) {
                        $field['radios'] = $this->sanitizeOptions($field, 'radios');
                    }
                    if (strcmp($op, 'json') == 0) {
                        $field['radios'] = json_encode($field['radios']);
                    }
                }
                $ret['data'][] = $field;
            }
        }
        return $ret;
    }

    /** Helper function for parseOptionValues()
    *
    * @param $field
    * @param $option
    *
    * @return array
    */
    private function sanitizeOptions($field, $option)
    {
      $search = array('&apos;', '&quot;', '&lt;', '&gt;', '&amp;');
      $field[$option] = str_replace($search, "", $field[$option]);
      $field[$option] = explode("\n", $field[$option]);
      $field[$option] = array_map('trim', $field[$option]);
      return $field[$option] = array_values(array_filter($field[$option], function($value, $key) { return $value != ''; }, ARRAY_FILTER_USE_BOTH));
    }

   /** Determines submitted form fields are actually inputs.
    *
    * @param $formtype
    *
    * @return bool
    */

    public function isNonInputField($formtype)
    {
      $nonInputes = array('m02', 'm04', 'm06', 'm08','m10', 'm14','m16');
      if ( in_array($formtype, $nonInputes) ) {
        return true;
      }
      return false;
    }

  /** Generates a unique csv file name
    *
    * @param $id
    *
    * @return string
    */

    public function generateFilename($id)
    {
        $hash = substr(sha1($id.env('FILE_SALT')), 0, 8);
        return $id.'-'.$hash.'.csv';
    }


   /** For all the file fields, determine if any has file uploaded
    *
    * @param $data
    *
    * @return bool
    */
    public function hasFileUpload($data)
    {
        if ($data) {
            foreach ($data as $field) {
                if ($field['formtype'] == "m13") {
                    return true;
                }
            }
        }
        return false;
    }

  /** Map keyword to machine operators
    *
    * @param $str
    *
    * @return string
    */
    public function getOp($str)
    {
        $output = "";
        switch (strtolower($str)) {
            case "any":
                $output = "||";
                break;
            case "all":
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


   /** Format form setting into workable array.
    *
    * @param $str
    *
    * @return string
    */
    public function scrubString($str)
    {
        if (empty($str)) {
            return $str;
        }

        $scrubbed = htmlspecialchars($str, ENT_NOQUOTES);
        $scrubbed = str_replace("&amp;", "&", $scrubbed);
        $scrubbed = str_replace("'", "&apos;", $scrubbed);
        $scrubbed = str_replace('\"', "&quot;", $scrubbed);
        $scrubbed = json_encode($this->parseOptionValues(json_decode($scrubbed, true)));
        return $scrubbed;
    }


  /** Determine if external form endpoint is defined.
    *
    * @param $formAction
    * @param $base_url
    *
    * @return bool
    */
    public function isCSVDatabase($formAction, $base_url = '')
    {
        $path = '//'. $base_url.'/form/submit';
        //if form action matches a csv transaction
        return substr($formAction, 0 - strlen($path)) == $path ? true : false;
    }


    /** Write submitted form data to CSV
    *
    * @param $filename
    * @param $body
    *
    * @return array
    */
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


  /** Read data from S3
    *
    * @param $filename
    *
    * @return array
    */
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


   /** Get S3 bucketname
    *
    * @return string
    */
    public function getBucketPath()
    {
        return 'https://'.env('BUCKETEER_BUCKET_NAME').'.s3.amazonaws.com/public/';
    }

   /** Generates unique file name on S3
    *
    * @param $formId
    * @param $name
    * @param $filename
    *
    * @return string
    */
    public function generateUploadedFilename($formId, $name, $filename)
    { //todo use responseId instead of time
        $time = time();
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $hash = substr(sha1($formId.$time.env('FILE_SALT')),0,8);
        //return 'https://'.env('BUCKETEER_BUCKET_NAME').'.s3.amazonaws.com/public/'.$formId.'-'.$time.'-'.$name.'-'.$hash.'.'.$ext;
        return $formId.'-'.$time.'-'.$name.'-'.$hash.'.'.$ext;
    }


   /** Parse form setting json for database CRUD operations
    *
    * @param $newFormData
    * @param $originalFormData
    *
    * @return array
    */
    public function getFormColumnsToUpdate($newFormData, $originalFormData)
    {
        $updates = array();
        $newFormData = $this->parseOptionValues($newFormData, 'json');
        if (!empty($originalFormData['data'])) {
            $originalFormData = $this->parseOptionValues($originalFormData);
            $originalFormData = $this->parseOptionValues($originalFormData, 'json');
            $checkboxes = $radios = '';
            foreach ($newFormData['data'] as $key => $value) {
                foreach ($originalFormData['data'] as $originalKey => $originalValue) {
                    if (strcmp($value['name'], $originalValue['name']) === 0) {
                        //unset multi-dimensional array values because their existence does not change the database structure
                        unset($value['conditions']);
                        unset($originalValue['conditions']);
                        unset($value['calculations']);
                        unset($originalValue['calculations']);
                        unset($value['webhooks']);
                        unset($originalValue['webhooks']);

                        //$diff = array_diff($value, $originalValue);
                        $diff = $this->check_diff_multi($value, $originalValue);
                        if (count($diff) != 0 && ! $this->isNonInputField($value['formtype']) ) { // key and value matches
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
        // Look for "name" update
        if(isset($updates['add']) && isset($updates['remove'])){
          $updates['rename']['from'] = $updates['remove']['name'];
          $updates['rename']['to'] = $updates['add']['name'];
          $updates['rename']['add'] = $updates['add'];
          unset($updates['remove']);
          unset($updates['add']);
        }
        return $updates;
    }

  private function check_diff_multi($array1, $array2){
      $result = array();
      foreach ($array1 as $key => $val) {
          if (is_array($val) && isset($array2[$key])) {
              $tmp = check_diff_multi($val, $array2[$key]);
              if ($tmp) {
                  $result[$key] = $tmp;
              }
          } elseif (!isset($array2[$key])) {
              $result[$key] = null;
          } elseif (md5($val) !== md5($array2[$key])) { // compare hash, string may include html
              $result[$key] = $array2[$key];
          }

          if (isset($array2[$key])) {
              unset($array2[$key]);
          }
      }

      $result = array_merge($result, $array2);

      return $result;
  }

  public function getFileUploadURL(&$records, $files){
    if ($files && !isset($files['status'])) {
        foreach ($records as $rkey => $rvalue) {
            foreach ($files as $file) {
                // if form_field_name in managed_files matches form column name
                if (array_key_exists($file['form_field_name'], $rvalue)) {
                    // if managed_files id matches reference id in form_[formid] table
                    if ($rvalue[$file['form_field_name']] == $file['id']) {
                        $records[$rkey][$file['form_field_name']] = $file['url']; // set file url
                        break;
                    }
                }
            }
        }
    }
  }

  public function getLookupValues(&$records, $lookups){
    if ($lookups && !isset($lookups['status'])) {
        foreach ($records as $rkey => $rvalue) {
            $values = array();
            $masterkey = '';
            foreach ($lookups as $lookup) {
                $lookupkey = $lookup['form_field_name'];
                if (!isset($values[$lookupkey])) {
                    $values[$lookupkey] = array();
                    $masterkey = $lookupkey;
                }
                // if form_field_name in lookup table matches form column name
                if (array_key_exists($lookupkey, $rvalue)) {
                    // if lookup table id matches reference id in form_[formid] table
                    $ids = explode(',', $rvalue[$lookupkey]);
                    if (in_array($lookup['id'], $ids)) {
                        array_push($values[$lookupkey], $lookup['value']); // set value
                    }
                }
            }
            // turn lookup values from array to string
            foreach ($values as $key => $value) {
                if (!empty($value)) {
                    $records[$rkey][$key] = implode(',', $value);
                }
            }
        }
    }
  }
}