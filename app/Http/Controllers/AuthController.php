<?php

namespace App\Http\Controllers;

use App\Models\Explorer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:explorers',
            'password' => 'required|string|min:8',
            'age' => 'required|integer|min:0',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $explorer = Explorer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'age' => $request->age,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return response()->json($explorer, 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $explorer = Explorer::where('email', $request->email)->first();

        if (!$explorer || !Hash::check($request->password, $explorer->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $explorer->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
