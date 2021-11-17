<?php

namespace App\Http\Controllers;

use App\Mail\Invite;
use App\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate(['privacy_consent' => 'required|accepted']);

        $participant = Participant::create(array_merge(
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:participants',
                'attendance' => ['required', 'string', Rule::in(['online', 'physical'])],
            ]),
            ['code' => Participant::generateCode()]
        ));

        Mail::to($participant->email)->queue(new Invite($participant));

        return view('register_confirmation', compact('participant'));
    }
}
