<?php

namespace App\Http\Controllers\Admin;

use App\Events\PollStatusHasChanged;
use App\Http\Controllers\Controller;
use App\Poll;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function update(Poll $poll, Request $request)
    {
        $poll->update(
            $request->validate(['status' => 'required|in:open,closed'])
        );

        event(new PollStatusHasChanged($poll));
    }
}
