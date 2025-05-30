<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return response()->json([
            'status' => 'success',
            'data' => $videos
        ]);
    }

    public function show($id)
    {
        $video = Video::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $video
        ]);
    }
} 