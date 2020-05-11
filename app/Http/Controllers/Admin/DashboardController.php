<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Question;

class DashboardController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('id', 'desc')->get();

        return view('admin.home', compact('questions'));
    }
}
