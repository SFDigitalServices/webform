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
    //$app->get('embed', 'FormController@embedJS');
    $app->get('getIndex', 'FormController@getIndex');
    $app->post('getForms', 'FormController@getUserForms');
    $app->post('getForm', 'FormController@getForm');
    $app->get('embed', 'FormController@embedJS');
    $app->get('generate', 'FormController@generate');
    $app->post('save', 'FormController@save');
    $app->post('create', 'FormController@create');
    $app->post('clone', 'FormController@clone');
    $app->post('delete', 'FormController@delete');
    $app->post('submit', 'FormController@submitCSV');
	$app->post('getFilename', 'FormController@getFilename');
	$app->post('csv-published', 'FormController@CSVPublished');
	$app->post('purge-csv', 'FormController@purgeCSV');
});
