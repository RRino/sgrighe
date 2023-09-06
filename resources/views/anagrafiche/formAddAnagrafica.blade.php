@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<style>
    .hidden {
        display: none;
    }
</style>

@section('content')
    <div class="container">

        @if ($errors->any())
            <ul class="alert alert-danger list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        @endif
 
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Aggiunge Anagrafica') }}</div>

                    <div class="card-body">

                        <div class="container-sm">

                            <form action="addAnagrafica" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="pwd">Tipo :</label>
                                    <div class="col-sm-9">
                                        <input class="message_pri" type="radio" name="per_soc" value="Persona"> Persona
                                        <input class="message_pri" type="radio" name="per_soc" value="Societa"> Societa
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pwd">Ruolo:</label>
                                    <select name="ruolo" id="tso" class="form-control"
                                        value="{{ $tipo_socio ?? old('tipo_socio') }}">
                                        <option value="">--- Schelta tipo ---</option>
                                        @foreach ($viewData['ruoli'] as $ruolo)
                                            <option value="{{ $ruolo->id }}">{{ $ruolo->ruolo }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="usr">Nome:</label>
                                    <input type="text" class="form-control" id="nom" name="nome"
                                        value="{{ $nome ?? old('nome') }}" placeholder="Inserire nome">
                                </div>

                                <div class="cognome">
                                    <label for="pwd">Cognome:</label>
                                    <input type="text" class="form-control" id="co" name="cognome"
                                        value="{{ $cognome ?? old('cognome') }}" placeholder="Inserire cognome">
                                </div>

                                <div class="form-group">
                                    <label for="pwd">Indirizzo:</label>
                                    <input type="text" class="form-control" id="in" name="indirizzo"
                                        value="{{ $indirizzo ?? old('indirizzo') }}" placeholder="Inserire Indirizzo">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">CAP :</label>
                                    <input type="text" class="form-control" id="in" name="cap"
                                        value="{{ $cap ?? old('cap') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Località:</label>
                                    <input type="text" class="form-control" id="in" name="localita"
                                        value="{{ $localita ?? old('localita') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Comune :</label>
                                    <input type="text" class="form-control" id="in" name="comune"
                                        value="{{ $comune ?? old('comune') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Sigla Prov.:</label>
                                    <input type="text" class="form-control" id="in" name="sigla_provincia"
                                        value="{{ $sigla_provincia ?? old('sigla_provincia') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Email:</label>
                                    <input type="text" class="form-control" id="in" name="email"
                                        value="{{ $email ?? old('email') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">PEC:</label>
                                    <input type="text" class="form-control" id="in" name="pec"
                                        value="{{ $pec ?? old('pec') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">C.F:</label>
                                    <input type="text" class="form-control" id="in" name="codice_fiscale"
                                        value="{{ $codice_fiscale ?? old('codice_fiscale') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">P.Iva</label>
                                    <input type="text" class="form-control" id="in" name="partita_iva"
                                        value="{{ $partita_iva ?? old('partita_iva') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Telefono:</label>
                                    <input type="text" class="form-control" id="in" name="telefono"
                                        value="{{ $telefono ?? old('telefono') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Cell.:</label>
                                    <input type="text" class="form-control" id="in" name="cellulare"
                                        value="{{ $cellulare ?? old('cellulare') }}">
                                </div>

                                <div class="form-group">
                                    <label for="pwd">Pubblicato:</label>
                                    <div class="col-sm-9">
                                        <input type="radio" name="published" value="1"> Abilitato
                                        <input type="radio" name="published" value="2"> Sospeso
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="pwd">Note:</label>
                                    <input type="text" class="form-control" id="in" name="description"
                                        value="{{ $description ?? old('description') }}">
                                </div>
                                <br>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary">Aggiungi</button>
                            </form><br>
                            <a class="btn btn-success b-list" href="{{ '/anagrafiche' }}" role="button">Anagrafica</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('.message_pri').change(function() {
            if ($(this).val() == 'Persona') {
                $('.cognome').removeClass('hidden');

            } else {

                $('.cognome').addClass('hidden');

            }
        });
    });
</script>
