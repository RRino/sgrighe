@extends('layouts.app')

<style>
    .img_dim {
        height: 50px;
    }

    .col {
        border: solid 1px #ccc;
        padding: 5px;
        min-width: 250px;
        margin-bottom: 10px;
        margin-left: 10px;
        height: auto;

    }

    .lab {
        width: 100px;
        color: #2f3a79;
    }





    .published {
        position: absolute;
        bottom: 0px;

    }

    .rsp {
        padding-top: 10px;
    }
</style>



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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Associati') }}</div>

                    <div class="card-body">
                        <a class="btn btn-success btn-sm b-add" href="{{ '/formAddAssociati' }}"
                            role="button">Aggiungi</a><br><br>
                        <hr>

                        <div id="tit2" style="text-align:center;margin-bottom:10px;font-size:16px;font-weight:700;">
                        </div>
                        <div class="container">
                            @if($errors->any())
                            <h4>{{$errors->first()}}</h4>
                            @endif
                            <div class="row">

                                {{-- dd($viewData['associati'][0]->ruoli) --}}
                                @php $primo = 0; @endphp
                                @foreach ($viewData['associati'] as $soci)
                               
                                    <div class="col">
                                        <div class="anagr">
                                            {{-- dd($soci->ruoli->nome) --}}
                                            {{ $soci->anagrafica->id . ' ' . $soci->anagrafica->nome . ' ' . $soci->anagrafica->cognome }}<br><br>
                                            <label class="lab">Indirizzo:</label>{{ $soci->anagrafica->indirizzo }}<br>
                                            <label class="lab">CAP:</label>{{ $soci->anagrafica->cap }}<br>
                                            <label class="lab">località:</label>{{ $soci->anagrafica->localita }}<br>
                                            <label class="lab">Comune:</label>{{ $soci->anagrafica->comune }}<br>
                                            <label
                                                class="lab">Provincia:</label>{{ $soci->anagrafica->sigla_provincia }}<br>
                                            <label class="lab">Email:</label>{{ $soci->anagrafica->email }}<br>
                                            <label class="lab">PEC:</label>{{ $soci->anagrafica->pec }}<br>
                                            <label class="lab">C.D.F:</label>{{ $soci->anagrafica->codice_fiscale }}<br>
                                            <label class="lab">P.IVA:</label>{{ $soci->anagrafica->partita_iva }}<br>
                                            <label class="lab">Tel.:</label>{{ $soci->anagrafica->telefono }}<br>
                                            <label class="lab">Cell.:</label>{{ $soci->anagrafica->cellulare }}<br>
                                        </div>

                                        <div class="ruolo_spec">

                                            @forelse($soci->ruolispecm as $soci->ruolispecm)
                                                <label class="lab rsp">Ruolo
                                                    specif:</label>{{ $soci->ruolispecm->nome }}<br>
                                            @empty
                                                <label class="lab rsp">Ruolo specif:</label><br>
                                                <label class="lab rsp">Ruolo specif:</label><br>
                                            @endforelse
                                        </div>
                                        <br>

                                        <div class="dataiscr">
                                            @forelse($soci->dateiscr_many as $soci->date_specm)
                                                <label class="lab dat">Data
                                                    iscriz:</label>{{ $soci->date_specm->nome }}<br>
                                            @empty
                                                <label class="lab dat">Data iscr:</label><br>
                                            @endforelse
                                            <br>
                                        </div>

                                        <div class="consegne">
                                            @forelse($soci->consegnem as $soci->consegnem)
                                                <label class="lab dat">Consene:</label>{{ $soci->consegnem->nome }}<br>
                                            @empty
                                                <label class="lab dat">Consegne:</label><br>
                                            @endforelse
                                            <br>
                                        </div>
                                        <div class="published">
                                            <label class="lab">Pubblicato:</label>
                                            {{ $soci->anagrafica->published }}
                                            </label><br>
                                        </div>
                                    </div>
                                @endforeach

                            </div>


                            <a class="btn btn-primary btn-sm adds" href="{{ '/delAss/'.$soci->id }}" role="button">Cancella</a>
                        </div>

                        {{-- $viewData['iscrizioni']->links() --}}
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var myDiv1Para = $('#tit1').remove();
        myDiv1Para.appendTo('#tit2');

    });
</script>
