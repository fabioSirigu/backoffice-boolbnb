<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SponsoredController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/messages', 'MessageController@store');

Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('homes', HomeController::class)->parameters([
        'homes' => 'home:slug'
    ]);

    Route::resource('services', ServiceController::class)->parameters([
        'services' => 'service:slug'
    ]);

    Route::resource('sponsored', SponsoredController::class)->parameters([
        'sponsored' => 'sponsored:slug'
    ]);
});



require __DIR__ . '/auth.php';
