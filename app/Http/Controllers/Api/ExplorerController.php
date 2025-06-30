<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Explorer;
use Illuminate\Http\Request;

class ExplorerController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $explorer = Explorer::create($validatedData);

        return response()->json($explorer, 201);
    }

    public function show($id)
    {
        $explorer = Explorer::with('items')->findOrFail($id);
        return response()->json($explorer);
    }

    public function updateLocation(Request $request, $id)
    {
        $validatedData = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $explorer = Explorer::findOrFail($id);
        $explorer->update($validatedData);

        return response()->json($explorer);
    }
}
