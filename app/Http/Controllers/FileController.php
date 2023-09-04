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
       // $viewData['path'] = 'files';

    $viewData['images4'] = DB::table('immaginis')->get();


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
                $categ = $request->categoria;
                $location = $request->categoria;
                // Upload file
                $file->move($location, $filename);

                $extension = $file->getClientOriginalExtension();

                $save = new Immagini();
                $save->name = $file;
                $save->path = $location;
                $save->nome_file = $filename;
                $save->categor = $extension;
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

    }

    

    public function fordownload(Request $request)
    {
        $fileName = $request->info; //"myfile.txt";

        \File::put(public_path($fileName), $request->info);
        // $fileName= 'img/copertina-46.pdf';
        return response()->download($fileName);

    }


    public function imageDelete($id) {

        $dati = DB::table('immaginis')->where('id',$id)->first();
        
        $image_name = $dati->nome_file;
        $folder = $dati->path;
        $image_path = public_path($folder.'/'.$image_name);
        if(File::exists($image_path)) {
          File::delete($image_path);
        }
        Immagini::destroy($id);
        return redirect('display_img');
      }
      
}
