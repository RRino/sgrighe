<?php

namespace App\Http\Controllers;

use App\Models\Consegne;
use Illuminate\Http\Request;

class ConsegneController extends Controller
{
   
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Consegne Rivista ";
        $viewData["subtitle"] = "Lista Consegne";
        $viewData["consegness"] = Consegne::all();
        return view('consegne.index')->with("viewData", $viewData);
    }

    public function show($id)
    {
        $viewData = [];
        $iscrizione = Consegne::findOrFail($id);
        $viewData["title"] = $iscrizione->getName()." - Consegne";
        $viewData["subtitle"] = $iscrizione->getName()." - Riviste";
        $viewData["consegne"] = $iscrizione;
        return view('consegne.show')->with("viewData", $viewData);
    }
}
