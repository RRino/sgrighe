 @include('layouts.app')
 <link rel="stylesheet" href="css/app.css">
 <div class="container">
<br>
 <h1 class="tit-add">Stampa etichette</h1>
 <h5 class="tit-add">Stampa i etichette dei soci dell'utima iscrizione, della penultima o da selezione da lista</h5>
 <style>
     .form {
         float: left;
         margin: 10px;
     }

.b-list {
  margin-top: 73px;
}
 </style>
 @section('content')


 @stop

     <form action="etichette_ultimo" class="form" method="POST">
         @csrf
         <div class="form-group">
             <label for="usr">Anno ultima iscrizione:</label>
             <input type="text" class="form-control" id="nom" name="etichette_ultimo" value="{{ now()->year }}">
             <input type="hidden" class="form-control" id="nom" name="tipo" value="2">
         </div>
         <button type="submit" class="btn btn-primary btn-sm btn-block">Crea PDF etichette</button>
     </form>



     <form action="etichette_penultimo" class="form" method="POST">
         @csrf
         <div class="form-group">
             <label for="usr">Anno penultima iscrizione:</label>
             <input type="text" class="form-control" id="nom" name="etichette_penultimo" value="{{ now()->year - 1 }}" placeholder="Inserire anno scorso">
             <input type="hidden" class="form-control" id="nom" name="tipo" value="3">
            </div>
         <button type="submit" class="btn btn-primary  btn-sm btn-block">Crea PDF etichette</button>
     </form>
   
     <a class="btn btn-success btn-sm b-list" href="{{ '/list' }}" role="button">Stampa selezionati da lista</a><br><br>
 </div>
