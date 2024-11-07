<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function update(Request $request): RedirectResponse
    {
        $user = User::find(Auth::user()->id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }
}
