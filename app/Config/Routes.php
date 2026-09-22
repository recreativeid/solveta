<?php

namespace Config;

use CodeIgniter\Routing\RouteCollection;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// Public Routes
$routes->get('/', 'Home::index');
$routes->get('/formulir', 'Formulir::index');
$routes->post('/formulir/submit', 'Formulir::submit');

// Authentication Routes
$routes->get('/admin/login', 'Auth::login');
$routes->post('/admin/login', 'Auth::attemptLogin');
$routes->get('/admin/logout', 'Auth::logout');

// Protected Admin Routes
$routes->group('admin', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Admin::index');
    $routes->post('update-copy', 'Admin::updateCopy');
    $routes->post('update-contact', 'Admin::updateContact');
    $routes->post('update-password', 'Admin::updatePassword');

    // Portfolio
    $routes->post('portfolio/save', 'Admin::savePortfolio');
    $routes->post('portfolio/delete/(:segment)', 'Admin::deletePortfolio/$1');

    // Pricing
    $routes->post('pricing/save', 'Admin::savePricing');
    $routes->post('pricing/delete/(:segment)', 'Admin::deletePricing/$1');

    // Brands / Marquee
    $routes->post('brand/save', 'Admin::saveBrand');
    $routes->post('brand/delete/(:segment)', 'Admin::deleteBrand/$1');

    // Order Submissions
    $routes->post('order/status', 'Admin::updateOrderStatus');
    $routes->post('order/delete/(:segment)', 'Admin::deleteOrder/$1');

    // Profit Analysis
    $routes->post('profit/save', 'Admin::saveProfit');

    // Transactions & Invoices
    $routes->post('transaction/save', 'Admin::saveTransaction');
    $routes->post('transaction/delete/(:segment)', 'Admin::deleteTransaction/$1');
    $routes->get('invoice/print/(:segment)', 'Admin::printInvoice/$1');
});

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
