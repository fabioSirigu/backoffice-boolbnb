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
        $services = $request->input('services');
        $servicesArray = explode(',', $services);

        $filteredHomes = DB::select(DB::raw('SELECT *, ( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians(latitude) ) ) ) AS distance FROM homes WHERE visible=1' . ($rooms ? ' AND rooms=' . $rooms : '') . ($services ? ' AND (' . implode(' OR ', array_fill(0, count($servicesArray), 'services LIKE ?')) . ')' : '') . ' HAVING distance < 20 ORDER BY distance'), $servicesArray);

        return response()->json([
            'result' => 'success',
            'data' => $filteredHomes,
        ]);
    }

    public function getServices()
    {
        $services = DB::table('services')->get();
        return response()->json([
            'result' => 'success',
            'data' => $services,
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
