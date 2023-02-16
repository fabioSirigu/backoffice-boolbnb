<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SponsoredController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\admin\SponsorshipController;


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

    Route::resource('messages', MessageController::class)->except(['create', 'edit', 'update', 'destroy']);

    Route::resource('sponsorship', SponsorshipController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);
});



require __DIR__ . '/auth.php';
