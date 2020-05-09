<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    public function options()
    {
        return $this->hasMany(PollOption::class);
    }

    public function isClosed()
    {
        return $this->status == 'closed';
    }
}
