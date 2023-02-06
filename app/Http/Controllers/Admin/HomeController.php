<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Home;
use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\UpdateHomeRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homes = Home::orderByDesc('id')->get();
        //dd($homes);
        return view('admin.homes.index', compact('homes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.homes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHomeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHomeRequest $request)
    {
        $val_data = $request->validated();

        if ($request->hasFile('cover_image')) {

            $cover_image = Storage::put('uploads', $val_data['cover_image']);
            $val_data['cover_image'] = $cover_image;
        }

        $slug_data = Home::createSlug($val_data['title']);

        $val_data['slug'] =  $slug_data;

        $val_data['user_id'] = Auth::id();

        $home = Home::create($val_data);

        /* if ($request->has('technologies')) {
            $home->technologies()->attach($val_data['technologies']);
        } */

        return to_route('admin.homes.index')->with('message', "The home: $home->title added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function show(Home $home)
    {
        return view('admin.homes.show', compact('home'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function edit(Home $home)
    {
        return view('admin.homes.edit', compact('home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHomeRequest  $request
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHomeRequest $request, Home $home)
    {
        $val_data = $request->validated();

        /*  if ($request->hasFile('cover_image')) {
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }
            $cover_image = Storage::put('uploads', $val_data['cover_image']);
            $val_data['cover_image'] = $cover_image;
        } */
        $slug_data = Home::createSlug($val_data['title']);
        $val_data['slug'] =  $slug_data;
        //$home = Home::create($val_data);
        $home->update($val_data);
        /* if ($request->has('technologies')) {
            $home->technologies()->sync($val_data['technologies']);
        } else {
            $home->technologies()->sync([]);
        } */

        // return redirect()->route('admin.homes.index');
        return to_route('admin.homes.index')->with('message', "The home: $home->title update successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Home  $home
     * @return \Illuminate\Http\Response
     */
    public function destroy(Home $home)
    {
        if ($home->cover_image) {
            Storage::delete($home->cover_image);
        }

        // return redirect()->route('products.index');
        $home->delete();
        return redirect()->route('admin.homes.index')->with('message', "The home: $home->title deleted successfully");
    }
}
