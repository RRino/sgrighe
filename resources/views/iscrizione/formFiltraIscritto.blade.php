@include('layouts.app')


 
<div class="container">
    @section('title', $viewData["title"])
    <br>
    <h1 class='tit-add'>{{ $viewData["title"] }}</h1>

    <link rel="stylesheet" href="/css/app.css">

         

       <form action="/trovaIscritto" method="POST">
        @csrf
        <div class="form-group">   
            <label for="usr">Cerca per Cognome</label>
            <input type="text" class="form-control" id="nom" name="cognome" >
        </div>
     <br>
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">Trova</button>
    </form>
    <br>