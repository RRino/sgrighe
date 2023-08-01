@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    You are Admin.
                    <a class="btn btn-success btn-sm" href="{{ '/anagrafiche' }}" role="button">Anagrafica</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection