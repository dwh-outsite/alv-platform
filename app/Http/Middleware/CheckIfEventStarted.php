<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;

class CheckIfEventStarted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->eventHasStarted() && !$request->routeIs('starting_soon')) {
            return redirect(route('starting_soon'));
        }

        if ($this->eventHasStarted() && $request->routeIs('starting_soon')) {
            return redirect(route('live'));
        }

        return $next($request);
    }

    private function eventHasStarted()
    {
        return Carbon::now()->isAfter(config('app.event.start_time'));
    }
}
