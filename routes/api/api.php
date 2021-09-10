<?php

use App\Http\Controllers\API\AlbumsAPIController;
use App\Http\Controllers\API\ArtistsAPIController;
use App\Http\Controllers\API\PlaylistsAPIController;
use App\Http\Controllers\API\TracksAPIController;

Route::group(['prefix' => 'v1'], function (): void {
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
        [AlbumsAPIController::class, 'getArtist']
    )->name('album.show');

    Route::get(
        '/artists/dataTable',
        [ArtistsAPIController::class, 'dataTable']
    )->name('artists.dataTable');
    Route::post(
        '/artists/multiDelete',
        [ArtistsAPIController::class, 'multiDelete']
    )->name('artists.multiDelete');
    Route::get(
        '/artist/{artist}',
        [ArtistsAPIController::class, 'getArtist']
    )->name('artist.show');

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

    Route::get(
        '/tracks/dataTable',
        [TracksAPIController::class, 'dataTable']
    )->name('tracks.dataTable');
    Route::post(
        '/tracks/multiDelete',
        [TracksAPIController::class, 'multiDelete']
    )->name('tracks.multiDelete');
    Route::get(
        '/track/{track}',
        [TracksAPIController::class, 'getTrack']
    )->name('track.show');
});
