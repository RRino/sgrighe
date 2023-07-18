@include('layouts.app')



<div class="container">
    @section('title', $viewData['title'])
    <br>
    <h1 class='tit-add'>{{ $viewData['title'] }}</h1>

    <link rel="stylesheet" href="/css/app.css">
    @section('content')



        <div class="container" style="border:1px solid #cecece;padding:20px;border-radius:5px;">
            <div class="row">
                <div class="col-sm">
                    <div class="card">

                        <div class="card-header bgsize-primary-4 white card-header">
                            <h4 class="card-title">Importa Iscrizione in Excel</h4>
                        </div>

                        <div class="card-body">

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert"></button>
                                    <strong>{{ $message }}</strong>
                                </div>

                                <br>
                            @endif

                            <form action="{{ url('importIscrizione') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <fieldset>
                                    <label>Segliere il file Iscrizione da caricare <small
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
                                                    class="ft-upload mr-1"></i> Carica Iscrizione Excel</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card-header bgsize-primary-4 white card-header">
                        <h4 class="card-title"> Esporta Iscrizione in Excel</h4>
                    </div>

                    <div class="card-body">
                        <div class="pull-right--">
                            <form method="POST" action="/exportIscrizione" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Anno iscriz:</label>
                                    <div class="col-lg-10 col-md-6 col-sm-12">
                                        <input name="anno" value="" type="text" class="form-control">
                                        <button type="submit" class="btn btn-primary btn-sm">Esporta Iscrizione anno</button>
                                    </div>
                                </div>


                                <div class="mb-3 row">
                                    <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tutti:</label>
                                    <div class="col-lg-10 col-md-6 col-sm-12">
                                        <a class="col-lg-6 col-md-6 col-sm-12  btn btn-primary btn-sm"
                                            href="{{ '/exportIscrizioneTutti' }}" role="button">Esporta Iscrizione
                                            tutti</a>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card-header bgsize-primary-4 white card-header">
                        <h4 class="card-title">Ritorno a pagina</h4>
                    </div>

                    <div class="card-body">
                        <a class="btn btn-success btn-sm b-add cae" href="{{ '/list' }}" role="button">Lista Soci</a>
                        <a class="btn btn-success btn-sm b-add cae" href="{{ '/iscrizione' }}" role="button">Lista
                            Iscrizioni</a>
                    </div>
                </div>
            </div>
        </div>