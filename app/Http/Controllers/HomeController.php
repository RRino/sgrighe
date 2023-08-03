<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       /// return view('home');
        
       /* Inserito in sg    $viewData = [];
       */
        $viewData["title"] = "Home Page - Online Store";
        return view('home.index')->with("viewData", $viewData);
        
    }

      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     // non usato in sg
    public function adminHome()
    {
        
        return view('adminHome');
    }
 // non usato in sg
    public function superAdminHome()
    {
        
        return view('superAdminHome');
    }
 // non usato in sg
    public function home()
    {
        
        return view('home');
    }
 // non usato in sg
     public function user()
    {
      
        return view('home');
    } 
    

    public function about()
    {
        $viewData = [];
        $viewData["title"] = "About us - 10 Righe APS";
        $viewData["subtitle"] = "About us";
        $viewData["description"] = "This is an about page ...";
        $viewData["author"] = "Developed by: Felipe Alvarez";
        return view('home.about')->with("viewData", $viewData);
    }
}

