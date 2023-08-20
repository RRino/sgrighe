<?php

namespace App\Http\Controllers;

use App\Models\Iscrizione;
use App\Models\Soci;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
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
        // TODO sistemare ricerca

        Paginator::useBootstrap();
        $viewData = [];
        $viewData["title"] = "iscr ";
        $viewData["subtitle"] = "Iscrizioni";

        //$viewData["iscrizioni"] = Iscrizione::all();
        $anno = Carbon::now()->format('Y');
        $viewData["anno"] = $anno;

        $viewData["iscrizioni"] = Soci::leftJoin('iscriziones', 'socis.id', '=', 'iscriziones.socio_id')
            ->select('socis.id',
                'iscriziones.socio_id',
                'socis.nome',
                'socis.cognome',
                'iscriziones.' . $anno . ' AS  a' . $anno,
                'iscriziones.' . ($anno - 1) . ' AS  a' . ($anno - 1),
                'iscriziones.' . ($anno - 2) . ' AS  a' . ($anno - 2),
            )
            ->orderBy('socis.cognome', 'ASC')
            ->paginate(session('pag'));

        return view('iscrizione.iscrizioneList')->with("viewData", $viewData);
    }

    public function showData(request $req)
    {

        /**
         *  Route::get('editIscrizione/{id}', 'showData');
         *
         * // edit iscrizione
         *  usato in formEditConsegne.blade -- // TODO formEditConsegnen ?-- IscrizioneList.blade
         *
         */
        $id = $req->id;

        $viewData = [];
        $viewData["title"] = "iscr ";
        $viewData["subtitle"] = "Iscrizioni";
        $anno = Carbon::now()->format('Y');
        $viewData["anno"] = $anno;

        $viewData["socis"] = Soci::leftJoin('iscriziones', 'socis.id', '=', 'iscriziones.socio_id')
            ->select('socis.id as ids',
                'socis.nome',
                'socis.cognome',
                'socis.description',
                'iscriziones.id',
                'iscriziones.socio_id',
                'iscriziones.' . $anno . ' AS  a' . $anno,
                'iscriziones.' . ($anno - 1) . ' AS  a' . ($anno - 1),
                'iscriziones.' . ($anno - 2) . ' AS  a' . ($anno - 2),
            )
            ->where('iscriziones.id', '=', $id)->get();

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

        $anno = $req->anno; //Carbon::now()->format('Y');

        if (Schema::hasColumn('iscriziones', $anno)) {
            $esite = 1;
        } else {
            $type = 'string';
            $length = 20;
            $fieldName = $anno;

            Schema::table('iscriziones', function (Blueprint $table) use ($type, $length, $fieldName) {
                $table->$type($fieldName, $length);
            });
        };

        $id = $req->socio_id;

        $viewData = [];
        $viewData["title"] = "iscr ";
        $viewData["subtitle"] = "Iscrizioni";

        $viewData["iscrizioni"] = new Iscrizione;
        $viewData["iscrizioni"]->socio_id = $id;
        $viewData["iscrizioni"]->$anno = $req->anno;
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
        $iscrizioni[$anno-1] = $req[$anno-1];
        $iscrizioni[$anno-2] = $req[$anno-2];
     
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

        $data = Soci::where('cognome', '=', $req->cognome)->get();
        if (isset($data[0]->id)) {
            $id = $data[0]->id;

            $viewData["iscrizioni"] = Iscrizione::rightJoin('socis', 'socis.id', '=', 'iscriziones.socio_id')->orderBy('iscriziones.socio_id', 'DESC')
                ->where('socio_id', '=', $id)
                ->get(['iscriziones.*', 'iscriziones.socio_id', 'socis.*']);
            return view('iscrizione.iscrizioneList')->with("viewData", $viewData);
        } else {
            $viewData["title"] = "Cognome non trovato";
            return view('iscrizione.formFiltraIscritto')->with("viewData", $viewData);
        }
    }
}
