<?php

namespace App\Http\Controllers;

use App\PollClosedException;
use App\PollOption;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function store(PollOption $pollOption, Request $request)
    {
        // Check if user has already voted. We do this using sessions, since storing the voters (participants) would
        // result in non-anonymous voting.
        if (in_array($pollOption->id, session()->get('polls_voted', []))) {
            return response(['error' => 'Cannot vote twice for the same poll.'], 422);
        }

        try {
            $pollOption->incrementVotes();
            session()->push('polls_voted', $pollOption->id);

            return response([], 200);
        } catch (PollClosedException $exception) {
            return response(['error' => $exception->getMessage()], 422);
        }
    }
}
