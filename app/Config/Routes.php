<?php

use App\Controllers\Post;
use App\Controllers\Profile_controller;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Post::index');

/**
 * page creation publication
 */
$routes->get('/create', 'Post::create');

$routes->post('/save', 'Post::save');

$routes->get('/update/(:segment)', [Post::class, 'update']);

$routes->post('/update/(:segment)', [Post::class, 'store']);

$routes->get('/delete/(:segment)', [Post::class, 'delete']);


// Authentification
$routes->get('/login', 'Auth::index');
$routes->post('auth/login', 'Auth::login');

$routes->get('inscription','Auth::inscription');
$routes->post('auth/register', 'Auth::register');
$routes->get('/logout', 'Auth::logout');

//Recherche
$routes->post('search', 'Post::search');

// Filtre
$routes->post('filter', 'Post::filter');

//Profile utilisateur
$routes->get('profile', 'Profile_controller::index');
$routes->post('profile', [Profile_controller::class, 'updated']);

// $routes->get('writable/uploads/(:segment)', [Post::class, 'render']);