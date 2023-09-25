<?php

namespace App\Http\Controllers;

use App\Models\Anagrafica;
use App\Models\Associati;
use App\Models\Consegne;
use App\Models\Dateiscr;
use App\Models\Enumconsegne;
use App\Models\Enumdateiscr;
use App\Models\Enumruolispec;
use App\Models\Ruoli;
use App\Models\Ruolispec;
use Illuminate\Http\Request;

class AssociatiController extends Controller
{
    public function test(Request $request)
    {
        $viewData = [];

        $viewData = [];
        $viewData['title'] = " associati";

        $nome = Associati::with(["anagrafica", "ruolispecm"])->get();
        return $nome;

        $viewData['associati'] = Associati::with(["anagrafica", "ruoli", "ruolispecm", "dateiscr_many", "consegne"])->get();
        return $viewData;

    }

    public function index()
    {

        $viewData = [];
        $viewData['title'] = " associati";

        $viewData['associati'] = Associati::with(["anagrafica", "ruoli", "ruolispecm", "dateiscr_many", "consegne"])->get();

        // return view('associati.index', compact('associatis', 'ruoli'));
        return view('associati.index')->with("viewData", $viewData);
    }

    public function index_tabella()
    {

        $viewData = [];
        $viewData['title'] = " associati";

        $viewData['associati'] = Associati::with(["anagrafica", "ruoli", "ruolispecm", "dateiscr_many", "consegne"])->get();

        // return view('associati.index', compact('associatis', 'ruoli'));
        return view('associati.index_tabella')->with("viewData", $viewData);
    }

    public function formAddassociati()
    {

        $viewData["anagrafica"] = Anagrafica::all();
        // Ruoli no ha enumruoli perche è singolo nonmultiplo
        $viewData["ruoli"] = Ruoli::all();
        $viewData["consegne"] = Consegne::all();
        $viewData["enumruolispec"] = Enumruolispec::all();
        $viewData["enumdateiscr"] = Enumdateiscr::all();
        $viewData['associati'] = Associati::with(["anagrafica", "ruoli", "ruolispecm", "dateiscr_many", "consegne"])->get();

        return view('associati.formAddAssociati')->with("viewData", $viewData);
    }

    public function addAssociati(Request $request)
    {

        $id = $request->id;

        $viewData = [];
        $errori = ':';
        $associati = new Associati;
        $associati->anagrafica_id = $request->anagrafica;
        $rid = (int) $request->anagrafica;

        if (Associati::where('anagrafica_id', $rid)->exists()) {
            $errori = 1;
            return back()->with([
                'error_message' => 'Anagrafica già esistente',
                'customerInfo' => $rid,
            ]);
        } else {
            // The record does not exist
            $associati->save();
            $associati = Associati::find($associati->id);
// -------------- Ruoli specifici ---------------
            if ($request?->ruolispec) {
                foreach ($request->ruolispec as $rqd) {
                    $ruolispec = new Ruolispec;
                    $ruolispec->associati_id = $associati->id;
                    $ruolispec->nome = $rqd;
                    $ruolispec->save();
                }
                $associati->ruolispec_id = $ruolispec->id;
            } else {
                $errori = "Manca Ruoli specifici";

            }
// ---------------- Data iscrizione -----------------
            if ($request?->dataiscr) {
                foreach ($request->dataiscr as $rqd) {
                    $dataiscr = new Dateiscr;
                    $dataiscr->associati_id = $associati->id;
                    $dataiscr->nome = $rqd;
                    $dataiscr->save();
                }
                $associati->dateiscr_id = $dataiscr->id;
            } else {
                $errori = $errori . ' ' . 'Manca data iscrizione';
            }
// ---------------- Consegna rivista -----------------------
            if ($request?->consegne) {
                $associati->consegne_id = $request->consegne;
            } else {
                $errori = $errori . ' ' . 'Manca consegna';
            }
        

            if ($request?->ruolo) {
                $associati->ruoli_id = $request->ruolo;
            } else {
                $errori = $errori . ' ' . 'Manca ruolo';
            }
// --------- Update --------------------------
            if ($errori == ':') {
                $associati->save();
            } else {
                return back()->with([
                    'error_message' => 'Errore ' . $errori,
                    'customerInfo' => $rid,
                ]);
            }

        }

        return back()->with(['successful_message' => 'Anagrafica associata correttamente']);

        // return redirect('/associati');

    }


    public function deleteAssociati($id)
    {
        $associati = Associati::find($id);
        $associati->ruolispec_id = null;
        $associati->dateiscr_id  = null;
        $associati->consegne_id = null;
        $associati->ruoli_id = null;
        $associati->save();

        Ruolispec::where('associati_id', '=', $id)->delete(); 
        Dateiscr::where('associati_id', '=', $id)->delete(); 
        Consegne::where('associati_id', '=', $id)->delete(); 
        $associati = Associati::find($id);
        $associati->delete(); //returns true/false


        return redirect('/associati');
    }
}
