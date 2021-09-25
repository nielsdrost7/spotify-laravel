<?php

use App\Http\Controllers\API\ArtistsAPIController;

Route::group(['prefix' => 'v1', 'as' => 'api.'], function (): void {
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
});
