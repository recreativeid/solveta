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

/*
 * --------------------------------------------------------------------
 * Route Definitions — SOLVETA Company Profile
 * --------------------------------------------------------------------
 */

// Core Company Profile Routes
$routes->get('', 'Home::index');
$routes->get('/', 'Home::index');

// Layanan (Services)
$routes->get('layanan', 'Home::layanan');
$routes->get('/layanan', 'Home::layanan');
$routes->get('layanan/starter', 'Home::layananStarter');
$routes->get('layanan/bisnis', 'Home::layananBisnis');
$routes->get('layanan/custom', 'Home::layananCustom');
// Aliases for backwards compatibility
$routes->get('layanan/standard', 'Home::layananStandard');
$routes->get('layanan/premium', 'Home::layananPremium');
$routes->get('layanan/platinum', 'Home::layananPlatinum');
$routes->get('services', 'Home::layanan');
$routes->get('/services', 'Home::layanan');

// Portofolio (Showcase)
$routes->get('portofolio', 'Home::portfolio');
$routes->get('/portofolio', 'Home::portfolio');
$routes->get('portfolio', 'Home::portfolio');
$routes->get('/portfolio', 'Home::portfolio');

// Tentang Kami (About Us)
$routes->get('tentang', 'Home::tentang');
$routes->get('/tentang', 'Home::tentang');
$routes->get('tentang-kami', 'Home::tentang');
$routes->get('/tentang-kami', 'Home::tentang');
$routes->get('about', 'Home::tentang');
$routes->get('/about', 'Home::tentang');

// Karir (Careers)
$routes->get('karir', 'Home::karir');
$routes->get('/karir', 'Home::karir');
$routes->get('career', 'Home::karir');
$routes->get('/career', 'Home::karir');
$routes->get('careers', 'Home::karir');
$routes->get('/careers', 'Home::karir');

// Kontak (Contact)
$routes->get('kontak', 'Home::kontak');
$routes->get('/kontak', 'Home::kontak');
$routes->get('contact', 'Home::kontak');
$routes->get('/contact', 'Home::kontak');

// Artikel (Articles / Tech Insights)
$routes->get('artikel', 'Home::artikel');
$routes->get('/artikel', 'Home::artikel');
$routes->get('artikel/(:segment)', 'Home::artikelDetail/$1');
$routes->get('/artikel/(:segment)', 'Home::artikelDetail/$1');
$routes->get('blog', 'Home::artikel');
$routes->get('/blog', 'Home::artikel');
$routes->get('blog/(:segment)', 'Home::artikelDetail/$1');
$routes->get('/blog/(:segment)', 'Home::artikelDetail/$1');

// Client Onboarding Brief Form
$routes->get('/formulir', 'Formulir::index');
$routes->post('/formulir/submit', 'Formulir::submit');

// Legacy Regional Landing Pages
$routes->get('indonesia', 'Home::indonesia');
$routes->get('/indonesia', 'Home::indonesia');
$routes->get('public/indonesia', 'Home::indonesia');
$routes->get('/public/indonesia', 'Home::indonesia');

$routes->get('malaysia', 'Home::malaysia');
$routes->get('/malaysia', 'Home::malaysia');
$routes->get('public/malaysia', 'Home::malaysia');
$routes->get('/public/malaysia', 'Home::malaysia');

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
    $routes->post('pricing/move/(:segment)/(:segment)', 'Admin::movePricing/$1/$2');

    // Addon Services
    $routes->post('addon/save', 'Admin::saveAddon');
    $routes->post('addon/delete/(:segment)', 'Admin::deleteAddon/$1');
    $routes->post('addon/move/(:segment)/(:segment)', 'Admin::moveAddon/$1/$2');

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

    // Articles / Blog Management
    $routes->post('article/save', 'Admin::saveArticle');
    $routes->post('article/delete/(:segment)', 'Admin::deleteArticle/$1');

    // Careers / Loker & Poster
    $routes->post('career/save', 'Admin::saveCareerJob');
    $routes->post('career/delete/(:segment)', 'Admin::deleteCareerJob/$1');
    $routes->post('career/announcement', 'Admin::updateCareerAnnouncement');
});

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
