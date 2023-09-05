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
                                <label class="slabel" for="pwd">Permalink:</label>
                                <a href="{{ $dati->permalink}}" target=”_blank”>Permalink</a>
                        
                            </div>

                            <div class="singolo">
                                <label class="slabel" for="usr">Tipologia:</label>
                                <span class="slabelb">{{ $dati->tipologia }}</span>
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Settore:</label>
                                <span class="slabelb">{{$dati->settore }}</span>
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Acronimo:</label>
                                {{ $dati->acronimo}}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Nome breve:</label>
                                {{ $dati->nome_breve }}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Telefono:</label>
                                {{ $dati->telefono}}
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Cellulare:</label>
                                {{ $dati->cellulare }}
                            </div>
                    
    
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Web e Social</label>
                                {{ $dati->webesocial }}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Email:</label>
                                {{ $dati->email}}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">PEC:</label>
                                {{$dati->pec}}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">C.F:</label>
                                {{-- $dati->getCodice_fiscale() --}}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Settore ISTAT:</label>
                                {{ $dati->settore_istat }}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Attivita ISTAT:</label>
                                {{ $dati->attivita_istat}}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Destinatari</label>
                                {{ $dati->destinatari}}
                            </div>
                    
                            <div class="singolo">
                                <label class="slabel" for="pwd">Presentazione:</label>
                                <td>{{ $dati->presentazione}}</td>
                    
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