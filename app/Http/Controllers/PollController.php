<?php

namespace App\Http\Controllers;

use App\Events\PollVotesHaveChanged;
use App\PollClosedException;
use App\PollOption;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function store(PollOption $pollOption, Request $request)
    {
        if ($pollOption->poll->participantHasVotedAlready($request->user())) {
            return response(['error' => 'Cannot vote twice for the same poll.'], 422);
        }

        try {
            $pollOption->incrementVotes();

            $pollOption->poll->registerVoteByParticipant($request->user());

            event(new PollVotesHaveChanged($pollOption->poll));

            return response([], 200);
        } catch (PollClosedException $exception) {
            return response(['error' => $exception->getMessage()], 422);
        }
    }
}
