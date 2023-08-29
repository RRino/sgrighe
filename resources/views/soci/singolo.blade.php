@extends('layouts.app')



<style>
    .slabelb {
        font-weight: 700;
    }
    .slabel {
        color:blue;;
    }
</style>

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
            <div class="card-body">
                <a class="btn btn-success btn-sm b-add" href="{{ '/list' }}" role="button">Lista Soci</a>
                <a class="btn btn-success btn-sm" href="{{ '/iscrizione' }}" role="button">Lista iscrizioni</a>
                <hr>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dati socio') }}</div>

                
                    

                        <div class="container">
               
                            @foreach ($viewData['socis'] as $dati)
                            <form method="POST" action="{{ '/deleteSocio/' . $dati->getId() }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <br>
                                <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip"
                                    title='Delete'>Cancella</button>
                                <a class="btn btn-primary b-list" href={{ '/edit/' . $dati->getId() }} role="button">Modifica</a>
                                <a class="btn btn-primary b-list" href={{ '/showIscrizione/' . $dati->getId() }}>Add iscrizione</a>
                               
                            </form>
                            <br>
                            @csrf
                            <div class="singolo">
                                <label class="slabel" for="usr">Id:</label>{{ $dati->getId() }}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="usr">Nome:</label>
                                <span class="slabelb">{{ $dati->getNome() }}</span>
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Cognome:</label>
                                <span class="slabelb">{{ $dati->getCognome() }}</span>
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Indirizzo:</label>
                                {{ $dati->getIndirizzo() }}
                            </div>
                    
                    
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">CAP:</label>
                                {{ $dati->getCap() }}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Località:</label>
                                {{ $dati->getLocalita() }}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Comune:</label>
                                {{ $dati->getComune() }}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Sigla Prov.:</label>
                                {{ $dati->getSigla_provincia() }}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Email:</label>
                                {{ $dati->getEmail() }}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">PEC:</label>
                                {{ $dati->getPec() }}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">C.F:</label>
                                {{ $dati->getCodice_fiscale() }}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">P.Iva:</label>
                                {{ $dati->getPartita_iva() }}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Telefono:</label>
                                {{ $dati->getTelefono() }}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Cell.:</label>
                                {{ $dati->getCellulare() }}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Tipo Socio:</label>
                                <td>{{ $dati->getTipo_socio() }}</td>
                    
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Pubblicato:</label>
                                {{ $dati->getPublished() }}
                                @if ($dati->getPublished() == false)
                                    Sospeso
                                @endif
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Consegna:</label>
                                {{ $dati->getConsegna() }}
                            </div>
                            Iscrizioni
                            <div class="singolo">
                                <label class="slabel" for="pwd">{{ $anno +1 }}:</label>
                                {{ $dati[$anno3] }}
                            </div>
                            <div class="singolo">
                                <label class="slabel" for="pwd">{{ $anno }}:</label>
                                {{ $dati[$anno0] }}
                            </div>
                            <div class="singolo">
                                <label class="slabel" for="pwd">{{ $anno - 1 }}:</label>
                                {{ $dati[$anno1] }}
                            </div>
                            <div class="singolo">
                                <label class="slabel" for="pwd">{{ $anno - 2 }}:</label>
                                {{ $dati[$anno2] }}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Note:</label>
                                {{ $dati->getDescription() }}
                            </div>
                            <br>
                        @endforeach
                        <br>




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