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

$router->get('/', function () use ($router) {
    return view('login');
 });

$router->post('/home', 'UserController@login');
$router->get('/home', 'UserController@login');
$router->get('/createView', 'UserController@createView');
$router->post('/user/logout', 'UserController@logout');
$router->get('/user/register', 'UserController@register');
$router->get('/user/delete', 'UserController@delete');
$router->get('/user/debug', 'UserController@debug');

$router->group(['prefix' => 'form'], function($router) {
    //$app->get('getIndex', ['as' => 'getIndex', 'uses' => 'FormController@getIndex']);
    $router->post('getForms', ['as' => 'getForms', 'uses' => 'FormController@getUserForms']);
    $router->post('getApiToken', ['as' => 'getApiToken', 'uses' =>'FormController@getApiToken']);
    //$app->post('createUser', ['as' => 'createUser', 'uses' =>'FormController@createUser']);
    $router->post('getForm', ['as' => 'getForm', 'uses' => 'FormController@getForm']);
    $router->get('embed', ['as' => 'embed', 'uses' => 'FormController@embedJS']);
    $router->get('generate', ['as' => 'generate', 'uses' => 'FormController@generate']);
    $router->get('push', ['as' => 'push', 'uses' => 'FormController@notifyUser']);
    $router->post('save', ['as' => 'save', 'uses' => 'FormController@save']);
    $router->post('create',['as' => 'create', 'uses' =>'FormController@create']);
    $router->post('clone', ['as' => 'clone', 'uses' => 'FormController@clone']);
    $router->post('delete',['as' => 'delete', 'uses' => 'FormController@delete']);
	$router->post('share', ['as' => 'share', 'uses' => 'FormController@share']);
    $router->post('submit',['as' => 'submit', 'uses' => 'FormController@submitCSV']);
	$router->post('getFilename', ['as'=>'getFilename', 'uses' => 'FormController@getFilename']);
    $router->post('authors', ['as' => 'authors', 'uses' => 'FormController@getAuthors']);
	$router->post('csv-published', ['as' => 'csv-published', 'uses' => 'FormController@CSVPublished']);
	$router->post('purge-csv', ['as' => 'purge-csv', 'uses' => 'FormController@purgeCSV']);
});
