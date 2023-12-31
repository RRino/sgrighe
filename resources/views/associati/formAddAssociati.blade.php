@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<style>
    .hidden {
        display: none;
    }
</style>

@section('content')
    <div class="container">


        @if (session('successful_message'))
            <div class="alert alert-success">
                {{ session('successful_message') }}
            </div>
        @endif

        @if (session('error_message'))
            <div class="alert alert-danger">
                {{ session('error_message') }}
            </div>
        @endif


        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Aggiunge Anagrafica') }}</div>

                    <div class="card-body">

                        <div class="container-sm">

                            <form action="addAssociati" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="usr">Anagrafica:</label>
                                    <select name="anagrafica" id="tso" class="form-select" aria-label="Tipo socio">
                                        @foreach ($viewData['anagrafica'] as $anag)
                                            <option id="opt1" value="{{ $anag->id }}">
                                                {{ $anag->id . ' ' . $anag->cognome }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="usr">Ruolo:</label>
                                    <select name="ruolo" id="tso" class="form-select" aria-label="Tipo socio">
                                        @foreach ($viewData['ruoli'] as $anag)
                                            <option id="opt1" value="{{ $anag->id }}">
                                                {{ $anag->id . ' ' . $anag->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="usr">Ruoli specifici:</label>

                                    <select name="ruolispec[]" id="tso" class="form-select"
                                        aria-label="Ruolo_specifico" multiple="">
                                        @foreach ($viewData['enumruolispec'] as $anag)
                                            <option id="opt1" value="{{ $anag->nome }}">
                                                {{ $anag->id . ' ' . $anag->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="usr">Date iscriz:</label>

                                    <select name="dataiscr[]" id="tso" class="form-select"
                                        aria-label="Data_iscrizione" multiple="">
                                        @foreach ($viewData['enumdateiscr'] as $anag)
                                            <option id="opt1" value="{{ $anag->nome }}">
                                                {{ $anag->nome . ' ' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>

       

                                <div class="form-group">
                                    <label for="usr">Consegne:</label>
                                    <select name="consegne" id="tso" class="form-select" aria-label="Consegna">
                                        @foreach ($viewData['consegne'] as $anag)
                                            <option id="opt1" value="{{ $anag->id }}">
                                                {{ $anag->sigla . ' - ' . $anag->nome }}</option>
                                        @endforeach
                                    </select>
                                </div><br>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary">Aggiungi</button>
                            </form><br>
                            <a class="btn btn-success b-list" href="{{ '/anagrafiche' }}" role="button">Anagrafica</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('.message_pri').change(function() {
            if ($(this).val() == 'Persona') {
                $('.cognome').removeClass('hidden');

            } else {

                $('.cognome').addClass('hidden');

            }
        });
    });
</script>
