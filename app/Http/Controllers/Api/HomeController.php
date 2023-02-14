<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function searchHomes($latitude, $longitude, $radius)
    {
        $radius = 6371;

        $filteredHomes = DB::select(DB::raw('SELECT *, ( ' . $radius . ' * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians(latitude) ) ) ) AS distance FROM homes WHERE visible=1 HAVING distance < 20 ORDER BY distance'));

        return response()->json([
            'result' => 'success',
            'data' => $filteredHomes,

        ]);
    }

    public function search($latitude, $longitude, $radius)
    {
        $radius = 6371;

        $filteredHomes = DB::select(DB::raw('SELECT *, ( ' . $radius . ' * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians(latitude) ) ) ) AS distance FROM homes WHERE visible=1 HAVING distance < 20 ORDER BY distance'));

        return response()->json([
            'result' => 'success',
            'data' => $filteredHomes,

        ]);
    }

    public function filterHomes($latitude, $longitude, $radius)
    {
        $radius = 6371;

        // Recupera i parametri di query dalla richiesta
        $rooms = request()->query('rooms');
        $services = request()->query('services');

        $query = 'SELECT *, ( ' . $radius . ' * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians(latitude) ) ) ) AS distance FROM homes WHERE visible=1';

        if ($rooms) {
            $query .= ' AND rooms = ' . $rooms;
        }

        if ($services) {
            // Esempio di filtro per servizi, aggiungi la logica specifica ai tuoi servizi
            $query .= ' AND services LIKE "%' . $services . '%"';
        }

        $query .= ' HAVING distance < 20 ORDER BY distance';

        $filteredHomes = DB::select(DB::raw($query));

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
