@extends('layouts.app')




<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


<style>
    .hidden{
        display:none;
    }
    </style>

@php
    use Carbon\Carbon;
    $anno = Carbon::now()->format('Y');
    $anno0 = 'a' . $anno;
    $anno1 = 'a' . $anno - 1;
    $anno2 = 'a' . $anno - 2;
    $anno3 = 'a' . $anno + 1;
@endphp

@section('content')

<a class="btn btn-success " href="{{ '/anagrafiche/tab1' }}" role="button">Lista</a>
<br><br>
    <div class="card mb-4">

        
        <div class="card-header">
            Edit soci
        </div>
        <div class="card-body">
            @if ($errors->any())
                <ul class="alert alert-danger list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            @endif

 
            @php
                $dati = $viewData['anagraficas'];
            @endphp
            
                <form method="POST" action="/editAnag" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col">

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tipo:</label>
                                <div class="col-lg-4 col-md-4 col-sm-4">

                                    <div class="form-group">
                                       
                                        <div class="col-sm-9">
                                            <input class="message_pri" type="radio" name="per_soc" value="Persona"> Persona
                                            <input class="message_pri" type="radio" name="per_soc" value="Societa"> Societa
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Id:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="id" value="{{ $dati->getId() }}" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nome:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="nome" value="{{ $dati->getNome() }}" type="text"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                    <label class="col-lg-2 col-md-6 col-sm-12 col-form-label cognome">Cognome:</label>
                                    <div class="col-lg-10 col-md-6 col-sm-12 cognome">
                                        <input name="cognome" value="{{ $dati->getCognome() }}" type="text"
                                            class="form-control">
                                    </div>
                                 
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Indirizzo:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="indirizzo" value="{{ $dati->getIndirizzo() }}" type="text"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">CAP:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="cap" value="{{ $dati->getCap() }}" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Località:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="localita" value="{{ $dati->getlocalita() }}" type="text"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Comune:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="comune" value="{{ $dati->getComune() }}" type="text"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Provincia:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="sigla_provincia" value="{{ $dati->getSigla_provincia() }}" type="text"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Email:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="email" value="{{ $dati->getEmail() }}" type="text"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Pec:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="pec" value="{{ $dati->getPec() }}" type="text"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">C.Fiscale:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="codice_fiscale" value="{{ $dati->getCodice_fiscale() }}" type="text"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Partita iva:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="partita_iva" value="{{ $dati->getPartita_iva() }}" type="text"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Telefono:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="telefono" value="{{ $dati->getTelefono() }}" type="text"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Cellulare:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="cellulare" value="{{ $dati->getCellulare() }}" type="text"
                                        class="form-control">
                                </div>
                            </div>

            


                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Pubblicato:</label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                  
                                        <div class="col-sm-9">
                                            <input type="radio" name="published" value="1"> Abilitato
                                            <input type="radio" name="published" value="2"> Sospeso
                                        </div>
                                    </div>
                                </div>
                            </div>

 
                        </div>
                    </div>
            
                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea class="form-control" name="description" rows="3">{{ $dati->getDescription() }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Invia</button>

                </form>
                <br>
      

            <br>
        </div>
    </div>
    <br>
    <br>
@endsection


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
 $(document).ready(function() {

$('.message_pri').change(function(){
    if($(this).val() == 'Persona')
    {
      $('.cognome').removeClass('hidden');
       
    }
    else
    {
       
      $('.cognome').addClass('hidden');
    
    }
  });
});
  </script>