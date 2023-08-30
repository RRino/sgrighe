@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">



<style>
    .nrighe {
        width: 200px;
    }
</style>

<style type="text/css">
    .product {

        margin: 55px;

        text-align: center;

        font-size: 20px;

        padding: 15px;

        border-radius: 10px;

        color: #fff;

        background-color: #008B8B;

    }

    .category {

        display: flex;

    }

    body {

        background-color: #d2d2d2;

    }

    .categorys {

        background-color: #fff;

        height: 500px;

    }
</style>



@section('content')
    <a class="btn btn-success btn-sm" href="{{ '/formAnagrafica' }}" role="button">Aggiungi consegna</a>
    <a class="btn btn-success btn-sm " href="{{ '/list' }}" role="button">Lista soci</a>
    <br><br>
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">


            </div>
            <div class="card-body">
                @if ($errors->any())
                    <ul class="alert alert-danger list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif




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


            <div class="container mt-5 justify-content-center">

                <div class="row">

                    <div class="col-md-12 categorys">

                        <div class="row">

                            <div class="mt-5 ms-3">

                                <div class="row">

                                    <div class="col-md-8 mb-3 ">



                                    </div>

        

                                </div>

                            </div>

                            <ul class="nav nav-tabs">

                                @foreach ($category as $item)
                                    <li class=" nav-item">

                                        <a href="{{ route('anagrafica', ['id' => $item->id]) }}"
                                            class="nav-link {{ $catTab == $item->id ? 'active' : '' }}">{{ $item->name }}</a>

                                    </li>
                                @endforeach

                            </ul>

                            <div class="tab-content">


                                @foreach ($category as $item)
                                    <div class="tab-pane {{ $catTab == $item->id ? 'active' : '' }}"
                                        id="home{{ $item->id }}" class="active">

                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nome</th>
                                                    <th scope="col">Cognome</th>
                                                </tr>
                                            </td>
                                            <tbody>
                                            @foreach ($item->anagraficas as $element)
                                            <tr>
                                                <td class="anagrafica">{{ $element->nome }}</td>
                                                <td class="anagrafica">{{ $element->cognome }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>

                                    </div>
                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
