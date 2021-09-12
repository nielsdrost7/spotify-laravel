<?php

namespace App\Http\Controllers\Spotify;

use App\Http\Controllers\AppBaseController;
use App\Services\SpotifyNowPlayingService;
use App\Services\SpotifyPlaylistsService;
use App\Services\SpotifyPlaylistsTracksService;
use Illuminate\Http\Request;

class SpotifyNowPlayingController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->spotifyNowPlayingService = new SpotifyNowPlayingService();
        $this->spotifyPlaylistsService = new SpotifyPlaylistsService();
        $this->spotifyPlaylistsTracksService = new SpotifyPlaylistsTracksService();
    }

    public function nowPlaying()
    {
        $nowPlaying = $this->spotifyNowPlayingService->getCurrentlyPlaying();

        return view('spotify.nowplaying')->with('nowPlaying', $nowPlaying);
    }

    public function playlists()
    {
        $playlists = $this->spotifyPlaylistsService->getAllPlaylists();

        return view('spotify.playlists.index')->with('playlists', $playlists);
    }

    public function playlistsTracks(Request $request, string $playlistId)
    {
        $playlistsTracks = $this->spotifyPlaylistsTracksService->getAllPlaylistsTracks($playlistId);
        dd($playlistsTracks);

        return view('spotify.playlists.index')->with('playlistsTracks', $playlistsTracks);
    }
}
