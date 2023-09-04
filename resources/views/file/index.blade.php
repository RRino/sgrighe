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
            .img_dim {
                width: 100px;
            }
        </style>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Documenti') }}</div>

                    <div class="card-body">
                        <a class="btn btn-success btn-sm b-add" href="{{ '/list' }}" role="button">Lista
                            Soci</a><br><br>
                        <hr>

                        <div class="container">

                            <table class="table tab1">
                                <tr class="head">
                                    <td>id</td>
                                    <td>Nome</td>
                                    <td>Posizione</td>
                                    <td>Documento</td>
                                </tr>
 
                                @foreach ($viewData['images4'] as $img)
                             
                                    @if ($img != '.' && $img != '..')
                                        <tr class="colo-list">
                                            <td style="background:#fff;">{{ $img->id }}</td>
                                            <td> <a href=<?php echo $img->path . '/' . str_replace(' ', '%20', $img->nome_file); ?>><?php echo $img->nome_file . '&nbsp;&nbsp;&nbsp;'; ?></a></td>
                                            <td>{{ $img->path }}</td>
                                            @if($img->categor == 'png' || $img->categor == 'jpg')
                                            <td> <a href=<?php echo $img->path . '/' . str_replace(' ', '%20', $img->nome_file); ?>><img class="img_dim" src="<?php echo $img->path . '/' . $img->nome_file; ?>"></a> </td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </table>

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
