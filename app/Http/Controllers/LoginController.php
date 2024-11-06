<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    /**
     * Displays the login form.
     *
     * @return View
     */
    public function login(): View
    {
        return view('auth.login');
    }
}
