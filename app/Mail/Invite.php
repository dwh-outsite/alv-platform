<?php

namespace App\Mail;

use App\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invite extends Mailable
{
    use Queueable, SerializesModels;

    public Participant $participant;

    /**
     * Create a new message instance.
     *
     * @param Participant $participant
     */
    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Inlogcode voor aankomende DWH ALV')
            ->markdown('emails.participants.invite');
    }
}
