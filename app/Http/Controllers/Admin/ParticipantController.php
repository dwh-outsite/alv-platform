<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Participant;

class ParticipantController extends Controller
{
    public function __invoke(Participant $participant)
    {
        return view('admin.participant', compact('participant'));
    }
}
