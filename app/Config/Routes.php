<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'About::index');
$routes->get('/blog', 'Blog::index');
$routes->get('/review', 'Review::index');
$routes->post('/review/addComment', 'ReviewController::addComment');
$routes->get('/review/(:any)', 'ReviewController::showAllReviewOfCertainProduct/$1');
$routes->get('/api/summary', 'ReviewAPIController::summary');
$routes->get('/login', 'LoginController::index');
$routes->get('/logout', 'LoginController::logout');
$routes->post('/login_action', 'LoginController::login_action');