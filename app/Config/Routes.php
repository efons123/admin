<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/produk', 'Produk::index');
$routes->get('/tambah', 'Produk::form_create');
$routes->get('/ubah/(:num)', 'Produk::form_update/$1');
$routes->put('/update-produk/(:num)', 'Produk::update_produk/$1');
$routes->delete('/delete-produk/(:num)', 'Produk::delete_produk/$1');
$routes->get('/detail-produk/(:num)', 'Produk::detail_produk/$1');
$routes->post('/create-produk', 'Produk::create_produk');
$routes->get('/kategori', 'Produk::kategori');
$routes->post('/kategori/tambah', 'Produk::store');
$routes->put('/kategori/ubah/(:num)', 'Produk::update/$1');
$routes->delete('/kategori/hapus/(:num)', 'Produk::destroy/$1');
