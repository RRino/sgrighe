<?php

namespace App\Http\Controllers;

use App\Models\Immagini;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class FileController extends Controller
{

    public function index()
    {

        $viewData = [];
        $viewData['path'] = 'files';

        $path = public_path($viewData['path']);
        $viewData['images4'] = scandir($path);
        $viewData['images4'] = DB::table('immaginis')->where('path', $viewData['path'])->get();

        return view('file.index')->with("viewData", $viewData);
    }

    public function list_file()
    {
        return view('file.list_file');
    }

    public function uploadFile(Request $request)
    {

        if ($request->categoria != "Seleziona Categoria") {

            // Validation
            $request->validate([
                'file' => 'required|mimes:png,jpg,jpeg,csv,txt,pdf,doc,xlsx|max:4048',
            ]);

            if ($request->file('file')) {
                $file = $request->file('file');
                //$filename = time().'_'.$file->getClientOriginalName();
                $filename = $file->getClientOriginalName();
                // File upload location
                $location = $request->categoria;
                // Upload file
                $file->move($location, $filename);

                $save = new Immagini();
                $save->name = $file;
                $save->path = $location;
                $save->nome_file = $filename;
                $save->save();

                Session::flash('message', 'Upload Successfully.');
                Session::flash('alert-class', 'alert-success');
            } else {
                Session::flash('message', 'File not uploaded.');
                Session::flash('alert-class', 'alert-danger');
            }


        } else {
            Session::flash('message', 'Categoria non selezionata.');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect('/file');

        //$request->file->storeAs('uploads', $fileName);

    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([

            'file' => 'required|mimes:csv,txt,xlx,xls,pdf,png|max:4048',
        ]);

        $name = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->store('public/files');

        $save = new Immagini();
        $save->name = $name;
        $save->path = $path;
        $save->save();

        return redirect('file')->with('status', 'File Has been uploaded successfully in Laravel 10');

    }

    public function fordownload(Request $request)
    {
        $fileName = $request->info; //"myfile.txt";

        \File::put(public_path($fileName), $request->info);
        // $fileName= 'img/copertina-46.pdf';
        return response()->download($fileName);

    }

}
