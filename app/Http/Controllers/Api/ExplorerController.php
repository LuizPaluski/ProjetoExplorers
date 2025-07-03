<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LocationHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExplorerController extends Controller
{
    public function update(Request $request)
    {

        $explorer = $request->user();

        $validator = Validator::make($request->all(), [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        LocationHistory::create([
            'explorer_id' => $explorer->id,
            'latitude' => $explorer->latitude,
            'longitude' => $explorer->longitude,
        ]);


        $explorer->update($request->only(['latitude', 'longitude']));

        return response()->json($explorer);
    }

    public function show(Request $request)
    {

        $explorer = $request->user()->load('items');
        return response()->json($explorer);
    }

    public function history(Request $request)
    {

        $history =  $request->user()->locationHistories()->orderBy('created_at', 'desc')->get();
        dd( response()->json($history));


    }
}
