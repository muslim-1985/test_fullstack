<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppController;
use App\Models\PublishingHouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublishingHouseController extends AppController
{
    public function storePublishingHouse (Request $request)
    {
        $request->validate([
            'name'=>'required|max:255'
        ]);
        try {
            PublishingHouse::create($request->all());
            return response()->json(['message' => 'PublishingHouse create success']);
        } catch (\Exception $e) {
            return response()->json(['message'=>'some error'], 500);
        }
    }
    public function getPublishingHouses ()
    {
        try {
            $houses = PublishingHouse::all();
            return response()->json(['houses' => $houses]);
        } catch (\Exception $e) {
            return response()->json(['message'=>'some error'], 500);
        }
    }
}
