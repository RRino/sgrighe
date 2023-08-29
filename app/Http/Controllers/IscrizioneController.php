<?php

namespace App\Http\Controllers;

use App\Models\Iscrizione;
use App\Models\Soci;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class IscrizioneController extends Controller
{

    public function iscrizioneList()
    {
        /**
         * Route::get('iscrizione', 'iscrizioneList');
         * // Lista iscrizioni con edit e ricerca
         */

        $viewData = iscri_leftJoin();

        return view('iscrizione.iscrizioneList')->with("viewData", $viewData);
        
    }

    public function showData(request $req)
    {

        /**
         *  Route::get('editIscrizione/{id}', 'showData');
         *
         * 
         */
        $id = $req->id;

        $viewData = [];
 
        $viewData["socis"] = iscri_leftJoinId($id);
     
        return view('iscrizione.EditIscrizione')->with("viewData", $viewData);
    }

    public function formIscr($id)
    {

        /**
         *
         *  Route::get('showIscrizione/{id}', 'formIscr');
         * // Form per aggiungere iscrizione ad un socio
         */

        $viewData = [];
        $viewData["title"] = "iscr ";
        $viewData["subtitle"] = "Iscrizioni";
        $viewData["socis"] = Soci::find($id);

        $viewData["iscrizione"] = Iscrizione::where('socio_id', '=', $id)->get();

        return view('iscrizione.AddIscrizione')->with("viewData", $viewData);
    }

    public function addIscrizione(Request $req)
    {
        /**
         *
         *  Route::POST('addIscrizione', 'AddIscrizione');
         * //  aggiunge anno iscrizione
         *
         */
        
//  TODO  QUI Richiesta creare colonna

        $anno = $req->anno; //Carbon::now()->format('Y');

        if (Schema::hasColumn('iscriziones', $anno)) {
            $esite = 1;
        } else {
            $fieldName = $anno;

            Schema::table('iscriziones', function (Blueprint $table) use ($fieldName) {
                $table->string($fieldName,20)->nullable();
            });
        };


        $id = $req->socio_id;

        $viewData = [];
        $viewData["title"] = "iscr ";
        $viewData["subtitle"] = "Iscrizioni";

        $viewData["iscrizioni"] = Iscrizione::find($id);
        $viewData["iscrizioni"]->socio_id = $id;
        $viewData["iscrizioni"]->$anno = $req->anno;
        $viewData["iscrizioni"]->description = $req->description;

        $viewData["iscrizioni"]->save();

        return redirect('/list');

    }

    public function deleteIscrizione($id)
    {
        $data = Iscrizione::find($id);
        $data->delete();
        return back()->withInput();
        //return redirect('iscrizione');
    }

    public function editIscrizione(Request $req)
    {

        $anno = Carbon::now()->format('Y');
        $id = $req->id;

        $viewData = [];
        $viewData["title"] = "iscr ";
        $viewData["subtitle"] = "Iscrizioni";
        $viewData["anno"] = $anno;

        Iscrizione::validate($req);
        $iscrizioni = Iscrizione::find($id);
        $iscrizioni->socio_id = $req->socio_id;
        $iscrizioni[$anno] = $req[$anno];
        $iscrizioni[$anno - 1] = $req[$anno - 1];
        $iscrizioni[$anno - 2] = $req[$anno - 2];
        $iscrizioni[$anno +1] = $req[$anno+1];

        $iscrizioni['nome'] = $req['nome'];
        $iscrizioni['cognome'] = $req['cognome'];
        $iscrizioni['description'] = $req['description'];

        $iscrizioni->save();

        $viewData["iscrizioni"] = Iscrizione::all();

        return redirect('/iscrizione');

    }

    public function filtraIscritto()
    {

        $viewData = [];
        $viewData["title"] = "Filtra Iscritto";

        return view('iscrizione.formFiltraIscritto')->with("viewData", $viewData);

    }

    public function trovaIscritto(Request $req)
    {

        $viewData = [];
        $viewData["title"] = "iscr ";
        $viewData["subtitle"] = "Iscrizioni";
        $anno = Carbon::now()->format('Y');
        $viewData["anno"] = $anno;

        $viewData = [];

        Iscrizione::validate($req);
        $data = Soci::where('cognome', '=', $req->cognome)->get();

        if (isset($data[0]->id)) {
            $id = $data[0]->id;

            $viewData['iscrizioni'] = iscri_leftJoinId($id);

            return view('iscrizione.iscrizioneList')->with("viewData", $viewData);
        } else {
            $viewData["title"] = "Cognome non trovato";
            return view('iscrizione.formFiltraIscritto')->with("viewData", $viewData);
        }
    }
}
