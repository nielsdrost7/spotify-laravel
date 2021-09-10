<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Playlist;
use DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlaylistsAPIController extends AppBaseController
{
    public function dataTable(Request $request): JsonResponse
    {
        $playlists = Playlist::select('id', 'name', 'uri');

        return DataTables::of($playlists)
            ->editColumn('name', function ($playlist) {
                return $playlist->name;
            })
            ->editColumn('uri', function ($playlist) {
                return $playlist->uri;
            })
            ->addColumn('action', function ($playlist) {
                $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                return $btn;
            })
            ->rawColumns(['action', 'uri'])
            ->make(true);
    }

    public function index(Request $request): JsonResponse
    {
        $query = Playlist::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $playlists = $query->get();

        return $this->sendResponse($playlists->toArray(), 'Playlist retrieved successfully');
    }
}
