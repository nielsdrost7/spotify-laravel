<?php

use App\Http\Controllers\Spotify\SpotifyNowPlayingController;

Route::get('/spotify/nowplaying', [SpotifyNowPlayingController::class, 'nowPlaying'])->name('spotify.nowplaying');
