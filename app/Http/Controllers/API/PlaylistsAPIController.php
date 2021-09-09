<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Playlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlaylistsAPIController extends AppBaseController
{
    public function index(Request $request): JsonResponse
    {
        $query = Playlist::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $albumPalettes = $query->get();

        return $this->sendResponse($albumPalettes->toArray(), 'Album Palettes retrieved successfully');
    }
}
