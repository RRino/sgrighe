@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">



<style>
    .nrighe {
        width: 200px;
    }
</style>



@section('title', $viewData['title'])


@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">
                
                <a class="btn btn-primary " href="{{ '/formConsegne' }}" role="button">Aggiungi consegna</a>
                <a class="btn btn-primary " href="{{ '/consegne' }}" role="button">Lista consegne</a>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <ul class="alert alert-danger list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif



                <div class="card">
                    <div class="card-header"> 
                        <form class="nrighe" action="/paginazione" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="nom" class="">N.righe</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="nom" name="rows"
                                        value="{{ session('pag') }}" placeholder="Numero righe e Invio">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="colo">

                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                       
                                        <th scope="col">Nome</th>
                                        <th scope="col">Sigla</th>
                                        <th scope="col">Modifica</th>
                                        <th scope="col">Cancella</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viewData['consegnes'] as $consegne)
                                        <tr>
        
                                            <td>{{ $consegne->getNome() }}</td>
                                            <td>{{ $consegne->getSigla() }}</td>
                                            
                                            <td><a href={{"/editConsegne/".$consegne->id}}>Edit</a></td>
                                            <td><a href={{"/deleteConsegne/".$consegne->id}} onclick="return confirm('Sei sicuro?')">Cancella</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                @endsection
            </div>
        </div>
    </div>
