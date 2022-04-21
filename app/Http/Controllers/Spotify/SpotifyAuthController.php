<?php

namespace App\Http\Controllers\Spotify;

use App\Http\Controllers\Controller;
use App\Services\SpotifyAuthService;
use Illuminate\Http\Request;

class SpotifyAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->clientId = config('spotify.client_id');
        $this->clientSecret = config('spotify.client_secret');
        $this->spotifyAuthService = new SpotifyAuthService($this->clientId, $this->clientSecret);
    }

    public function authorizeApplication()
    {
        $scopes = [
            'user-read-private',
            'user-read-email',
            'user-read-playback-state',
            'user-read-currently-playing',
            'user-modify-playback-state',
            'user-read-playback-position',
            'user-read-recently-played',
            'app-remote-control',
            'streaming',
            'playlist-modify-public',
            'playlist-modify-private',
        ];

        $baseUrl = 'https://accounts.spotify.com/authorize';
        $url = $baseUrl . '?' . http_build_query([
            'client_id'     => config('spotify.auth.client_id'),
            'grant_type'    => 'authorization_code',
            'response_type' => 'code',
            'scope'         => implode(' ', $scopes),
            'redirect_uri'  => route('spotify.callback'),
        ]);

        return redirect()->away($url);
    }

    public function storeTokens(Request $request)
    {
        /* if ($request->error == 'access_denied') {
            abort('403', 'access_denied');
        } */

        $authCode = $request->code;

        $body = $this->spotifyAuthService->getAccessToken($authCode);

        return redirect()->away(route('spotify.nowplaying'));
    }
}
