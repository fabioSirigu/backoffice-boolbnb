<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $homes = Home::with('services')->get();
        return response()->json([
            'success' => true,
            'data' => $homes
        ]);
    }
}
