<?php

namespace App\Http\Controllers;

use App\Events\QuestionWasAsked;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function store(Request $request)
    {
        $question = auth()->user()->questions()->create($request->validate([
            'question' => 'required|string'
        ]));

        event(new QuestionWasAsked($question));

        return response([], 201);
    }
}
