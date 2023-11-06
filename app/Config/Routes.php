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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->post('/chart-transaksi', 'Home::showChartTransaksi');
$routes->post('/chart-customer', 'Home::showChartCustomer');
$routes->post('/chart-pembelian', 'Home::showChartPembelian');
$routes->post('/chart-supplier', 'Home::showChartSupplier');
$routes->get('/page', 'Auth::Error');

$routes->get('/container', 'Home::tugasContainer');
$routes->get('/tugas2', 'Home::tugas2');

$routes->get('/book', 'Book::index', ['filter' => 'role']);
$routes->get('book-detail/(:any)', 'Book::detail/$1');
$routes->get('/book-create', 'Book::create', ['as' => 'tambah-buku']);
$routes->post('/book-create', 'Book::save', ['as' => 'simpan-buku']);
$routes->get('/book-edit/(:any)', 'Book::edit/$1', ['as' => 'ubah-buku']);
$routes->post('book-edit/(:num)', 'Book::update/$1', ['as' => 'update-buku']);
$routes->post('/book/import', 'Book::importData');
$routes->delete('book-delete/(:num)', 'Book::delete/$1', ['as' => 'delete-buku']);

$routes->get('/komik', 'Komik::index', ['filter' => 'role']);
$routes->get('komik-detail/(:any)', 'Komik::detail/$1');
$routes->get('/komik-create', 'Komik::create', ['as' => 'tambah-komik']);
$routes->post('/komik-create', 'Komik::save', ['as' => 'simpan-komik']);
$routes->get('/komik-edit/(:any)', 'Komik::edit/$1', ['as' => 'ubah-komik']);
$routes->post('komik-edit/(:num)', 'Komik::update/$1', ['as' => 'update-komik']);
$routes->post('/komik/import', 'Komik::importData');
$routes->delete('komik-delete/(:num)', 'Komik::delete/$1', ['as' => 'delete-komik']);

$routes->addRedirect('/customer', 'customer/index')->get('/customer/index', 'Customer::index', ['filter' => 'role'])->setAutoRoute(true);
$routes->addRedirect('/supplier', 'supplier/index')->get('/supplier/index', 'Supplier::index', ['filter' => 'role'])->setAutoRoute(true);
$routes->addRedirect('/mahasiswa', 'mahasiswa/index')->get('/mahasiswa/index', 'Mahasiswa::index', ['filter' => 'role'])->setAutoRoute(true);

$routes->get('/login', 'Auth::indexlogin');
$routes->post('/login/auth', 'Auth::auth');
$routes->get('/login/register', 'Auth::indexregister');
$routes->post('/login/save', 'Auth::saveRegister');
$routes->get('/logout', 'Auth::logout');

$routes->group('users', ['filter' => 'role'], ['filter' => 'auth'], function ($r) {
    $r->get('/', 'Users::index');
    $r->get('index', 'Users::index');
    $r->get('create', 'Users::create');
    $r->post('create', 'Users::save');
    $r->get('edit/(:num)', 'Users::edit/$1');
    $r->post('edit/(:num)', 'Users::update/$1');
    $r->delete('delete/(:num)', 'Users::delete/$1');
});

//BUKU
$routes->group('jual', ['filter' => 'auth'], function ($r) {
    $r->get('/', 'Penjualan::index');
    $r->get('load', 'Penjualan::loadCart');
    $r->post('/', 'Penjualan::addCart');
    $r->get('gettotal', 'Penjualan::getTotal');
    $r->post('update', 'Penjualan::updateCart');
    $r->post('bayar', 'Penjualan::pembayaran');
    $r->delete('(:any)', 'Penjualan::deleteCart/$1');
    $r->get('laporan', 'Penjualan::report');
    $r->post('laporan/filter', 'Penjualan::filter');
    $r->get('exportpdf', 'Penjualan::exportPDF');
    $r->get('invoicepdf/(:any)', 'Penjualan::invoicePDF/$1');
    $r->get('exportexcel', 'Penjualan::exportExcel');
});

//KOMIK
$routes->group('beli', ['filter' => 'auth'], function ($r) {
    $r->get('/', 'Pembelian::index');
    $r->get('load', 'Pembelian::loadCart');
    $r->post('/', 'Pembelian::addCart');
    $r->get('gettotal', 'Pembelian::getTotal');
    $r->post('update', 'Pembelian::updateCart');
    $r->post('bayar', 'Pembelian::pembayaran');
    $r->delete('(:any)', 'Pembelian::deleteCart/$1');
    $r->get('laporan', 'Pembelian::report');
    $r->post('laporan/filter', 'Pembelian::filter');
    $r->get('exportpdf', 'Pembelian::exportPDF');
    $r->get('invoicepdf/(:any)', 'Pembelian::invoicePDF/$1');
    $r->get('exportexcel', 'Pembelian::exportExcel');
});


// $routes->group('book', function ($r){
//     $r->get('/book', 'Book::index');
//     $r->get('book-detail/(:any)', 'Book::detail/$1');
//     $r->get('/book-create', 'Book::create', ['as' => 'tambah-buku']);
//     $r->post('/book-create', 'Book::save', ['as' => 'simpan-buku']);
//     $r->get('/book-edit/(:any)', 'Book::edit/$1', ['as' => 'ubah-buku']);
//     $r->post('book-edit/(:num)', 'Book::update/$1', ['as' => 'update-buku']);
//     $r->delete('book-delete/(:num)', 'Book::delete/$1', ['as' => 'delete-buku']);
// })

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
