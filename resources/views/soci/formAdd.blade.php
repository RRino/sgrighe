@extends('layouts.app')

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
                    <div class="card-header">{{ __('Aggiunge socio') }}</div>

                    <div class="card-body">

                        <div class="container-sm">
                            <form action="add" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="usr">Nome:</label>
                                    <input type="text" class="form-control" id="nom" name="nome" value="{{ $nome ?? old('nome') }}"
                                        placeholder="Inserire nome">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Cognome:</label>
                                    <input type="text" class="form-control" id="co" name="cognome" value="{{ $cognome ?? old('cognome') }}"
                                        placeholder="Inserire cognome">
                                </div>

                                <div class="form-group">
                                    <label for="pwd">Indirizzo:</label>
                                    <input type="text" class="form-control" id="in" name="indirizzo" value="{{ $indirizzo ?? old('indirizzo') }}"
                                        placeholder="Inserire Indirizzo">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">CAP :</label>
                                    <input type="text" class="form-control" id="in" name="cap" value="{{ $cap ?? old('cap') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Località:</label>
                                    <input type="text" class="form-control" id="in" name="localita" value="{{ $localita ?? old('localita') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Comune :</label>
                                    <input type="text" class="form-control" id="in" name="comune" value="{{ $comune ?? old('comune') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Sigla Prov.:</label>
                                    <input type="text" class="form-control" id="in" name="sigla_provincia" value="{{ $sigla_provincia ?? old('sigla_provincia') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Email:</label>
                                    <input type="text" class="form-control" id="in" name="email" value="{{ $email ?? old('email') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">PEC:</label>
                                    <input type="text" class="form-control" id="in" name="pec" value="{{ $pec ?? old('pec') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">C.F:</label>
                                    <input type="text" class="form-control" id="in" name="codice_fiscale" value="{{ $codice_fiscale ?? old('codice_fiscale') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">P.Iva</label>
                                    <input type="text" class="form-control" id="in" name="partita_iva" value="{{ $partita_iva ?? old('partita_iva') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Telefono:</label>
                                    <input type="text" class="form-control" id="in" name="telefono" value="{{ $telefono ?? old('telefono') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Cell.:</label>
                                    <input type="text" class="form-control" id="in" name="cellulare" value="{{ $cellulare ?? old('cellulare') }}">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Tipo Socio:</label>
                                    <select name="tipo_socio" id="tso" class="form-control" value="{{ $tipo_socio ?? old('tipo_socio') }}">
                                        <option value="">--- Schelta tipo ---</option>
                                        <option value="1">ordinario</option>
                                        <option value="2">Famigliare</option>
                                        <option value="3">Societa</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Pubblicato:</label>
                                    <select name="published" id="tso" class="form-control" value="{{ $published ?? old('published') }}">
                                        <option value="">--- Schelta tipo ---</option>
                                        <option value="1">Abilitato</option>
                                        <option value="2">Sospeso</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="pwd">Consegna:</label>
                                    <input type="text" class="form-control" id="in" name="consegna" value="{{ $consegna ?? old('consegna') }}">
                                </div>

                                <div class="form-group">
                                    <label for="pwd">Note:</label>
                                    <input type="text" class="form-control" id="in" name="description" value="{{ $description ?? old('description') }}">
                                </div>
                                <br>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block">Aggiungi</button>
                            </form>
                            <a class="btn btn-success b-list" href="{{ '/list' }}" role="button">Lista Soci.</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
<br>
<br>
<br>
@endsection
