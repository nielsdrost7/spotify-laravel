<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Models\Artist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArtistsAPIController extends AppBaseController
{
    public function index(Request $request): JsonResponse
    {
        $query = Artist::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $artists = $query->get();

        return $this->sendResponse($artists->toArray(), 'Artists retrieved successfully');
    }
}
