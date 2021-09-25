<?php

use App\Http\Controllers\Admin\ArtistsController;

Route::group(['prefix' => 'admin', 'as' => 'artists.', 'middleware' => ['auth']], function (): void {
    Route::get(
        '/artists/',
        [ArtistsController::class, 'index']
    )->name('artists.dataTable');
    Route::get(
        '/artist/{artist}',
        [ArtistsController::class, 'show']
    )->name('show');
});
