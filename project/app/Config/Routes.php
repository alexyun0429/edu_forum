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
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/hi', 'Home::index');

$routes->get('/login', 'Login::index');
$routes->post('/(.*)/login', 'Login::login');
$routes->get('/(.*)/logout', 'Login::logout');
$routes->get('/forgot_password', 'Login::forgot_password');
$routes->post('/forgot_password/submit', 'Login::forgot_password');

$routes->get('/register', 'Register::index');
$routes->post('/register/save', 'Register::save');
$routes->get('/verify-email', 'Register::verifyEmail');

$routes->get('/profile', 'Profile::index');

$routes->get('/profile/generateProfilePDF', 'Profile::generateProfilePDF');
// $routes->match(['get', 'post'], 'proifle/htmlToPDF', 'Profile::htmlToPDF');

$routes->post('/profile/phoneVerify', 'Profile::phoneVerify');

$routes->get('/profile_edit', 'Profile::edit');
$routes->post('/profile/change_password', 'Profile::change_password');
$routes->post('/profile/upload_picture', 'Profile::upload_picture');
$routes->post('/profile/drop_course', 'Profile::drop_course');

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->match(['get', 'post'], '/join_course', 'Dashboard::join');

$routes->get('/forum/(:segment)/(:segment)', 'Forum::index/$1/$2');
$routes->get('/forum/(:segment)/(:segment)/load_more_threads/(:num)', 'Forum::load_more_threads/$2/$3');

// $routes->get('/forum/(:segment)/(:segment)/loadMoreThreads/(:num)', 'Forum::loadMoreThreads/$2/$3');
// $routes->get('/forum/(:segment)/(:segment)/loadMoreThreads', 'Forum::loadMoreThreads/$1/$2');

$routes->get('/forum/(:segment)/thread/(:num)', 'Thread::show/$2/');

$routes->post('forum/(:segment)/thread/(:num)/like', 'Thread::like/$1/$2');

$routes->post('/forum/(:segment)/thread/(:num)/add_comment', 'Thread::add_comment/$2');

$routes->get('/forum/(:segment)/thread/add_thread', 'Thread::add_thread/$1');
$routes->post('/forum/(:segment)/thread/add_thread', 'Thread::add_thread/$1');


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
