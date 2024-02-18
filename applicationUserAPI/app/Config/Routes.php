<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

  $routes->get('/', 'UserController::index');
  $routes->post('store', 'UserController::store');
  $routes->post('update/(:num)', 'UserController::update/$1');

  $routes->group('admin', ['filter' => 'role'], function ($routes) {
    $routes->get('editUser/(:num)', 'UserController::editUser/$1');
    $routes->get('deleteMaster/(:num)', 'UserController::deleteMaster/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');
    $routes->get('master', 'UserController::master');
    $routes->get('createUser', 'UserController::createUser');
});
  
$routes->group('auth', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('loginProses', 'AuthController::loginProses');
    $routes->get('logout', 'AuthController::logout');
});