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

<style>
    html, body {
        background-image: url("/img/palazzo-rossi.jpg");
        background-position:center;
             background-repeat:no-repeat;
             background-size:cover;
               background-color: #87CEEB;
               color: #636b6f;
               /*font-family: 'Raleway', sans-serif;*/
               font-weight: 100;
               height: 100vh;
               margin: 0;
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
                    
              
 
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

