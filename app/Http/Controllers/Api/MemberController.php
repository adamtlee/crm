<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Services\MemberService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class MemberController extends Controller
{
    protected $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function index()
    {
        $members = Member::with('user')->get();
        return response()->json([
            'status' => 'success',
            'data' => $members
        ]);
    }

    public function show($id)
    {
        $member = Member::with('user')->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $member
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            // User data
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            
            // Member data
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'phone_number' => 'required|string|max:20',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone_number' => 'required|string|max:20',
            'membership_id' => 'required|exists:memberships,id',
        ]);

        $result = $this->memberService->createMemberWithUser(
            $request->only([
                'first_name',
                'last_name',
                'birth_date',
                'phone_number',
                'emergency_contact_name',
                'emergency_contact_phone_number',
                'membership_id',
            ]),
            $request->only(['name', 'email', 'password'])
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Member registered successfully',
            'data' => [
                'user' => $result['user'],
                'member' => $result['member']
            ]
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('member-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => [
                'user' => $user,
                'member' => $user->member,
                'token' => $token
            ]
        ]);
    }
} 