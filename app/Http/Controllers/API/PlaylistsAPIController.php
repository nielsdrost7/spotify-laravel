<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Playlist;
use App\Services\SpotifyPlaylistsTracksService;
use DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlaylistsAPIController extends AppBaseController
{
    public function __construct()
    {
        $this->spotifyPlaylistsTracksService = new SpotifyPlaylistsTracksService();
    }

    public function dataTable(Request $request): JsonResponse
    {
        $playlists = Playlist::select(
            'id',
            'spotify_id',
            'spotify_uri',
            'api_url',
            'name',
        )
        ->groupBy('spotify_id')
        ->orderBy('name')
        ->limit(5000);

        return DataTables::of($playlists)

        ->addColumn('placeholder', '&nbsp;')

        ->editColumn(
            'id',
            function (Playlist $playlist) {
                return $playlist->id ?? '';
            }
        )
        ->editColumn(
            'name',
            function (Playlist $playlist) {
                return $playlist->name ?? '';
            }
        )
        ->editColumn(
            'spotify_id',
            function (Playlist $playlist) {
                return $playlist->spotify_id ?? '';
            }
        )
        ->editColumn(
            'spotify_uri',
            function (Playlist $playlist) {
                return $playlist->spotify_uri ?? '';
            }
        )
        ->editColumn(
            'api_url',
            function (Playlist $playlist) {
                return $playlist->api_url ?? '';
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
