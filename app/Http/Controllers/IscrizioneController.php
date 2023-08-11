<?php

namespace App\Http\Controllers;

use App\Models\Iscrizione;
use App\Models\Soci;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class IscrizioneController extends Controller
{

    public function iscrizioneList()
    {
       /**
        * Route::get('iscrizione', 'iscrizioneList');
        * // Lista iscrizioni con edit e ricerca
        */
        // TODO sistemare ricerca 

        Paginator::useBootstrap();
        $viewData = [];
        $viewData["title"] = "iscr ";
        $viewData["subtitle"] = "Iscrizioni";
       
        $viewData["iscrizioni"] = Iscrizione::join('socis', 'socis.id', '=', 'iscriziones.socio_id')->orderBy('iscriziones.socio_id', 'ASC')
        ->get(['iscriziones.id as idi','iscriziones.anno','iscriziones.socio_id', 'socis.*']);



        return view('iscrizione.iscrizioneList')->with("viewData", $viewData);
    }

    public function showData(request $req)
    {

        /**
         *  Route::get('editIscrizione/{id}', 'showData');
         * // edit iscrizione 
         *  usato in formEditConsegne.blade -- // TODO formEditConsegnen ?-- IscrizioneList.blade
         * 
         */
        $id = $req->id;
       
        $viewData = [];
        $viewData["title"] = "iscr ";
        $viewData["subtitle"] = "Iscrizioni";

        $viewData["iscriziones"] = Iscrizione::findOrFail($id);
        $socio_id = $viewData["iscriziones"]->socio_id;
        $viewData["socis"] = Soci::findOrFail($socio_id);

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
        $id = $req->socio_id;


        $viewData = [];
        $viewData["title"] = "iscr ";
        $viewData["subtitle"] = "Iscrizioni";



        $viewData["iscrizioni"] = new Iscrizione;
        $viewData["iscrizioni"]->socio_id = $id;
        $viewData["iscrizioni"]->anno = $req->anno;
        $viewData["iscrizioni"]->description = $req->description;
        $viewData["iscrizioni"]->save();
        //$viewData["socis"] = Soci::find($id);

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
        

        $viewData = [];
        $viewData["title"] = "iscr ";
        $viewData["subtitle"] = "Iscrizioni";

        $viewData["iscrizioni"] = new Iscrizione;
        $viewData["iscrizioni"]->socio_id = $id;
        $viewData["iscrizioni"]->anno = $req->anno;
        $viewData["iscrizioni"]->nome = $req->nome;
        $viewData["iscrizioni"]->cognome = $req->cognome;
        $viewData["iscrizioni"]->description = $req->description;
        $viewData["iscrizioni"]->save();
        $viewData["socis"] = Soci::find($id);

        return redirect('/iscrizione');

    }

    public function filtraIscritto(){
     
        $viewData = [];
        $viewData["title"] = "Filtra Iscritto";
     

        return view('iscrizione.formFiltraIscritto')->with("viewData", $viewData);;

    }

    public function trovaIscritto(Request $req){
    
        $viewData = [];
       
        $data =  Soci::where('cognome', '=', $req->cognome)->get();
        if(isset($data[0]->id)) {
        $id = $data[0]->id;
   
          
        $viewData["iscrizioni"] = Iscrizione::join('socis', 'socis.id', '=', 'iscriziones.socio_id')->orderBy('iscriziones.socio_id', 'DESC')
        ->where('socio_id', '=', $id)
        ->get(['iscriziones.id as idi','iscriziones.anno','iscriziones.socio_id', 'socis.*']);
        return view('iscrizione.iscrizioneList')->with("viewData", $viewData);
        }else{
            $viewData["title"] = "Cognome non trovato";
            return view('iscrizione.formFiltraIscritto')->with("viewData", $viewData);
        }
    }
}
