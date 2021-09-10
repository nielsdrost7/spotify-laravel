<?php

namespace App\Console\Spotify;

use App\Services\SpotifyService;
use Illuminate\Console\Command;

class FetchDataFromSpotifyCommand extends Command
{
    protected $signature = 'spotify:fetch-data-from-spotify-api';

    protected $description = 'Fetch data for tile';

    public function handle(): void
    {
        $this->info('Fetching spotify data...');

        $spotify = new SpotifyService(
            config('dashboard.tiles.spotify.client_id'),
            config('dashboard.tiles.spotify.secret'),
            config('dashboard.tiles.spotify.auth_code'),
        );

        $spotifyData = $spotify->getSpotifiyData();

        $this->info('All done!');
    }
}
