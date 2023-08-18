<?php

namespace App\Http\Controllers;

use App\Models\Servizio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServizioController extends Controller
{
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


    public function preferenze()
    {


        $viewData = [];
        $viewData["title"] = "Parametri";
        $viewData["subtitle"] = "Iscrizioni";
   

        // verifica se esistono i valori di default del database servizios altrimenti li crea
        $servizio = DB::table('servizios')->where('nome', 'check')->first();
        if($servizio == null){
            DB::insert('insert into servizios (nome,uso) values (?,?)', ['check','check']);
        }

        $servizio = DB::table('servizios')->where('nome', 'check_del')->first();
        if($servizio == null){
            DB::insert('insert into servizios (nome,uso) values (?,?)', ['check_del','cancella socio da check']);
        }

        $servizio = DB::table('param_bollettinis')
        ->whereNotNull('causale')
        ->get();
        if($servizio == null){
            DB::insert('insert into param_bollettinis (causale,prezzo) values (?,?)', ['ISCRIZIONE ASSOCIAZIONE PROGETTO 10 Righe APS 2023 piu 2 riviste ','20']);
        }
        $viewData['bollettinis'] = DB::table('param_bollettinis')->get();


        $servizio = DB::table('param_etichettes')
        ->whereNotNull('nome')
        ->get();
        if($servizio == null){
            DB::insert('insert into param_etichettes (nome,spazio_sopra,larghezza ,altezza ,numero_verticale, numero_orrizontale,description ) 
            values (?,?,?,?,?,?,?)', ['Etic_70x36'.'6','70','36','8','3','default']);
        }
        $viewData['etichettes'] = DB::table('param_etichettes')->get();

        return view('servizio.preferenze')->with("viewData", $viewData);
    }


    public function pref_bollettini(Request $request)
    {

   

         /**
         *  Route::post(' ', ' ');
         * // ok Aggiorna  
         * usato in  
         *
         *
         */

         Param_bollettini::validate($request);
         $viewData["title"] = "- Param bollettini - ";
         $bollettini = Param_bollettini::findOrFail($request->nome);
         $viewData["bollettinis"] = Param_bollettini::all();
         $bollettini->setCausale($request->input('causale'));
         $bollettini->setDescription($request->input('description'));

         $bollettini->save();
        return view('servizio.preferenze');
    }
}
