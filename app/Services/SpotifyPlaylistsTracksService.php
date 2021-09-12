<?php

namespace App\Services;

use Illuminate\Support\Arr;

class SpotifyPlaylistsTracksService extends SpotifyService
{
    public function getAllPlaylistsTracks(string $playlistId)
    {
        $tracks = $this->sendGetRequest(
            '/v1/playlists/' . $playlistId . '/tracks'
        );
        $trackItems = collect($tracks['items']);

        $playlistsTracks = $trackItems->map(function ($track) {
            $trackColl = collect($track['track']);
            $t = $trackColl->only(
                'id',
                'name',
                'artists',
                'album',
                'href',
                'uri'
            );

            return $t;
        });

        dd($playlistsTracks);

        $data = Arr::get($playlistsTracks, 'items') ?? null;

        return $data;
    }

    public function getMassDataPlaylistsTracks(string $playlistId)
    {
        $trackItems = [];

        $tracks = $this->sendGetRequest(
            '/v1/playlists/' . $playlistId . '/tracks'
        );

        $numberOfPages = (int) ceil(($tracks['total'] / $tracks['limit']));

        for ($i = 0; $i <= 1; $i++) {
            $uri = str_replace('https://api.spotify.com', '', $tracks['next']);
            $trackItems[] = $this->getPaginatedPlaylistsTracks($uri);
        }

        dd('trackitems', $trackItems);
        $temp = array_merge($tracks, $trackItems);
        dd('temp', $temp);

        $trackItems = collect($tracks['items']);

        $playlistsTracks = $trackItems->map(function ($track) {
            $trackColl = collect($track['track']);
            $t = $trackColl->only(
                'id',
                'name',
                'artists',
                'album',
                'href',
                'uri'
            );

            return $t;
        });

        dd($playlistsTracks->first()['name']);

        return $data;
    }

    private function getPaginatedPlaylistsTracks($uri)
    {
        $tracks = $this->sendGetRequest(
            $uri
        );
        $trackItems = collect($tracks['items']);

        dump($tracks['next']);

        $playlistsTracks = $trackItems->map(function ($track) {
            $trackColl = collect($track['track']);
            $t = $trackColl->only(
                'id',
                'name',
                'artists',
                'album',
                'href',
                'uri'
            );

            return $t;
        });

        $data['name'] = $playlistsTracks->first()['name'];
        $data['next'] = $tracks['next'];

        return $data;
    }
}
