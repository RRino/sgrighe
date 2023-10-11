<?php
use Carbon\Carbon;
use App\Models\Consegne;
use App\Models\Iscrizione;
use App\Models\Soci;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


function formatPrice($value)
{
    return '$' . number_format($value, 2);
}

function index(Request $request)
{

    /* Current Login User Details */
    $user = auth()->user();
    var_dump($user);
  
    /* Current Login User ID */
    $userID = auth()->user()->id; 
    var_dump($userID);
      
    /* Current Login User Name */
    $userName = auth()->user()->name; 
    var_dump($userName);
      
    /* Current Login User Email */
    $userEmail = auth()->user()->email; 
    var_dump($userEmail);
}


  function iscri_leftJoin(){
 
    Paginator::useBootstrap();
    $viewData = [];
    $viewData["title"] = "iscr ";
    $viewData["subtitle"] = "Iscrizioni";

 
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
            'iscriziones.' . ($anno+1) . ' AS  a' . ($anno+1),
        )
        ->orderBy('socis.cognome', 'ASC')
        ->paginate(session('pag'));

        return $viewData;
  }
 
  function iscri_leftJoinId($id){

    $anno = Carbon::now()->format('Y');
    $viewData["anno"] = $anno;

    $viewData["iscrizioni"] = Soci::leftJoin('iscriziones', 'socis.id', '=', 'iscriziones.socio_id')
    ->select('socis.id as ids',
        'iscriziones.socio_id',
        'socis.nome',
        'iscriziones.id',
        'socis.cognome',
        'iscriziones.' . $anno . ' AS  a' . $anno,
        'iscriziones.' . ($anno - 1) . ' AS  a' . ($anno - 1),
        'iscriziones.' . ($anno - 2) . ' AS  a' . ($anno - 2),
        'iscriziones.' . ($anno+1) . ' AS  a' . ($anno+1),
    )
    ->where('socis.id', $id)
    ->orderBy('socis.cognome', 'ASC')
    ->paginate(session('pag'));

    return $viewData["iscrizioni"];
  }

  

  function select_sociRightjoin_singolo($id){

    $anno = Carbon::now()->format('Y');
    $viewData["anno"] = $anno;

    $viewData["socis"] = Soci::select('socis.id',
    'socis.nome',
    'socis.cognome',
    'socis.indirizzo',
    'socis.consegna',
    'socis.cap',
    'socis.localita',
    'socis.comune',
    'socis.sigla_provincia',
    'socis.email',
    'socis.pec',
    'socis.codice_fiscale',
    'socis.partita_iva',
    'socis.telefono',
    'socis.cellulare',
    'socis.tipo_socio',
    'socis.published',
    'socis.description',
    'socis.created_at',
    'socis.updated_at',
    'iscriziones.socio_id',
    //'iscriziones.' . $anno . ' AS  a' . $anno,
   // 'iscriziones.' . ($anno - 1) . ' AS  a' . ($anno - 1),
   // 'iscriziones.' . ($anno - 2) . ' AS  a' . ($anno - 2),
   // 'iscriziones.' . ($anno+1) . ' AS  a' . ($anno+1),
)
    ->rightJoin('iscriziones', 'iscriziones.socio_id', '=', 'socis.id')
    ->where('socis.id', $id)->get();


    return $viewData;
  }
 

  function  exportSoci_IscrittiTutti(){

    $anno = Carbon::now()->format('Y');
    $viewData["anno"] = $anno;

    $viewData = DB::table('socis')
    ->leftJoin('iscriziones', 'socis.id', '=', 'iscriziones.socio_id')
    ->get();// joining the posts table , where user_id and posts_user_id are same

        return $viewData;
  }

  function allUpper($str){
    return strtoupper($str);
  }