<?php

namespace App\Http\Controllers;

use App\Models\Anagrafica;
use App\Models\Associati;
use App\Models\Consegne;
use App\Models\Ruoli;
use App\Models\Ruoli_spec;
use App\Models\Soci;
use App\Models\Tabs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnagraficheController extends Controller
{
    public function test(Request $request)
    {


               // return view('user')->with("data", $data);
              //- return Anagrafica::find(1)->collegamentiMany()->get();
               //return User::find(1)->getAccount()->get();
                return Anagrafica::with("collegamentiMany")->get();// vedi tutti
       
       
              // return User::find(1)->phone;
               //return Phone::find(2)->user;
               //return Phone::with("user")->get();// richiama tutti "user" è una funzione in Phone model
         
               
        return Anagrafica::find(2)->getAssociati()->get();
        //return Anagrafica::with("getAssociati")->get();// vedi tutti
    }

    public function index(Request $request)
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

        return view()->exists('anagrafiche.index') ? view('anagrafiche.anagrafica', compact('category', 'catTab')) : '';

        // $viewData["anagraficas"] = Anagrafica::orderBy('nome')->paginate(session('pag'));
        // return view('anagrafiche.anagrafica')->with("viewData", $viewData);
    }

    public function formAddAnagrafica()
    {

        $viewData = [];
        $viewData["title"] = "Aggiunge Anagrafica";

        //$viewData["consegnes"] = Anagrafica::all();

        return view('anagrafiche.formAddAnagrafica')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        /**
         * Route::POST('addAnagrafica', 'store');
         * // ok salva nuovo anagrafica nel database
         *
         */
        Anagrafica::validate($request);

        $newanagrafica = new Anagrafica();
        $newanagrafica->setNome($request->input('nome'));
        $newanagrafica->setCognome($request->input('cognome'));
        $newanagrafica->setIndirizzo($request->input('indirizzo'));

        $newanagrafica->setTper_soc($request->get('per_soc'));

        $newanagrafica->setCap($request->input('cap'));
        $newanagrafica->setLocalita($request->input('localita'));
        $newanagrafica->setComune($request->input('comune'));
        $newanagrafica->setSigla_provincia($request->input('sigla_provincia'));
        $newanagrafica->setEmail($request->input('email'));
        $newanagrafica->setPec($request->input('pec'));
        $newanagrafica->setCodice_fiscale($request->input('codice_fiscale'));
        $newanagrafica->setPartita_iva($request->input('partita_iva'));
        $newanagrafica->setTelefono($request->input('telefono'));
        $newanagrafica->setCellulare($request->input('cellulare'));
        $newanagrafica->setPublished($request->input('published'));
        $newanagrafica->setDescription($request->input('description'));

        $newanagrafica->save();

      
/*
            $ruolo = $request->ruolo;
            $collegamenti = new Collegamenti();
            $collegamenti->anagrafica_id = $newanagrafica->id;
            $collegamenti->ruolo_id = $ruolo;
            // salva collegamenti
            $collegamenti->save();
    */   

        //return back();
        return redirect('/anagrafiche');

    }

    public function delete($id)
    {

        Anagrafica::destroy($id);

        return redirect('/anagrafiche');
    }

    public function show($tab = null)
    {

        if (is_null($tab)) {
            $tab = 'tab1';
        }

        $viewData = [];
        $viewData["anagrafiche"] = $tab;

        if ($tab == 'tab3') {
            $viewData["tabella"] = 'consegne';
            $viewData["dati"] = Consegne::all();
            $viewData["column"] = DB::getSchemaBuilder()->getColumnListing('consegnes');
            
        }

        if ($tab == 'tab1') {
            $viewData["tabella"] = 'anagrafica';
            $viewData['ruoli'] = DB::table('ruolis')->get();
            $viewData['ruoli_spec'] = DB::table('ruoli_specs')->get();
            // nomi colonne da utilizzare
            $viewData["column"] = ['id', 'nome', 'cognome', 'indirizzo'];
            // dati da tabella database
            $viewData["dati"] = DB::table('anagraficas')
            //->select($viewData["column"])
                ->get();
               

        }

        if ($tab == 'tab2') {
            $viewData["tabella"] = 'soci';
            $viewData["dati"] = Soci::all();
            $viewData["column"] = DB::getSchemaBuilder()->getColumnListing('socis');
        }

        if ($tab == 'tab4') {
            return view('/iconeHome');
        }

        if ($tab == 'tab5') {
            $viewData["tabella"] = 'immagini';
            $viewData['images4'] = DB::table('immaginis')->get();
          
            $viewData["column"] = DB::getSchemaBuilder()->getColumnListing('immaginis');
            //return view('file.index')->with("viewData", $viewData);
        }
        // return view('anagrafiche.anagrafica', ['regions' => Consegne::all(),'tab' => $tab ]);

        return view('anagrafiche.index')->with("viewData", $viewData);

    }

    public function update(Request $request)
    {

        /**
         *  Route::post('editAnag', 'update');
         * // ok Aggiorna Anagrafica
         */
        $anno = Carbon::now()->format('Y');
        $id = $request->id;

        $viewData = [];
        $viewData["title"] = "iscr ";
        $viewData["subtitle"] = "Anagrafica";
        $viewData["anno"] = $anno;
        $viewData['ruoli'] = Ruoli::all();
        $viewData['ruolo_specifico'] = Ruoli_spec::all();

        Anagrafica::validate($request);
        $viewData["title"] = "- anagrafica - ";
        $anagrafica = Anagrafica::find($id);

        $anagrafica->setNome($request->input('nome'));
        $anagrafica->setCognome($request->input('cognome'));
        $anagrafica->setIndirizzo($request->input('indirizzo'));
        //$anagrafica->setConsegna($request->get('consegna'));
        $anagrafica->setTper_soc($request->get('per_soc'));
        $anagrafica->setCap($request->input('cap'));
        $anagrafica->setLocalita($request->input('localita'));
        $anagrafica->setComune($request->input('comune'));
        $anagrafica->setSigla_provincia($request->input('sigla_provincia'));
        $anagrafica->setEmail($request->input('email'));
        $anagrafica->setPec($request->input('pec'));
        $anagrafica->setCodice_fiscale($request->input('codice_fiscale'));
        $anagrafica->setPartita_iva($request->input('partita_iva'));
        $anagrafica->setTelefono($request->input('telefono'));
        $anagrafica->setCellulare($request->input('cellulare'));
        $anagrafica->setPublished($request->get('published'));
        $anagrafica->setDescription($request->input('description'));
         // salva anagrafica
        $anagrafica->save();
         // verifica se esiste gia
        
        $rid = $request->input('id');
        $datis = Associati::where('anagrafica_id',$rid)->get();
        
        if (!isset($datis->anagrafica_id)) {
            $id = $request->input('id');
            $associati = new Associati;
           
            $associati->anagrafica_id = $rid;
          
            $associati->save();
        }

        return redirect('/anagrafiche');

    }

   
    public function editAnagrafica($id)
    {

        $viewData = [];
        // da helpers
        // $viewData = //select_sociRightjoin_singolo($id);
        $viewData['ruoli'] = Ruoli::all();
        $viewData['anagraficas'] = Anagrafica::find($id);
        $viewData['ruoli_spec'] = Ruoli_spec::all();
        $viewData['associati'] = Associati::all();

        return view('anagrafiche.formEditAnagrafica')->with("viewData", $viewData);
    }
}
