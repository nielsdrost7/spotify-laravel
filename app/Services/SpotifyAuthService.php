<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SpotifyAuthService
{
    public const SPOTIFY_API_TOKEN_URL = 'https://accounts.spotify.com/api/token';

    private $clientId;

    private $clientSecret;

    private $authCode;

    private $redirect_uri;

    private $scopes = 'user-read-private user-read-email streaming app-remote-control user-read-playback-state user-read-currently-playing
user-modify-playback-state user-read-playback-position user-read-recently-played playlist-modify-public playlist-modify-private';

    public function __construct()
    {
    }

    /**
     * Generate the access token that will be used to make request to the Spotify API.
     *
     * @throws RequestException
     */
    private function generateAccessToken($authCode): void
    {
        $clientId = config('spotify.auth.client_id');
        $clientSecret = config('spotify.auth.client_secret');

        try {
            $response = Http::asForm()->withHeaders([
                'Authorization' => 'Basic ' . base64_encode($clientId . ':' . $clientSecret),
            ])->post(self::SPOTIFY_API_TOKEN_URL, [
                'client_id'    => $clientId,
                'grant_type'   => 'authorization_code',
                'code'         => $authCode,
                'redirect_uri' => route('spotify.callback'),
            ]);
        } catch (RequestException $e) {
            $status = $e->getCode();
            $message = $errorResponse->error_description;

            abort($status, $message);
        } catch (Exception $e) {
            dd($e);
        }

        $body = json_decode((string) $response->getBody());
        Cache::forget('spotifyRefreshToken');
        Cache::put('spotifyRefreshToken', $body->refresh_token);
        Cache::remember('spotifyAccessToken', $body->expires_in, function () use ($body) {
            return $body->access_token;
        });
    }

    public function getAccessToken($authCode = null): string
    {
        if (isset($authCode)) {
            $this->generateAccessToken($authCode);
        } else {
            if (! Cache::has('spotifyAccessToken')) {
                $this->generateAccessToken();
            }
        }

        return Cache::get('spotifyAccessToken');
    }

    public function refreshTokens(): void
    {
        $clientId = config('spotify.auth.client_id');
        $clientSecret = config('spotify.auth.client_secret');

        $accessToken = Cache::get('spotifyAccessToken');
        $refreshToken = Cache::get('spotifyRefreshToken');

        try {
            $response = Http::asForm()->withHeaders([
                'Authorization' => 'Basic ' . base64_encode($clientId . ':' . $clientSecret),
            ])->post(self::SPOTIFY_API_TOKEN_URL, [
                'grant_type'    => 'refresh_token',
                'refresh_token' => 'AQCZ0sZ8S5FNac80VU4yDcLepdUyZmHQNKs6b4o4IZHuMlvMuHmH4mNs-s8fYuIEttE7hgEv8b3vY0jek9VFeO-2SxzrQptFkZpBkGz-xUqRUPSnX58248YjeIqD4qDXtBc',
                'redirect_uri'  => route('spotify.callback'),
            ]);
        } catch (RequestException $e) {
            $status = $e->getCode();
            $message = $e->getMessage();

            Log::error('Access token failed to update', $message);
            abort($status, $message);
        } catch (Exception $e) {
            dd('exception', $e->getMessage());
        }

        $body = json_decode((string) $response->getBody());

        Cache::put('spotifyAccessToken', $body->access_token);
        Log::info('Access token updated successfully');
    }
}
