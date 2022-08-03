<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->group('master', function ($routes) {
    // Mahasiswa
    $routes->group('mahasiswa', ['namespace' => 'App\Controllers\Panel'], function ($routes) {
        $routes->get('', 'MahasiswaController::index', ['as' => 'data-mahasiswa']);
        $routes->get('add', 'MahasiswaController::add', ['as' => 'data-mahasiswa-add']);
        $routes->get('edit/(:num)', 'MahasiswaController::edit/$1', ['as' => 'data-mahasiswa-edit']);
    });
    $routes->group('mahasiswa', ['namespace' => 'App\Controllers\Api'], function ($routes) {
        $routes->post('add', 'MahasiswaController::add', ['as' => 'data-mahasiswa-add']);
        $routes->post('edit/(:num)', 'MahasiswaController::edit/$1', ['as' => 'data-mahasiswa-edit']);
        $routes->get('delete/(:num)', 'MahasiswaController::delete/$1', ['as' => 'data-mahasiswa-delete']);
    });

    // Dosen
    $routes->group('dosen', ['namespace' => 'App\Controllers\Panel'], function ($routes) {
        $routes->get('', 'DosenController::index', ['as' => 'data-dosen']);
        $routes->get('add', 'DosenController::add', ['as' => 'data-dosen-add']);
        $routes->get('edit/(:num)', 'DosenController::edit/$1', ['as' => 'data-dosen-edit']);
    });
    $routes->group('dosen', ['namespace' => 'App\Controllers\Api'], function ($routes) {
        $routes->post('add', 'DosenController::add', ['as' => 'data-dosen-add']);
        $routes->post('edit/(:num)', 'DosenController::edit/$1', ['as' => 'data-dosen-edit']);
        $routes->get('delete/(:num)', 'DosenController::delete/$1', ['as' => 'data-dosen-delete']);
    });

    // Ruang
    $routes->group('ruang', ['namespace' => 'App\Controllers\Panel'], function ($routes) {
        $routes->get('', 'RuangController::index', ['as' => 'data-ruang']);
        $routes->get('add', 'RuangController::add', ['as' => 'data-ruang-add']);
        $routes->get('edit/(:num)', 'RuangController::edit/$1', ['as' => 'data-ruang-edit']);
    });
    $routes->group('ruang', ['namespace' => 'App\Controllers\Api'], function ($routes) {
        $routes->post('add', 'RuangController::add', ['as' => 'data-ruang-add']);
        $routes->post('edit/(:num)', 'RuangController::edit/$1', ['as' => 'data-ruang-edit']);
        $routes->get('delete/(:num)', 'RuangController::delete/$1', ['as' => 'data-ruang-delete']);
    });

    // Matkul
    $routes->group('matkul', ['namespace' => 'App\Controllers\Panel'], function ($routes) {
        $routes->get('', 'MatkulController::index', ['as' => 'data-matkul']);
        $routes->get('add', 'MatkulController::add', ['as' => 'data-matkul-add']);
        $routes->get('edit/(:num)', 'MatkulController::edit/$1', ['as' => 'data-matkul-edit']);
    });
    $routes->group('matkul', ['namespace' => 'App\Controllers\Api'], function ($routes) {
        $routes->post('add', 'MatkulController::add', ['as' => 'data-matkul-add']);
        $routes->post('edit/(:num)', 'MatkulController::edit/$1', ['as' => 'data-matkul-edit']);
        $routes->get('delete/(:num)', 'MatkulController::delete/$1', ['as' => 'data-matkul-delete']);
    });

    // Kuliah
    $routes->group('kuliah', ['namespace' => 'App\Controllers\Panel'], function ($routes) {
        $routes->get('', 'KuliahController::index', ['as' => 'data-kuliah']);
        $routes->get('add', 'KuliahController::add', ['as' => 'data-kuliah-add']);
        $routes->get('edit/(:num)', 'KuliahController::edit/$1', ['as' => 'data-kuliah-edit']);
    });
    $routes->group('kuliah', ['namespace' => 'App\Controllers\Api'], function ($routes) {
        $routes->post('add', 'KuliahController::add', ['as' => 'data-kuliah-add']);
        $routes->post('edit/(:num)', 'KuliahController::edit/$1', ['as' => 'data-kuliah-edit']);
        $routes->get('delete/(:num)', 'KuliahController::delete/$1', ['as' => 'data-kuliah-delete']);
    });
});
// Ujian
$routes->group('ujian', ['namespace' => 'App\Controllers\Panel'], function ($routes) {
    $routes->get('data', 'UjianController::index', ['as' => 'ujian-data']);
    $routes->get('data/riwayat', 'UjianController::riwayat', ['as' => 'ujian-data-riwayat']);
    $routes->get('riwayat', 'UjianController::riwayatOnly', ['as' => 'ujian-riwayat']);
    $routes->get('data/detail/(:num)', 'UjianController::detail/$1', ['as' => 'ujian-data-detail']);
    $routes->get('add', 'UjianController::add', ['as' => 'ujian-data-add']);
    $routes->get('edit/(:num)', 'UjianController::edit/$1', ['as' => 'ujian-data-edit']);
    $routes->get('atur', 'UjianController::atur', ['as' => 'ujian-atur']);
    $routes->get('atur/upload/(:num)', 'UjianController::upload/$1', ['as' => 'ujian-atur-upload']);
    $routes->get('jadwal', 'UjianController::jadwal', ['as' => 'ujian-jadwal']);
    $routes->add('masuk/(:any)', 'UjianController::masukUjian/$1', ['as' => 'ujian-masuk']);
    $routes->add('room/(:any)/(:num)', 'UjianController::roomUjian/$1/$2', ['as' => 'ujian-room']);
});
$routes->group('ujian', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->post('add', 'UjianController::add', ['as' => 'ujian-data-add']);
    $routes->post('edit/(:num)', 'UjianController::edit/$1', ['as' => 'ujian-data-edit']);
    $routes->get('delete/(:num)', 'UjianController::delete/$1', ['as' => 'ujian-data-delete']);
    $routes->post('soal/download', 'UjianController::download', ['as' => 'soal-download']);
    $routes->post('soal/upload', 'UjianController::upload', ['as' => 'soal-upload']);
    $routes->post('soal/save', 'UjianController::save', ['as' => 'soal-save']);
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