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

        dd('salvaSelChck_selSocio',$request);
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
}
