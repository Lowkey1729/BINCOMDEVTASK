<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lga;
use App\Models\PollingUnit;

class LgaController extends Controller
{
    public function fetchLGAResults($id){

        $result = Lga::find($id);

        return response()->json([
            'message' => 'successful',
            'content' => $result->announcedLgaResults()->get(),
            'lga_details' => $result,
        ], 200);

    }

    public function fetchLGAs() {
        $result = Lga::all();

        return response()->json([
            'message' => 'successful',
            'content' => $result,
        ], 200);
    }
}
