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

    public function consegne(){
        $viewData = [];
        $viewData["title"] = "Anagrafica Consegne";
        $viewData["consegnes"] = Consegne::orderBy('nome')->paginate(session('pag'));
        return view('consegne.consegne')->with("viewData", $viewData);
    }

    public function formAddConsegne(){
        $viewData = [];
        $viewData["title"] = "Aggiunge Consegne";
        $viewData["consegnes"] = Consegne::all();
        return view('consegne.formAddConsegne')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        Consegne::validate($request);
        $nome = $request->nome;
        $newconsegne = new Consegne();
        $newconsegne->setNome($request->input('nome'));
        $newconsegne->setSigla($request->input('sigla'));
        $newconsegne->save();
        //return back();
        return redirect('/consegne');

    }

    public function delete($id){
        Consegne::destroy($id);
        return redirect('/consegne');
    }
}
