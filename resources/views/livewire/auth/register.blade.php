<?php

use App\Models\Member;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|string|email|max:255|unique:users')]
    public string $email = '';

    #[Validate('required|string|min:8|confirmed')]
    public string $password = '';

    public string $password_confirmation = '';

    #[Validate('required|string|max:255')]
    public string $first_name = '';

    #[Validate('required|string|max:255')]
    public string $last_name = '';

    #[Validate('required|date')]
    public string $birth_date = '';

    #[Validate('required|string|max:20')]
    public string $phone_number = '';

    #[Validate('required|string|max:255')]
    public string $emergency_contact_name = '';

    #[Validate('required|string|max:20')]
    public string $emergency_contact_phone_number = '';

    public function register(): void
    {
        $this->validate();

        // Get or create a basic membership
        $membership = Membership::firstOrCreate(
            ['name' => 'Basic'],
            ['description' => 'Basic membership plan']
        );

        // Create the user
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Create the member profile
        Member::create([
            'user_id' => $user->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'birth_date' => $this->birth_date,
            'email_address' => $this->email,
            'phone_number' => $this->phone_number,
            'emergency_contact_name' => $this->emergency_contact_name,
            'emergency_contact_phone_number' => $this->emergency_contact_phone_number,
            'membership_id' => $membership->id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create your account')" :description="__('Enter your information below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Account Information -->
        <div class="space-y-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Account Information') }}</h3>
            
            <flux:input
                wire:model="name"
                :label="__('Name')"
                type="text"
                required
                autofocus
                autocomplete="name"
                placeholder="John Doe"
            />

            <flux:input
                wire:model="email"
                :label="__('Email address')"
                type="email"
                required
                autocomplete="username"
                placeholder="email@example.com"
            />

            <flux:input
                wire:model="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="new-password"
                placeholder="••••••••"
            />

            <flux:input
                wire:model="password_confirmation"
                :label="__('Confirm Password')"
                type="password"
                required
                autocomplete="new-password"
                placeholder="••••••••"
            />
        </div>

        <!-- Member Information -->
        <div class="space-y-4">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Member Information') }}</h3>

            <div class="grid grid-cols-2 gap-4">
                <flux:input
                    wire:model="first_name"
                    :label="__('First Name')"
                    type="text"
                    required
                    placeholder="John"
                />

                <flux:input
                    wire:model="last_name"
                    :label="__('Last Name')"
                    type="text"
                    required
                    placeholder="Doe"
                />
            </div>

            <flux:input
                wire:model="birth_date"
                :label="__('Birth Date')"
                type="date"
                required
            />

            <flux:input
                wire:model="phone_number"
                :label="__('Phone Number')"
                type="tel"
                required
                placeholder="(123) 456-7890"
            />

            <flux:input
                wire:model="emergency_contact_name"
                :label="__('Emergency Contact Name')"
                type="text"
                required
                placeholder="Jane Doe"
            />

            <flux:input
                wire:model="emergency_contact_phone_number"
                :label="__('Emergency Contact Phone')"
                type="tel"
                required
                placeholder="(123) 456-7890"
            />
        </div>

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">{{ __('Register') }}</flux:button>
        </div>
    </form>

    @if (Route::has('login'))
        <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
            {{ __('Already have an account?') }}
            <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
        </div>
    @endif
</div>
