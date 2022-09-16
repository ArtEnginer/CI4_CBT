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

$routes->group('master', ['filter' => 'role:Admin'], function ($routes) {
    // Mahasiswa
    $routes->group('mahasiswa', ['namespace' => 'App\Controllers\Panel'], function ($routes) {
        $routes->get('', 'MahasiswaController::index', ['as' => 'data-mahasiswa']);
        $routes->get('add', 'MahasiswaController::add', ['as' => 'data-mahasiswa-add']);
        $routes->get('edit/(:num)', 'MahasiswaController::edit/$1', ['as' => 'data-mahasiswa-edit']);
        // import
        $routes->get('import', 'MahasiswaController::import', ['as' => 'data-mahasiswa-import']);
    });
    $routes->group('mahasiswa', ['namespace' => 'App\Controllers\Api'], function ($routes) {
        $routes->post('add', 'MahasiswaController::add', ['as' => 'data-mahasiswa-add']);
        $routes->post('edit/(:num)', 'MahasiswaController::edit/$1', ['as' => 'data-mahasiswa-edit']);
        $routes->get('delete/(:num)', 'MahasiswaController::delete/$1', ['as' => 'data-mahasiswa-delete']);
        // import
        $routes->post('upload', 'MahasiswaController::upload', ['as' => 'data-mahasiswa-upload']);
        $routes->post('save-excel', 'MahasiswaController::saveExcel', ['as' => 'data-mahasiswa-save-excel']);
        // download
        $routes->get('download', 'MahasiswaController::download', ['as' => 'data-mahasiswa-download']);
    });

    // Dosen
    $routes->group('dosen', ['namespace' => 'App\Controllers\Panel'], function ($routes) {
        $routes->get('', 'DosenController::index', ['as' => 'data-dosen']);
        $routes->get('add', 'DosenController::add', ['as' => 'data-dosen-add']);
        $routes->get('edit/(:num)', 'DosenController::edit/$1', ['as' => 'data-dosen-edit']);
        // import
        $routes->get('import', 'DosenController::import', ['as' => 'data-dosen-import']);
    });
    $routes->group('dosen', ['namespace' => 'App\Controllers\Api'], function ($routes) {
        $routes->post('add', 'DosenController::add', ['as' => 'data-dosen-add']);
        $routes->post('edit/(:num)', 'DosenController::edit/$1', ['as' => 'data-dosen-edit']);
        $routes->get('delete/(:num)', 'DosenController::delete/$1', ['as' => 'data-dosen-delete']);
        // import
        $routes->post('upload', 'DosenController::upload', ['as' => 'data-dosen-upload']);
        $routes->post('save-excel', 'DosenController::saveExcel', ['as' => 'data-dosen-save-excel']);
        // download
        $routes->get('download', 'DosenController::download', ['as' => 'data-dosen-download']);
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
        // import
        $routes->get('import', 'MatkulController::import', ['as' => 'data-matkul-import']);
    });
    $routes->group('matkul', ['namespace' => 'App\Controllers\Api'], function ($routes) {
        $routes->post('add', 'MatkulController::add', ['as' => 'data-matkul-add']);
        $routes->post('edit/(:num)', 'MatkulController::edit/$1', ['as' => 'data-matkul-edit']);
        $routes->get('delete/(:num)', 'MatkulController::delete/$1', ['as' => 'data-matkul-delete']);
        // import
        $routes->post('upload', 'MatkulController::upload', ['as' => 'data-matkul-upload']);
        $routes->post('save-excel', 'MatkulController::saveExcel', ['as' => 'data-matkul-save-excel']);
        // download
        $routes->get('download', 'MatkulController::download', ['as' => 'data-matkul-download']);
    });

    // Kuliah
    $routes->group('kuliah', ['namespace' => 'App\Controllers\Panel'], function ($routes) {
        $routes->get('', 'KuliahController::index', ['as' => 'data-kuliah']);
        $routes->get('add', 'KuliahController::add', ['as' => 'data-kuliah-add']);
        $routes->get('edit/(:num)', 'KuliahController::edit/$1', ['as' => 'data-kuliah-edit']);
        // import
        $routes->get('import', 'KuliahController::import', ['as' => 'data-kuliah-import']);
    });
    $routes->group('kuliah', ['namespace' => 'App\Controllers\Api'], function ($routes) {
        $routes->post('add', 'KuliahController::add', ['as' => 'data-kuliah-add']);
        $routes->post('edit/(:num)', 'KuliahController::edit/$1', ['as' => 'data-kuliah-edit']);
        $routes->get('delete/(:num)', 'KuliahController::delete/$1', ['as' => 'data-kuliah-delete']);
        // import
        $routes->post('upload', 'KuliahController::upload', ['as' => 'data-kuliah-upload']);
        $routes->post('save-excel', 'KuliahController::saveExcel', ['as' => 'data-kuliah-save-excel']);
        // download
        $routes->get('download', 'KuliahController::download', ['as' => 'data-kuliah-download']);
    });
});
// Ujian
$routes->group('ujian', ['namespace' => 'App\Controllers\Panel'], function ($routes) {
    $routes->get('data', 'UjianController::index', ['filter' => 'role:Admin', 'as' => 'ujian-data']);
    $routes->get('data/riwayat', 'UjianController::riwayat', ['filter' => 'role:Admin', 'as' => 'ujian-data-riwayat']);
    $routes->get('riwayat', 'UjianController::riwayatOnly', ['filter' => 'role:Admin', 'as' => 'ujian-riwayat']);
    $routes->get('data/detail/(:num)', 'UjianController::detail/$1', ['filter' => 'role:Admin', 'as' => 'ujian-data-detail']);
    $routes->get('add', 'UjianController::add', ['filter' => 'role:Admin', 'as' => 'ujian-data-add']);
    $routes->get('edit/(:num)', 'UjianController::edit/$1', ['filter' => 'role:Admin', 'as' => 'ujian-data-edit']);
    $routes->group('atur', ['namespace' => 'App\Controllers\Panel', 'filter' => 'role:Dosen'], function ($routes) {
        $routes->get('', 'UjianController::atur', ['as' => 'ujian-atur']);
        $routes->get('edit/(:num)', 'UjianController::editSoal/$1', ['as' => 'ujian-atur-edit']);
        $routes->get('upload/(:num)', 'UjianController::upload/$1', ['as' => 'ujian-atur-upload']);
    });
    $routes->get('jadwal', 'UjianController::jadwal', ['as' => 'ujian-jadwal', 'filter' => 'role:Mahasiswa']);
    $routes->get('nilai/(:num)', 'UjianController::nilai/$1', ['as' => 'ujian-nilai', 'filter' => 'role:Mahasiswa']);
    $routes->add('masuk/(:any)', 'UjianController::masukUjian/$1', ['as' => 'ujian-masuk', 'filter' => 'role:Mahasiswa']);
    $routes->add('room/(:any)/(:any)/(:num)', 'UjianController::roomUjian/$1/$2/$3', ['as' => 'ujian-room', 'filter' => 'role:Mahasiswa']);
    $routes->get('review', 'UjianController::review', ['as' => 'ujian-review', 'filter' => 'role:Dosen']);
    $routes->get('review/(:num)', 'UjianController::reviewJawaban/$1', ['as' => 'ujian-review-jawaban', 'filter' => 'role:Dosen']);
});
$routes->group('ujian', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->post('add', 'UjianController::add', ['as' => 'ujian-data-add']);
    $routes->post('edit/(:num)', 'UjianController::edit/$1', ['as' => 'ujian-data-edit']);
    $routes->get('delete/(:num)', 'UjianController::delete/$1', ['as' => 'ujian-data-delete']);
    $routes->post('soal/download', 'UjianController::download', ['as' => 'soal-download']);
    $routes->post('soal/upload', 'UjianController::upload', ['as' => 'soal-upload']);
    $routes->post('soal/save', 'UjianController::save', ['as' => 'soal-save']);
    $routes->get('atur/selesai/(:num)', 'UjianController::selesai/$1', ['as' => 'ujian-atur-selesai', 'filter' => 'role:Dosen']);
    $routes->get('get/(:any)/(:any)/(:num)', 'SoalController::getSoalUjian/$1/$2/$3', ['as' => 'soal-get']);
    $routes->get('get/(:any)/now/(:any)', 'SoalController::getSoalUjianNow/$1/$2', ['as' => 'soal-get-now']);
    $routes->post('jawab/(:any)/(:any)/(:num)', 'SoalController::jawab/$1/$2/$3', ['as' => 'ujian-jawab']);
    $routes->group('soal', ['namespace' => 'App\Controllers\Api', 'filter' => 'role:Dosen'], function ($routes) {
        $routes->group('pilgan', ['namespace' => 'App\Controllers\Api', 'filter' => 'role:Dosen'], function ($routes) {
            $routes->get('(:num)/(:num)/img', 'SoalController::soalPilganGambar/$1/$2', ['as' => 'soal-pilgan-img']);
            $routes->get('(:num)/(:num)/img/delete', 'SoalController::gambarPilganDelete/$1/$2', ['as' => 'soal-pilgan-img-delete']);
            $routes->post('(:num)/(:num)/img/upload', 'SoalController::gambarPilganUpload/$1/$2', ['as' => 'soal-pilgan-img-upload']);
            $routes->post('(:num)/(:num)/img/save', 'SoalController::gambarPilganSave/$1/$2', ['as' => 'soal-pilgan-img-save']);
        });
        $routes->group('essay', ['namespace' => 'App\Controllers\Api', 'filter' => 'role:Dosen'], function ($routes) {
            $routes->get('(:num)/(:num)/img', 'SoalController::soalEssayGambar/$1/$2', ['as' => 'soal-essay-img']);
            $routes->get('(:num)/(:num)/img/delete', 'SoalController::gambarEssayDelete/$1/$2', ['as' => 'soal-essay-img-delete']);
            $routes->post('(:num)/(:num)/img/upload', 'SoalController::gambarEssayUpload/$1/$2', ['as' => 'soal-essay-img-upload']);
            $routes->post('(:num)/(:num)/img/save', 'SoalController::gambarEssaySave/$1/$2', ['as' => 'soal-essay-img-save']);
        });
    });
    $routes->get('room/(:any)/done', 'SoalController::done/$1', ['as' => 'ujian-done', 'filter' => 'role:Mahasiswa']);
    $routes->post('review/(:num)', 'UjianController::reviewJawabanSave/$1', ['as' => 'ujian-review-jawaban', 'filter' => 'role:Dosen']);
});
// User
$routes->group('user', ['namespace' => 'App\Controllers\Panel', 'filter' => 'role:Admin'], function ($routes) {
    $routes->get('', 'PenggunaController::index', ['as' => 'user']);
    $routes->get('edit/(:num)', 'PenggunaController::edit/$1', ['as' => 'user-edit']);
    $routes->get('detail/(:num)', 'PenggunaController::detail/$1', ['as' => 'user-detail']);
    // edit password
    $routes->get('edit-password/(:num)', 'PenggunaController::editPassword/$1', ['as' => 'user-edit-password']);
});
$routes->group('user', ['namespace' => 'App\Controllers\Api', 'filter' => 'role:Admin'], function ($routes) {
    $routes->post('add', 'PenggunaController::add', ['as' => 'user-add']);
    $routes->post('detail/(:num)', 'PenggunaController::detail/$1', ['as' => 'user-detail']);
    $routes->get('delete/(:any)/(:num)', 'PenggunaController::delete/$1/$2', ['as' => 'user-delete']);
    $routes->post('edit/(:num)', 'PenggunaController::edit/$1', ['as' => 'user-edit']);
    $routes->post('edit-password/(:num)', 'PenggunaController::editPassword/$1', ['as' => 'user-edit-password']);
});



/*
 * Auth routes file.
 */
$routes->group('', ['namespace' => 'App\Controllers'], function ($routes) {
    // Login/out
    $routes->get('login', 'AuthController::login', ['as' => 'login']);
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('logout', 'AuthController::logout');

    // Registration
    $routes->get('register', 'AuthController::register', ['as' => 'register']);
    $routes->post('register', 'AuthController::attemptRegister');

    // Activation
    $routes->get('activate-account', 'AuthController::activateAccount', ['as' => 'activate-account']);
    $routes->get('resend-activate-account', 'AuthController::resendActivateAccount', ['as' => 'resend-activate-account']);

    // Forgot/Resets
    $routes->get('forgot', 'AuthController::forgotPassword', ['as' => 'forgot']);
    $routes->post('forgot', 'AuthController::attemptForgot');
    $routes->get('reset-password', 'AuthController::resetPassword', ['as' => 'reset-password']);
    $routes->post('reset-password', 'AuthController::attemptReset');
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