@extends('layouts.app')

@section('content')
    <div class="container">

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
                    <div class="card-header">{{ __('Aggiunge ruolo') }}</div>

                    <div class="card-body">
                        <a class="btn btn-success b-list" href="{{ '/ruoli' }}" role="button">Lista Ruoli</a>
                        <div class="container-sm">
                            <form action="addRuoli" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="usr">Nome:</label>
                                    <input type="text" class="form-control" id="nom" name="nome" value="{{ $nome ?? old('nome') }}"
                                        placeholder="Inserire nome">
                                </div>
                                <!--<div class="form-group">
                                    <label for="pwd">Sigla:</label>
                                    <input type="text" class="form-control" id="co" name="id" value="{{-- $sigla??old('cognome') --}}"
                                        placeholder="Inserire id">
                                </div>-->

                                
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary square btn-sm">Invia</button><br>
                            </form>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
