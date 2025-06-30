<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Explorer;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'explorer_id' => 'required|exists:explorers,id',

        ]);

        $item = Item::create($validatedData);

        return response()->json($item, 201);
    }

    public function show(Request $request){
        $item = Item::all()->only('value');
        if($item > "100" ){
            $item = Item::all()->count();
        }
        $item2 = Item::all()->sum('value');
        return response()->json([$item2, $item], 200 );
    }
}
