<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function store(Request $request)
    {
        auth()->user()->questions()->create($request->validate([
            'question' => 'required|string'
        ]));

        return response([], 201);
    }
}
