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

        for ($i = 0; $i <= $numberOfPages; $i++) {
            $uri = '/v1/playlists/' . $playlistId . '/tracks';
            $parameters = [
                'offset' => $i * 100,
                'limit'  => 100,
            ];
            $items[] = $this->getPaginatedPlaylistsTracks($uri, $parameters);
        }

        $trackItems = collect($items)->flatten(1)->unique();

        return $trackItems;
    }

    private function getPaginatedPlaylistsTracks($uri, $parameters)
    {
        $tracks = $this->sendGetRequest(
            $uri,
            $parameters
        );
        $trackItems = collect($tracks['items']);

        $playlistsTracks = $trackItems->map(function ($track) {
            $artistsColl = collect($track['track']['artists'][0]);
            $trackColl = collect($track['track'], $track['track']['album']);
            $albumColl = collect($track['track']['album']);

            $returnTrack['artist'] = $artistsColl->only(
                'id',
                'name',
                'href',
                'uri',
            );

            $returnTrack['album'] = $albumColl->only([
                'id',
                'artists',
                'name',
                'href',
                'uri',
            ]);

            $returnTrack['track'] = $trackColl->only(
                'id',
                'album',
                'name',
                'href',
                'uri'
            );

            return $returnTrack;
        });

        return $playlistsTracks;
    }

    public function addPlaylistTracks($playlistId, $trackUris, $options = [])
    {
        //$playlistId = '2SbVATMTXA76bVYq7Ks06Z';

        $headers = [
            'Content-Type' => 'application/json',
        ];

        $uri = '/v1/playlists/' . $playlistId . '/tracks';

        $this->lastResponse = $this->sendPostRequest(
            $uri,
            $trackUris,
            $headers
        );

        return $this->lastResponse;
    }

    public function deletePlaylistTracks($playlistId, $trackUris, $options = [])
    {
        if (null === $playlistId) {
            $playlistId = '2SbVATMTXA76bVYq7Ks06Z';
        }
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $uri = '/v1/playlists/' . $playlistId . '/tracks';

        $this->lastResponse = $this->sendDeleteRequest(
            $uri,
            $trackUris,
            $headers
        );
        dump($this->lastResponse['reasonPhrase']);

        return $this->lastResponse;
    }
}
