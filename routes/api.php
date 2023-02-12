<?php

use App\Http\Controllers\api\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Home;
use Illuminate\Support\Facades\DB;

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

Route::get('/homes', [HomeController::class, 'index']);
Route::get('/homes/{home:slug}', [HomeController::class, 'show']);

Route::get('homes/filter', function (Request $request) {

    $latitude = $request->input('latitude');
    $longitude = $request->input('longitude');
    $radius = 20; // 20 km

    $filteredHomes = DB::table('homes')
        ->select(DB::raw("*, ( 6371 * acos( cos( radians({$latitude}) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians({$longitude}) ) + sin( radians({$latitude}) ) * sin( radians( latitude ) ) ) ) AS distance"))
        ->having('distance', '<', $radius)
        ->get();

    return response()->json($filteredHomes);
});
