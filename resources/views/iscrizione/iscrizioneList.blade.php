@include('layouts.app')

<div class="container">
    <br>
    <h1 class='tit-add'>Lista iscrizioni</h1>

    <link rel="stylesheet" href="/css/app.css">





    <hr>

    @section('content')

        <!-- FILE: app/views/main/index.blade.php -->



    @stop

    <a class="btn btn-success btn-sm b-add" href="{{ '/list' }}" role="button">Lista Soci</a><br><br>
    <hr>

    <td><a class="btn btn-primary btn-sm b-add" href={{ '/filtraIscritto' }}>Filtra Socio</a></td>

    <table class="table tab1">
        <tr class="head">

            <td>socio_id</td>
            <td>Nome</td>
            <td>Cognome</td>
            <td>Anno</td>
            <td>Modifica/Aggiungi</td>
            <td>Cancella</td>

        </tr>



        @php
        
            $x = 0;
            $co = count($viewData['iscrizioni']);
            session(['primo' => $viewData['iscrizioni'][0]->socio_id]);
            session(['secondo' => $viewData['iscrizioni'][1]->socio_id]);
        @endphp

        @foreach ($viewData['iscrizioni'] as $anag)
            <tr class="colo-list">
                 {{-- 'pr'.session('primo').'sec'.session('secondo').'tr'.session('terzo') --}} 
                @php
                    if ($x < $co - 2) {
                        $x++;
                    }
                @endphp

                @if ( (session('secondo')  == session('primo')) || session('primo') == session('terzo'))
                <td style="background:#fff;">{{ $anag['socio_id'] }}</td>
 
                @else
                    <td style="background:#ccc;">{{ $anag['socio_id'] }}</td>
     
                @endif

                <td>{{ $anag['nome'] }}</td>
                <td>{{ $anag['cognome'] }}</td>
                <td>{{ $anag['anno'] }}</td>



                <td><a href={{ '/editIscrizione/' . $anag->idi }}>Edit/Aggiungi</a></td>
                <td><a href={{ '/deleteIscrizione/' . $anag->idi }} onclick="return confirm('Sei sicuro?')">Cancella</a>
                </td>
            </tr>

            @php
            session(['terzo' => $viewData['iscrizioni'][$x-1]->socio_id]);
            session(['primo' => $viewData['iscrizioni'][$x]->socio_id]);
            session(['secondo' => $viewData['iscrizioni'][$x+1]->socio_id]);
        @endphp

        @endforeach
    </table>


</div>
