<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MembershipController extends Controller
{
    /**
     * Display a listing of the memberships.
     */
    public function index()
    {
        $memberships = Membership::all();
        return response()->json([
            'status' => 'success',
            'data' => $memberships
        ]);
    }

    /**
     * Display the specified membership.
     */
    public function show($id)
    {
        $membership = Membership::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $membership
        ]);
    }

    /**
     * Store a newly created membership in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:memberships',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $membership = Membership::create($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Membership created successfully',
            'data' => $membership
        ], 201);
    }

    /**
     * Update the specified membership in storage.
     */
    public function update(Request $request, $id)
    {
        $membership = Membership::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:memberships,name,' . $id,
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $membership->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Membership updated successfully',
            'data' => $membership
        ]);
    }

    /**
     * Remove the specified membership from storage.
     */
    public function destroy($id)
    {
        $membership = Membership::findOrFail($id);
        $membership->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Membership deleted successfully'
        ]);
    }
} 