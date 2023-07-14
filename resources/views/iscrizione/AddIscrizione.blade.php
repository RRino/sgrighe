 @include('layouts.app')
<link rel="stylesheet" href="css/app.css">
<h1 class="tit-add">Aggiunge Iscrizione</h1>

@section('content')

<!-- FILE: app/views/main/index.blade.php -->

{{-- dd($iscriziones->socio_id) --}}

@stop

<div class="container-sm">

<form action="/addIscrizione" method="POST">
    @csrf
    <div class="form-group">
      <label for="usr">Socio:{{ $viewData['socis']->getId() }} {{ $viewData['socis']->getCognome()  }} </label>
      <input type="hidden" class="form-control" id="nom" name="socio_id" value={{ $viewData['socis']->getId()  }} >
    </div>
<div class="form-group">
    <label for="usr">Anno:</label>
    <input type="text" class="form-control" id="nom" name="anno"  placeholder="Inserire anno">
  </div>

  <div class="form-group">
    <label for="usr">Nome:</label>
    <input type="text" class="form-control" id="nom" name="nome"  value="{{ $viewData['socis']->getNome()  }}">
  </div>

  <div class="form-group">
    <label for="usr">Cognome:</label>
    <input type="text" class="form-control" id="nom" name="cognome"  value="{{ $viewData['socis']->getCognome()  }}">
  </div>

  <div class="form-group">
    <label for="pwd">Note:</label>
    <input type="text" class="form-control" id="co" name="description"  placeholder="Inserire Note">
  </div>

  
  
    <!-- 2 column grid layout for inline styling -->
    <div class="row mb-4">
      <div class="col d-flex justify-content-center">

      </div>
  
    </div>
  
    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block">Aggiungi</button>
  </form>
  <a class="btn btn-success b-list" href="{{"/iscrizione"}}" role="button">Lista iscrizioni</a>
  <a class="btn btn-success b-list" href="{{"/list"}}" role="button">Lista soci</a>

</div>
