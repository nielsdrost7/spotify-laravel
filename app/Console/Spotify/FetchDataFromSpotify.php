<?php

namespace App\Console\Spotify;

use App\Services\SpotifyAuthService;
use Illuminate\Console\Command;

class FetchDataFromSpotify extends Command
{
    protected $signature = 'spotify:fetch-data-from-spotify';

    protected $description = 'Refresh spotify access token';

    public function handle(): void
    {
        $this->spotifyAuthService = new SpotifyAuthService();
        $this->info('Refreshing access token...');
        $this->spotifyAuthService->refreshTokens();

        //Http::get(config('app.url') . '/spotify/refresh');

        $this->info('Refresh complete.');
    }
}
