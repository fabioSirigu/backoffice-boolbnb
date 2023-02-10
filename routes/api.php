<?php

use App\Http\Controllers\api\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Home;

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
