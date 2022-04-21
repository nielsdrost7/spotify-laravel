<?php

namespace App\Services;

use Illuminate\Support\Arr;

class SpotifyNowPlayingService extends SpotifyService
{
    public function getCurrentlyPlaying()
    {
        $nowPlaying = $this->sendGetRequest('/v1/me/player/currently-playing');

        $data = [
            'isPlaying'   => Arr::get($nowPlaying, 'is_playing') ?? null,
            'trackAlbum'  => Arr::get($nowPlaying, 'item.album.name') ?? null,
            'trackArtist' => Arr::get($nowPlaying, 'item.artists.0.name') ?? null,
            'trackName'   => Arr::get($nowPlaying, 'item.name') ?? null,
            'trackHref'   => Arr::get($nowPlaying, 'item.href') ?? null,
            'trackUri'    => Arr::get($nowPlaying, 'item.uri') ?? null,
            'images'      => Arr::get($nowPlaying, 'item.album.images.0') ?? null,
        ];

        dd($nowPlaying);

        return $data;
    }
}
