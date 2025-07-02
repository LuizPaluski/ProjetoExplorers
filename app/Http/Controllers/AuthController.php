<?php

namespace App\Http\Controllers;

use App\Models\Explorer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http; // 1. Importe o cliente HTTP
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
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

//adiconado Api de localizacao para nao precisar colcor os numeros toda hora obs: usei ia para implementar
        $apiKey = config('app.geocode_api_key');
        $response = Http::get('https://geocode.maps.co/search', [
            'q' => $request->address,
            'api_key' => $apiKey,
        ]);

        if ($response->failed() || empty($response->json())) {
            return response()->json(['message' => 'Could not find coordinates for the address.'], 422);
        }

        $location = $response->json()[0];


        $explorer = Explorer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'age' => $request->age,
            'latitude' => $location['lat'],
            'longitude' => $location['lon'],
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
