<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return response()->json([
            'status' => 'success',
            'data' => $members
        ]);
    }

    public function show($id)
    {
        $member = Member::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $member
        ]);
    }
} 