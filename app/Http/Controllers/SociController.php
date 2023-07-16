<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Consegne;
use App\Models\Iscrizione;
use App\Models\Soci;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;



class SociController extends Controller
{
    public function index()
    { 
        /**
         * Visualizza lista soci
         *  Route::get('/list', 'index')->name('soci.index')->middleware('is_admin');
         */

        $viewData = [];
        $viewData["title"] = "Anagrafica";

        Paginator::useBootstrap();
        $viewData["socis"] = Soci::orderBy('cognome')->paginate(session('pag'));

        // $viewData["soci"] = Soci::join('iscriziones', 'iscriziones.socio_id', '=', 'socis.id')->orderBy('socis.cognome', 'DESC')
        //  ->get(['iscriziones.id as idi','iscriziones.anno','iscriziones.socio_id', 'socis.*']);
    /*   $viewData["soci"] = Soci::leftJoin('iscriziones', function ($join) {
        $join->on('iscriziones.socio_id', '=', 'socis.id')
        ->select('socis.*');
        // ->where('contacts.user_id', '>', 5);
        })
        ->paginate(500);

        $leagues = DB::table('leagues')
        ->select('league_name')
        ->join('countries', 'countries.country_id', '=', 'leagues.country_id')
        ->where('countries.country_name', $country)
        ->get();
         */
        return view('soci.index')->with("viewData", $viewData);
    }

   public function pagine(Request $req){
    
    /**
     * Route::POST('/paginazione', 'pagine');
     * setta il numero righe nelle tabelle per la paginazione
     * nota - se c'è un join non va ?
     * /paginazione usato in  consegne.blade -- soci.index.blade
     */

        session(['pag' => $req->rows]);
        //return back();
        return redirect('/list');
    } 


    public function changeStatus($id)
    {

         /**
          * Cambia lo stato Ablilitato/sospeso del socio
          *Route::get('changeStatus/{id}', 'changeStatus');
          * richiamato da ajax
          */
        $viewData = [];
        $soci = Soci::find($id);
        $stato = $soci->getPublished();

        if ($stato == "Abilitato") {
            $soci->published = "Sospeso";           
        } else {
            $soci->published = "Abilitato";          
        }

        $soci->save();

        $id = '';
        $viewData["title"] = "Soci";
        Paginator::useBootstrap();
        $viewData["socis"] = Soci::orderBy('cognome')->paginate(session('pag'));
       
        return redirect('/list');
    }



    public function indexOrd($ord)
    {
         /**
          * Crea ordinamento colonna passata in $ord
          * Route::get('/list/{col}', 'indexOrd')->middleware('is_admin');
          */
        $viewData = [];
        $viewData["title"] = "Soci";

        Paginator::useBootstrap();
        $viewData["socis"] = Soci::orderBy($ord, 'DESC')->paginate(session('pag'));

        // $viewData["soci"] = Soci::join('iscriziones', 'iscriziones.socio_id', '=', 'socis.id')->orderBy('socis.cognome', 'DESC')
        //  ->get(['iscriziones.id as idi','iscriziones.anno','iscriziones.socio_id', 'socis.*']);

        return view('soci.index')->with("viewData", $viewData);
    }

    public function indexFiltro(Request $req)
    {

        /**
         * Filtra soci per anno join con iscrizione
         *  Route::post('filtro', 'indexFiltro');
         * usato in filtroAanno.blade
         * 
         */
        $anno = $req->anno;

        $viewData = [];
        $viewData["title"] = "Filtro anno";
        //$viewData["socis"] = Soci::all();

        $viewData["soci"] = Soci::join('iscriziones', 'iscriziones.socio_id', '=', 'socis.id')
            ->where('iscriziones.anno', '=', $anno)
            ->orderBy('socis.cognome', 'DESC')
            ->get(['iscriziones.id as idi', 'iscriziones.anno', 'iscriziones.socio_id', 'socis.*']);

        return view('soci.indexFiltro')->with("viewData", $viewData);
    }

    public function formAdd()
    {

        /**
         * crea la form per aggiungere anno
         *  Route::view('formAdd', 'soci.formAdd');
         * *
         * usato in indexFiltro.blade -- index.blade --
         */
        $viewData = [];
        $viewData["title"] = "Admin Page - Soci -";
        $viewData["consegnes"] = Consegne::all();
        return view('soci.addSoci')->with("viewData", $viewData);
    }

    public function salvasocio(Request $request)
    {

        /**
         * Route::POST('add', 'salvasocio');
         * // ok salva nuovo socio nel database
         * usato in formAdd.blade
         */
        Soci::validate($request);
        $viewData["consegnes"] = Consegne::all();

        $newsoci = new Soci();
        $newsoci->setNome($request->input('nome'));
        $newsoci->setCognome($request->input('cognome'));
        $newsoci->setIndirizzo($request->input('indirizzo'));
        $newsoci->setConsegna($request->get('consegna'));
        $newsoci->setTipo_socio($request->get('tipo_socio'));

        $newsoci->setCap($request->input('cap'));
        $newsoci->setLocalita($request->input('localita'));
        $newsoci->setComune($request->input('comune'));
        $newsoci->setSigla_provincia($request->input('sigla_provincia'));
        $newsoci->setEmail($request->input('email'));
        $newsoci->setPec($request->input('pec'));
        $newsoci->setCodice_fiscale($request->input('codice_fiscale'));
        $newsoci->setPartita_iva($request->input('partita_iva'));
        $newsoci->setTelefono($request->input('telefono'));
        $newsoci->setCellulare($request->input('cellulare'));
        $newsoci->setPublished($request->input('published'));
        $newsoci->setDescription($request->input('description'));

        $newsoci->save();

        //return back();
        return view('soci.formAdd', ['name' => 'James']);

    }

    public function cancellaSocio($id)
    {
        /**
         * Route::delete('delete/{id}', 'cancellaSocio'); 
         * // ok Cancella socio dal database
         * 
         */

         
        soci::destroy($id);
        return redirect('/list');
    }

    public function editSocio($id)
    {
         
        $viewData = [];
        $viewData["title"] = "Admin Page - Edit soci ";
        $viewData["soci"] = Soci::find($id);
        $viewData["consegnes"] = Consegne::all();
        $viewData["iscriziones"] = Iscrizione::orderBy('anno','DESC')->get();
       // dd($viewData);
        return view('soci.edit')->with("viewData", $viewData);
    }

    public function update(Request $request)
    {

        /**
         *  Route::post('editSocio', 'update');
         * // ok Aggiorna Socio 
         * usato in soci.edit.blade
         * 
         * 
         */

        Soci::validate($request);
        $viewData["title"] = "- soci - ";
        $soci = Soci::findOrFail($request->id);
        $viewData["socis"] = Soci::all();
        $soci->setNome($request->input('nome'));
        $soci->setCognome($request->input('cognome'));
        $soci->setIndirizzo($request->input('indirizzo'));
        $soci->setConsegna($request->get('consegna'));
        $soci->setTipo_socio($request->get('tipo_socio'));
        $soci->setCap($request->input('cap'));
        $soci->setLocalita($request->input('localita'));
        $soci->setComune($request->input('comune'));
        $soci->setSigla_provincia($request->input('sigla_provincia'));
        $soci->setEmail($request->input('email'));
        $soci->setPec($request->input('pec'));
        $soci->setCodice_fiscale($request->input('codice_fiscale'));
        $soci->setPartita_iva($request->input('partita_iva'));
        $soci->setTelefono($request->input('telefono'));
        $soci->setCellulare($request->input('cellulare'));
        $soci->setPublished($request->get('published'));
        $soci->setDescription($request->input('description'));
        $soci->setUltimo($request->input('ultimo'));
        $soci->setPenultimo($request->input('penultimo'));
        $soci->save();
        return redirect('/list');
        //return view('soci.index')->with("viewData", $viewData);
    }

    public function singolo(Request $req)
    {

        /**
         * 
         * Route::get('singolo/{id}', 'singolo');
         *  // ok Visualizza dati singolo socio 
         * richiamato da click sul cognome da lista soci
         * 
         */
        $id = $req->id;

        $viewData = [];
        $viewData["title"] = "Socio ";
        $viewData["subtitle"] = "Singolo";
        $viewData["socis"] = Soci::find($id);
        $viewData["iscriziones"] = Iscrizione::select('id', 'anno', 'description')->where('socio_id', $id)->get();

        return view('soci.singolo')->with("viewData", $viewData);
    }

    public function anno(Request $req)
    {

        $viewData = [];
        $viewData["title"] = "Anno ";
        $viewData["subtitle"] = "Iscrizioni";

        $anno = $req->ultimo_anno;
        \Illuminate\Pagination\Paginator::useBootstrap();
        $$viewData = DB::table('socis')->where('socis.ultimo', $anno)->orderBy('id', 'DESC')->paginate(session('pag'));

        // $viewData["socis"] = Soci::find($id);

        $viewData["iscrizionis"] = Iscrizione::all();
        return view('soci.singolo')->with("viewData", $viewData);

        //return view('soci.SociList', ['socis' => $datas]);
    }





    public function sociCancella(Request $requ){
    
        // Recupera gli 'id' salvati nel database tabella 'servizios'
        // inseriti dal Controller ServizioController 
        //public function salvaSelChck()


            $datis= DB::table('servizios')->where('nome', 'check')->first();
            $dt = explode(',', $datis->dati);
           
            $sheet1Data = Soci::find($dt);
            // Cancella i soci
            foreach ($sheet1Data as $key => $socio) {              
                soci::destroy($socio->id);
            }
            
        return redirect('/list');
    }

}
