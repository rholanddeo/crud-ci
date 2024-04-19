<?php

use App\Controllers\Home;
use App\Controllers\BarangController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', function ()
{
    return view('login');
});


$routes->get('/barang', [BarangController::class, 'index']);
$routes->get('/barang-create',  'BarangController::create');
$routes->post('/barang/store', 'BarangController::store');
$routes->get('/barang-edit-(:num)', 'BarangController::edit/$1');
$routes->post('/barang/update/(:num)', 'BarangController::update/$1');
$routes->get('/barang/delete/(:num)', 'BarangController::delete/$1');

$routes->get('/suplier', 'SuplierController::index');
$routes->get('/suplier-create', 'SuplierController::create');
$routes->post('/suplier/store', 'SuplierController::store');
$routes->get('/suplier-edit-(:num)', 'SuplierController::edit/$1');
$routes->post('/suplier/update/(:num)', 'SuplierController::update/$1');
$routes->get('/suplier/delete/(:num)', 'SuplierController::delete/$1');

$routes->get('/transaksi', 'TransaksiController::index');
$routes->get('/transaksi-create', 'TransaksiController::create');
$routes->post('/transaksi/store', 'TransaksiController::store');
