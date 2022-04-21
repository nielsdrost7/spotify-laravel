<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Track;
use App\Services\SpotifyPlaylistsTracksService;
use DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TracksAPIController extends AppBaseController
{
    public function __construct()
    {
        $this->spotifyPlaylistsTracksService = new SpotifyPlaylistsTracksService();
    }

    public function dataTable(Request $request): JsonResponse
    {
        $tracks = Track::select(
            'tracks.id as trackId',
            'tracks.name as track_name',
            'tracks.spotify_id as spotifyId',
            'tracks.spotify_uri as spotifyUri',
            'tracks.api_url as apiUrl',
            'albums.id',
            'albums.name as album_name',
            'artists.id',
            'artists.name as artist_name'
        )
        ->joinRelationship('album.artist')
        ->orderBy('artists.name')
        ->orderBy('tracks.name')
        ->get();

        return DataTables::of($tracks)

        ->addColumn('placeholder', '&nbsp;')

        ->editColumn(
            'track_id',
            function (Track $track) {
                return $track->trackId ?? '';
            }
        )
        ->editColumn(
            'artist_name',
            function (Track $track) {
                return $track->artist_name ?? '';
            }
        )
        ->editColumn(
            'track_name',
            function (Track $track) {
                return $track->track_name ?? '';
            }
        )
        ->editColumn(
            'spotify_id',
            function (Track $track) {
                return $track->spotifyId ?? '';
            }
        )
        ->editColumn(
            'spotify_uri',
            function (Track $track) {
                return $track->spotifyUri ?? '';
            }
        )
        ->editColumn(
            'api_url',
            function (Track $track) {
                return $track->apiUrl ?? '';
            }
        )
        ->rawColumns(['placeholder'])
        ->make(true);
    }

    public function multiDelete(Request $request): bool
    {
        $trackIds = array_values($request->ids);
        $trackUris = array_values($request->spotifyUris);
        $playlistIds = ['2PG4sqjxUor5k1PtITTc0f', '2SbVATMTXA76bVYq7Ks06Z', '7DS263hH2FI4LzEh4m3DES', '5W2G6VALfr94wc13VRnUNi', '0mWbAiiT8XInEC9EApLjwV'];

        $deletedTracks = Track::whereIn('id', $trackIds)->forceDelete();

        foreach ($playlistIds as $playlistId) {
            $returnResponse = $this->spotifyPlaylistsTracksService->deletePlaylistTracks($playlistId, $trackUris);
        }

        return true;
    }
}
