<?php

namespace App\Http\Controllers;

use App\Models\Consegne;
use Illuminate\Http\Request;

class AnagraficheController extends Controller
{
    public function home(){

        return view('anagrafiche.anagraficheHome');
    }

    public function consegne(){

        $viewData = [];
        $viewData["title"] = "Anagrafica Consegne";

        $viewData["consegnes"] = Consegne::orderBy('nome')->paginate(session('pag'));
        return view('anagrafiche.consegne')->with("viewData", $viewData);
    }

    public function formAddConsegne(){

        $viewData = [];
        $viewData["title"] = "Aggiunge Consegne";
        $viewData["consegnes"] = Consegne::all();
     
        return view('anagrafiche.formAddConsegne')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        Consegne::validate($request);
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
