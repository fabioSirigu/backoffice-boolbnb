<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function searchHomes($latitude, $longitude, $radius, Request $request)
    {
        $rooms = $request->input('rooms');

        $filteredHomes = DB::select(DB::raw('SELECT *, ( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians(latitude) ) ) ) AS distance FROM homes WHERE visible=1' . ($rooms ? ' AND rooms=' . $rooms : '') . ' HAVING distance < 20 ORDER BY distance'));

        return response()->json([
            'result' => 'success',
            'data' => $filteredHomes,
        ]);
    }

    public function index()
    {
        $homes = Home::with('services')->get();
        if ($homes) {
            return response()->json([
                'success' => true,
                'data' => $homes
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Nessuna Casa trovata.'
            ]);
        }
    }

    public function show($slug)
    {
        $homes = Home::with('services')->where('slug', $slug)->first();

        if ($homes) {
            return response()->json([
                'success' => true,
                'data' => $homes
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Nessuna Casa trovata.'
            ]);
        }
    }
}
