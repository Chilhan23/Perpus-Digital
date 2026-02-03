<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function check()
    {
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('borrows.index');
    }
}
