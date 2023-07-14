 @include('layouts.app')
 <link rel="stylesheet" href="css/app.css">
 <div class="container">
<br>
 <h1 class="tit-add">Stampa bollettini</h1>
 <h5 class="tit-add">Stampa i bollettini dei soci dell'utima iscrizione, della penultima o da selezione da lista</h5>
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

     <form action="bollettini_anno" class="form" method="POST">
         @csrf
         <div class="form-group">
             <label for="usr">Anno rinnovo:</label>
             <input type="text" class="form-control" id="nom" name="bollettini_anno" value="{{ now()->year }}">
             <input type="hidden" class="form-control" id="nom" name="tipo" value="3">
         </div>
         <button type="submit" class="btn btn-primary btn-sm btn-block">Crea PDF bollettini</button>
     </form>

   
     <a class="btn btn-success btn-sm b-list" href="{{ '/list' }}" role="button">Stampa selezionati da lista</a><br><br>
 </div>
