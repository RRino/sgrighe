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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Associati') }}</div>

                    <div class="card-body">
                        <a class="btn btn-success btn-sm b-add" href="{{ '/asstest' }}" role="button">Lista
                            Soci</a><br><br>
                        <hr>


                        <div class="container">

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Sel</th>
                                        <th scope="col">Id</th>

                                        <th scope="col">Nome</th>
                                        <th scope="col"><a href="/list/cognome">Cognome</a></th>
                                        <!-- Route::get('/list/{col}', 'indexOrd');//ok ordina una colonna in index.blade -->
                                        <th scope="col"><a href="/list/indirizzo">Indirizzo</a></th>
                                        <th scope="col">CAP</th>
                                        <th scope="col"><a href="/list/localita">Località</a></th>
                                        <th scope="col"><a href="/list/comune">Comune</a></th>
                                        <th scope="col"><a href="/list/sigla_provincia">Prov.</a></th>

                                        <th scope="col">Ruolo</th>
                                        <th scope="col">Ruoli_spec</th>

                                        <th scope="col">Abilitato</th>
                                        <!--<th scope="col">Attivo</th>--><!-- Non usato per ora -->

                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- dd($viewData) --}}

                                    @foreach ($viewData['associati'] as $soci)
                                        <tr>
                                            <td><input type="checkbox" class="checkbox"
                                                    data-id="{{ $soci->anagrafica->id }}"></td>
                                            <td>{{ $soci->anagrafica_id }}</td>

                                            <td>{{ $soci->anagrafica->nome }}</td>
                                            <td>{{ $soci->anagrafica->cognome }}</td>
                                            <td>{{ $soci->anagrafica->indirizzo }}</td>
                                            <td>{{ $soci->anagrafica->cap }}</td>
                                            <td>{{ $soci->anagrafica->localita }}</td>
                                            <td>{{ $soci->anagrafica->comune }}</td>
                                            <td>{{ $soci->anagrafica->sigla_provincia }}</td>
                                            <td>{{ $soci->ruoli->nome }}</td>


                                            @forelse($soci->ruoli_specm as $soci->ruoli_specm)
                                            
                                                    <td>{{ $soci->ruoli_specm->nome }}</td>
                                            
                                           
                                            @empty
                                                <td>x</td>
                                            @endforelse




                                            <!-- Ruoli -->


                                            <!-- / Ruoli specifici -->











                                            <!--  -->

                                            @if ($soci->anagrafica->getPublished() == 'Abilitato')
                                                <td><a style="color:green"
                                                        href="/changeStatus/{{ $soci->anagrafica->getId() }}"> Si
                                                    </a>
                                                </td>
                                            @else
                                                <td><a style="color:red"
                                                        href="/changeStatus/{{ $soci->anagrafica->getId() }}"> No
                                                    </a>
                                                </td>
                                                <?php /* @endif
                                                    @endif */
                                                ?>

                                                <td></td>



                                        </tr>
                                    @endif
                                    @endforeach

                                </tbody>
                            </table>

                            {{-- $viewData['iscrizioni']->links() --}}
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
