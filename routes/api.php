<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PollingUnitController;
use App\Http\Controllers\API\LgaController;
use App\Http\Controllers\API\PartyController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/polling_units', [PollingUnitController::class, 'fetchAllPollingUnits']);

Route::get('/each_polling_unit_result/{id}', [PollingUnitController::class, 'fetchEachPollingUnit']);

Route::get('/each_LGA_result/{id}', [LgaController::class, 'fetchLGAResults']);

Route::get('/fetch_LGAs', [LgaController::class, 'fetchLGAs']);

Route::get('/parties', [PartyController::class, 'fetchParties']);

Route::post('/store_results', [PollingUnitController::class, 'store']);
