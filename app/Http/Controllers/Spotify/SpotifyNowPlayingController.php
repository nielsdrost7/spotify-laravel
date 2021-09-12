<?php

namespace App\Http\Controllers\Spotify;

use App\Http\Controllers\AppBaseController;
use App\Services\SpotifyNowPlayingService;

class SpotifyNowPlayingController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->spotifyNowPlayingService = new SpotifyNowPlayingService();
    }

    public function nowPlaying()
    {
        $nowPlaying = $this->spotifyNowPlayingService->getCurrentlyPlaying();

        return view('spotify.nowplaying')->with('nowPlaying', $nowPlaying);
    }
}
