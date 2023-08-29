@extends('layouts.app')

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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Iscrizioni socio') }}</div>

                    <div class="card-body">
                        <a class="btn btn-success btn-sm b-add" href="{{ '/list' }}" role="button">Lista Soci</a>
                        <a class="btn btn-success btn-sm" href="/showIscrizione/{{ $viewData['socis'][0]->socio_id }}">Aggiungi
                            iscrizione</a>
                        <a class="btn btn-success btn-sm" href="{{ '/iscrizione' }}" role="button">Lista iscrizioni</a>
                        <br><br>
                        <hr>
                    

                        <div class="container">
                            <form action="/editIscrizione" method="POST">
                                @csrf
                        
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                        
                                            <th scope="col">Id</th>
                                            <th scope="col">Socio_id</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Cognome</th>
                                            <th scope="col">{{ $anno+1 }}</th>
                                            <th scope="col">{{ $anno }}</th>
                                            <th scope="col">{{ $anno-1 }}</th>
                                            <th scope="col">{{ $anno-2 }}</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" id="nom" name="id"
                                                    value="{{ $viewData['socis'][0]->ids  }}" >
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="nom" name="socio_id"
                                                    value="{{ $viewData['socis'][0]->socio_id  }}" >
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="nom" name="nome"
                                                    value="{{ $viewData['socis'][0]->getNome()  }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="nom" name="cognome"
                                                    value="{{ $viewData['socis'][0]->getCognome()  }}">
                                            </td>
                                            <td>   <input type="text" class="form-control" id="nom" name="{{ $anno+1 }}"
                                                value="{{ $viewData['socis'][0]->$anno3 }}">
                                            </td>
                                            <td>   <input type="text" class="form-control" id="nom" name="{{ $anno }}"
                                                value="{{ $viewData['socis'][0]->$anno0 }}">
                                            </td>
                                            <td>   <input type="text" class="form-control" id="nom" name="{{ $anno-1 }}"
                                                value="{{ $viewData['socis'][0]->$anno1 }}">
                                            </td>
                                            <td>   <input type="text" class="form-control" id="nom" name="{{ $anno-2 }}"
                                                value="{{ $viewData['socis'][0]->$anno2 }}">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        
                        
                                
                                <br>
                        
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary">Aggiorna</button>
                            </form>
                        
                          

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




