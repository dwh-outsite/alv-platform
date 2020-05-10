<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model implements Authenticatable
{
    /* Authenticatable methods */

    public function getAuthIdentifierName()
    {
       return 'id';
    }

    public function getAuthIdentifier()
    {
       return $this->id;
    }

    public function getAuthPassword()
    {
       return $this->code;
    }

    public function getRememberToken()
    {
        // Not implemented
    }

    public function setRememberToken($value)
    {
        throw new \Exception("Rembering sessions is not supported.");
    }

    public function getRememberTokenName()
    {
        throw new \Exception("Rembering sessions is not supported.");
    }

    /* End of authenticatable methods */

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
