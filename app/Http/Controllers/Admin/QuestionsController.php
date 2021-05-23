<?php

namespace App\Http\Controllers\Admin;

use App\Events\QuestionWasAsked;
use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function store(Request $request)
    {
        $question = Question::create($request->validate([
            'custom_name' => 'required|string',
            'question' => 'required|string'
        ]));

        event(new QuestionWasAsked($question));

        return response([], 201);
    }
}
