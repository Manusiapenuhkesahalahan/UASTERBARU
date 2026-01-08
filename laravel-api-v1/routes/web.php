<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
*/

// 1. Route Halaman Utama
$router->get('/', function () use ($router) {
    return $router->app->version();
}); // <--- Tutup fungsi ini di sini!

// 2. Route Group dipindahkan ke LUAR fungsi di atas
$router->group(['prefix' => 'api/Category'], function () use ($router) {
    $router->get('/', 'CategoryController@index');
    $router->post('/', 'CategoryController@store');
    $router->delete('/{id}', 'CategoryController@destroy');
});