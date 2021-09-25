<?php

use App\Http\Controllers\API\AlbumsAPIController;
use App\Http\Controllers\API\PlaylistsAPIController;

Route::group(['prefix' => 'v1', 'as' => 'api.'], function (): void {
    Route::get(
        '/albums/dataTable',
        [AlbumsAPIController::class, 'dataTable']
    )->name('albums.dataTable');
    Route::post(
        '/albums/multiDelete',
        [AlbumsAPIController::class, 'multiDelete']
    )->name('albums.multiDelete');
    Route::get(
        '/album/{album}',
        [AlbumsAPIController::class, 'getAlbum']
    )->name('album.show');

    Route::get(
        '/playlists/dataTable',
        [PlaylistsAPIController::class, 'dataTable']
    )->name('playlists.dataTable');
    Route::post(
        '/playlists/multiDelete',
        [PlaylistsAPIController::class, 'multiDelete']
    )->name('playlists.multiDelete');
    Route::get(
        '/playlist/{playlist}',
        [PlaylistsAPIController::class, 'getPlaylist']
    )->name('playlist.show');
});
