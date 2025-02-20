<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('utama');
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
$routes->add('/', 'front\utama::index');
$routes->add('/goback', 'front\utama::goback');
$routes->add('/api/(:any)', 'api::$1');
$routes->add('/utama', 'utama::index');
$routes->add('/login', 'utama::login');
$routes->add('/logout', 'utama::logout');
$routes->add('/mposition', 'master\mposition::index');
$routes->add('/mpositionpages', 'master\mpositionpages::index');
$routes->add('/muser', 'master\muser::index');
$routes->add('/mpassword', 'master\mpassword::index');
$routes->add('/mstore', 'master\mstore::index');
$routes->add('/mppn', 'master\mppn::index');
$routes->add('/mcategory', 'master\mcategory::index');
$routes->add('/munit', 'master\munit::index');

$routes->add('/mproduct', 'master\mproduct::index');
$routes->add('/mroom', 'master\mproduct::room');
$routes->add('/mloker', 'master\mproduct::loker');
$routes->add('/urutan', 'api::urutan');

$routes->add('/transaction', 'transaction\transaction::index');
$routes->add('/listnota', 'transaction\transaction::listnota');
$routes->add('/createnota', 'transaction\transaction::createnota');
$routes->add('/insertnota', 'transaction\transaction::insertnota');
$routes->add('/deletenota', 'transaction\transaction::deletenota');
$routes->add('/nota', 'transaction\transaction::nota');
$routes->add('/listproductgambar', 'transaction\transaction::listproductgambar');
$routes->add('/listproductlist', 'transaction\transaction::listproductlist');
$routes->add('/deletetransactiond', 'transaction\transaction::deletetransactiond');
$routes->add('/updateqty', 'transaction\transaction::updateqty');
$routes->add('/pelunasan', 'transaction\transaction::pelunasan');
$routes->add('/updatestatus', 'transaction\transaction::updatestatus');
$routes->add('/transactionprint', 'transaction\transaction::print');
$routes->add('/cekstatus', 'transaction\transaction::cekstatus');
$routes->add('/nominalkas', 'transaction\transaction::nominalkas');
$routes->add('/modalawalkas', 'transaction\transaction::modalawalkas');
$routes->add('/cekmodal', 'transaction\transaction::cekmodal');
// $routes->add('/kas', 'transaction\transaction::kas');
$routes->add('/shift', 'transaction\transaction::shift');
$routes->add('/posisishift', 'transaction\transaction::posisishift');
$routes->add('/rkas', 'report\rkas::index');
$routes->add('/rtransaction', 'report\rtransaction::index');
$routes->add('/rtransactiond', 'report\rtransactiond::index');
$routes->add('/rlabarugi', 'report\rlabarugi::index');
$routes->add('/payment', 'transaction\payment::index');
$routes->add('/purchase', 'transaction\purchase::index');
$routes->add('/purchased', 'transaction\purchased::index');
$routes->add('/kasmodal', 'transaction\transaction::kasmodal');

$routes->add('/msupplier', 'master\msupplier::index');
$routes->add('/mproductbuy', 'master\mproduct::buy');
$routes->add('/mmember', 'master\mmember::index');
$routes->add('/mpositionm', 'master\mpositionm::index');

$routes->add('/listmember', 'transaction\transaction::listmember');
$routes->add('/insertmember', 'transaction\transaction::insertmember');

$routes->add('/rneraca', 'report\rneraca::index');
$routes->add('/rneracaprint', 'report\rneraca::print');
$routes->add('/rneracashift', 'report\rneraca::shift');

$routes->add('/maccount', 'master\maccount::index');
$routes->add('/mbank', 'master\mbank::index');

$routes->add('/rprodukkeluar', 'report\rprodukkeluar::index');
$routes->add('/rprodukmasuk', 'report\rprodukmasuk::index');

$routes->add('/cekproductlanjutan', 'transaction\transaction::cekproductlanjutan');

$routes->add('/rpkaryawan', 'report\rpkaryawan::index');
$routes->add('/rroom', 'report\rroom::index');
$routes->add('/tamu', 'transaction\transaction::tamu');


$routes->add('/rfnb', 'transaction\fnb::index');
$routes->add('/fnb', 'transaction\fnb::index');

$routes->add('/room', 'utama::room');
$routes->add('/roomstatus', 'utama::roomstatus');

$routes->add('/display', 'display::index');
$routes->add('/droom', 'display::room');
$routes->add('/droomstatus', 'display::roomstatus');

$routes->add('/upload', 'api::upload');
$routes->add('/tupload', 'api::tupload');


$routes->add('/utamafront', 'front\utama::index');

$routes->add('/register-pekerja', 'worker\login::index');
$routes->post('/register-pekerja', 'worker\login::register');

$routes->add('/register-perusahaan', 'company\login::index');
$routes->post('/register-perusahaan', 'company\login::register');

$routes->add('/login-perusahaan', 'company\login::login');
$routes->add('/login-pekerja', 'worker\login::login');

$routes->add('/passwordperusahaan/(:segment)', 'company\login::password/$1');
$routes->post('/passwordperusahaan/(:segment)', 'company\login::addpassword/$1');

$routes->add('/passwordpekerja/(:segment)', 'worker\login::password/$1');
$routes->post('/passwordpekerja/(:segment)', 'worker\login::addpassword/$1');


$routes->get('/sendmail', 'SendMail::index');
$routes->match(['get', 'post'], 'SendMail/sendMail', 'SendMail::sendMail');


$routes->add('/mmastermetodepembayaran', 'master\mmastermetodepembayaran::index');
$routes->add('/mmetodepembayaran', 'master\mmetodepembayaran::index');
$routes->add('/mmetodepembayarand', 'master\mmetodepembayarand::index');


$routes->add('/arraymetodepembayaran', 'transaction\transaction::arraymetodepembayaran');
$routes->add('/isipbyr', 'transaction\transaction::isipbyr');


$routes->add('/mpoingrade', 'master\mpoingrade::index');
$routes->add('/mpoin', 'master\mpoin::index');
$routes->add('/mpekerjaposition', 'master\mposition::pekerja');
$routes->add('/mpekerja', 'master\muser::pekerja');
$routes->add('/mpenilaian', 'master\mpenilaian::index');

$routes->add('/company_utama', 'company\utama::index');
$routes->add('/transaksip', 'company\rtransaction::index');
$routes->add('/transaksipd', 'company\rtransactiond::index');
$routes->add('/pengajuan', 'company\pengajuan::index');
$routes->add('/pengajuan_product', 'company\pengajuan::product');
$routes->add('/pengajuan_pekerja', 'company\pengajuan::pekerja');

$routes->add('/worker_utama', 'worker\utama::index');
$routes->add('/transaksiw', 'worker\rtransaction::index');
$routes->add('/transaksiwd', 'worker\rtransactiond::index');
$routes->add('/pelatihan', 'worker\pelatihan::index');





// $routes->set404Override('errorc::notFound');
$route['404_override'] = 'my404';
$routes->set404Override(function(){
    return view('err404');
});
// $routes->set404Override(function() {
// 	return view('404');
// });




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
