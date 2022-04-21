<?php

namespace App\Services;

use Illuminate\Support\Arr;

class SpotifyPlaylistsService extends SpotifyService
{
    public function getAllPlaylists()
    {
        $nowPlaying = $this->sendGetRequest('/v1/me/playlists');
        $data = Arr::get($nowPlaying, 'items') ?? null;

        return $data;
    }
}
