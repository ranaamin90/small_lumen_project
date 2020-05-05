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

$router->post('auth/login', 'Auth\AuthController@login');

//Categories routes
$router->get('categories', 'CategoriesController@index');
$router->post('categories', 'CategoriesController@store');
$router->put('categories/{category}', 'CategoriesController@update');
$router->delete('categories/{category}', 'CategoriesController@destroy');
//products routes
$router->get('products', 'ProductsController@index');
$router->post('products', 'ProductsController@store');
$router->put('products/{product}', 'ProductsController@update');
$router->delete('products/{product}', 'ProductsController@destroy');

// $router->group(['middleware' => 'jwt.auth'], function() use ($router) {
    
// });