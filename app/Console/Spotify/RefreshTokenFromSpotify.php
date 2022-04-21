<?php

namespace App\Console\Spotify;

use App\Services\SpotifyAuthService;
use Illuminate\Console\Command;

class RefreshTokenFromSpotify extends Command
{
    protected $signature = 'spotify:refresh-token';

    protected $description = 'Refresh spotify access token';

    public function handle(): void
    {
        $this->spotifyAuthService = new SpotifyAuthService();
        $this->info('Refreshing access token...');
        $this->spotifyAuthService->refreshTokens();
        $this->info('Refresh complete.');
    }
}
