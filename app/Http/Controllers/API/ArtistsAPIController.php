<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Artist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArtistsAPIController extends AppBaseController
{
    public function dataTable(Request $request): JsonResponse
    {
        $artists = Artist::select('id', 'name', 'listeners', 'uri');

        return DataTables::of($artists)
            ->editColumn('name', function ($artist) {
                return $artist->name;
            })
            ->editColumn('listeners', function ($artist) {
                return $artist->listeners;
            })
            ->editColumn('uri', function ($artist) {
                return $artist->uri;
            })
            ->addColumn('action', function ($artist) {
                $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                return $btn;
            })
            ->rawColumns(['action', 'href'])
            ->make(true);
    }

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
