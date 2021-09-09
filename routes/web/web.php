<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AlbumsController;
use App\Http\Controllers\Admin\ArtistsController;
use App\Http\Controllers\Admin\PlaylistsController;
use App\Http\Controllers\Admin\TracksController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\HomeController;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function (): void {
    Route::get('/', [AdminController::class, 'index'])->name('adminhome');

    Route::get('albums', [AlbumsController::class, 'index'])->name('albums.index');
    Route::get('artists', [ArtistsController::class, 'index'])->name('artists.index');
    Route::get('playlists', [PlaylistsController::class, 'index'])->name('playlists.index');
    Route::get('tracks', [TracksController::class, 'index'])->name('tracks.index');

    Route::resource('albums', AlbumsController::class);
    Route::resource('artists', ArtistsController::class);
    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::resource('users', AlbumsController::class);
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('homeHome');
Auth::routes(['register' => false]);
