<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('user/(:num)', 'UserController::getById/$1');
$routes->get('user', 'UserController::showUser');
$routes->post('user', 'UserController::createUser');
$routes->put('user/(:num)', 'UserController::updateUser/$1');
$routes->delete('user/(:num)', 'UserController::deleteUser/$1');



