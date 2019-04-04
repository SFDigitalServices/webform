<?php
namespace App\Helpers;

class FileStoreHelper
{
     /**
     * Loops through form data to determine if any of them are file uploads
     *
     * @returns boolean
     */
	function hasFileUpload($data) {
		foreach ($data as $field) {
			if ($field['formtype'] == "m13") {
				return true;
			}
		}
		return false;
	}
     /**
     * Rewrites the header for the CSV file
     */
	public function rewriteCSV($content, $filename) {
		$column = 0;
		$write = Array();
		foreach ($content->data as $field) {
			$nonInputs = array("m02", "m04", "m06", "m08", "m10", "m13", "m14", "m16");
			$multipleInputs = array("s02", "s04", "s06", "s08");
			if (in_array($field->formtype, $multipleInputs)) {
				if ($field->formtype == "s02" || $field->formtype == "s04") {
					$options = explode("\n",$field->option);
				} else if ($field->formtype == "s06") {
					$options = explode("\n",$field->checkboxes);
				} else if ($field->formtype == "s08") {
					$options = explode("\n",$field->radios);
				}
				foreach ($options as $option) {
					$write[$column] = isset($field->name) ? $field->name." ".$option : $option;
					$column++;
				}
			} else if (!in_array($field->formtype, $nonInputs)) { // catch all for everything except multiple and non-inputs
				$write[$column] = isset($field->name) ? $field->name : '';
				$column++;
			}
		}
		//file_put_contents('/var/www/html/public/csv/'.$filename, implode(",",$write)."\n");
		$this->writeCSV($filename, implode(",",$write)."\n");
	}
     /**
     * Checks if the form requires CSVs and then sends data off to rewrite the CSV header
     */
	public function processCSV($form, $base_url = '') {
		//read content and settings
		$content = json_decode($form->content);
		if ($this->isCSVDatabase($content->settings->action, $base_url)) {
			$filename = $this->generateFilename($form->id);
			//rewrite header row if CSV is not published (only header row or less exists)
			if (!$this->isCSVPublished($filename)) $this->rewriteCSV($content, $filename);
		}
	}
     /**
     * Checks form action url to compare it to the CSV endpoint
     *
     * @returns boolean
     */
	public function isCSVDatabase($formAction, $base_url = '') {
		$path = '//'. $base_url.'/form/submit';
		//if form action matches a csv transaction
		return substr($formAction,0 - strlen($path)) == $path ? true : false;
	}
     /**
     * Tells if CSV is published by request
     *
     * @returns int 1 or 0
     */
	public function CSVPublished(Request $request) {
		return $this->isCSVPublished($this->getFilename($request)) ? 1 : 0;
	}
     /**
     * Tells if CSV is published by filename
     *
     * @returns boolean
     */
	public function isCSVPublished($filename) {
		$csv = $this->readCSV($filename);
		return count($csv) > 1 ? true : false;
	}
     /**
     * Opens and reads CSV file
     *
     * @returns array
     */
	public function readCSV($filename) {
		//$csv = array_map('str_getcsv', file('/var/www/html/public/csv/'.$filename , FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
		$csv = array();
		$read = $this->readS3($filename);
		if ($read) {
			$rows = str_getcsv($read,"\n");
			foreach ($rows as $row) {
				$csv[] = str_getcsv($row);
			}
		}
		return $csv;
	}
     /**
     * Write CSV file
     *
     * @returns 
     */
	public function writeCSV($filename, $body) {
		//file_put_contents('/var/www/html/public/csv/'.$filename, implode(",",$write)."\n");
		return $this->writeS3($filename, $body);
	}
     /**
     * Write a new row in CSV file
     */
	public function appendCSV($filename, $arr) {
		$csv = $this->readCSV($filename);
		array_push($csv, $arr);
		$output = "";
		foreach ($csv as $row) {
			$output .= implode(",", $row)."\n";
		}
		$this->writeCSV($filename, $output);
	}
     /**
     * Write to Bucketeer account
     *
     * @returns result object
     */
	public function writeS3($filename, $body) {
		//require('../vendor/autoload.php');
		
		/*$s3 = new S3Client([
			'profile' => 'default',
			'version' => 'latest',
			'region' => env('BUCKETEER_AWS_REGION'),
			'credentials' => [
				'key' => env('BUCKETEER_AWS_ACCESS_KEY_ID'),
				'secret' => env('BUCKETEER_AWS_SECRET_ACCESS_KEY')
			]
		]);*/
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
     /**
     * Read from Bucketeer account
     *
     * @returns body or file or false
     */
	public function readS3($filename) {
		
		/*$s3 = new S3Client([
			'profile' => 'default',
			'version' => 'latest',
			'region' => env('BUCKETEER_AWS_REGION'),
			'credentials' => [
				'key' => env('BUCKETEER_AWS_ACCESS_KEY_ID'),
				'secret' => env('BUCKETEER_AWS_SECRET_ACCESS_KEY')
			]
		]);	*/
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
     /**
     * Gets the CSV filename from a request
     *
     * @returns string
     */
	public function getFilename(Request $request) {
		$id = $request->input('id');
		//todo make sure user has access to this form id
		$path = $request->input('path');
		if ($path) {
			return 'https://'.env('BUCKETEER_BUCKET_NAME').'.s3.amazonaws.com/public/'.$this->generateFilename($id);
		} else {
			return $this->generateFilename($id);
		}
	}
     /**
     * Gets bucket url
     *
     * @returns URL string
     */
	public function getBucketPath() {
		return 'https://'.env('BUCKETEER_BUCKET_NAME').'.s3.amazonaws.com/public/';
	}
     /**
     * Gets the CSV filename from id
     *
     * @returns string
     */
	private function generateFilename($id) {
		$hash = substr(sha1($id.env('FILE_SALT')),0,8);
		return $id.'-'.$hash.'.csv';
	}
     /**
     * Makes a filename path from form id
     *
     * @returns string
     */
	private function generateUploadedFilename($formId, $name, $filename) { //todo use responseId instead of time
		$time = time();
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$hash = substr(sha1($formId.$time.env('FILE_SALT')),0,8);
		//return 'https://'.env('BUCKETEER_BUCKET_NAME').'.s3.amazonaws.com/public/'.$formId.'-'.$time.'-'.$name.'-'.$hash.'.'.$ext;
		return $formId.'-'.$time.'-'.$name.'-'.$hash.'.'.$ext;
	}
	
}