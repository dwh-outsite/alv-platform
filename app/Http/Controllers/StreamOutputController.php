<?php

namespace App\Http\Controllers;

use App\Events\StreamOutputCountdownHasStarted;
use App\Events\StreamOutputHasChanged;
use App\Poll;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Carbon;

class StreamOutputController extends Controller
{
    public function showQuestion(Question $question)
    {
        event(new StreamOutputHasChanged('question', $question->toArray()));
    }

    public function showMessage(Request $request)
    {
        ['text' => $text] = $request->validate([
            'text' => 'required|string',
        ]);

        event(new StreamOutputHasChanged(
            'message',
            ['text' => Markdown::parse(nl2br($text))->toHtml()]
        ));
    }

    public function showPoll(Poll $poll)
    {
        event(new StreamOutputHasChanged('poll', $poll->toArray()));
    }

    public function showPollQuestion(Poll $poll)
    {
        event(new StreamOutputHasChanged('poll-question', $poll->toArray()));
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

    public function showUpperThird(Request $request)
    {
        ['text' => $text] = $request->validate([
            'text' => 'required|string',
        ]);

        event(new StreamOutputHasChanged(
            'upperThird',
            ['text' => Markdown::parse($text)->toHtml()]
        ));
    }

    public function showAgenda()
    {
        event(new StreamOutputHasChanged('agenda', null));
    }

    public function showCountdown(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string',
            'hour' => 'required|int',
            'minutes' => 'required|int',
        ]);

        $time = Carbon::now()->setHour($input['hour'])->setMinutes($input['minutes'])->setSeconds(0)->timestamp;

        event(new StreamOutputCountdownHasStarted([
            'name' => $input['name'],
            'time' => $time,
        ]));
    }

    public function showVoteCountdown(Request $request)
    {
        event(new StreamOutputHasChanged('voteCountdownShow', $request->only('seconds')));
    }

    public function hideVoteCountdown(Request $request)
    {
        event(new StreamOutputHasChanged('voteCountdownHide', $request->only('seconds')));
    }

    public function hideAll()
    {
        event(new StreamOutputHasChanged(null, null));
    }
}
