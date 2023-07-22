@include('layouts.app')

<div class="container">
    <br>
    <h1 class='tit-add'>Lista iscrizioni</h1>

    <link rel="stylesheet" href="/css/app.css">

    {{-- dd($iscriziones) --}}



    <hr>

    @section('content')

        <!-- FILE: app/views/main/index.blade.php -->

        {{-- dd($iscriziones) --}}

    @stop

    <a class="btn btn-success btn-sm b-add" href="{{ '/list' }}" role="button">Lista Soci</a><br><br><hr>
   
    <td><a class="btn btn-primary btn-sm b-add" href={{ '/filtraIscritto' }}>Filtra Socio</a></td>

    <table class="table tab1">
        <tr class="head">
            <td>id</td>
            <td>socio_id</td>
            <td>Nome</td>
            <td>Cognome</td>
            <td>Anno</td>
            <td>Modifica/Aggiungi</td>
            <td>Cancella</td>

        </tr>
         
            {{-- dd($viewData['iscrizioni']) --}}
        
            @foreach ($viewData['iscrizioni'] as $anag)
            <tr class="colo-list">
                <td>{{$anag['idi'] }}</td>
                <td>{{$anag['socio_id'] }}</td>
                <td>{{$anag['nome'] }}</td>
                <td>{{$anag['cognome'] }}</td>
                <td>{{$anag['anno'] }}</td>

                <td><a href={{ '/editIscrizione/'.$anag->idi }}>Edit/Aggiungi</a></td>
                <td><a href={{'/deleteIscrizione/'.$anag->idi }}
                        onclick="return confirm('Sei sicuro?')">Cancella</a>
                </td>



            </tr>
            
        @endforeach
    </table>


</div>
