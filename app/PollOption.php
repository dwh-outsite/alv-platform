<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
    protected $guarded = [];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function incrementVotes()
    {
        if ($this->poll->isClosed()) {
            throw new PollClosedException('Cannot vote for a closed poll.');
        }

        $this->increment('votes');
    }
}
