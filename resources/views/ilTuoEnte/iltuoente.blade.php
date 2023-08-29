@extends('layouts.app')



<style>
    .slabelb {
        font-weight: 700;
    }
    .slabel {
        color:blue;;
    }
</style>



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
              
                <hr>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dati socio') }}</div>

                
                    

                        <div class="container">
               
                            @foreach ($viewData['iltuoentes'] as $dati)
                            <form method="POST" action="{{ '/deleteSocio/' . $dati->id }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <br>
                                <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip"
                                    title='Delete'>Cancella</button>
                                <a class="btn btn-primary b-list" href={{ '/edit/' . $dati->id }} role="button">Modifica</a>
                                <a class="btn btn-primary b-list" href={{ '/showIscrizione/' . $dati->id }}>Add iscrizione</a>
                               
                            </form>
                            <br>
                            @csrf
                            <div class="singolo">
                                <label class="slabel" for="usr">Id:</label>{{ $dati->id }}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="usr">Tipologia:</label>
                                <span class="slabelb">{{ $dati->tipologia }}</span>
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Cognome:</label>
                                <span class="slabelb">{{-- $dati->getCognome() --}}</span>
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Indirizzo:</label>
                                {{-- $dati->getIndirizzo() --}}
                            </div>
                    
                    
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">CAP:</label>
                                {{-- $dati->getCap() --}}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Località:</label>
                                {{-- $dati->getLocalita() --}}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Comune:</label>
                                {{-- $dati->getComune() --}}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Sigla Prov.:</label>
                                {{-- $dati->getSigla_provincia() --}}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Email:</label>
                                {{-- $dati->getEmail() --}}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">PEC:</label>
                                {{-- $dati->getPec() --}}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">C.F:</label>
                                {{-- $dati->getCodice_fiscale() --}}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">P.Iva:</label>
                                {{-- $dati->getPartita_iva() --}}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Telefono:</label>
                                {{-- $dati->getTelefono() --}}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Cell.:</label>
                                {{-- $dati->getCellulare() --}}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Tipo Socio:</label>
                                <td>{{-- $dati->getTipo_socio() --}}</td>
                    
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Pubblicato:</label>
                                {{-- $dati->getPublished() --}}
                        
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Consegna:</label>
                                {{-- $dati->getConsegna() --}}
                            </div>
             
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Note:</label>
                                {{-- $dati->getDescription() --}}
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