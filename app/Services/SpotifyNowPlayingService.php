<?php

namespace App\Services;

use Aerni\Spotify\SpotifyAuth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class SpotifyNowPlayingService
{
    public const SPOTIFY_API_TOKEN_URL = 'https://accounts.spotify.com/api/token';

    private $clientId;

    private $clientSecret;

    private $authCode;

    private $redirect_uri;

    private $scopes = 'user-read-private user-read-email streaming app-remote-control user-read-playback-state user-read-currently-playing
user-modify-playback-state user-read-playback-position user-read-recently-played';

    public function getIsPlaying(): void
    {
        $auth = resolve(SpotifyAuth::class);
        $this->accessToken = $auth->getAccessToken();
        $nowPlaying = $this->getCurrentlyPlaying();

        dd($nowPlaying);
    }

    private function getCurrentlyPlaying()
    {
        $endpoint = 'https://api.spotify.com/v1/me/player/currently-playing';
        dd($this->accessToken);
        try {
            $response = Http::withToken(
                $this->accessToken
            )->withHeaders([
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ])->get($endpoint)->json();
        } catch (RequestException $e) {
            $status = $e->getCode();
            $message = $errorResponse->error_description;

            abort($status, $message);
        }
        dd('response', $response);

        $response = collect($response);

        if ($response == null) {
            return [];
        }

        $data = [
            'isPlaying'   => $response->get('is_playing'),
            'trackName'   => Arr::get($response, 'item.name') ?? null,
            'trackArtist' => Arr::get($response, 'item.artists') ?? null,
            'images'      => Arr::get($response, 'item.album.images.0') ?? null,
        ];

        return $data;
    }
}
