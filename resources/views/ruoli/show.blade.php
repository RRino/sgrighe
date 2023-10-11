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
                
                <a class="btn btn-primary " href="{{ '/formRuoli' }}" role="button">Aggiungi ruolo</a>
                
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <ul class="alert alert-danger list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                    <div class="colo">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Modifica</th>
                                        <th scope="col">Cancella</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viewData['ruolis'] as $consegne)
                                        <tr>
                                            <td>{{ $consegne->id }}</td>
                                            <td>{{ $consegne->nome }}</td>
                                            <td><a href={{"/editRuoli/".$consegne->id}}>Modifica</a></td>
                                            <td><a href={{"/deleteRuoli/".$consegne->id}} onclick="return confirm('Sei sicuro?')">Cancella</a></td>
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
