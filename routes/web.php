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

//CRUD handlers
$app->get('/form/editor', 'FormController@getEditor');
$app->get('/form/embed', 'FormController@embedJS');
$app->get('/form/save', 'FormController@saveData');
$app->get('/form/create', 'FormController@createForm');
$app->get('/form/clone', 'FormController@cloneForm');

$app->post('/user-login', 'LoginController@userLogin');

/*$app->get('/form/data/{id}', 'FormController@getData');
$app->get('/form/options', 'FormController@getOptions');
$app->post('/form/data', 'FormController@saveData');
$app->post('/form/do-upload', 'FormController@doUpload');

$app->get('/grid/data', 'GridController@getData');
$app->post('/grid/data[/]', 'GridController@addData');
$app->put('/grid/data/{id}', 'GridController@updateData');
$app->delete('/grid/data/{id}', 'GridController@removeData');

$app->get("/grid/data-dynamic", 'DynamicGridController@getData');

$app->get('/tree/data', 'TreeController@getAll');
$app->get('/tree/data-dynamic', 'TreeController@getLevel');
*/

//static pages
/*$app->get('/', function() { return view('login'); });
$app->get('/tree',  function(){ return view('tree'); });
$app->get('/grid',  function(){ return view('grid'); });
$app->get('/grid-dynamic', function(){ return view('grid-dynamic'); });
$app->get('/grid-paging',  function(){ return view('grid-paging'); });
$app->get('/grid-server',  function(){ return view('grid-server'); });
$app->get('/form', 		   function(){ return view('form'); });
$app->get('/form-combo', 	 function(){ return view('form-combo'); });
$app->get('/form-uploading', function(){ return view('form-uploading'); });
*/
