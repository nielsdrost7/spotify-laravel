<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Track;
use DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TracksAPIController extends AppBaseController
{
    public function dataTable(Request $request): JsonResponse
    {
        $tracks = Track::select('id', 'name', 'duration', 'href');

        return DataTables::of($tracks)
            ->editColumn('name', function ($track) {
                return $track->name;
            })
            ->editColumn('duration', function ($track) {
                return $track->duration;
            })
            ->editColumn('href', function ($track) {
                return $track->href;
            })
            ->addColumn('action', function ($track) {
                $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                return $btn;
            })
            ->rawColumns(['action', 'href'])
            ->make(true);
    }

    public function index(Request $request): JsonResponse
    {
        $query = Track::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $tracks = $query->get();

        return $this->sendResponse($tracks->toArray(), 'Tracks retrieved successfully');
    }
}
