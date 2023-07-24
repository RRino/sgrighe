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

         .parametri {
             margin-left: 100px;
         }
     </style>
     @section('content')


     @stop
     <!--

     Route::post('etichette_anno',  'PdfEtichette');

-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <br>

     <form action="etichette_anno" class="form" method="POST">
         @csrf
         <div class="form-group">
             <label for="usr">Anno ultima iscrizione:</label>
             <input type="text" class="form-control" id="nom" name="etichette_anno"
                 value="{{ now()->year }}">
             <input type="hidden" class="form-control" id="nom" name="tipo" value="2">
         </div><br>
         <button type="submit" class="btn btn-primary btn-sm btn-block">Crea PDF etichette</button>
<br><br><br>
         <div class="details" style="display:none">
             <div class="form-group">
                 <label for="usr">Anno ultima iscrizione:</label>
                 <input type="text" class="form-control" id="nom" name="etichette_anno"
                     value="{{ now()->year }}">
                 <input type="hidden" class="form-control" id="nom" name="tipo" value="2">
             </div><br>
         </div>

         
     </form>


     <br>




     <a class="btn btn-success btn-sm b-list" href="{{ '/list' }}" role="button">Lista soci</a><br>
 </div>




 <div class="parametri">
     <a id="more" href="#"
         onclick="$('.details').slideToggle(function(){$('#more').html($('.details').is(':visible')?'Chiudi parametri':'Visualizza parametri etichette');});">Parametri
         etichette</a>
 </div>
