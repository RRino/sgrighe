<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anagrafica;
use App\Models\Associati;

class AssociatiController extends Controller
{
    public function test(Request $request)
    {

        $viewData = [];
        $viewData['associati'] = Associati::with("anagrafica")->get();

        return $viewData['associati'][0]->anagrafica->nome;
        //return Associati::with("anagrafica")->get();// vedi tutti
        // return Associati::find(1)->anagrafica()->get();
        //return Anagrafica::with("getAssociati")->get();// vedi tutti
    }

    public function index()
    {

        $viewData = [];
        $viewData['title'] = " associati";
        
        $viewData['associati'] = Associati::with("anagrafica")->get();

         
        return view('associati.index')->with("viewData", $viewData);
    }
}
