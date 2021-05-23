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

    public function getNameAttribute()
    {
        return is_null($this->participant) ? $this->custom_name : $this->participant->name;
    }

    public function toArray()
    {
        return array_merge(parent::toArray(), ['name' => $this->name]);
    }
}
