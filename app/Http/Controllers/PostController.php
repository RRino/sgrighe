<?php

     

namespace App\Http\Controllers;

     

use Illuminate\Http\Request;

use App\Models\Post;

use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;

     

class PostController extends Controller

{

  

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function create(): View

    {

        return view('postsCreate');

    }

        

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function store(Request $request): RedirectResponse

    {

        $this->validate($request, [

             'title' => 'required',

             'body' => 'required'

        ]);

   

        $post = Post::create([

            'title' => $request->title,

            'body' => $request->body

        ]);

   

        return back()

                ->with('success','Post created successfully.');

    }

}