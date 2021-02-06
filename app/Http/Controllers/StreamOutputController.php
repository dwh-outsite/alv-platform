<?php

namespace App\Http\Controllers;

use App\Events\StreamOutputHasChanged;
use App\Poll;
use App\Question;
use Illuminate\Http\Request;

class StreamOutputController extends Controller
{
    public function showQuestion(Question $question)
    {
        event(new StreamOutputHasChanged('question', $question->toArray()));
    }

    public function showPoll(Poll $poll)
    {
        event(new StreamOutputHasChanged('poll', $poll->toArray()));
    }

    public function showLowerThird(Request $request)
    {
        event(new StreamOutputHasChanged(
            'lowerThird',
            $request->validate([
                'name' => 'required|string',
                'title' => 'required|string'
            ])
        ));
    }

    public function showAgenda()
    {
        event(new StreamOutputHasChanged('agenda', null));
    }

    public function showVoteCountdown(Request $request)
    {
        event(new StreamOutputHasChanged('voteCountdown', $request->only('seconds')));
    }

    public function hideAll()
    {
        event(new StreamOutputHasChanged(null, null));
    }
}
