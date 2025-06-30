<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TradeController extends Controller
{
    public function trade(Request $request)
    {
        $validatedData = $request->validate([
            'explorer1_id' => 'required|exists:explorers,id',
            'explorer2_id' => 'required|exists:explorers,id|different:explorer1_id',
            'explorer1_items' => 'required|array',
            'explorer1_items.*' => 'exists:items,id',
            'explorer2_items' => 'required|array',
            'explorer2_items.*' => 'exists:items,id',
        ]);

        $explorer1Items = Item::whereIn('id', $validatedData['explorer1_items'])
            ->where('explorer_id', $validatedData['explorer1_id']);

        $explorer2Items = Item::whereIn('id', $validatedData['explorer2_items'])
            ->where('explorer_id', $validatedData['explorer2_id']);

        if ($explorer1Items->count() !== count($validatedData['explorer1_items']) ||
            $explorer2Items->count() !== count($validatedData['explorer2_items'])) {
            return response()->json(['error' => 'One or more items do not belong to the specified explorer.'], 400);
        }

        $explorer1Value = $explorer1Items->sum('value');
        $explorer2Value = $explorer2Items->sum('value');

        if ($explorer1Value !== $explorer2Value) {
            return response()->json(['error' => 'The value of the items being traded is not equivalent.'], 400);
        }

        DB::transaction(function () use ($validatedData, $explorer1Items, $explorer2Items) {
            $explorer1Items->update(['explorer_id' => $validatedData['explorer2_id']]);
            $explorer2Items->update(['explorer_id' => $validatedData['explorer1_id']]);
        });

        return response()->json(['message' => 'Trade successful.']);
    }
}
