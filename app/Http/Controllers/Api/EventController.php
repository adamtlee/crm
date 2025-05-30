<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return response()->json([
            'status' => 'success',
            'data' => $events
        ]);
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $event
        ]);
    }
} 