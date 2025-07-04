<?php

use App\Http\Controllers\ProspectController; 
use App\Http\Controllers\VideoController;
use App\Http\Controllers\Dashboard\BillingController;
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

    Route::get('dashboard/billing', [BillingController::class, 'index'])->name('dashboard.billing');

    Route::get('dashboard/video', [VideoController::class, 'index'])->name('dashboard.video');

    // Settings routes
    Route::redirect('settings', 'settings/profile');
    Route::resource('prospects', ProspectController::class);
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('invoices/export-csv', [\App\Http\Controllers\Api\InvoiceController::class, 'exportCsv'])->name('invoices.export.csv');
});

require __DIR__.'/auth.php';
