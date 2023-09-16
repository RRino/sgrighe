<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anagrafica;
use App\Models\Associati;
use App\Models\Collegamenti;
use App\Models\Ruoli;
use App\Models\Ruoli_spec;
use Illuminate\Support\Facades\DB;

class AssociatiController extends Controller
{
    public function test(Request $request)
    {
        $viewData = [];
       // $viewData['associati'] = Associati::with("anagrafica")->get();
       //return Collegamenti::with("anagrafica")->get();
       //$viewData['ruoli'] = Ruoli::all();
       $viewData = [];
       $viewData['title'] = " associati";
      
       $viewData['ruoli'] = Ruoli::with(["ruoli_specb"])->get();
       $viewData['ruoli_spec'] = Ruoli_spec::all();
       $viewData['associati'] = Associati::with(["anagrafica"])->get();
    
       return $viewData;

        //return $viewData['associati'][0]->anagrafica->nome;
        //return Associati::with("anagrafica")->get();// vedi tutti
        // return Associati::find(1)->anagrafica()->get();
        //return Anagrafica::with("getAssociati")->get();// vedi tutti
    }

    public function index()
    {

        $viewData = [];
        $viewData['title'] = " associati";
       
        $viewData['ruoli'] = Ruoli::all();
        $viewData['ruoli_spec'] = Ruoli_spec::all();
        $viewData['associati'] = Associati::with(["anagrafica"])->get();
    
 

        return view('associati.index')->with("viewData", $viewData);
    }



}
