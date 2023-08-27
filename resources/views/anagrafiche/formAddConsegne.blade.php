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
                    <div class="card-header">{{ __('Aggiunge consegna') }}</div>

                    <div class="card-body">

                        <div class="container-sm">
                            <form action="addConsegne" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="usr">Nome:</label>
                                    <input type="text" class="form-control" id="nom" name="nome" value="{{ $nome ?? old('nome') }}"
                                        placeholder="Inserire nome">
                                </div>
                                <div class="form-group">
                                    <label for="pwd">Sigla:</label>
                                    <input type="text" class="form-control" id="co" name="sigla" value="{{ $sigla ?? old('cognome') }}"
                                        placeholder="Inserire sigla">
                                </div>

                                
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block">Aggiungi</button>
                            </form>
                            <a class="btn btn-success b-list" href="{{ '/anagrafiche.consegne' }}" role="button">Consegne</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
