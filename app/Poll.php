<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $guarded = [];
    protected $with = ['options'];

    public function options()
    {
        return $this->hasMany(PollOption::class);
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class);
    }

    public function participantHasVotedAlready($participant)
    {
        return $this->participants()->where('participant_id', $participant->id)->exists();
    }

    /**
     * Register that a participant has voted, but not what the participant voted for.
     */
    public function registerVoteByParticipant($participant)
    {
        $this->participants()->attach($participant);
    }

    public function isClosed()
    {
        return $this->status == 'closed';
    }
}
