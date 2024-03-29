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
 * Users and Roles routes
 */
$router->group(['prefix' => 'v1/', 'middleware' => 'auth'], function () use ($router) {
    //UserController routes
    $router->post('users', 'Authentication\UserController@store');
    $router->get('users', 'Authentication\UserController@index');
    $router->get('users/{user}', 'Authentication\UserController@show');
    $router->put('users/{user}', 'Authentication\UserController@update');
    $router->patch('users/{user}', 'Authentication\UserController@update');
    $router->delete('users/{user}', 'Authentication\UserController@destroy');
    //RoleController routes
    $router->post('roles', 'Authorization\RoleController@store');
    $router->get('roles', 'Authorization\RoleController@index');
    $router->get('roles/{role}', 'Authorization\RoleController@show');
    $router->put('roles/{role}', 'Authorization\RoleController@update');
    $router->patch('roles/{role}', 'Authorization\RoleController@update');
    $router->delete('roles/{role}', 'Authorization\RoleController@destroy');
});
