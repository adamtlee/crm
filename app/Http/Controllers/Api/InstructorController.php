<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index()
    {
        $instructors = Instructor::all();
        return response()->json([
            'status' => 'success',
            'data' => $instructors
        ]);
    }

    public function show($id)
    {
        $instructor = Instructor::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $instructor
        ]);
    }
} 