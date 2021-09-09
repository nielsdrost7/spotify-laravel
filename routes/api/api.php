<?php

use App\Http\Controllers\API\AlbumsAPIController;
use App\Http\Controllers\API\ArtistsAPIController;

Route::group(['prefix' => 'v1'], function (): void {
    //Route::resource('albums', AlbumsAPIController::class);
    //Route::resource('album_palettes', App\Http\Controllers\API\AlbumPaletteAPIController::class);
    //Route::resource('album_photos', App\Http\Controllers\API\AlbumPhotoAPIController::class);
    //Route::resource('album_tags', App\Http\Controllers\API\AlbumTagAPIController::class);
    //Route::resource('album_tracks', App\Http\Controllers\API\AlbumTrackAPIController::class);
    // Route::get(
    //     '/albums/{album}',
    //     [AlbumsAPIController::class, 'getAlbum']
    // )->name('getAlbum');

    Route::get(
        '/albums/dataTable',
        [AlbumsAPIController::class, 'dataTable']
    )->name('albums.dataTable');
    Route::post(
        '/albums/multiDelete',
        [AlbumsAPIController::class, 'multiDelete']
    )->name('albums.multiDelete');

    //Route::resource('tags', App\Http\Controllers\API\TagAPIController::class);

    Route::get(
        '/artist/{artist}',
        [ArtistsAPIController::class, 'getArtist']
    )->name('artist');
    //Route::get('/artists', [ArtistsAPIController::class, 'getArtists']);
    //Route::get('/albums', [AlbumAPIController::class, 'getAlbums']);
    //Route::get('/albums/{slug}', [AlbumAPIController::class, 'getAlbum']);
    //Route::get('/tags', 'API\TagsController@getTags');
    //Route::get('/cities', 'API\CitiesController@getCities');
    //Route::get('/cities/{slug}', 'API\CitiesController@getCity');
});
// Authenticated API Routes.
/*Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function (): void {
    Route::get('/artists/search', 'API\ArtistsController@getArtistSearch');
    Route::put('/user', 'API\UsersController@putUpdateUser');
    Route::get('/albums/{slug}/edit', 'API\AlbumsController@getAlbumEditData');
    Route::post('/albums', 'API\AlbumsController@postNewAlbum');
    Route::put('/albums/{slug}', 'API\AlbumsController@putEditAlbum');
    Route::post('/albums/{slug}/like', 'API\AlbumsController@postLikeAlbum');
    Route::delete('/albums/{slug}/like', 'API\AlbumsController@deleteLikeAlbum');
    Route::post('/albums/{slug}/tags', 'API\AlbumsController@postAddTags');
    Route::delete('/albums/{slug}/tags/{tagID}', 'API\AlbumsController@deleteAlbumTag');
    Route::delete('/albums/{slug}', 'API\AlbumsController@deleteAlbum');
});
// Owner Routes. Must be at least a artist owner to access these routes.
Route::group(['prefix' => 'v1/admin', 'middleware' => ['auth:api', 'owner']], function (): void {
    Route::get('/actions', 'API\Admin\ActionsController@getActions');
    Route::put('/actions/{action}/approve', 'API\Admin\ActionsController@putApproveAction');
    Route::put('/actions/{action}/deny', 'API\Admin\ActionsController@putDenyAction');
    Route::get('/artists', 'API\Admin\ArtistsController@getArtists');
    Route::get('/artists/{artist}', 'API\Admin\ArtistsController@getArtist');
    Route::put('/artists/{artist}', 'API\Admin\ArtistsController@putUpdateArtist');
    Route::get('/artists/{artist}/albums/{album}', 'API\Admin\AlbumsController@getAlbum');
    Route::put('/artists/{artist}/albums/{album}', 'API\Admin\AlbumsController@putUpdateAlbum');
});

// Admin Routes
Route::group(['prefix' => 'v1/admin', 'middleware' => ['auth:api', 'admin']], function (): void {
    Route::get('/users', 'API\Admin\UsersController@getUsers');
    Route::get('/users/{user}', 'API\Admin\UsersController@getUser');
    Route::put('/users/{user}', 'API\Admin\UsersController@putUpdateUser');
});
// Super Admin Routes
Route::group(['prefix' => 'v1/admin', 'middleware' => ['auth:api', 'super-admin']], function (): void {
    Route::get('/brew-methods', 'API\Admin\BrewMethodsController@getBrewMethods');
    Route::get('/brew-methods/{method}', 'API\Admin\BrewMethodsController@getBrewMethod');
    Route::post('/brew-methods', 'API\Admin\BrewMethodsController@postAddBrewMethod');
    Route::put('/brew-methods/{method}', 'API\Admin\BrewMethodsController@putUpdateBrewMethod');
    Route::get('/cities', 'API\Admin\CitiesController@getCities');
    Route::get('/cities/{city}', 'API\Admin\CitiesController@getCity');
    Route::post('/cities', 'API\Admin\CitiesController@postAddCity');
    Route::put('/cities/{city}', 'API\Admin\CitiesController@putUpdateCity');
    Route::delete('/cities/{city}', 'API\Admin\CitiesController@deleteCity');
});*/
