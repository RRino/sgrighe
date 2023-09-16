<?php

namespace App\Http\Controllers;

use App\Models\Servizio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Param_etichette;
use App\Models\Param_bollettini;

class ServizioController extends Controller
{

    public function getSelect(Request $request)
    {
        
           return 'select '.$request;
    }

    public function salvaSelChck(Request $request)
    {

        $ids = $request->ids;

        if (Servizio::where('nome', 'check')->exists()) {
            // The record exists
            $servizio = DB::table('servizios')->where('nome', 'check')->first();
            $servizio->nome = 'soci';
            $servizio->uso = 'selChck';
            $servizio->dati = $ids;
            // $servizio->save();
            $affected = DB::table('servizios')
                ->where('nome', 'check')
                ->update(['dati' => $ids]);
        } else {
            // The record does not exist
            DB::insert('insert into servizios (nome,uso,dati) values (?, ?,?)', ['check', 'check', $ids]);
        }

    }

    public function salvaSelChck_selSocio(Request $request)
    {

        $ids = $request->ids;

        if (Servizio::where('nome', 'check_del')->exists()) {
            // The record exists
            $servizio = DB::table('servizios')->where('nome', 'check_del')->first();
            $servizio->nome = 'soci';
            $servizio->uso = 'selChck';
            $servizio->dati = $ids;
            // $servizio->save();
            $affected = DB::table('servizios')
                ->where('nome', 'check')
                ->update(['dati' => $ids]);
        } else {
            // The record does not exist
            DB::insert('insert into servizios (nome,uso,dati) values (?, ?,?)', ['check', 'check', $ids]);
        }

    }

    public function preferenze_etichette()
    {

        $viewData = [];
        $viewData["title"] = "Parametri";
        $viewData["subtitle"] = "Iscrizioni";

        
        // verifica se esistono i valori di default del database servizios altrimenti li crea
        $servizio = DB::table('servizios')->where('nome', 'check')->first();
        if ($servizio == null) {
            DB::insert('insert into servizios (nome,uso) values (?,?)', ['check', 'check']);
        }

        $servizio = DB::table('servizios')->where('nome', 'check_del')->first();
        if ($servizio == null) {
            DB::insert('insert into servizios (nome,uso) values (?,?)', ['check_del', 'cancella socio da check']);
        }


        $etic = Param_etichette::all();
        if($etic->isEmpty()){
            DB::insert('insert into param_etichettes (nome,spazio_sopra,larghezza ,altezza ,numero_verticale, numero_orrizontale,description )
            values (?,?,?,?,?,?,?)', ['Etic_70x36' , 6, 70, 36, 8, 3, 'default']);
        }
        $viewData['etichettes'] = DB::table('param_etichettes')->get();

        return view('servizio.preferenze_etichette')->with("viewData", $viewData);
    }


    public function preferenze_bollettini()
    {

        $viewData = [];
        $viewData["title"] = "Parametri";
        $viewData["subtitle"] = "Iscrizioni";

        // verifica se esistono i valori di default del database servizios altrimenti li crea
        $servizio = DB::table('servizios')->where('nome', 'check')->first();
        if ($servizio == null) {
            DB::insert('insert into servizios (nome,uso) values (?,?)', ['check', 'check']);
        }

        $servizio = DB::table('servizios')->where('nome', 'check_del')->first();
        if ($servizio == null) {
            DB::insert('insert into servizios (nome,uso) values (?,?)', ['check_del', 'cancella socio da check']);
        }


        $boll = Param_bollettini::all();
        if($boll->isEmpty())
        {
            DB::table('param_bollettinis')->insert(['causale' => 'ISCRIZIONE ASSOCIAZIONE PROGETTO 10 RIGHE APS 2023 PIU 2 RIVISTE ', 'prezzo' => '20']);
         }


        $viewData['bollettinis'] = DB::table('param_bollettinis')->get();

        return view('servizio.preferenze_bollettini')->with("viewData", $viewData);
    }


    
    public function editParamBollettini(Request $request)
    {

        $id = $request->id;
     
        Param_bollettini::validate($request);
        $viewData["title"] = "- Param bollettini - ";
        $bollettini = Param_bollettini::find($id);     
        $bollettini->setCausale($request->input('causale'));
        $bollettini->setDescription($request->input('description'));

        $bollettini->save();

        $viewData["bollettinis"] = Param_bollettini::all();

        return view('servizio.preferenze_bollettini')->with("viewData", $viewData);;
    }

    public function editParamEtichette(Request $request)
    {

       
        $viewData = [];
        $viewData["title"] = "Admin Page - Edit soci ";
        $param_etichette = Param_etichette::find($request->id);
     
        $param_etichette->setNome($request->input('nome'));
        $param_etichette->setLarghezza($request->input('larghezza'));
        $param_etichette->setAltezza($request->input('altezza'));
        $param_etichette->setNumero_verticale($request->input('numero_verticale'));
        $param_etichette->setNumero_orrizontale($request->input('numero_orrizontale'));
        $param_etichette->setDescription($request->input('description'));
        $param_etichette->save();
        
        $viewData["etichettes"] = Param_etichette::all();
     

        return view('servizio.preferenze_etichette')->with("viewData", $viewData);
    }

    public function addParamEtichette(Request $req)
    {

      
// TODO multiple etichette Da fare non usdato per ora
        $viewData = [];
        $viewData["title"] = "etichette ";
        $viewData["subtitle"] = "Parametri etichette";

        $viewData["param_etichette"] = new Param_etichette;
        $viewData["param_etichette"]->nome = $req->nome;
        $viewData["param_etichette"]->spazio_sopra = $req->spazio_sopra;
        $viewData["param_etichette"]->altezza = $req->altezza;
        $viewData["param_etichette"]->larghezza = $req->larghezza;
        $viewData["param_etichette"]->numero_verticale = $req->numero_verticale;
        $viewData["param_etichette"]->numero_orrizontale = $req->numero_orrizontale;
        $viewData["param_etichette"]->description = $req->description;
        $viewData["param_etichette"]->save();
        //$viewData["socis"] = Soci::find($id);

       // return redirect('/etichette_anno');

    }


}
