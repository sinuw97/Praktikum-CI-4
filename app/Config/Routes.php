<?php

use App\Controllers\AuthController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/dashboard', 'Home::index');
$routes->get('/kategori', 'KategoriController::index');
// POST
$routes->get('/kategori/add', 'KategoriController::add');
$routes->post('/kategori/create', 'KategoriController::create');
// EDIT / PATCH
$routes->get('/kategori/(:num)', 'KategoriController::showKategoriById/$1');
$routes->patch('/kategori/update/(:num)', 'KategoriController::updateKategori/$1');
// DELETE
$routes->delete('/kategori/delete/(:num)', 'KategoriController::deleteKategori/$1');
// EXCEL
$routes->get('/kategori/ekspor', 'KategoriController::export');

// AUTH
$routes->get('/auth', 'AuthController::index');
$routes->post('/auth/login', 'AuthController::login');
$routes->get('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');