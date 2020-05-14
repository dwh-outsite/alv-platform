<?php

use App\User as Admin;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('polls', function ($user) {
    return $user->id > 0;
});

Broadcast::channel('admin-polls', function ($user) {
    return $user instanceof Admin;
});

Broadcast::channel('questions', function ($user) {
    return $user instanceof Admin;
});

Broadcast::channel('participants', function ($user) {
    return ['id' => $user->id, 'name' => $user->name, 'type' => $user instanceof Admin ? 'admin' : 'participant'];
});
