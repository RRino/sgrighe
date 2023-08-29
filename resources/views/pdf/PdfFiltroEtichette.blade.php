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


        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Crea Etichette') }}</div>

                    <div class="container">
                        <br>
                        <a class="btn btn-success btn-sm b-list" href="{{ '/list' }}" role="button">Lista soci</a><br>
                       <hr>
                        <form action="etichette_anno" class="form" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="usr">Anno ultima iscrizione:</label><br>
                                <input type="text" class="form-controlx" id="nom" name="etichette_anno"
                                    value="{{ now()->year }}">


                                <input type="hidden" class="form-control" id="nom" name="tipo" value="2">
                            </div><br>
                        
                            <button type="submit" class="btn btn-primary">Crea PDF etichette</button>
                        </form>
                        <br><br><br><br>

                        {{-- $viewData['iscrizioni']->links() --}}
                        <br>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
@endsection
