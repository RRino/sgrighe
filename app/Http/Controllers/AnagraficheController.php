<?php

namespace App\Http\Controllers;

use App\Models\Anagrafica;
use App\Models\Consegne;
use App\Models\Soci;
use App\Models\Tabs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnagraficheController extends Controller
{
    public function index()
    {

        return view('anagrafiche.index');
    }

  

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
        $viewData["tab"] = $tab;
        if ($tab == 'tab1') {
            $viewData["dati"] = Consegne::all();
            $viewData["column"] = DB::getSchemaBuilder()->getColumnListing('consegnes');
        }
        if ($tab == 'tab2') {
            $viewData["dati"] = Anagrafica::all();
            $viewData["column"] = DB::getSchemaBuilder()->getColumnListing('anagraficas');
        }

        if ($tab == 'tab3') {
            $viewData["dati"] = Soci::all();
            $viewData["column"] = DB::getSchemaBuilder()->getColumnListing('socis');
        }
        // return view('anagrafiche.anagrafica', ['regions' => Consegne::all(),'tab' => $tab ]);

        return view('anagrafiche.anagrafica')->with("viewData", $viewData);

    }

}
