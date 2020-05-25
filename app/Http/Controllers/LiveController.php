<?php

namespace App\Http\Controllers;

use App\Poll;
use Illuminate\Http\Request;

class LiveController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('live', [
            'poll' => Poll::getOpenPoll()
        ]);
    }
}
