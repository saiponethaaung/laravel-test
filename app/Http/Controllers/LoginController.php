<?php

namespace App\Http\Controllers;

use App\Http\Requests\V1\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => 404,
                'message' => 'Invalid credentials'
            ]);
        }

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('User-Token')->plainTextToken
        ]);
    }
}
