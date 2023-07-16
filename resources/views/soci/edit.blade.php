@extends('layouts.app')
@section('title', $viewData['title'])


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

            <form method="POST" action="/editSocio" enctype="multipart/form-data">
                @csrf
            
                <div class="row">
                    <div class="col">

                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Id:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="id" value="{{ $viewData['soci']->getId() }}" type="text"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nome:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="nome" value="{{ $viewData['soci']->getNome() }}" type="text"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Cognome:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="cognome" value="{{ $viewData['soci']->getCognome() }}" type="text"
                                    class="form-control">
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Indirizzo:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="indirizzo" value="{{ $viewData['soci']->getIndirizzo() }}" type="text"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">CAP:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="cap" value="{{ $viewData['soci']->getCap() }}" type="text"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Località:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="localita" value="{{ $viewData['soci']->getlocalita() }}" type="text"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Comune:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="comune" value="{{ $viewData['soci']->getComune() }}" type="text"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Provincia:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="sigla_provincia" value="{{ $viewData['soci']->getSigla_provincia() }}"
                                    type="text" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Email:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="email" value="{{ $viewData['soci']->getEmail() }}" type="text"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Pec:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="pec" value="{{ $viewData['soci']->getPec() }}" type="text"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">C.Fiscale:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="codice_fiscale" value="{{ $viewData['soci']->getCodice_fiscale() }}"
                                    type="text" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Partita iva:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="partita_iva" value="{{ $viewData['soci']->getPartita_iva() }}" type="text"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Telefono:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="telefono" value="{{ $viewData['soci']->getTelefono() }}" type="text"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Cellulare:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="cellulare" value="{{ $viewData['soci']->getCellulare() }}" type="text"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tipo socio:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <select name="tipo_socio" id="tso" class="form-control imp">
                                    <option>Seleziona Tipo di socio</option>
                                    <option value="1">ordinario</option>
                                    <option value="2">Famigliare</option>
                                    <option value="3">societa</option>
                                </select>
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Pubblicato:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <select name="published" id="tso" class="form-control imp">
                                    <option>Seleziona Stato</option>
                                    <option value="1">Pubblicato</option>
                                    <option value="0">Sospeso</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Consegna:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <select name="consegna" id="tso" class="form-control imp">
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

         
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Ultimo anno:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="ultimo" value="{{ $viewData['iscriziones'][0]->getAnno()}}" type="text"
                                    class="form-control" readonly>
                            </div>
                        </div>
             
                        <div class="mb-3 row">
                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Penultimo anno:</label>
                            <div class="col-lg-10 col-md-6 col-sm-12">
                                <input name="penultimo" value="{{ $viewData['iscriziones'][1]->getAnno()}}" type="text"
                                    class="form-control" readonly>
                            </div>
                        </div>
                  
              
                </div>
                <div class="mb-3">
                    <label class="form-label">Note</label>
                    <textarea class="form-control" name="description" rows="3">{{ $viewData['soci']->getDescription() }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Invia</button>
            </form>


        </div>
    </div>
    <br>
    <br>
@endsection
