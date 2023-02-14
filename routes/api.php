<?php

use App\Http\Controllers\api\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Home;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Auth\Guard\ApiGuard;

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

Route::get('/homes/{latitude}/{logitude}/{radius}', [HomeController::class, 'searchHomes']);

Route::get('/services', [HomeController::class, 'getServices']);

Route::get('/search/{latitude}/{logitude}/{radius}', [HomeController::class, 'search'])->name('search');

Route::middleware(['auth:api'])->get('/api/user', function (Request $request) {
    if ($request->user()) {
        $user = $request->user();
        return response()->json(['data' => $user]);
    } else {
        return response()->json(['error' => 'Utente non autenticato']);
    }
});
