<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class GraphicsController extends Controller
{
    public function index()
    {
        return view('admin.graphics');
    }
}
