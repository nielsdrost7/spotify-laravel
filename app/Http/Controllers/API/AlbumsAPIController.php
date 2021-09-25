<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Album;
use App\Services\SpotifyPlaylistsTracksService;
use DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AlbumsAPIController extends AppBaseController
{
    public function __construct()
    {
        $this->spotifyPlaylistsTracksService = new SpotifyPlaylistsTracksService();
    }

    public function dataTable(Request $request): JsonResponse
    {
        $albums = Album::select(
            'id',
            'spotify_id',
            'spotify_uri',
            'api_url',
            'name',
        )
        ->groupBy('spotify_id')
        ->orderBy('name')
        ->limit(5000);

        return DataTables::of($albums)

        ->addColumn('placeholder', '&nbsp;')

        ->editColumn(
            'id',
            function (Album $album) {
                return $album->id ?? '';
            }
        )
        ->editColumn(
            'name',
            function (Album $album) {
                return $album->name ?? '';
            }
        )
        ->editColumn(
            'spotify_id',
            function (Album $album) {
                return $album->spotify_id ?? '';
            }
        )
        ->editColumn(
            'spotify_uri',
            function (Album $album) {
                return $album->spotify_uri ?? '';
            }
        )
        ->editColumn(
            'api_url',
            function (Album $album) {
                return $album->api_url ?? '';
            }
        )
        ->rawColumns(['placeholder'])
        ->make(true);
    }

    public function multiDelete(Request $request): void
    {
        dd($request->spotifyIds);
    }
}
