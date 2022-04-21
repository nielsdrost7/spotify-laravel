<?php

namespace App\Actions;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Support\Str;
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

    public function execute($albums): void
    {
        $keyedAlbums = $albums->each(function ($album) {
            $artist = $album['artists'][0] ?? null;

            if (!is_null($artist)) {
                $foundArtist = Artist::updateOrCreate([
                    'name' => $artist['name'],
                ], [
                    'spotify_id'  => $artist['id'],
                    'api_url'     => $artist['href'],
                    'spotify_uri' => $artist['uri'],
                ]);
                dump('ArtistDump', $foundArtist->name);
            }

            $newAlbum = Album::updateOrCreate([
                'spotify_id' => $album['id'],
            ], [
                'api_url'     => $album['href'],
                'spotify_uri' => $album['uri'],
                'name'        => Str::of($album['name'])->limit(191),
            ]);
            dump('AlbumDump', $newAlbum->name);

            if (!is_null($artist)) {
                $foundArtist->albums()->save($newAlbum);
            }

            return $newAlbum;
        });
        dump('Albums are done');
        dump($keyedAlbums->count());
    }
}
