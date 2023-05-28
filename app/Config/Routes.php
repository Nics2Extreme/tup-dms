<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->add('/login', function () {

    helper(['url', 'form']);

    // Check if user is already logged in
    if (session()->get('loggedUser')) {
        // User is already logged in, redirect back
        return redirect()->back();
    } else {
        // User is not logged in, proceed to the login page
        return view('auth/login'); // Replace 'login' with the appropriate view name
    }
});
$routes->get('/logout', 'Auth::getLogout');

$routes->post('/check', 'Auth::postCheck');
$routes->post('/save', 'Dashboard::postSave');

$routes->group('', ['filter' => 'AuthCheck'], function ($routes) {

    $routes->post('/upload', 'FileUpload::upload');
    $routes->get('/download/(:segment)', 'FileUpload::download/$1');
    $routes->get('/find/(:segment)', 'DocumentController::getDocument/$1');
    $routes->get('/users', 'Auth::getUsers');
    $routes->post('/receive', 'DocumentController::receive');
    $routes->post('/request', 'DocumentController::request');
    $routes->post('/send', 'DocumentController::send');

    $routes->group('', ['filter' => 'UserFilter'], function ($routes) {
        $routes->get('/user/(:segment)', 'Dashboard::getUserDashboard');
        $routes->get('/usercompose', 'FileUpload::getUserCompose');
        $routes->get('/profile', 'Dashboard::getUserProfile');
        $routes->get('/userdocument/(:segment)', 'DocumentController::getUserDocument/$1');
        $routes->get('/userrequest', 'DocumentController::getUserRequest');
        $routes->get('/documents/(:segment)', 'DocumentController::getUserDocuments/$1');
    });

    $routes->group('', ['filter' => 'AdminFilter'], function ($routes) {
        $routes->get('/admin', 'Dashboard::getAdminDashboard');
        $routes->get('/compose', 'FileUpload::getAdminCompose');
        $routes->get('/register', 'Dashboard::getRegister');
        $routes->get('/request', 'DocumentController::getAdminRequest');
        $routes->get('/document/(:segment)', 'DocumentController::getAdminDocument/$1');
        $routes->get('/documents', 'DocumentController::getDocuments');
    });
});

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
