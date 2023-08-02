<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\CustomerProfile;
use App\Http\Requests\CustomerProfileRequest;

class CustomerProfileController extends Controller
{
    public function store(CustomerProfileRequest $request)
    {
        try {
            $customerProfile = CustomerProfile::create($request->validated());
            return response()->json([
                'status' => 'success',
                'message' => "UserRegistration successful"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => "UserRegistration failed"
            ], 401);
        }
    }

    public function update(CustomerProfileRequest $request, CustomerProfile $customerProfile)
    {
        try {

            $customerProfile->update($request->validated());
            return response()->json([
                'status' => 'success',
                'message' => "UserRegistration successful"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => "UserRegistration failed"
            ], 401);
        }
    }
}
