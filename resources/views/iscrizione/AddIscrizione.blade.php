 @include('layouts.app')
 <link rel="stylesheet" href="css/app.css">
 <h1 class="tit-add">Aggiunge Iscrizione</h1>




 <div class="container">
     <div class="row">
         <div class="col-sm" style="border:solid 1px #ccc;padding:10px;border-radius:5px;">

             <div class="card">
                 <div class="card-header bgsize-primary-4 white card-header">
                     <h4 class="card-title">Aggiungi iscrizione</h4>
                 </div>
                 <div class="card-body">

                     <form action="/addIscrizione" method="POST">
                         @csrf
                         <div class="form-group">
                             <label for="usr">Socio:{{ $viewData['socis']->getId() }}
                                 {{ $viewData['socis']->getCognome() }}
                             </label>
                             <input type="hidden" class="form-control" id="nom" name="socio_id"
                                 value={{ $viewData['socis']->getId() }}>
                         </div>
         

                         <div class="form-group">
                             <label for="usr">Nome:</label>
                             <input type="text" class="form-control" id="nom" name="nome"
                                 value="{{ $viewData['socis']->getNome() }}" readonly>
                         </div>

                         <div class="form-group">
                             <label for="usr">Cognome:</label>
                             <input type="text" class="form-control" id="nom" name="cognome"
                                 value="{{ $viewData['socis']->getCognome() }}" readonly>
                         </div>
                         <div class="form-group">
                          <label for="usr">Anno:</label>
                          <input type="text" class="form-control" id="nom" name="anno"
                              placeholder="Inserire anno">
                      </div>
                         <div class="form-group">
                             <label for="pwd">Note:</label>
                             <input type="text" class="form-control" id="co" name="description"
                                 placeholder="Inserire Note">
                         </div>



                         <!-- 2 column grid layout for inline styling -->
                         <div class="row mb-4">
                             <div class="col d-flex justify-content-center">

                             </div>

                         </div>

                         <!-- Submit button -->
                         <button type="submit" class="btn btn-primary btn-block">Aggiungi</button>
                     </form>
                 </div>
             </div>
         </div>
         <div class="col-sm" style="border:solid 1px #ccc;padding:10px;border-radius:5px;">
             <div class="card">
                 <div class="card-header bgsize-primary-4 white card-header">
                     <h4 class="card-title">Iscrizioni</h4>
                 </div>
                 <div class="card-body">
                     <div>
                         <table class="table" style="max-width:500px;border:solid 1px #ccc">
                             @foreach ($viewData['iscrizione'] as $iscrizione)
                                 <thead>
                                     <th>anno</th>
                                     <th>note</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <td>{{ $iscrizione->getAnno() }}</td>
                                         <td>{{ $iscrizione->getDescription() }}</td>
                                     </tr>
                                 </tbody>
                             @endforeach
                         </table>

                     </div>
                 </div>
             </div>
         </div>
         <div class="col-sm" style="border:solid 1px #ccc;padding:10px;border-radius:5px;">
             <div class="card">
                 <div class="card-header bgsize-primary-4 white card-header">
                     <h4 class="card-title">Ritorno a pagina</h4>
                 </div>
                 <div class="card-body">
                     <a class="btn btn-success  " href="{{ '/iscrizione' }}" role="button">Lista iscrizioni</a>
                     <a class="btn btn-success  " href="{{ '/list' }}" role="button">Lista soci</a>
                 </div>
             </div>
         </div>
     </div>
 </div>
