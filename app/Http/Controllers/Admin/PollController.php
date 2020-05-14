<?php

namespace App\Http\Controllers\Admin;

use App\Events\PollStatusHasChanged;
use App\Events\PollWasAdded;
use App\Http\Controllers\Controller;
use App\Poll;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->validate([
            'question' => 'required',
            'options' => 'required|array'
        ]);

        $poll = Poll::create(['question' => $input['question']]);

        foreach ($input['options'] as $answer) {
            $poll->options()->create(['answer' => $answer]);
        }

        event(new PollWasAdded($poll));

        return $poll;
    }

    public function update(Poll $poll, Request $request)
    {
        $input = $request->validate(['status' => 'required|in:open,closed']);

        foreach (Poll::where('status', 'open')->get() as $openPoll) {
            $openPoll->update(['status' => 'closed']);
            event(new PollStatusHasChanged($openPoll));
        }

        $poll->update($input);

        event(new PollStatusHasChanged($poll));
    }
}
