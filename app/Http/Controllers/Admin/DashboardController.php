<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Poll;
use App\Question;

class DashboardController extends Controller
{
    public function index()
    {
        $polls = Poll::orderBy('id', 'desc')->get();
        $questions = Question::orderBy('id', 'desc')->get();

        return view('admin.home', compact('polls', 'questions'));
    }
}
