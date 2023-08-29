@extends('layouts.app')

<style>
.img_fluid{
    width:150px;
    height:200px;
    margin:5px;
}
    </style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

    
                                  
                    <a href="iltuoente_list"><img src="{{ asset('/img/il-tuo-ente.png') }}" class="img_fluid"></a>
                    <a href="/anagrafiche"><img src="{{ asset('/img/anagrafiche.png') }}" class="img_fluid"></a>
                    <a  href="{{ '/list' }}"> <img src="{{ asset('/img/associati.png') }}" class="img_fluid"></a>
                   
                    <img src="{{ asset('/img/email.png') }}" class="img_fluid">
 
                    <img src="{{ asset('/img/contabilita.png') }}" class="img_fluid">
                    <img src="{{ asset('/img/organi-sociali.png') }}" class="img_fluid">
                    <img src="{{ asset('/img/progetti.png') }}" class="img_fluid">
                    <img src="{{ asset('/img/cartelle.png') }}" class="img_fluid">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection