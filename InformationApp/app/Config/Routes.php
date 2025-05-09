<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// Knowledge Base routes - protected by auth filter
$routes->group('knowledge-base', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'KnowledgeBase::index');
    $routes->get('new', 'KnowledgeBase::new');
    $routes->post('/', 'KnowledgeBase::create');
    $routes->get('(:num)', 'KnowledgeBase::show/$1');
    $routes->get('(:num)/edit', 'KnowledgeBase::edit/$1');
    $routes->put('(:num)', 'KnowledgeBase::update/$1');
    $routes->delete('(:num)', 'KnowledgeBase::delete/$1');
});

// Authentication Routes
$routes->get('login', 'Auth::login', ['as' => 'login']);
$routes->post('login', 'Auth::attemptLogin');
$routes->get('register', 'Auth::register', ['as' => 'register']);
$routes->post('register', 'Auth::attemptRegister');
$routes->get('logout', 'Auth::logout', ['as' => 'logout']);
$routes->post('logout', 'Auth::logout');

service('auth')->routes($routes);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */

// Add other routes as needed