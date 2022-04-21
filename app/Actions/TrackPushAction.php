<?php

namespace App\Actions;

use App\Services\SpotifyPlaylistsTracksService;
use Spatie\QueueableAction\QueueableAction;

class TrackPushAction
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

    public function execute($playlistId, $tracks): void
    {
        $tracksCollection = collect($tracks);

        $chunkedTracks = $tracksCollection->pluck('id')->chunk(50)->each(function ($trackIds) use ($playlistId) {
            $filteredTrackIds = $trackIds->filter(function ($trackId, $key) {
                return !empty($trackId) || !is_null($trackId) || !isset($trackId);
            });

            $moreTracks = $filteredTrackIds->map(function ($trackId) use ($trackIds) {
                if (empty($trackId) || is_null($trackId) || !isset($trackId)) {
                    $randomId = $trackIds->shuffle()->first();
                    $returnedRandomTrack = 'spotify:track:' . $randomId;

                    return $returnedRandomTrack;
                }
                $return = 'spotify:track:' . $trackId;

                return $return;
            });
            $chunkedMoreTracks = $moreTracks->toArray();
            $trackIds = array_values($chunkedMoreTracks);
            $result = (new SpotifyPlaylistsTracksService())->addPlaylistTracks($playlistId, $trackIds);

            return $result;
        });
    }
}
