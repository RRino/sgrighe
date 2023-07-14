@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <ul class="nav">
                    <li><a class="btn btn-success btn-sm b-add" href="login">Login</a></li><br>
                   <!-- <li><a class="btn btn-success btn-sm b-add" href="/iscrizione">Iscrizioni Lista</a></li>-->
                </ul>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Non Autorizzato') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection