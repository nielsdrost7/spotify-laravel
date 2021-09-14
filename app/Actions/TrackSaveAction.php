<?php

namespace App\Actions;

use App\Models\Album;
use App\Models\Track;
use Spatie\QueueableAction\QueueableAction;

class TrackSaveAction
{
    use QueueableAction;

    /**
     * Create a new action instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Prepare the action for execution, leveraging constructor injection.
    }

    /**
     * Execute the action.
     *
     * @return mixed
     */
    public function execute($tracks)
    {
        $keyedTracks = $tracks->map(function ($track) {
            $album = $track['album'];

            $foundAlbum = Album::updateOrCreate([
                'name' => $album['name'],
            ], [
                'spotify_id'  => $album['id'],
                'api_url'     => $album['href'],
                'spotify_uri' => $album['uri'],
            ]);

            $newTrack = Track::updateOrCreate([
                'spotify_id' => $track['id'],
            ], [
                'api_url'     => $track['href'],
                'spotify_uri' => $track['uri'],
                'name'        => $track['name'],
            ]);
            $foundAlbum->tracks()->save($newTrack);

            return $newTrack;
        });
        $keyedTracks->count();
    }
}
