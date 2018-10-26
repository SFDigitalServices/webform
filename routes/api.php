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

$app->post('/user/login', 'UserController@login');
$app->post('/user/logout', 'UserController@logout');
$app->post('/user/register', 'UserController@register');

$app->group(['prefix' => 'form'], function($app) {
    //$app->get('embed', 'FormController@embedJS');
    $app->post('editor', 'FormController@getEditor');
    $app->post('embed', 'FormController@embedJS');
    $app->post('save', 'FormController@saveForm');
    $app->post('create', 'FormController@createForm');
    $app->post('clone', 'FormController@cloneForm');
});
