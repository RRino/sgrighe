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

    
                    <a class="btn btn-secondary " href="{{ '/consegne' }}" role="button">Consegne</a>
                    <a class="btn btn-primary " href="{{ '/tipo_socio' }}" role="button">Tipo socio</a>

                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection