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

Auth::routes();

Route::get('/', 'DashboardController@index')->name('home');
Route::get('/colors', 'DashboardController@colors')->name('colors');
Route::get('/typography', 'DashboardController@typography')->name('typography');
Route::get('/charts', 'DashboardController@charts')->name('charts');
Route::get('/widgets', 'DashboardController@widgets')->name('widgets');

Route::prefix('/base')->group(function (): void {
    Route::get('/', 'DashboardController@breadcrumb');
    Route::get('/breadcrumb', 'DashboardController@breadcrumb');
    Route::get('/cards', 'DashboardController@cards');
    Route::get('/carousel', 'DashboardController@carousel');
    Route::get('/collapse', 'DashboardController@collapse');
    Route::get('/forms', 'DashboardController@forms');
    Route::get('/jumbotron', 'DashboardController@jumbotron');
    Route::get('/list-group', 'DashboardController@listGroup');
    Route::get('/navs', 'DashboardController@navs');
    Route::get('/pagination', 'DashboardController@pagination');
    Route::get('/popovers', 'DashboardController@popovers');
    Route::get('/progress', 'DashboardController@progress');
    Route::get('/scrollspy', 'DashboardController@scrollspy');
    Route::get('/switches', 'DashboardController@switches');
    Route::get('/tables', 'DashboardController@tables');
    Route::get('/tabs', 'DashboardController@tabs');
    Route::get('/tooltips', 'DashboardController@tooltips');
});

Route::prefix('/buttons')->group(function (): void {
    Route::get('/', 'DashboardController@buttons');
    Route::get('/button-group', 'DashboardController@buttonGroup');
    Route::get('/dropdowns', 'DashboardController@dropdowns');
    Route::get('/brand-buttons', 'DashboardController@brandButtons');
});

Route::prefix('/icons')->group(function (): void {
    Route::get('/', 'DashboardController@coreuiIcons');
    Route::get('/coreui-icons', 'DashboardController@coreuiIcons');
    Route::get('/flags', 'DashboardController@flags');
    Route::get('/font-awesome', 'DashboardController@fontAwesome');
    Route::get('/simple-line-icons', 'DashboardController@simpleLineIcons');
});

Route::prefix('/notifications')->group(function (): void {
    Route::get('/', 'DashboardController@alerts');
    Route::get('/alerts', 'DashboardController@alerts');
    Route::get('/badge', 'DashboardController@badge');
    Route::get('/modals', 'DashboardController@modals');
});

Route::get('/500', 'DashboardController@error');
