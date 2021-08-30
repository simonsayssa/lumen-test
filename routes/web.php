<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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
$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@authenticate');

$router->group(['prefix' => 'to-do'], function () use ($router) {
    $router->get('/', 'ToDoController@index');
    $router->post('/', 'ToDoController@store');
    $router->put('/{id}', 'ToDoController@update');
    $router->delete('/{id}', 'ToDoController@destroy');
});

$router->group(['prefix' => 'to-do-category'], function () use ($router) {
    $router->get('/', 'ToDoCategoryController@index');
    $router->post('/', 'ToDoCategoryController@store');
    $router->put('/{id}', 'ToDoCategoryController@update');
    $router->delete('/{id}', 'ToDoCategoryController@destroy');
});
