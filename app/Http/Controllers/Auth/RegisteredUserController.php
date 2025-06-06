<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Member;
use App\Models\Membership;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'phone_number' => ['required', 'string', 'max:20'],
            'emergency_contact_name' => ['required', 'string', 'max:255'],
            'emergency_contact_phone_number' => ['required', 'string', 'max:20'],
        ]);

        // Get or create a basic membership
        $membership = Membership::firstOrCreate(
            ['name' => 'Basic'],
            ['description' => 'Basic membership plan']
        );

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create the member profile
        Member::create([
            'user_id' => $user->id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birth_date' => $request->birth_date,
            'email_address' => $request->email,
            'phone_number' => $request->phone_number,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone_number' => $request->emergency_contact_phone_number,
            'membership_id' => $membership->id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
} 