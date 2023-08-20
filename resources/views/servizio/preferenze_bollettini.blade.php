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

         

                            <form method="POST"  action="/param_bollettini" enctype="multipart/form-data">
                                @csrf                             
                                <fieldset>
                                    <div class="minput-group">
                                        <label>Id</label>                                
                                        <input type="text" required class="form-control" name="id"
                                            value="{{ $viewData['bollettinis'][0]->id }}">
                                    <label>Causale</label>                                
                                        <input type="text" required class="form-control" name="causale"
                                            value="{{ $viewData['bollettinis'][0]->causale }}">
                                        <label>Costo</label>
                                        <input type="text" required class="form-control" name="prezzo"
                                            value="{{ $viewData['bollettinis'][0]->prezzo }}">
                                        <div class="input-group-append" id="button-addon2">
                                            <button class="btn btn-primary square btn-sm cae" type="submit">Salva</button>
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
                        <a class="btn btn-success btn-sm b-add cae" href="{{ '/list' }}" role="button">Lista
                            Soci</a>
                        <a class="btn btn-success btn-sm b-add cae" href="{{ '/' }}" role="button">Home</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</div>
