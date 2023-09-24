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

        $viewData['associati'] = Associati::with(["anagrafica", "ruoli", "ruolispecm", "dateiscr_many", "consegnem"])->get();
        return $viewData;

    }

    public function index()
    {

        $viewData = [];
        $viewData['title'] = " associati";

        $viewData['associati'] = Associati::with(["anagrafica", "ruoli", "ruolispecm", "dateiscr_many", "consegnem"])->get();

        // return view('associati.index', compact('associatis', 'ruoli'));
        return view('associati.index')->with("viewData", $viewData);
    }

    public function formAddassociati()
    {

        $viewData["anagrafica"] = Anagrafica::all();
        // Ruoli no ha enumruoli perche è singolo nonmultiplo
        $viewData["ruoli"] = Ruoli::all();
        $viewData["enumconsegne"] = Enumconsegne::all();
        $viewData["enumruolispec"] = Enumruolispec::all();
        $viewData["enumdateiscr"] = Enumdateiscr::all();
        $viewData['associati'] = Associati::with(["anagrafica", "ruoli", "ruolispecm", "dateiscr_many", "consegnem"])->get();

        return view('associati.formAddAssociati')->with("viewData", $viewData);
    }

    public function addAssociati(Request $request)
    {

        $id = $request->id;

        $viewData = [];
       
        $associati = new Associati;
        $associati->anagrafica_id = $request->anagrafica;
        $rid = (int)$request->anagrafica;
        $verificaExist = Associati::find($rid);
        if (!$verificaExist?->id) {

            return back()->with([
                'error_message' => 'Anagrafica già esistente',
                'customerInfo' => $rid,
            ]);

        } else {
            $associati->save();
if($request?->ruolispec){
            foreach ($request->ruolispec as $rqd) {
                $ruolispec = new Ruolispec;
                $ruolispec->associati_id = $associati->id;
                $ruolispec->nome = $rqd;
                $ruolispec->save();
            }
            $associati->ruolispec_id = $ruolispec->id;
        }else{
            return back()->with([
                'error_message' => 'no ruolo spec',
                'customerInfo' => $rid,
            ]);  
        }
            foreach ($request->dataiscr as $rqd) {
                $dataiscr = new Dateiscr;
                $dataiscr->associati_id = $associati->id;
                $dataiscr->nome = $rqd;
                $dataiscr->save();
            }

            foreach ($request->consegne as $rqd) {
                $consegne = new Consegne;
                $consegne->associati_id = $associati->id;
                $consegne->nome = $rqd;
                $consegne->save();
            }

            $associati = Associati::find($associati->id);
            //$associati->anagrafica_id = $request->anagrafica;
            $associati->ruoli_id = $request->ruolo;
            
            $associati->dateiscr_id = $dataiscr->id;
            $associati->consegne_id = $consegne->id;

            // $datis = Associati::where('anagrafica_id', $request->anagrafica)->get();

            // if ($datis->isEmpty()) {
            $associati->save();
            // }
        }


  
        return back()->with(['successful_message' => 'Anagrafica associata correttamente']);
 

  return redirect('/associati');

    
}
}