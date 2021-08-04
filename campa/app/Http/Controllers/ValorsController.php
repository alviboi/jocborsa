<?php

namespace App\Http\Controllers;

use App\Models\Valors;
use Illuminate\Http\Request;

class ValorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Valors::get();
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
     * @param  \App\Models\Valors  $valors
     * @return \Illuminate\Http\Response
     */
    public function show(Valors $valors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Valors  $valors
     * @return \Illuminate\Http\Response
     */
    public function edit(Valors $valors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Valors  $valors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Valors $valors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Valors  $valors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Valors $valors)
    {
        //
    }

    public function este()
    {
        //
        $valors=Valors::get();
        for ($i=1; $i < sizeof($valors)+1; $i++) { 
            # code...
            $aleatori=rand(7,13)/10;
            $valors2=Valors::where('id','=',$i)->first();
            $a=$valors2->valor;
            $valors2->valor=$a*$aleatori;
            $valors2->save();
            $valors2=null;
        }
    }
}
