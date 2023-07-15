@extends('layouts.app')


@section('content')

<div class="mexcelcontainer">
            <div class="col-md-12">

                <div class="card">

                    <div class="card-header bgsize-primary-4 white card-header">
                        <h4 class="card-title">Importa Esporta dati in Excel</h4>
                    </div>

                    <div class="card-body">

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>

                            <br>
                        @endif

                        <form action="{{ url('import') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                <label>Segliere il file da caricare <small
                                        class="warning text-muted">{{ __('Please upload only Excel (.xlsx or .xls) files') }}</small></label>
                                <div class="minput-group">
                                    <input type="file" required class="form-control" name="uploaded_file"
                                        id="uploaded_file">
                                    @if ($errors->has('uploaded_file'))
                                        <p class="text-right mb-0">
                                            <small class="danger text-muted"
                                                id="file-error">{{ $errors->first('uploaded_file') }}</small>
                                        </p>
                                    @endif
                                    <div class="input-group-append" id="button-addon2">
                                        <button class="btn btn-primary square btn-sm cae" type="submit"><i
                                                class="ft-upload mr-1"></i> Carica da Excel</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>

                    </div>
                </div>

            </div>
            <div class="pull-right">

                <a href="{{ url('export') }}" class="btn btn-primary btn-sm cae" >Esporta in Excel </a>
                <a class="btn btn-success btn-sm b-add cae" href="{{"/list"}}" role="button">Lista Soci x</a>
    
            </div>
      

   

        <div class="titolo cae">
            <h4>Elenco soci</h4>
        </div>
        <hr>
        <table class="table">
            <thead>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Indirizzo</th>
                <th>Consegna</th>
                <th>CAP</th>
                <th>Localita</th>
                <th>Comune</th>
                <th>Provincia</th>
                <th>Ultimo</th>
                <th>Penultimo</th>
                <th>Email</th>
                <th>Pec</th>
                <th>C.F.</th>
                <th>P.I.</th>
                <th>Tel.</th>
                <th>Cell.</th>
                <th>Tipo socio</th>
                <th>Stato</th>
                <th>Note</th>
                <th>Creato</th>
                <th>Modificato</th>
            </thead>

            <tbody>
            <tbody>
                @foreach ($data as $row)
                @if ($row->nome !== null)
                    <tr>
                        <td>{{ $row->nome }}</td>
                        <td>{{ $row->cognome }}</td>
                        <td>{{ $row->indirizzo }}</td>
                        <td>{{ $row->consegna }}</td>
                        <td>{{ $row->cap }}</td>
                        <td>{{ $row->localita }}</td>
                        <td>{{ $row->comune }}</td>
                        <td>{{ $row->sigla_provincia }}</td>
                        <td>{{ $row->ultimo }}</td>
                        <td>{{ $row->penultimo }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->pec }}</td>
                        <td>{{ $row->codice_fiscale }}</td>
                        <td>{{ $row->partita_iva }}</td>
                        <td>{{ $row->telefono }}</td>
                        <td>{{ $row->cellulare }}</td>
                        <td>{{ $row->tipo_socio }}</td>
                        <td>{{ $row->published }}</td>
                        <td>{{ $row->description }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td>{{ $row->updated_at }}</td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
      
        <h5>Pagination:</h5>
        {{ $data->links() }}
    </div>

