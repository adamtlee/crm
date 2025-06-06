<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view('dashboard.video', compact('videos'));
    }

    public function show(string $id)
    {
        $video = Video::findOrFail($id);
        return view('videos.show', compact('video'));
    }
}
