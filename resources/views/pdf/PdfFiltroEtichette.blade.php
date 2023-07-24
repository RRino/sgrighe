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

         body {
             height: 1000px;
         }
     </style>
     @section('content')


     @stop
     <!--

     Route::post('etichette_anno',  'PdfEtichette');

          -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <br>
     <a class="btn btn-success btn-sm b-list" href="{{ '/list' }}" role="button">Lista soci</a><br>
     <form action="etichette_anno" class="form" method="POST">
         @csrf
         <div class="form-group">
             <label for="usr">Anno ultima iscrizione:</label>
             <input type="text" class="form-control" id="nom" name="etichette_anno"
                 value="{{ now()->year }}">
             <input type="hidden" class="form-control" id="nom" name="tipo" value="2">
         </div><br>
         <button type="submit" class="btn btn-primary btn-sm btn-block">Crea PDF etichette</button>
     </form>
     <br><br><br><br><br><br>





     <div class="details" style="display:none">
         <form action="param_etichette" class="form" method="POST">
             <div class="form-group">
                 <label for="usr">Nome</label>
                 <input type="text" class="form-control" id="nom" name="nome" value="{{ old('nome') }}">
                 <label for="usr">Spazio sup. mm:</label>
                 <input type="text" class="form-control" id="nom" name="spazio_sup" value="">
                 <label for="usr">Altezza etichetta mm:</label>
                 <input type="text" class="form-control" id="nom" name="altezza_etic" value="">
                 <label for="usr">Larghezza etichetta mm:</label>
                 <input type="text" class="form-control" id="nom" name="altezza_etic" value="">
                 <label for="usr">Numero orrizontale:</label>
                 <input type="text" class="form-control" id="nom" name="num_orriz" value="">
                 <label for="usr">Numero verticale:</label>
                 <input type="text" class="form-control" id="nom" name="num_vertic" value="">
                 <br>
                 <button type="submit" class="btn btn-primary btn-sm btn-block">Salva </button>
             </div><br>
         </form>
     </div>

     <br>
     <br>










     <div class="parametri">
         <a id="more" href="#"
             onclick="$('.details').slideToggle(function(){$('#more').html($('.details').is(':visible')?'Chiudi parametri':'Visualizza parametri etichette');});">Parametri
             etichette</a>
     </div>
     <br>
     <br>
 </div>


 <br>
 <br>
