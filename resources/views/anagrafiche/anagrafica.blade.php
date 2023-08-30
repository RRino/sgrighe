@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">




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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('xxxxxx') }}</div>

                    <div class="card-body">
                        <a class="btn btn-success btn-sm b-add" href="{{ '/list' }}" role="button">Lista
                            Soci</a><br><br>
                        <hr>


                        <div class="container">




                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <a href="tab1" id="home-tab"
                                    class="nav-link @if ($viewData['tab'] === 'tab1') active @endif">Dati Generali</a>
                                <a href="tab2" id="home-tab"
                                    class="nav-link @if ($viewData['tab'] === 'tab2') active @endif">Indirizzi e
                                    Contatti</a>
                                <a href="tab3" id="home-tab"
                                    class="nav-link @if ($viewData['tab'] === 'tab3') active @endif">Tab 3</a>
                                <a href="tab4" id="home-tab"
                                    class="nav-link @if ($viewData['tab'] === 'tab4') active @endif">Tab 4</a>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">...</div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...
                                </div>

                            </div>

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach ($viewData['column'] as $col)
                                            <th scope="col">{{ $col }}</th>
                                        @endforeach


                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach ($viewData['consegnes'] as $consegne)
                                        <tr>
                                            @php
                                                $status = 0;
                                                $nc = count($viewData['column']);
                                            @endphp
                                            @foreach ($viewData['column'] as $col)
                                                @if ($status < $nc)
                                                    @php
                                                        $coln = $viewData['column'][$status];
                                                        $status++;
                                                    @endphp
                                                    <td>{{ $consegne[$coln] }}</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>





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
