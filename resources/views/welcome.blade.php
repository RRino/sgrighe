@extends('layouts.app')

<style>
.img_fluid{
    width:150px;
    height:200px;
    margin:5px;
}
.pl{
    width:100%;
}
    </style>
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

               
                   <img src="{{ asset('/img/palazzo-rossi.jpg') }}" class="pl">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

