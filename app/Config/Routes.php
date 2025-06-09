<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/kategori', 'KategoriController::index');
// POST
$routes->get('/kategori/add', 'KategoriController::add');
$routes->post('/kategori/create', 'KategoriController::create');
// EDIT / PATCH
$routes->get('/kategori/(:num)', 'KategoriController::showKategoriById/$1');
$routes->patch('/kategori/update/(:num)', 'KategoriController::updateKategori/$1');
// DELETE
$routes->delete('/kategori/delete/(:num)', 'KategoriController::deleteKategori/$1');
