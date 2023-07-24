 @include('layouts.app')
 <link rel="stylesheet" href="css/app.css">
 <div class="container">
     <br>
     <h1 class="tit-add">Stampa bollettini</h1>
     <h5 class="tit-add">Stampa i bollettini dei soci anno di rinnovo</h5>
     <style>
         .form {
             max-width: 600px;
             margin: 10px;
         }

         #an {
             max-width: 100px;
         }

         .b-list {
             margin-top: 73px;
         }
     </style>
     @section('content')


     @stop
     <!--
    
    Route::post('creaBollettini_anno', 'PdfBollettini');
    // richiamato dal form filtro anno bollettini
-->
     <form action="creaBollettini_anno" class="form" method="POST">
         @csrf
         <div class="form-group">
             <label for="usr">Anno rinnovo:</label>
             <input type="text" class="form-control" id="an" name="bollettini_anno"
                 value="{{ now()->year }}">
             <input type="hidden" class="form-control" id="nom" name="tipo" value="3">
             <label for="usr">Causale:</label>
             <input type="text" class="form-control" id="ca" name="causale"
                 value="ISCRIZIONE ASSOCIAZIONE PROGETTO 10 Righe APS 2023 piu 2 riviste">
         </div><br>
         <button type="submit" class="btn btn-primary btn-sm btn-block">Crea PDF bollettini</button>
     </form>
     <br>

     <a class="btn btn-success btn-sm b-list" href="{{ '/list' }}" role="button">Lista soci</a><br><br>
 </div>
