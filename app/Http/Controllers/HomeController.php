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
        return view('home');
    }

      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('adminHome');
    }

    public function superAdminHome()
    {
        return view('superAdminHome');
    }

    public function home()
    {
        return view('home');
    }

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
