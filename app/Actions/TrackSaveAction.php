<?php

namespace App\Actions;

use App\Models\Album;
use App\Models\Artist;
use App\Models\Track;
use Illuminate\Support\Str;
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
            $album = $track['album'] ?? null;
            $artist = $track['album']['artists'][0] ?? null;

            if (!is_null($artist)) {
                $foundArtist = Artist::firstOrCreate([
                    'name' => $artist['name'],
                ], [
                    'spotify_id'  => $artist['id'],
                    'api_url'     => $artist['href'],
                    'spotify_uri' => $artist['uri'],
                ]);
            }

            if (!is_null($album)) {
                $foundAlbum = Album::firstOrCreate([
                    'name' => $album['name'],
                ], [
                    'spotify_id'  => $album['id'],
                    'api_url'     => $album['href'],
                    'spotify_uri' => $album['uri'],
                ]);
            }

            $newTrack = Track::updateOrCreate([
                    'spotify_id' => $track['id'],
                ], [
                    'api_url'     => $track['href'],
                    'spotify_uri' => $track['uri'],
                    'name'        => Str::of($track['name'])->limit(191),
                ]);

            if (!is_null($album) && !is_null($artist)) {
                $foundArtist->albums()->save($foundAlbum);
                $foundAlbum->tracks()->save($newTrack);
            }

            //dump($newTrack->name, $foundArtist->name, $foundAlbum->name);

            return $newTrack;
        });
        dump('Tracks are done');
        $keyedTracks->count();
    }
}
