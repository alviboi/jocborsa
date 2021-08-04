<?php

namespace App\Http\Controllers;

use App\Models\blau;
use Illuminate\Http\Request;
use App\Models\diners;
use App\Models\Valors;

class BlauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return blau::where('user_id','=',auth()->id())->get();

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
        $existeix = blau::where('user_id','=',auth()->id())->first();
        $diners_dat = diners::where('user_id','=',auth()->id())->first();
 
        if (!$diners_dat){
            $diners_dat = new diners();
            $diners_dat->user_id = auth()->id();
            $diners_dat->quantitat = 1500;
        } 

        $valor = Valors::where('producte','=','Blau')->first();
        if ($existeix){
            $dat = blau::find($existeix->id);
            $quantitat_old=$existeix->quantitat;
            $dat->id=$existeix->id;            
        } else {
            $dat = new blau();
            $quantitat_old=0;
        }
        $input = $request->all();
        if ($request->operacio == 'Compra') {
            $preu_total = $valor->valor*$request->quantitat;
            if ($diners_dat->quantitat>$preu_total){
                $valor_quantitat = $quantitat_old + $request->quantitat;
                $diners_dat->quantitat=$diners_dat->quantitat-$preu_total;
            } else {
                return response()->json([
                    'message' => 'No tens prou diners.'
                ], 404);
            }      
        } else {
            $valor_quantitat = $quantitat_old - $request->quantitat;


            if ($valor_quantitat < 0 ) {
                return response()->json([
                    'message' => 'No sigues tan listo. No en tens prou.'
                ], 404);
            } else {
                $preu_total = $request->quantitat * $valor->valor;
                $diners_dat->quantitat=$diners_dat->quantitat+$preu_total;
            }
        }
        $dat->quantitat = $valor_quantitat;
        $dat->user_id = auth()->id();
        $dat->save();
        $diners_dat->save();
        return response()->json([
            'message' => "Operació realitzada. Diners: ".$diners_dat->quantitat." Blau: ".$dat->quantitat,
            'quantitat' => $dat->quantitat,
            'diners' => $diners_dat->quantitat

        ], 200);    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\blau  $blau
     * @return \Illuminate\Http\Response
     */
    public function show(blau $blau)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\blau  $blau
     * @return \Illuminate\Http\Response
     */
    public function edit(blau $blau)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\blau  $blau
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, blau $blau)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\blau  $blau
     * @return \Illuminate\Http\Response
     */
    public function destroy(blau $blau)
    {
        //
    }
}
