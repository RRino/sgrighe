<?php

namespace App\Http\Controllers;

use App\Models\Anagrafica;
use App\Models\Consegne;
use App\Models\Soci;
use App\Models\Tabs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;



class AnagraficheController extends Controller
{
  

    public function anagrafica(Request $request)
    {

        $viewData = [];
        $viewData["title"] = "Anagrafica";

        $category = Tabs::with('anagraficas')->get();

        if ($category[0]->settore == 'anagrafica') {
            $category = Tabs::with('anagraficas')->get();
            $catTab = isset($request->id) ? $request->id : $category->first()->id;
        } else {
            $category = Tabs::with('danagraficas')->get();
            $catTab = isset($request->id) ? $request->id : $category->first()->id;
        }

        return view()->exists('anagrafiche.anagrafica') ? view('anagrafiche.anagrafica', compact('category', 'catTab')) : '';

        // $viewData["anagraficas"] = Anagrafica::orderBy('nome')->paginate(session('pag'));

        // return view('anagrafiche.anagrafica')->with("viewData", $viewData);
    }

    public function formAddAnagrafica()
    {

        $viewData = [];
        $viewData["title"] = "Aggiunge Consegne";
        $viewData["consegnes"] = Consegne::all();

        return view('anagrafiche.formAddAnagrafica')->with("viewData", $viewData);
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
        return redirect('/anagrafica');

    }

    public function delete($id)
    {

        Consegne::destroy($id);

        return redirect('/anagrafica');
    }

    public function show($tab = null)
    {

        if (is_null($tab)) {
            $tab = 'tab1';
        }

        $viewData = [];
        $viewData["anagrafiche"] = $tab;
        if ($tab == 'tab1') {
            $viewData["dati"] = Consegne::all();
            $viewData["column"] = DB::getSchemaBuilder()->getColumnListing('consegnes');
        }
        if ($tab == 'tab2') {
            // nomi colonne da utilizzare
            $viewData["column"] = ['nome', 'cognome'];
            // dati da tabella database
            $viewData["dati"] = DB::table('anagraficas')
                ->select($viewData["column"])
                ->get();

        }

        if ($tab == 'tab3') {
            $viewData["dati"] = Soci::all();
            $viewData["column"] = DB::getSchemaBuilder()->getColumnListing('socis');
        }

        if ($tab == 'tab4') {
            return view('/iconeHome');
        }

        if ($tab == 'tab5') {
            return view('/iconeHome');
        }
        // return view('anagrafiche.anagrafica', ['regions' => Consegne::all(),'tab' => $tab ]);

        return view('anagrafiche.anagrafica')->with("viewData", $viewData);

    }

  

}
