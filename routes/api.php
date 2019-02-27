<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return view('login');
 });

$app->post('/home', 'UserController@login');
$app->get('/home', 'UserController@login');
$app->get('/createView', 'UserController@createView');
$app->post('/user/logout', 'UserController@logout');
$app->get('/user/register', 'UserController@register');
$app->get('/user/delete', 'UserController@delete');
$app->get('/user/debug', 'UserController@debug');

$app->group(['prefix' => 'form'], function($app) {
    //$app->get('getIndex', ['as' => 'getIndex', 'uses' => 'FormController@getIndex']);
    $app->post('getForms', ['as' => 'getForms', 'uses' => 'FormController@getUserForms']);
    $app->post('getApiToken', ['as' => 'getApiToken', 'uses' =>'FormController@getApiToken']);
    //$app->post('createUser', ['as' => 'createUser', 'uses' =>'FormController@createUser']);
    $app->post('getForm', ['as' => 'getForm', 'uses' => 'FormController@getForm']);
    $app->get('embed', ['as' => 'embed', 'uses' => 'FormController@embedJS']);
    $app->get('generate', ['as' => 'generate', 'uses' => 'FormController@generate']);
    $app->post('save', ['as' => 'save', 'uses' => 'FormController@save']);
    $app->post('create',['as' => 'create', 'uses' =>'FormController@create']);
    $app->post('clone', ['as' => 'clone', 'uses' => 'FormController@clone']);
    $app->post('delete',['as' => 'delete', 'uses' => 'FormController@delete']);
    $app->post('submit',['as' => 'submit', 'uses' => 'FormController@submitCSV']);
	$app->post('getFilename', ['as'=>'getFilename', 'uses' => 'FormController@getFilename']);
	$app->post('csv-published', ['as' => 'csv-published', 'uses' => 'FormController@CSVPublished']);
	$app->post('purge-csv', ['as' => 'purge-csv', 'uses' => 'FormController@purgeCSV']);
});
