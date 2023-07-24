 @include('layouts.app')
<link rel="stylesheet" href="css/app.css">

<div class="contenainer">
<h1 class="tit-add">Filtro iscrizione</h1>

@section('content')


@stop

<div class="container-sm">
  <a class="btn btn-success btn-sm b-list" href="{{"/list"}}" role="button">Ritorno a lista</a><br><br>

  <form action="/filtro" method="POST">
    @csrf
    <div class="form-group">
      <label for="usr">Anno:</label>
      <input type="text" class="form-control" id="nom" name="anno"  placeholder="Inserire anno">
    </div>
    <br>
    <button type="submit" class="btn btn-primary btn-sm btn-block">Filtra anno </button>
  </form>

  
<br>


 
</div>
</div>