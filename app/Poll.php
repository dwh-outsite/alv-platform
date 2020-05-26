<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $guarded = [];
    protected $with = ['options'];

    public static function getOpenPoll() {
        return static::where('status', 'open')->latest()->first();
    }

    public function isClosed()
    {
        return $this->status == 'closed';
    }

    public function options()
    {
        return $this->hasMany(PollOption::class);
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class)->withTimestamps();
    }

    public function admins()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function alreadyVoted($user)
    {
        if ($user instanceof User) {
            return $this->admins()->where('user_id', $user->id)->exists();
        }
        if ($user instanceof Participant) {
            return $this->participants()->where('participant_id', $user->id)->exists();
        }
        return true;
    }

    /**
     * Register that a user has voted, but not what the user voted for.
     *
     * @param $user Admin|Participant
     */
    public function registerVote($user)
    {
        if ($user instanceof User) {
            $this->admins()->attach($user);
        }
        if ($user instanceof Participant) {
            $this->participants()->attach($user);
        }
    }
}
