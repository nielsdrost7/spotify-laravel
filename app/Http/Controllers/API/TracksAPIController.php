<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Models\AlbumTrack;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TracksAPIController extends AppBaseController
{
    public function index(Request $request): JsonResponse
    {
        $query = AlbumTrack::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $albumTracks = $query->get();

        return $this->sendResponse($albumTracks->toArray(), 'Album Tracks retrieved successfully');
    }
}
