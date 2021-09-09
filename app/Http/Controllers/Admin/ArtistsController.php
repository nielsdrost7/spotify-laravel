<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;

class ArtistsController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.artists.index');
    }
}
