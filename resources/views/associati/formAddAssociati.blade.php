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
                    <div class="card-header">{{ __('Aggiunge Anagrafica') }}</div>

                    <div class="card-body">

                        <div class="container-sm">

                            <form action="addAssociati" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="usr">Anagrafica:</label>
                                    <select name="tipo_socio" id="tso" class="form-select" aria-label="Tipo socio">
                                        @foreach ($viewData['anagrafica'] as $anag)
                                            <option id="opt1" value="{{ $anag->id }}">
                                                {{ $anag->id . ' ' . $anag->cognome }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="usr">Ruolo:</label>
                                    <input type="text" class="form-control" id="nom" name="ruolo"
                                        value="{{ $nome ?? old('ruolo') }}" placeholder="Inserire ruolo">
                                </div>


                                <br>

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
