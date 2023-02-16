<?php

namespace App\Http\Controllers\Api\Sponsoreds;

use App\Http\Controllers\Controller;
use App\Http\Resources\SponsoredResource;
use Illuminate\Http\Request;
use App\Models\Sponsored;

class SponsoredController extends Controller
{
    public function index(Request $request)
    {
        $sponsoreds = Sponsored::all();
        return SponsoredResource::collection($sponsoreds);
    }
}
