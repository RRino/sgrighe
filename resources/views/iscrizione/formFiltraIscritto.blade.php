


@extends('layouts.app')

@php
use Carbon\Carbon;
$anno = Carbon::now()->format('Y');
// $anno = $viewData["anno"];

$anno0 = 'a'.$anno;
$anno1 = 'a'.$anno-1;
$anno2 = 'a'.$anno-2;
$anno3 = 'a'.$anno+1;
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


        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Filtra iscritto') }}</div>

                    <div class="card-body">
                        <a class="btn btn-success btn-sm b-add" href="{{ '/iscrizione' }}" role="button">Lista Iscritti</a> 
                        <a class="btn btn-success btn-sm b-add" href="{{ '/list' }}" role="button">Lista soci</a> <hr>
                        <hr>
                    

                        <div class="container">
                        
                            <link rel="stylesheet" href="/css/app.css">
                        
                        
                          
                            <form action="/trovaIscritto" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="usr">Cerca per Cognome</label>
                                    <input type="text" class="form-control" id="nom" name="cognome">
                                </div>
                                <br>
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary">Trova</button>
                            </form>
                            <br>
                        
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







