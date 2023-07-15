@include('layouts.app')



<div class="container">
    @section('title', $viewData['title'])
    <br>
    <h1 class='tit-add'>{{ $viewData['title'] }}</h1>

    <link rel="stylesheet" href="/css/app.css">
    @section('content')


        <div class="col-md-12">

            <div class="card">

                <div class="card-header bgsize-primary-4 white card-header">
                    <h4 class="card-title">Importa Esporta Soci in Excel</h4>
                </div>

                <div class="card-body">

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert"></button>
                            <strong>{{ $message }}</strong>
                        </div>

                        <br>
                    @endif

                    <form action="{{ url('importSoci') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <label>Segliere il file Soci da caricare <small
                                    class="warning text-muted">{{ __('Please upload only Excel (.xlsx or .xls) files') }}</small></label>
                            <div class="minput-group">
                                <input type="file" required class="form-control" name="uploaded_file" id="uploaded_file">
                                @if ($errors->has('uploaded_file'))
                                    <p class="text-right mb-0">
                                        <small class="danger text-muted"
                                            id="file-error">{{ $errors->first('uploaded_file') }}</small>
                                    </p>
                                @endif
                                 
                                <div class="input-group-append" id="button-addon2">
                                    <button class="btn btn-primary square btn-sm cae" type="submit"><i
                                            class="ft-upload mr-1"></i> Carica Soci Excel</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div>



            <div class="pull-right--">

                <a href="{{ url('exportSoci') }}" class="btn btn-primary btn-sm cae">Esporta Soci in Excel </a>
                <a class="btn btn-success btn-sm b-add cae" href="{{ '/list' }}" role="button">Lista Soci</a>

            </div>
        </div>
