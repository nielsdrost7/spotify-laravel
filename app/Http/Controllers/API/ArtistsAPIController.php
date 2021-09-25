<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Track;
use App\Services\SpotifyPlaylistsTracksService;
use DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArtistsAPIController extends AppBaseController
{
    public function __construct()
    {
        $this->spotifyPlaylistsTracksService = new SpotifyPlaylistsTracksService();
    }

    public function dataTable(Request $request): JsonResponse
    {
        $artists = Artist::select(
            'id',
            'spotify_id',
            'spotify_uri',
            'api_url',
            'name',
        )
        ->groupBy('spotify_id')
        ->orderBy('name')
        ->limit(5000);

        return DataTables::of($artists)

        ->addColumn('placeholder', '&nbsp;')

        ->editColumn(
            'id',
            function (Artist $artist) {
                return $artist->id ?? '';
            }
        )
        ->editColumn(
            'name',
            function (Artist $artist) {
                return $artist->name ?? '';
            }
        )
        ->editColumn(
            'spotify_id',
            function (Artist $artist) {
                return $artist->spotify_id ?? '';
            }
        )
        ->editColumn(
            'spotify_uri',
            function (Artist $artist) {
                return $artist->spotify_uri ?? '';
            }
        )
        ->editColumn(
            'api_url',
            function (Artist $artist) {
                return $artist->api_url ?? '';
            }
        )
        ->rawColumns(['placeholder'])
        ->make(true);
    }

    public function multiDelete(Request $request): bool
    {
        $artistIds = array_values($request->ids);
        $albumIds = Album::select('id')->whereIn('artist_id', $artistIds)->get();
        $dbTrackUris = Track::select('spotify_uri')->whereIn('album_id', $albumIds)->get();
        $playlistIds = ['2PG4sqjxUor5k1PtITTc0f', '2SbVATMTXA76bVYq7Ks06Z', '7DS263hH2FI4LzEh4m3DES', '5W2G6VALfr94wc13VRnUNi'];
        $trackUris = $dbTrackUris->pluck('spotify_uri')->toArray();

        $deletedArtists = Artist::whereIn('id', $artistIds)->forceDelete();
        dump('deletedArtists', $deletedArtists);

        foreach ($playlistIds as $playlistId) {
            $returnResponse = $this->spotifyPlaylistsTracksService->deletePlaylistTracks($playlistId, $trackUris);
        }

        return true;
    }
}
