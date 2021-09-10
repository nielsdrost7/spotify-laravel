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
        $nowPlaying = $this->spotifyNowPlayingService->getIsPlaying();

        return view('spotify.nowplaying')->with('nowPlaying', $nowPlaying);

        // return view('dashboard-spotify-tile::tile', [
        //     'refreshIntervalInSeconds' => config('dashboard.tiles.spotify.refresh_interval_in_seconds') ?? 60,
        //     'isPlaying'                => $spotifyStore->getIsPlaying(),
        //     'trackName'                => $spotifyStore->getTrackName(),
        //     'albumImage'               => $spotifyStore->getAlbumImage(),
        //     'artists'                  => $spotifyStore->getArtists(),
        // ]);
    }
}
