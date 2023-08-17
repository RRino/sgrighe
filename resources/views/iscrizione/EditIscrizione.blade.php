@include('layouts.app')

<h1 class="tit-add">Modifica Iscrizione</h1>
<link rel="stylesheet" href="/css/app.css">

{{-- dd($viewData["socis"][0]) --}}
@php
    $anno = $viewData["anno"];
    $anno1 = 'a'.$anno-1;
    $anno2 = 'a'.$anno-2;
@endphp
<div class="container-sm">
    <form action="/editIscrizione" method="POST">
        @csrf
        <div class="form-group">   
            <label for="usr">Nome</label>
            <input type="text" class="form-control" id="nom" name="id" value="{{  $viewData["socis"][0]->ids. ' '.$viewData["socis"][0]->getNome() . ' '.$viewData["socis"][0]->getCognome()  }}" >
        </div>

  
        <div class="form-group">
            <label for="usr"></label>
            <input type="hidden" class="form-control" id="nom" name="socio_id" value="{{ $viewData["socis"][0]->socio_id }}">
        </div><br>

        <div class="form-group">
            <label for="usr">{{ $anno }}:</label>
            <input type="text" class="form-control" id="nom" name="anno" value="{{ $viewData["socis"][0]->$anno }}">
        </div><br>
        <div class="form-group">
            <label for="usr">{{ $anno-1 }}:</label>
            <input type="text" class="form-control" id="nom" name="anno" value="{{ $viewData["socis"][0]->$anno1 }}">
        </div><br>
        <div class="form-group">
            <label for="usr">{{ $anno-2 }}</label>
            <input type="text" class="form-control" id="nom" name="anno" value="{{ $viewData["socis"][0]->$anno2 }}">
        </div><br>

        <div class="form-group">
            <label for="pwd">Note:</label>
            <input type="text" class="form-control" id="co" name="description" value="{{ $viewData["socis"][0]->description }}">
        </div>
  
<br>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block">Aggiorna</button>
    </form>

    <a class="btn btn-success b-list" href= "/showIscrizione/{{ $viewData["socis"][0]->socio_id}}" >Aggiungi iscrizione</a>
    <a class="btn btn-success b-list" href="{{ '/iscrizione' }}" role="button">Ritorno a lista</a>
</div>
