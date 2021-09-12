<?php

use App\Http\Controllers\Spotify\SpotifyAuthController;
use App\Http\Controllers\Spotify\SpotifyNowPlayingController;

Route::get('/spotify/authorize', [SpotifyAuthController::class, 'authorizeApplication'])->name('spotify.authorize');
Route::get('/spotify/callback', [SpotifyAuthController::class, 'storeTokens'])->name('spotify.callback');
Route::get('/spotify/refresh', [SpotifyAuthController::class, 'refreshTokens'])->name('spotify.refresh');

Route::get('/spotify/nowplaying', [SpotifyNowPlayingController::class, 'nowPlaying'])->name('spotify.nowplaying');
