<?php

namespace App\Http\Controllers;

use App\Models\Kapal;
use App\Models\Spb;
use Illuminate\Http\Request;

class SpbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spb = Spb::with('spb')->get();
        return view('backend.spb.index', compact('spb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kapal = Kapal::all();
        return view('backend.spb.create', compact('kapal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spb  $spb
     * @return \Illuminate\Http\Response
     */
    public function show(Spb $spb)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spb  $spb
     * @return \Illuminate\Http\Response
     */
    public function edit(Spb $spb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spb  $spb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spb $spb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spb  $spb
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spb $spb)
    {
        //
    }
}
