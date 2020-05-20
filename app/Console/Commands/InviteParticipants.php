<?php

namespace App\Console\Commands;

use App\Mail\Invite;
use App\Participant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class InviteParticipants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'participants:invite';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Invite the participants in the database.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Participant::all()->each(fn ($participant) => Mail::to($participant->email)->queue(new Invite($participant)));
    }
}
