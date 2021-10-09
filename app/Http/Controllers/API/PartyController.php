<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Party;
class PartyController extends Controller
{
    public function fetchParties(){

        $result = Party::all();

        return response()->json([
            'message' => 'successful',
            'content' => $result,
        ]);
    }
}
