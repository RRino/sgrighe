<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class IlTuoEnteController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Il Tuo Ente";

        $viewData["iltuoentes"] = DB::table('iltuoentes')->get();

        return view('ilTuoEnte.iltuoente')->with("viewData", $viewData);
    }
}
