<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Auth\UserProvider;

class ParticipantProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        return Participant::where((new Participant)->getAuthIdentifierName(), $identifier)->first();
    }

    public function retrieveByCredentials(array $credentials)
    {
        return Participant::where('code', $credentials['code'])->first();
    }

    public function validateCredentials(UserContract $user, array $credentials)
    {
        return strcmp($credentials['code'], $user->getAuthPassword() === 0);
    }

    public function updateRememberToken(UserContract $user, $token)
    {
        throw new \Exception("Rembering sessions is not supported");
    }

    public function retrieveByToken($identifier, $token)
    {
        throw new \Exception("Rembering sessions is not supported");
    }
}
