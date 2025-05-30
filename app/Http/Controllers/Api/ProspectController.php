<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prospect;
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    public function index()
    {
        $prospects = Prospect::all();
        return response()->json([
            'status' => 'success',
            'data' => $prospects
        ]);
    }

    public function show($id)
    {
        $prospect = Prospect::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $prospect
        ]);
    }
} 