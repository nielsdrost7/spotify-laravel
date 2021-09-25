<?php

use App\Http\Controllers\API\TracksAPIController;

Route::group(['prefix' => 'v1', 'as' => 'api.'], function (): void {
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
