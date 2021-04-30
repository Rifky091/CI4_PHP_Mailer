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
$routes->setDefaultController('Home');
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
$routes->get('/', 'NonPengguna::index');
$routes->get('/login', 'NonPengguna::authenticate');
$routes->post('/login-auth', 'NonPengguna::login');
$routes->post('/register', 'NonPengguna::register');
$routes->get('/logout', 'NonPengguna::logout');
$routes->get('/pengguna', 'Pengguna::index');
$routes->get('/pengguna/profile', 'Pengguna::profile');
$routes->put('/pengguna/updateProfile/(:segment)', 'Pengguna::updateProfile/$1');
$routes->get('/pengguna/listJadwal', 'Pengguna::listJadwal');
$routes->get('/pengguna/editJadwal/(:segment)', 'Pengguna::editJadwal/$1');
$routes->put('/pengguna/updateJadwal/(:segment)', 'Pengguna::updateJadwal/$1');
$routes->delete('/pengguna/deleteJadwal/(:segment)', 'Pengguna::deleteJadwal/$1');
$routes->get('/pengguna/addJadwal', 'Pengguna::addJadwal');
$routes->get('/pengguna/listTugas', 'Pengguna::listTugas');
$routes->get('/pengguna/editTugas/(:segment)', 'Pengguna::editTugas/$1');
$routes->put('/pengguna/updateTugas/(:segment)', 'Pengguna::updateTugas/$1');
$routes->delete('/pengguna/deleteTugas/(:segment)', 'Pengguna::deleteTugas/$1');
$routes->get('/pengguna/addTugas', 'Pengguna::addTugas');
$routes->get('/admin', 'Admin::index');
$routes->delete('/admin/delete/(:segment)', 'Admin::delete/$1');

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
