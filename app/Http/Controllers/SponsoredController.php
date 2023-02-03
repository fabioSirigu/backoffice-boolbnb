<?php

namespace App\Http\Controllers;

use App\Models\Sponsored;
use App\Http\Requests\StoreSponsoredRequest;
use App\Http\Requests\UpdateSponsoredRequest;

class SponsoredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSponsoredRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSponsoredRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsored  $sponsored
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsored $sponsored)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsored  $sponsored
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsored $sponsored)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSponsoredRequest  $request
     * @param  \App\Models\Sponsored  $sponsored
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSponsoredRequest $request, Sponsored $sponsored)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsored  $sponsored
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsored $sponsored)
    {
        //
    }
}
