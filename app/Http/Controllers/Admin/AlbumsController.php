<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;

class AlbumsController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.albums.index');
    }
}
