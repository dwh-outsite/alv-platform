<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        if (auth()->attempt($request->validate(['code' => 'required']))) {
            return redirect()->route('live');
        }
        return back()->withErrors(['code' => 'The entered code is not correct, please try again.']);
    }
}
