@extends('layouts.app')

@php
    use Carbon\Carbon;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xls;
    use Illuminate\Support\Facades\Response;
    
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

        <style>
            .imx {
                width: 100px;
            }
        </style>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('xxxxxx') }}</div>

                    <div class="card-body">
                        <a class="btn btn-success btn-sm b-add" href="{{ '/list' }}" role="button">Lista
                            Soci</a><br><br>
                        <hr>


                        <div class="container">


                            <form action="{{-- route('down') --}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="info">Add Info</label>
                                    <input type="text" name="info">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                            @foreach ($viewData['images'] as $img)
                                
                                 
                                   <a href="{{ $img->path }}">{{ $img->name }}</a>
                        
                                
                            @endforeach
                    

                            <br>

                        </div>
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
