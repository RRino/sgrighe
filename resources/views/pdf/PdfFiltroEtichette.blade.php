 @include('layouts.app')
 <link rel="stylesheet" href="css/app.css">
 <div class="container">
<br>
 <h1 class="tit-add">Stampa etichette</h1>
 <h5 class="tit-add">Stampa i etichette dei soci anno rinnovo</h5>
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
<!-- 

     Route::post('etichette_anno',  'PdfEtichette'); 

-->
     <form action="etichette_anno" class="form" method="POST">
         @csrf
         <div class="form-group">
             <label for="usr">Anno ultima iscrizione:</label>
             <input type="text" class="form-control" id="nom" name="etichette_anno" value="{{ now()->year }}">
             <input type="hidden" class="form-control" id="nom" name="tipo" value="2">
         </div><br>
         <button type="submit" class="btn btn-primary btn-sm btn-block">Crea PDF etichette</button>
     </form>
<br>



   
     <a class="btn btn-success btn-sm b-list" href="{{ '/list' }}" role="button">Lista soci</a><br>
 </div>
