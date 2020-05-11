<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    protected $with = ['participant'];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
