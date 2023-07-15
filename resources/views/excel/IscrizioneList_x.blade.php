@extends('layouts.app')


@section('content')

<div class="container">
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

                        <form action="{{ url('importIscriz') }}" method="post" enctype="multipart/form-data">

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

                <a href="{{ url('exportIscrizione') }}" class="btn btn-primary btn-sm cae" >Esporta in Excel </a>
                <a class="btn btn-success btn-sm b-add cae" href="{{"/list"}}" role="button">Lista Soci</a>
    
            </div>
      

   

        <div class="titolo cae">
            <h4>Elenco iscritti</h4>
        </div>
        <hr>
        <table class="table">
            <thead>
                <th>id</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>anno</th>
                <th>soci_id</th>
                
            </thead>

            <tbody>
            <tbody>
                @foreach ($data as $row)
                @if ($row->nome !== null)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->nome }}</td>
                        <td>{{ $row->cognome }}</td>
                        <td>{{ $row->anno }}</td>
                        <td>{{ $row->socio_id }}</td>
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

