@include('layouts.app')

<h1 class="tit-add">Modifica Iscrizione</h1>
<link rel="stylesheet" href="/css/app.css">

<div class="container-sm">
    <form action="/editIscrizione" method="POST">
        @csrf
        <div class="form-group">   
            <label for="usr">Nome</label>
            <input type="text" class="form-control" id="nom" name="id" value="{{  $viewData["iscriziones"]->id. ' '.$viewData["socis"]->getNome() . ' '.$viewData["socis"]->getCognome()  }}" >
        </div>

  
        <div class="form-group">
            <label for="usr"></label>
            <input type="hidden" class="form-control" id="nom" name="socio_id" value="{{ $viewData["iscriziones"]->socio_id }}">
        </div>

        <div class="form-group">

            <label for="usr">Anno:</label>
            <input type="text" class="form-control" id="nom" name="anno" value="{{ $viewData["iscriziones"]->anno }}">
        </div>
        <div class="form-group">
            <label for="pwd">Note:</label>
            <input type="text" class="form-control" id="co" name="description" value="{{ $viewData["iscriziones"]->description }}">
        </div>
  
<br>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">Aggiorna</button>
    </form>

    <a class="btn btn-success b-list" href= "/showIscrizione/{{ $viewData["iscriziones"]->socio_id}}" >Aggiungi iscrizione</a>
    <a class="btn btn-success b-list" href="{{ '/iscrizione' }}" role="button">Ritorno a lista</a>
</div>
