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

/** @var \Laravel\Lumen\Routing\Router $router */
$router->get('/', function () use ($router) {
    return ['success' => true];
});

$router->group(['prefix' => '/trains'], function () use ($router) {
    $router->get('/', 'TrainsController@index');
    $router->post('/', 'TrainsController@create');
    $router->get('/{trainId}', 'TrainsController@view');
    $router->post('/{trainId}', 'TrainsController@update');
    $router->delete('/{trainId}', 'TrainsController@delete');
});
