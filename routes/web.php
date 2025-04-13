<?php

use App\Http\Controllers\ProspectController; 
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard routes
    Route::get('dashboard', function () {
        return view('dashboard.overview');
    })->name('dashboard');

    Route::get('dashboard/membership', function () {
        return view('dashboard.membership');
    })->name('dashboard.membership');

    Route::get('dashboard/attendance', function () {
        return view('dashboard.attendance');
    })->name('dashboard.attendance');

    Route::get('dashboard/billing', function () {
        return view('dashboard.billing');
    })->name('dashboard.billing');

    // Settings routes
    Route::redirect('settings', 'settings/profile');
    Route::resource('prospects', ProspectController::class);
    Route::resource('videos', VideoController::class);
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
