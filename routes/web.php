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

/**
 * @var \Laravel\Lumen\Routing\Router $router
 */

$router->get('/', 'AuthController@login');


$router->group(['prefix' => 'auth'], function () use ($router) {

    $router->group(['namespace' => 'Member'], function () use ($router) {
        $router->post('login','AuthController@login');
        $router->post('logout','AuthController@logout');
        $router->post('refreshToken','AuthController@refreshToken');
        $router->post('register','AuthController@register');
    });

});
