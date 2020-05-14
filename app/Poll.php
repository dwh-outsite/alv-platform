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

    public function isClosed()
    {
        return $this->status == 'closed';
    }
}
