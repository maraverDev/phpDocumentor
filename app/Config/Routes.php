<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'DashboardController::index'); // Página principal
$routes->get('/users', 'DashboardController::index'); // Página principal

// CRUD de usuarios
$routes->get('users/save/(:num)', 'UserController::saveUser/$1'); // Formulario editar
$routes->post('users/save/(:num)', 'UserController::saveUser/$1'); // POST para editar

// Autenticación
// Ahora delete con auth
$routes->get('delete/(:num)', 'AuthController::delete/$1'); // Eliminar usuario
$routes->get('login', 'AuthController::login'); // Mostrar formulario de inicio de sesión
$routes->post('login/process', 'AuthController::processLogin'); // Procesar inicio de sesión
$routes->get('register', 'AuthController::register'); // Mostrar formulario de registro
$routes->post('register/process', 'AuthController::processRegister'); // Procesar registro
$routes->get('logout', 'AuthController::logout'); // Cerrar sesión
$routes->get('dashboard', 'DashboardController::index');


$routes->get('edit/(:num)', 'AuthController::edit/$1');
$routes->post('update/(:num)', 'AuthController::update/$1');
