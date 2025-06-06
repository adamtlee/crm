<?php

namespace App\Services;

use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MemberService
{
    public function createMemberWithUser(array $memberData, array $userData)
    {
        return DB::transaction(function () use ($memberData, $userData) {
            // Create the user first
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
            ]);

            // Create the member and associate with the user
            $member = Member::create([
                ...$memberData,
                'user_id' => $user->id,
            ]);

            return [
                'user' => $user,
                'member' => $member
            ];
        });
    }
} 