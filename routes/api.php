<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\MemberController;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/members', function(){
        return response()->json(['message' => 'Route hit!']);
    });
}); 