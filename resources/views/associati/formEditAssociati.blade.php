@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<style>
    .hidden {
        display: none;
    }
    label{
        color:blue;
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
                    <div class="card-header">{{ __('Edit Associato') }}</div>

                    <div class="card-body">

                        <div class="container-sm">
                            {{-- dd($viewData['associati'][0]->anagrafica,$viewData['associati'][0]->ruoli) --}}
                            <form action="updateAssociati" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="usr">Associato:</label>
                                    
                                    {{ $viewData['associati'][0]->anagrafica->nome . ' ' . $viewData['associati'][0]->anagrafica->nome }}
                                <input type='hidden' name="anagrafica" value="<?php echo $viewData['associati'][0]->anagrafica->id ?>">
                                <input type='hidden' name="ass_id" value="<?php echo $viewData['associati'][0]->id ?>">
                                </div>

                                <div class="form-group">
                                    <label for="usr">Ruolo:</label>
                                    {{ $viewData['ruoli_es']->nome }}
                                    <select name="ruolo" id="tso" class="form-select" aria-label="Tipo socio">
                                        @foreach ($viewData['ruoli'] as $anag)
                                            <option id="opt1" value="{{ $anag->id }}">
                                                {{ $anag->id . ' ' . $anag->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                              
                                    <div class="ruolo_spec">
                                        @php $primo = 0;@endphp
                                        @forelse($viewData['associati'][0]->ruolispecm as $soci)
                                            @if ($primo == 0)
                                                <label class="lab rsp">Ruolo specif:</label>
                                                @php $primo = 1;@endphp
                                            @endif
                                            {{ $soci->nome }}
                                        @empty
                                            <label class="lab rsp">Ruolo specif:</label>
                                        @endforelse
                                    </div>

                                    <select name="ruolispec[]" id="tso" class="form-select"
                                        aria-label="Ruolo_specifico" multiple="">
                                        @foreach ($viewData['enumruolispec'] as $anag)
                                            <option id="opt1" value="{{ $anag->id }}">
                                                {{ $anag->id . ' ' . $anag->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>




                                <div class="form-group">
                                              
                                    <div class="ruolo_spec">
                                        @php $primo = 0;@endphp
                                        @forelse($viewData['associati'][0]->dateiscr_many as $soci)
                                            @if ($primo == 0)
                                                <label class="lab rsp">Date iscrizione:</label>
                                                @php $primo = 1;@endphp
                                            @endif
                                            {{ $soci->nome }}
                                        @empty
                                            <label class="lab rsp">Date iscrizione:</label>
                                        @endforelse
                                    </div>

                                    <select name="dataiscr[]" id="tso" class="form-select"
                                        aria-label="Date iscrizione" multiple="">
                                        @foreach ($viewData['enumdateiscr'] as $anag)
                                            <option id="opt1" value="{{ $anag->id }}">
                                                {{ $anag->id . ' ' . $anag->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>


                                <div class="form-group">
                                    <label for="usr">Consegne:</label>
                                    {{ $viewData['consegne_es']->nome }}
                                    <select name="consegne" id="tso" class="form-select" aria-label="Consegne">
                                        @foreach ($viewData['consegne'] as $anag)
                                            <option id="opt1" value="{{ $anag->id }}">
                                                {{ $anag->id . ' ' . $anag->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                       


                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary">Esegui</button>
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
