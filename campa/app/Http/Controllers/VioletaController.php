<?php

namespace App\Http\Controllers;

use App\Models\violeta;
use Illuminate\Http\Request;
use App\Models\diners;
use App\Models\Valors;

class VioletaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return violeta::where('user_id','=',auth()->id())->get();

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
        $existeix = violeta::where('user_id','=',auth()->id())->first();
        $diners_dat = diners::where('user_id','=',auth()->id())->first();
 
        if (!$diners_dat){
            $diners_dat = new diners();
            $diners_dat->user_id = auth()->id();
            $diners_dat->quantitat = 1500;
        } 

        $valor = Valors::where('producte','=','Violeta')->first();
        if ($existeix){
            $dat = violeta::find($existeix->id);
            $quantitat_old=$existeix->quantitat;
            $dat->id=$existeix->id;            
        } else {
            $dat = new violeta();
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
            'message' => "Operaci?? realitzada. Diners: ".$diners_dat->quantitat." Violeta: ".$dat->quantitat,
            'quantitat' => $dat->quantitat,
            'diners' => $diners_dat->quantitat

        ], 200);    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\violeta  $violeta
     * @return \Illuminate\Http\Response
     */
    public function show(violeta $violeta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\violeta  $violeta
     * @return \Illuminate\Http\Response
     */
    public function edit(violeta $violeta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\violeta  $violeta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, violeta $violeta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\violeta  $violeta
     * @return \Illuminate\Http\Response
     */
    public function destroy(violeta $violeta)
    {
        //
    }
}
