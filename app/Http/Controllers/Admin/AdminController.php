<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;

class AdminController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index');
    }
}
