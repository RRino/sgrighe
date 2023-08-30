@include('layouts.app')

<h1 class="tit-add">Modifica Iscrizione</h1>
<link rel="stylesheet" href="/css/app.css">

<div class="container-sm">
    <form action="/editIscrizione" method="POST">
        @csrf
        <div class="form-group">   
            <label for="usr">Nome</label>
            <input type="text" class="form-control" id="nom" name="id" value="{{ $viewData["consegne"]->getNome() }}" >
        </div>

  
        <div class="form-group">
            <label for="usr"></label>
            <input type="text" class="form-control" id="nom" name="sigla" value="{{ $viewData["consegne"]->getSigla()}}">
        </div>

<br>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">Aggiorna</button>
    </form>

    <a class="btn btn-success b-list" href="{{ '/consegne' }}" role="button">Ritorno a Consegne</a>
</div>
