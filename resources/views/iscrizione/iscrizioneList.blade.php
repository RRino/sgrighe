@include('layouts.app')



<div class="container">
    <br>
    <h1 class='tit-add'>Lista iscrizioni</h1>

    <link rel="stylesheet" href="/css/app.css">

    @php
    $anno = $viewData["anno"];
    $anno0 = 'a'.$anno;
    $anno1 = 'a'.$anno-1;
    $anno2 = 'a'.$anno-2;
@endphp

    <a class="btn btn-success btn-sm b-add" href="{{ '/list' }}" role="button">Lista Soci</a><br><br>
    <hr>

    <td><a class="btn btn-primary btn-sm b-add" href={{ '/filtraIscritto' }}>Filtra Socio</a></td>

    <table class="table tab1">
        <tr class="head">

            <td>socio_id</td>
            <td>Nome</td>
            <td>Cognome</td>
            <td>{{ $anno }}</td>
            <td>{{ $anno-1 }}</td>
            <td>{{ $anno-2 }}</td>
            <td>Modifica/Aggiungi</td>
            <td>Cancella</td>

        </tr>


{{-- dd($viewData['iscrizioni'][1]) --}}
@php
    $anno = $viewData["anno"] ;
@endphp

        @foreach ($viewData['iscrizioni'] as $anag)
            <tr class="colo-list">
                <td style="background:#fff;">{{ $anag->socio_id }}</td>
                <td>{{ $anag['nome'] }}</td>
                <td>{{ $anag['cognome'] }}</td>
                <td>{{ $anag->$anno0 }}</td>
                <td>{{ $anag->$anno1 }}</td>
                <td>{{ $anag->$anno2 }}</td>

                <td><a href={{ '/editIscrizione/' . $anag->id }}>Edit/Aggiungi</a></td>
                <td><a href={{ '/deleteIscrizione/' . $anag->id }} onclick="return confirm('Sei sicuro?')">Cancella</a>
                </td>
            </tr>

          @endforeach
    </table>

    {{ $viewData['iscrizioni']->links() }}
    <br>
</div>
