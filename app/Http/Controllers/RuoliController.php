<?php

namespace App\Http\Controllers;

use App\Models\Ruoli;
use Illuminate\Http\Request;

class RuoliController extends Controller
{

    public function show()
    {
        $viewData = [];
        $viewData["title"] = "Ruoli";
        $viewData["ruolis"] = Ruoli::all(); //Ruoli::orderBy('nome');
        return view('ruoli.show')->with("viewData", $viewData);
    }

    public function add()
    {
        $viewData = [];
        $viewData["title"] = "Aggiunge Ruolo";
        $viewData["ruolis"] = Ruoli::all();
        return view('ruoli.formAdd')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        //Ruoli::validate($request);
        $nome = $request->nome;
        $newconsegne = new Ruoli();
        $newconsegne->nome = $request->input('nome');
        $newconsegne->id = $request->input('id');
        $newconsegne->save();
        //return back();
        return redirect('/ruoli');
    }

    public function delete($id)
    {
        Ruoli::destroy($id);
        return redirect('/ruoli');
    }

    public function update(Request $request)
    {
        $nome = $request->nome;
        $id = $request->id;
        $newconsegne = Ruoli::find($id);
        $newconsegne->nome = $request->input('nome');
        $newconsegne->id = $request->input('id');
        $newconsegne->save();
        //return back();
        return redirect('/ruoli');
    }

    public function edit($id)
    {
        $viewData = [];
        $viewData["title"] = "Edit Ruolo";
        $viewData["ruolis"] = Ruoli::find($id);

        return view('ruoli.formEdit')->with("viewData", $viewData);
    }

}
