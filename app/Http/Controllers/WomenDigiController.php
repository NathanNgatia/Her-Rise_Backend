<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WomenDigi;

class WomenDigiController extends Controller
{

    public function createWomenDigi(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location_id' => 'required|integer|exists:locations,id'
        ]);

        $womendigi = new WomenDigi;
        $womendigi->name = $request->name;
        $womendigi->description = $request->description;
        $womendigi->location_id = $request->location_id;
        $womendigi->save();

        $womendigiCheck = WomenDigi::find($womendigi->id);

        return response()->json($womendigiCheck);
    }

    
    public function getAllWomenDigi()
    {
        $womendigi = womendigi::all();
        if ($womendigi) {
            return response()->json($womendigi);
        } else {
            return response("No womendigi was found.");
        }
    }

    //Get a womendigi
    public function getWomenDigi($id)
    {
        try {
            $womendigi = WomenDigi::findOrFail($id);
            return response()->json($womendigi);
        } catch (\Exception $e) {
            return response()->json([
                "error" => "womendigi Not found with id: ",
                $id
            ], 404);
        }
    }

    //Update a womendigi
    public function updateWomenDigi(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'location_id' => 'required|integer|exists:locations,id'
        ]);
        try {
            $existingwomendigi = womendigi::findOrFail($id);
            if ($existingwomendigi) {
                $existingwomendigi->name = $request->name;
                $existingwomendigi->description = $request->description;
                $existingwomendigi->location_id = $request->location_id;
                $existingwomendigi->save();

                return response()->json($existingwomendigi);
            } else {
                response()->json("No Record Found!");
            }
        } catch (\Exception $e) {
            return response()->json([
                "error" => "womendigi could not be updated!"
            ], 404);
        }
    }

    public function deleteWomenDigi($id)
    {
        try {
            $existingwomendigi = womendigi::findOrFail($id);
            if ($existingwomendigi) {                
                $existingwomendigi->delete();
                return response()->json([
                    "deleted" => $existingwomendigi
                ]);
            } else {
                return response("womendigi does not exist");
            }
        } catch (\Exception $e) {
            return response()->json([
                "error" => "womendigi could not be deleted!"
            ], 403);
        }
    }
}
