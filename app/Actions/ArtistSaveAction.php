<?php

namespace App\Actions;

use App\Models\Artist;
use Illuminate\Support\Str;
use Spatie\QueueableAction\QueueableAction;

class ArtistSaveAction
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

    public function execute($artists): void
    {
        $keyedArtists = $artists->each(function ($artist) {
            $newArtist = Artist::updateOrCreate([
                'spotify_id' => $artist['id'],
            ], [
                'api_url'     => $artist['href'],
                'spotify_uri' => $artist['uri'],
                'name'        => Str::of($artist['name'])->limit(191),
            ]);
            dump($newArtist->id, $newArtist->name);

            return $newArtist;
        });
        dump('Artists are done');
        dump($keyedArtists->count());
    }
}
