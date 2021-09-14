<?php

namespace App\Actions;

use App\Models\Album;
use App\Models\Artist;
use Spatie\QueueableAction\QueueableAction;

class AlbumSaveAction
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
    public function execute($albums)
    {
        $keyedAlbums = $albums->each(function ($album) {
            $artist = $album['artists'][0];

            $foundArtist = Artist::updateOrCreate([
                'name' => $artist['name'],
            ], [
                'api_url'     => $artist['href'],
                'spotify_uri' => $artist['uri'],
                'name'        => $artist['name'],
            ]);

            $newAlbum = Album::updateOrCreate([
                'spotify_id' => $album['id'],
            ], [
                'api_url'     => $album['href'],
                'spotify_uri' => $album['uri'],
                'name'        => $album['name'],
            ]);

            $foundArtist->albums()->save($newAlbum);

            return $newAlbum;
        });
    }
}
