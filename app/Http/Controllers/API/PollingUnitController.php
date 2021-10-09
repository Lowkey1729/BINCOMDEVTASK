<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnnouncedPuResult;
use App\Models\PollingUnit;

class PollingUnitController extends Controller
{
    public function fetchEachPollingUnit($id) {
       $result = PollingUnit::find($id);
       return response()->json([
           'message' => 'successful',
           'content' => $result->announcedPuResults()->get(),
           'polling_details' => $result,
       ], 200);
    }

    public function fetchAllPollingUnits(){
        $result = PollingUnit::all();

        return response()->json([
            'message' => 'successful',
            'content' => $result,
        ], 200);
    }

    public function store(Request $request){

        $details = AnnouncedPuResult::create([
            'polling_unit_uniqueid' => $request->pollingUnit,
            'party_abbreviation' => $request->party,
            'party_score' => $request->party_score,
            'entered_by_user' => $request->entered_by_user,
            'user_ip_address' => $_SERVER['REMOTE_ADDR'],
        ]);


        return response()->json([
            'message' => 'successful',
            'content' => $details,
        ], 200);

    }
}
