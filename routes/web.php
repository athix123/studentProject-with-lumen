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
$router->get('/student/allauth', ['middleware' => 'auth', 'uses' =>  'StudentController@all']);
$router->post('/v1/studentbox','DoesBoxController@upload');

// Router for Students
$router->get('/v1/student/all','StudentController@all');
$router->get('/v1/student/{id}', 'StudentController@getById');
$router->get('/v1/student/skill/{id}', 'StudentController@getStudentSkill');
$router->get('/v1/student/character/{id}', 'StudentController@getStudentChar');
$router->group(['prefix' => 'v1/student',  'middleware' => 'auth'], function () use ($router) {
	// $router->get('/', 'StudentController@all');
	$router->post('/create', 'StudentController@create');
	$router->put('/update/{id}', 'StudentController@update');
	$router->delete('/delete/{id}', 'StudentController@delete');
	// $router->get('/student/all', 'StudentController@all');
	// $router->put('/skill/update/{id}', 'StudentController@update');
	// $router->get('/major/{id}', 'StudentController@getStudentMajor');
});

// Router for Major
$router->get('/v1/major','MajorController@all');
$router->get('/v1/major/{id}','MajorController@getById');
$router->get('/v1/major/skill/{id}', 'MajorController@getMajorSkillById');
$router->group(['prefix' => 'v1/major',  'middleware' => 'auth'], function () use ($router) {
	$router->post('/create', 'MajorController@create');
	$router->put('/update/{id}', 'MajorController@update');
	$router->delete('/delete/{id}', 'MajorController@delete');
});

// Router for Skill
$router->get('/v1/skill','SkillController@all');
$router->get('/v1/skill/{id}', 'SkillController@getById');
$router->get('/v1/skill/major/{id}','SkillController@getByMajorId');
$router->group(['prefix' => 'v1/skill',  'middleware' => 'auth'], function () use ($router) {
	$router->post('/create','SkillController@create');
	$router->put('/update/{id}', 'SkillController@update');
	$router->delete('/delete/{id}', 'SkillController@delete');
});

// Router for Character
$router->get('/v1/character','CharacterController@all');
$router->get('/v1/character/{id}', 'CharacterController@getById');
$router->group(['prefix' => 'v1/character',  'middleware' => 'auth'], function () use ($router) {
	$router->post('/create','CharacterController@create');
	$router->put('/update/{id}', 'CharacterController@update');
	$router->delete('/delete/{id}', 'CharacterController@delete');
});

// Router for About
$router->get('/v1/about','AboutController@get');
$router->group(['prefix' => 'v1/about',  'middleware' => 'auth'], function () use ($router) {
	$router->put('/update/{id}','AboutController@update');
	$router->post('/','AboutController@create');
});

// Router for Founder
$router->get('/v1/founder', 'FounderController@get');
$router->group(['prefix' => 'v1/founder', 'middleware' => 'auth'], function () use ($router) {
	$router->put('/update/{id}','FounderController@update');
	$router->post('/','FounderController@create');
});

// Router for OurWork
$router->get('/v1/ourwork','OurWorkController@get');
$router->get('/v1/ourwork/{id}', 'OurWorkController@getById');
$router->group(['prefix' => 'v1/ourwork','middleware' => 'auth'], function () use ($router) {
	$router->post('/create','OurWorkController@create');
	$router->put('/update/{id}', 'OurWorkController@update');
	$router->delete('/delete/{id}', 'OurWorkController@delete');
});
