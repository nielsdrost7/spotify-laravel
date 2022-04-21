<?php

namespace App\Console\Spotify;

use App\Actions\AlbumSaveAction;
use App\Actions\ArtistSaveAction;
use App\Actions\TrackPushAction;
use App\Actions\TrackSaveAction;
use App\Services\SpotifyPlaylistsTracksService;
use Illuminate\Console\Command;

class FetchDataFromSpotify extends Command
{
    protected $signature = 'spotify:fetch-data';

    protected $description = 'Fetch spotify data (and deduplicate)';

    //0mWbAiiT8XInEC9EApLjwV
    //'2PG4sqjxUor5k1PtITTc0f', '2SbVATMTXA76bVYq7Ks06Z', '7DS263hH2FI4LzEh4m3DES', '5W2G6VALfr94wc13VRnUNi', '0mWbAiiT8XInEC9EApLjwV'
    protected $spotifyPlaylistId = '2SbVATMTXA76bVYq7Ks06Z';

    protected $destinationPlaylistId = '2PG4sqjxUor5k1PtITTc0f';

    public function handle(): void
    {
        $this->spotifyPlaylistsTracksService = new SpotifyPlaylistsTracksService();
        $this->info('Fetching Data');
        $allItemsUnique = $this->spotifyPlaylistsTracksService->getMassDataPlaylistsTracks($this->spotifyPlaylistId);

        $artists = $allItemsUnique->pluck('artist');
        $albums = $allItemsUnique->pluck('album');
        $tracks = $allItemsUnique->pluck('track');
        //(new ArtistSaveAction())->onQueue()->execute($artists);

        $this->info('Artists sent to queue, Working on Albums');

        //(new AlbumSaveAction())->onQueue()->execute($albums);

        $this->info('Albums sent to queue, Working on Tracks');

        //(new TrackSaveAction())->onQueue()->execute($tracks);

        (new TrackPushAction())->onQueue()->execute($this->destinationPlaylistId, $tracks);

        $this->info('Fetching Data and deduplicating complete.');
    }
}
