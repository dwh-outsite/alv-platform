<?php

namespace App\Providers;

use App\Participant;
use App\ParticipantProvider;
use Illuminate\Auth\SessionGuard;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        auth()->extend('participants-session', function ($app) {
            $provider = new ParticipantProvider(Participant::class);

            return new SessionGuard('participants-session', $provider, $app->make('session.store'));
        });
    }
}
