<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Firewall\Vendor\Laravel\Facade as Firewall;

class FirewallController extends Controller
{
    public function __invoke(Request $request)
    {
        ['ip' => $ip] = $request->validate(['ip' => 'required']);

        if (!Firewall::blacklist($ip)) {
            return response('Blocking this IP failed.', 500);
        }

        return back()->with('message', 'The IP has been blocked.');
    }
}
