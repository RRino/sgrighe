@extends('layouts.app')

@php
    use Carbon\Carbon;
    $anno = Carbon::now()->format('Y');
    // $anno = $viewData["anno"];
    
    $anno0 = 'a' . $anno;
    $anno1 = 'a' . $anno - 1;
    $anno2 = 'a' . $anno - 2;
    $anno3 = 'a' . $anno + 1;
@endphp

@section('content')
    <div class="container-fluid">

        @if ($errors->any())
            <ul class="alert alert-danger list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <a class="btn btn-success btn-sm " href="{{ '/list' }}" role="button">Lista Soci</a>
        <a class="btn btn-success btn-sm " href="{{ '/iscrizione' }}" role="button">Lista iscrizioni</a>
        <br><br>
        <div class="row justify-content-center">
        
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ 'Aggiungi iscrizione a : '.$viewData['socis']->getNome(). ' ' .$viewData['socis']->getCognome() }}</div>

                    <div class="card-body">
            
                        <div class="container">

                            <form action="/addIscrizione" method="POST">
                                @csrf
                                <div class="form-group">

                                    <input type="hidden" class="form-control" id="nom" name="socio_id"
                                        value={{ $viewData['socis']->getId() }}>
                                </div>





                                <div class="form-group">
                                    <label for="usr">Anno:</label>
                                    <input type="text" class="form-control" id="nom" name="anno"
                                        placeholder="Inserire anno">
                                </div>




                                <!-- 2 column grid layout for inline styling -->
                                <div class="row mb-4">
                                    <div class="col d-flex justify-content-center">

                                    </div>

                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary">Aggiungi</button>
                            </form>
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
