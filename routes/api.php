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
    $router->post('getForms', ['as' => 'getForms', 'uses' => 'FormController@getUserForms']);
    $router->post('getApiToken', ['as' => 'getApiToken', 'uses' =>'FormController@getApiToken']);
    $router->post('getForm', ['as' => 'getForm', 'uses' => 'FormController@getForm']);
    $router->get('embed', ['as' => 'embed', 'uses' => 'FormController@embedJS']);
    $router->get('preview', ['as' => 'preview', 'uses' => 'FormController@preview']);
    $router->post('preview', ['as' => 'preview', 'uses' => 'FormController@previewSubmitted']);
    $router->get('generate', ['as' => 'generate', 'uses' => 'FormController@generate']);
    $router->get('push', ['as' => 'push', 'uses' => 'FormController@notifyUser']);
    $router->post('save', ['as' => 'save', 'uses' => 'FormController@save']);
    $router->post('create',['as' => 'create', 'uses' =>'FormController@create']);
    $router->post('clone', ['as' => 'clone', 'uses' => 'FormController@clone']);
    $router->post('delete',['as' => 'delete', 'uses' => 'FormController@delete']);
	  $router->post('share', ['as' => 'share', 'uses' => 'FormController@share']);
    $router->post('submit',['as' => 'submit', 'uses' => 'FormController@submitForm']);
    $router->post('submitPartial',['as' => 'submitPartial', 'uses' => 'FormController@submitPartialForm']);
    $router->get('submitPartial',['as' => 'submitPartial', 'uses' => 'FormController@submitPartialForm']);
    $router->get('retrieveDraft',['as' => 'retrieveDraft', 'uses' => 'FormController@retrieveFormDraft']);
	  $router->post('getFilename', ['as'=>'getFilename', 'uses' => 'FormController@getFilename']);
    $router->post('authors', ['as' => 'authors', 'uses' => 'FormController@getAuthors']);
	  $router->post('csv-published', ['as' => 'csv-published', 'uses' => 'FormController@CSVPublished']);
    $router->post('purge-csv', ['as' => 'purge-csv', 'uses' => 'FormController@purgeCSV']);
    $router->post('export-csv', ['as' => 'export-csv', 'uses' => 'FormController@exportFormData']);
    $router->get('resume-draft', ['as' => 'resume-draft', 'uses' => 'FormController@resumeDraft']);
    $router->post('draft-list', ['as' => 'draft-list', 'uses' => 'FormController@getFormDraftList']);
    $router->post('getPreviewPage', ['as' => 'getPreviewPage', 'uses' => 'FormController@getPreviewPage']);
});

$router->group(['prefix' => 'api'], function($router) {
    $router->post('getFormData', ['as' => 'getFormData', 'uses' => 'APIController@getFormData']);
    $router->post('getArchivedFormData', ['as' => 'getArchivedFormData', 'uses' => 'APIController@getArchivedFormData']);
    $router->post('getFormSchema', ['as' => 'getFormSchema', 'uses' => 'APIController@getFormSchema']);
    $router->post('getLookupTable', ['as' => 'getLookupTable', 'uses' => 'APIController@getLookupTable']);
});
