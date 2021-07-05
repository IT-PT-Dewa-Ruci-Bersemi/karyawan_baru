<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$app = function () {
    Route::any('/', function () {
        return redirect()->route('admin_login');
    });

    Route::get('login', 'AdminLogin@index')->name('admin_login');
    Route::post('/login/dologin', 'AdminLogin@do_login')->name('admin_login_process');
    Route::get('/logout', 'AdminLogin@do_logout')->name('admin_logout');

    Route::middleware(['auth:admin'])->group(function () {
        Route::any('dashboard', 'Dashboard@index')->name('admin_dashboard');

        Route::any('/administrator', 'Administrator@index')->name('admin_administrator');
        Route::any('/administrator_group', 'AdministratorGroup@index')->name('admin_administrator_group');
        Route::any('/administrator_group/permission/{id}', 'AdministratorGroup@permission')->name('admin_administrator_group_permission');

        Route::any('/personal-setting', 'Setting@personal')->name('admin_personal_setting');

        Route::any('/configs', 'Configs@index')->name('admin_config');
        Route::any('/cache/reset', 'Configs@_resetCache')->name('admin_config_cache');
        Route::post('/configs/_do_save', 'Configs@_save')->name('admin_save_config');



        Route::any('/soal', 'SoalController@index')->name('admin_list_soal');
        Route::any('/soal-grup', 'SoalGrupController@index')->name('admin_soal_grup');
        Route::any('/cek/{id}', 'SoalJawabanController@index')->name('cek');
        





        Route::group(['prefix' => 'docs'], function () {
            Route::any('/', 'Core\Docs@index')->name('admin_system_docs');
            Route::any('/{permalink}', 'Core\Docs@detail')->name('admin_system_docs_detail');
        });

        Route::group(['prefix' => '_core'], function () {
            Route::any('/', 'Core\CoreBoard@index')->name('_core');

            Route::group(['prefix'=>'apps'], function () {
                Route::any('/config', 'Core\CoreBoard@_appsConfig')->name('_core_apps_config');
                Route::post('/save-config', 'Core\CoreBoard@_saveConfig')->name('_core_save_apps_config');
            });

            Route::group(['prefix'=>'docs'], function () {
                Route::any('/', 'Core\CoreDocs@index')->name('_core_apps_docs');
                Route::any('/{id}', 'Core\CoreDocs@index')->name('_core_apps_docs_detail');
            });

            Route::group(['prefix'=>'navigation'], function () {
                Route::any('/master', 'Core\CoreBoard@masterNavigation')->name('_core_apps_master_navigation');
                Route::any('/permission/{id}', 'Core\CoreBoard@navigationPermission')->name('_core_apps_navigation_permission');
                Route::any('/master/{id}', 'Core\CoreBoard@navigation')->name('_core_apps_master_navigation_detail');
                Route::any('/{master_nav_id}/{id}', 'Core\CoreBoard@navigation')->name('_core_apps_navigation_detail');
            });
        });
    });
};

if (env('APP_ENV') == 'local' || env('APP_ENV') == null) {
    $app();
} else {
    Route::domain(env('APP_ADMIN_URL'))->group(function () use ($app) {
        $app();
    });
}
