<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'About::index');
$routes->get('/blog', 'Blog::index');
$routes->get('/(:any)/review', 'ReviewController::showAllReviewOfCertainProduct/$1');
$routes->get('/review', 'Review::index');
gi