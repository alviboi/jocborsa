<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\blau;
use App\Models\groc;
use App\Models\diners;
use App\Models\indigo;
use App\Models\roig;
use App\Models\taronja;
use App\Models\Valors;
use App\Models\verd;
use App\Models\violeta;


use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $total=array();
        $User=User::get();
        $Valors=Valors::all();
        foreach ($User as $value) {
            # code...
            
            $Blau=Blau::where('id','=',$value['id'])->first();
            $Groc=Groc::where('id','=',$value['id'])->first();
            $diners=Diners::where('id','=',$value['id'])->first();
            $Indigo=Indigo::where('id','=',$value['id'])->first();
            $roig=roig::where('id','=',$value['id'])->first();
            $Taronja=Taronja::where('id','=',$value['id'])->first();
            // return $Valors;;
            $Verd=Verd::where('id','=',$value['id'])->first();
            $Violeta=Violeta::where('id','=',$value['id'])->first();
            $total[$value['name']]=$roig['quantitat']*$Valors[0]['valor']+$Taronja['quantitat']*$Valors[1]['valor']+$Groc['quantitat']*$Valors[2]['valor']+$Verd['quantitat']*$Valors[3]['valor']+$Blau['quantitat']*$Valors[4]['valor']+$Indigo['quantitat']*$Valors[5]['valor']+$Violeta['quantitat']*$Valors[6]['valor']+$diners['quantitat'];

        }
        arsort($total);

        return $total;
        
        

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
