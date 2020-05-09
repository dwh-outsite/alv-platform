<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model implements Authenticatable
{
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
        throw new \Exception("Rembering sessions is not supported.");
    }

    public function setRememberToken($value)
    {
        throw new \Exception("Rembering sessions is not supported.");
    }

    public function getRememberTokenName()
    {
        throw new \Exception("Rembering sessions is not supported.");
    }
}
