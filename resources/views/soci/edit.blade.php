@extends('layouts.app')


@section('title', $viewData['title'])


<a class="btn btn-success btn-sm" href="{{ '/iscrizione' }}" role="button">Iscrizioni</a>
<a class="btn btn-success btn-sm" href="{{ '/list' }}" role="button">Lista</a>
<br><br>


@php
    use Carbon\Carbon;
    $anno = Carbon::now()->format('Y');
    $anno0 = 'a' . $anno;
    $anno1 = 'a' . $anno - 1;
    $anno2 = 'a' . $anno - 2;
    $anno3 = 'a' . $anno +1;
@endphp

@section('content')
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


            @foreach ($viewData['socis'] as $dati)
            
                <form method="POST" action="/editSocio" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col">

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Id:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="id" value="{{ $dati->getId() }}" type="text"
                                        class="form-control">
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
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Cognome:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
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
                                    <input name="cap" value="{{ $dati->getCap() }}" type="text"
                                        class="form-control">
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
                                    <input name="sigla_provincia" value="{{ $dati->getSigla_provincia() }}"
                                        type="text" class="form-control">
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
                                    <input name="codice_fiscale" value="{{ $dati->getCodice_fiscale() }}"
                                        type="text" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Partita iva:</label>
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <input name="partita_iva" value="{{ $dati->getPartita_iva() }}"
                                        type="text" class="form-control">
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
                                    <input name="cellulare" value="{{ $dati->getCellulare() }}"
                                        type="text" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tipo socio:</label>
                                <div class="col-lg-4 col-md-4 col-sm-4">

                                    <select name="tipo_socio" id="tso" class="form-select"
                                        aria-label="Tipo socio">

                                        <option value="1" selected>{{ $dati->getTipo_socio() }}</option>

                                        <option value="1">ordinario</option>
                                        <option value="2">Famigliare</option>
                                        <option value="3">societa</option>
                                    </select>
                                </div>
                            </div>


                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Pubblicato:</label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="published" id="tso" class="form-select" aria-label="Pubblicato">
                                        @if ($dati->getPublished() == true)
                                            <option value="1" selected>{{ $dati->getPublished() }}
                                            </option>
                                        @else
                                            <option value="0" selected>Sospeso </option>
                                        @endif

                                        <option value="1">Abilitato</option>
                                        <option value="0">Sospeso</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Consegna:</label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="consegna" id="tso" class="form-select"
                                        aria-label="Default select example">
                                        <option selected="selected">Seleziona Consegna</option>
                                        @foreach ($viewData['consegnes'] as $consegna)
                                            <option value="{{ $consegna->nome }}">{{ $consegna->nome }}</option>
                                        @endforeach()

                                    </select>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Iscrizioni</label>
        <br>
        <a class="btn btn-success btn-sm" href="{{ '/editIscrizione/'.$dati->getId() }}" role="button">Edit Iscrizioni</a>
        <br>
        <div class="singolo">
            <label class="slabel" for="pwd">{{ $anno+1 }}:</label>
            {{ $dati[$anno3] }}
        </div>
        <div class="singolo">
            <label class="slabel" for="pwd">{{ $anno }}:</label>
            {{ $dati[$anno0] }}
        </div>
        <div class="singolo">
            <label class="slabel" for="pwd">{{ $anno - 1 }}:</label>
            {{ $dati[$anno1] }}
        </div>
        <div class="singolo">
            <label class="slabel" for="pwd">{{ $anno - 2 }}:</label>
            {{ $dati[$anno2] }}
        </div>


                    </div>
                    <div class="mb-3">
                        <label class="form-label">Note</label>
                        <textarea class="form-control" name="description" rows="3">{{ $dati->getDescription() }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Invia</button>

                </form>
                <br>
            @endforeach
 
            <br>
        </div>
    </div>
    <br>
    <br>
@endsection
