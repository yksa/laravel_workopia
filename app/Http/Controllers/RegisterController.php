<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    /**
     * Displays the registration form.
     *
     * @return View
     */
    public function register(): View
    {
        return view('auth.register');
    }
}
