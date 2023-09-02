<?php
    
namespace App\Http\Controllers;
     
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Response;
use App\Models\File;

class FileController extends Controller
{
  
    public function index(){

        $viewData = [];
    
        //$viewData['images'] = Storage::disk('public')->allFiles('');
       $viewData['images'] = Storage::disk('public')->files('files');
       return view('file.index')->with("viewData", $viewData);
    
      //$viewData['images'] = File::files(public_path('uploads'));
      //return view('file.index')->with("viewData", $viewData);
    
    
    // If you would like to retrieve a list of 
    // all files within a given directory including all sub-directories    
    //$files2 = File::allFiles(public_path()); 
    //dd($files,$files2);
    
       /* return Response::make(file_get_contents('img/copertina-46.pdf'), 200, [
            'content-type'=>'application/pdf',
        ]);*/
       //or
     //  return response()->file(public_path('img/copertina-46.pdf'),['content-type'=>'application/pdf']);
    }

    public function list_file(){
        return view('file.list_file');
   }

   public function uploadFile(Request $request){

        // Validation
        $request->validate([
              'file' => 'required|mimes:png,jpg,jpeg,csv,txt,pdf,doc|max:2048'
        ]);

        if($request->file('file')) {
              $file = $request->file('file');
              //$filename = time().'_'.$file->getClientOriginalName();
              $filename = $file->getClientOriginalName();

              // File upload location
              $location = 'storage/documenti';

              // Upload file
              $file->move($location,$filename);

              Session::flash('message','Upload Successfully.');
              Session::flash('alert-class', 'alert-success');
        }else{
              Session::flash('message','File not uploaded.');
              Session::flash('alert-class', 'alert-danger');
        }
        return redirect('/file');

        //$request->file->storeAs('uploads', $fileName); 

   }

   public function store(Request $request)
   {
 
         
        $validatedData = $request->validate([
       
         'file' => 'required|mimes:csv,txt,xlx,xls,pdf,png|max:4048'
        ]);
 
        $name = $request->file('file')->getClientOriginalName();
 
        $path = $request->file('file')->store('public/files');
 
  
        $save = new File();
 
        $save->name = $name;
        $save->path = $path;
        $save->save();

        return redirect('file')->with('status', 'File Has been uploaded successfully in Laravel 10');
 
    }
  
  

public function fordownload(Request $request){
    $fileName= $request->info;//"myfile.txt";
 
    \File::put(public_path($fileName),$request->info);
   // $fileName= 'img/copertina-46.pdf';
    return response()->download($fileName);
   
   }

}
