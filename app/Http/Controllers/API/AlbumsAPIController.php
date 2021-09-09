<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Album;
use DataTables;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AlbumsAPIController extends AppBaseController
{
    public function dataTable(Request $request): JsonResponse
    {
        $albums = Album::select('id', 'name', 'playcount', 'uri')->orderBy('name');

        return DataTables::of($albums)
            ->addColumn('checkbox', function ($album) {
                return '<input type="checkbox" name="pdr_checkbox[]" class="pdr_checkbox" value="' . $album->id . '" />';
            })
            ->editColumn('id', function ($album) {
                return $album->id;
            })
            ->editColumn('name', function ($album) {
                return $album->name;
            })
            ->editColumn('playcount', function ($album) {
                return $album->playcount;
            })
            ->editColumn('uri', function ($album) {
                return $album->uri;
            })
            ->addColumn('action', function ($album) {
                $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                return $btn;
            })
            ->rawColumns(['checkbox', 'action', 'href'])
            ->make(true);
    }

    public function index(Request $request): JsonResponse
    {
        $query = Album::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }

        $albums = $query->get();

        return $this->sendResponse($albums->toArray(), 'Albums retrieved successfully');
    }
}
