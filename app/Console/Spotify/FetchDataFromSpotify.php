<?php

namespace App\Console\Spotify;

use App\Services\SpotifyPlaylistsTracksService;
use Illuminate\Console\Command;

class FetchDataFromSpotify extends Command
{
    protected $signature = 'spotify:fetch-data';

    protected $description = 'Fetch spotify data (and deduplicate)';

    protected $spotifyPlaylistId = '5W2G6VALfr94wc13VRnUNi';

    public function handle(): void
    {
        $this->spotifyPlaylistsTracksService = new SpotifyPlaylistsTracksService();
        $this->info('Fetching Data');
        $this->spotifyPlaylistsTracksService->getMassDataPlaylistsTracks($this->spotifyPlaylistId);
        $this->info('Fetching Data and deduplicating complete.');
    }
}
