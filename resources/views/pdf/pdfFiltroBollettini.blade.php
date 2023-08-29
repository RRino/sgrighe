@extends('layouts.app')

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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Crea bollettini anno scelto') }}</div>

                    <div class="card-body">
                        <a class="btn btn-success btn-sm b-add" href="{{ '/list' }}" role="button">Lista
                            Soci</a><br><br>
                        <hr>


                        <div class="container">
                            <form action="creaBollettini_anno" class="form" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="usr">Anno non rinnovato:</label><br>
                                    <input type="text" class="" id="an" name="bollettini_anno"
                                        value="{{ now()->year }}"><br>
                                    <input type="hidden" class="" id="nom" name="tipo" value="3">

                                    <br>
                                    <button type="submit" class="btn btn-primary">Crea PDF
                                        bollettini</button>
                            </form>
                            <br>

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
