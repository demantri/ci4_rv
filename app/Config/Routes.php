<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('login', 'Login::index');

$routes->get('dashboard', 'Dashboard::index',['filter' => 'auth']);

$routes->get('bahan-baku', 'Masterdata::bahan_baku',['filter' => 'auth']);
$routes->get('supplier', 'Masterdata::supplier',['filter' => 'auth']);
$routes->get('produk', 'Masterdata::produk',['filter' => 'auth']);
// admin only
$routes->get('role', 'Masterdata::role',['filter' => 'auth']);
$routes->get('user', 'Masterdata::user',['filter' => 'auth']);

$routes->get('pembelian', 'Pembelian::index',['filter' => 'auth']);
$routes->get('pembelian/laporan-pembelian', 'Pembelian::laporan_pembelian',['filter' => 'auth']);
$routes->add('pembelian/laporan-pembelian', 'Pembelian::laporan_pembelian',['filter' => 'auth']);

$routes->get('penjualan', 'Penjualan::index',['filter' => 'auth']);

$routes->get('notification', 'MessageController::showSweetAlertMessages');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
