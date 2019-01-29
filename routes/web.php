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
    return $router->app->version();
});

// Router Login Auth
$router->post('/v1/register', 'UserController@register');
$router->post('/v1/login', 'UserController@login');
$router->get('/user/{id}', 'LoginController@index');
$router->get('/student/all', ['middleware' => 'auth', 'uses' =>  'StudentController@all']);
$router->post('/v1/studentbox','DoesBoxController@upload');

// Router for Students
$router->group(['prefix' => 'v1/student'], function () use ($router) {
	$router->get('/', 'StudentController@all');
	$router->get('/{id}', 'StudentController@getById');
	$router->post('/create', 'StudentController@create');
	$router->put('/update/{id}', 'StudentController@update');
	$router->delete('/delete/{id}', 'StudentController@delete');
	$router->get('/skill/{id}', 'StudentController@getStudentSkill');
	$router->get('/character/{id}', 'StudentController@getStudentChar');
	// $router->get('/student/all', 'StudentController@all');
	// $router->put('/skill/update/{id}', 'StudentController@update');
	// $router->get('/major/{id}', 'StudentController@getStudentMajor');
});

// Router for Major
$router->group(['prefix' => 'v1/major'], function () use ($router) {
	$router->get('/','MajorController@all');
	$router->get('/{id}','MajorController@getById');
	$router->get('/skill/{id}', 'MajorController@getMajorSkillById');
	$router->post('/create', 'MajorController@create');
	$router->put('/update/{id}', 'MajorController@update');
	$router->delete('/delete/{id}', 'MajorController@delete');
});

// Router for Skill
$router->group(['prefix' => 'v1/skill'], function () use ($router) {
	$router->get('/','SkillController@all');
	$router->get('/{id}', 'SkillController@getById');
	$router->post('/create','SkillController@create');
	$router->put('/update/{id}', 'SkillController@update');
	$router->delete('/delete/{id}', 'SkillController@delete');
	$router->get('/major/{id}','SkillController@getByMajorId');
});

// Router for Character
$router->group(['prefix' => 'v1/character'], function () use ($router) {
	$router->get('/','CharacterController@all');
	$router->get('/{id}', 'CharacterController@getById');
	$router->post('/create','CharacterController@create');
	$router->put('/update/{id}', 'CharacterController@update');
	$router->delete('/delete/{id}', 'CharacterController@delete');
});

// Router for About
$router->group(['prefix' => 'v1/about'], function () use ($router) {
	$router->get('/','AboutController@get');
	$router->put('/update/{id}','AboutController@update');
	$router->post('/','AboutController@create');
});

// Router for Founder
$router->group(['prefix' => 'v1/founder'], function () use ($router) {
	$router->get('/','FounderController@get');
	$router->put('/update/{id}','FounderController@update');
	$router->post('','FounderController@create');
});

// Router for OurWork
$router->group(['prefix' => 'v1/ourwork'], function () use ($router) {
	$router->get('/','OurWorkController@get');
	$router->get('/{id}', 'OurWorkController@getById');
	$router->post('/create','OurWorkController@create');
	$router->put('/update/{id}', 'OurWorkController@update');
	$router->delete('/delete/{id}', 'OurWorkController@delete');
});
