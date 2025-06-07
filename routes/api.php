<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\InstructorController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\ProspectController;
use App\Http\Controllers\Api\MembershipController;

Route::get('/', function (){ 
    return response()->json([
        'message' => 'BASIC API.'
    ], 200);
});

// Member authentication routes
Route::post('/members/register', [MemberController::class, 'register']);
Route::post('/members/login', [MemberController::class, 'login']);

// Protected routes
Route::middleware(['auth', 'web'])->group(function () {
    // Video routes
    Route::get('/videos', [VideoController::class, 'index']);
    Route::get('/videos/{id}', [VideoController::class, 'show']);

    // Member routes
    Route::get('/members', [MemberController::class, 'index']);
    Route::get('/members/{id}', [MemberController::class, 'show']);

    // Instructor routes
    Route::get('/instructors', [InstructorController::class, 'index']);
    Route::get('/instructors/{id}', [InstructorController::class, 'show']);

    // Event routes
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{id}', [EventController::class, 'show']);

    // Invoice routes
    Route::get('/invoices', [InvoiceController::class, 'index']);
    Route::get('/invoices/{id}', [InvoiceController::class, 'show']);

    // Prospect routes
    Route::get('/prospects', [ProspectController::class, 'index']);
    Route::get('/prospects/{id}', [ProspectController::class, 'show']);

    // Auth routes
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Membership routes
    Route::apiResource('memberships', MembershipController::class);
});
