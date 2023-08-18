@extends('layouts.app')

<div class="container">


    <link rel="stylesheet" href="/css/app.css">
    @section('content')
        <div class="container" style="border:1px solid #cecece;padding:20px;border-radius:5px;">
            <div class="row">
                <div class="col-sm">
                    <div class="card">

                        <div class="card-header bgsize-primary-4 white card-header">
                            <h4 class="card-title">Bollettini</h4>
                        </div>

                        <div class="card-body">


                            <form action="{{-- url('importSoci') --}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <fieldset>
                                    <label>Causale <small
                                            class="warning text-muted">{{ __('Inserire causale') }}</small></label>
                                    <div class="minput-group">
                                        <input type="text" required class="form-control" name="causale">
                                        <label>Costo <small
                                            class="warning text-muted">{{ __('Inserire il costo ') }}</small></label>
                                        <input type="text" required class="form-control" name="prezzo">
                                        <div class="input-group-append" id="button-addon2">
                                            <button class="btn btn-primary square btn-sm cae" type="submit"><i
                                                    class="ft-upload mr-1"></i> Invia</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>

  

                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card-header bgsize-primary-4 white card-header">
                        <h4 class="card-title">Etichette</h4>
                    </div>

                    <div class="card-body">
                        <div class="pull-right--">
                            <form method="POST" action="/exportSoci" enctype="multipart/form-data">
                                @csrf
        
                                <fieldset>
                                    <label>Nome etichetta </label>
                                    <div class="minput-group">
                                        <input type="text" required class="form-control" name="causale">
                                        <label>Larghezza <small
                                            class="warning text-muted">{{ __('in mm ') }}</small></label>
                                        <input type="text" required class="form-control" name="prezzo">


                                        <div class="input-group-append" id="button-addon2">
                                            <button class="btn btn-primary square btn-sm cae" type="submit"><i
                                                    class="ft-upload mr-1"></i> Invia</button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>


                        </div>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="card-header bgsize-primary-4 white card-header">
                        <h4 class="card-title">Ritorno a pagina:</h4>
                    </div>

                    <div class="card-body">
                        <a class="btn btn-success btn-sm b-add cae" href="{{ '/list' }}" role="button">Lista Soci</a>
                        <a class="btn btn-success btn-sm b-add cae" href="{{ '/' }}" role="button">Home</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</div>
