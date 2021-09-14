<?php

namespace App\Services;

use App\Exceptions\Spotify\SpotifyException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SpotifyService
{
    private $accessToken = '';

    protected $request = null;

    protected $spotifyAuthService;

    protected $lastResponse = [];

    public const API_URL = 'https://api.spotify.com';

    public function __construct()
    {
        $this->spotifyAuthService = new SpotifyAuthService();
    }

    private function getAccessToken(): string
    {
        if (! Cache::has('spotifyAccessToken')) {
            $this->generateAccessToken();
        }

        return Cache::get('spotifyAccessToken');
    }

    /**
     * Handle response errors.
     *
     * @param array|object $body   the parsed response body
     * @param int          $status the HTTP status code, passed along to any exceptions thrown
     *
     * @throws SpotifyException
     *
     * @return void
     */
    protected function handleResponseError($responseBody): void
    {
        $error = (object) $responseBody['error'];    // Object!

        if (isset($error->message) && isset($error->status)) {
            $exception = new SpotifyException($error->message, $error->status);

            if (isset($error->reason)) {
                $exception->setReason($error->reason);
            }

            throw $exception;
        } else {
            throw new SpotifyException('An unknown error occurred.', $error->status);
        }
    }

    /**
     * Send a request to the Spotify API, automatically refreshing the access token as needed.
     *
     * @param string $method     the HTTP method to use
     * @param string $uri        the URI to request
     * @param array  $parameters Optional. Query string parameters or HTTP body, depending on $method.
     * @param array  $headers    Optional. HTTP headers.
     *
     * @throws SpotifyException
     * @throws SpotifyAuthException
     *
     * @return array Response data.
     *               - array|object body The response body. Type is controlled by the `return_assoc` option.
     *               - array headers Response headers.
     *               - int status HTTP status code.
     *               - string url The requested URL.
     */
    protected function sendRequest($method, $uri, $parameters = [], $headers = [])
    {
        try {
            return $this->sendGetRequest($method, $uri, $parameters, $headers);
        } catch (SpotifyException $e) {
            if ($e->hasExpiredToken()) {
                $result = $this->spotifyAuthService->refreshAccessToken();

                if (!$result) {
                    throw new SpotifyException('Could not refresh access token.');
                }

                return $this->sendGetRequest($method, $uri, $parameters, $headers);
            } elseif ($e->isRateLimited()) {
                $lastResponse = $this->getLastResponse();
                $retryAfter = (int) $lastResponse['headers']['retry-after'];

                sleep($retryAfter);

                return $this->sendGetRequest($method, $uri, $parameters, $headers);
            }

            throw $e;
        }
    }

    /**
     * Make a request to Spotify.
     *
     * @param string $url        the URL to request
     * @param array  $parameters Optional. Query string parameters or HTTP body, depending on $method.
     * @param array  $headers    Optional. HTTP headers.
     *                           //GuzzleHttp\Psr7\Response
     *
     * @throws SpotifyException
     *
     * @return array Response data.
     *               - array|object body The response body. Type is controlled by the `return_assoc` option.
     *               - array headers Response headers.
     *               - int status HTTP status code.
     *               - string url The requested URL.
     */
    public function sendGetRequest($endpoint, $parameters = [], $headers = [])
    {
        $this->lastResponse = [];

        if (is_array($parameters) || is_object($parameters)) {
            $parameters = http_build_query($parameters, '', '&');
            dump($parameters);
        }

        $this->accessToken = $this->spotifyAuthService->getAccessToken();

        try {
            $response = Http::withHeaders([
                'Accept'       => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->acceptJson()
            ->withToken(
                $this->accessToken
            )
            ->get(self::API_URL . $endpoint . '/?' . $parameters);
        } catch (Exception $e) {
            dd($e);
        }

        if ($response->failed()) {
            $this->handleResponseError($response);
        }
        $responseBody = $response->json();
        $this->lastResponse = [
            'url'          => $endpoint,
            'status'       => $response->getStatusCode(),
            'reasonPhrase' => $response->getReasonPhrase(),
            'body'         => $responseBody,
            'headers'      => $response->headers(),
        ];

        return $responseBody;
    }
}
