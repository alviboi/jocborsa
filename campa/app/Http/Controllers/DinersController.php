<?php

namespace App\Http\Controllers;

use App\Models\diners;
use Illuminate\Http\Request;

class DinersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $diners_dat=diners::where('user_id','=',auth()->id())->first();
        
        if (!$diners_dat){
            $diners_dat = new diners();
            $diners_dat->user_id = auth()->id();
            $diners_dat->quantitat = 1500;
            $diners_dat->save();
        }  
        return $diners_dat->quantitat;

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
     * @param  \App\Models\diners  $diners
     * @return \Illuminate\Http\Response
     */
    public function show(diners $diners)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\diners  $diners
     * @return \Illuminate\Http\Response
     */
    public function edit(diners $diners)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\diners  $diners
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, diners $diners)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\diners  $diners
     * @return \Illuminate\Http\Response
     */
    public function destroy(diners $diners)
    {
        //
    }
}
