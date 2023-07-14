@extends('layouts.app')
   
@section('content')
    <div class="mcontainer">

        <div class="titolo">
            <h4>Elenco soci.</h4>
        </div>
        <hr>
        <table class="table">
            <thead>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Indirizzo</th>
                <th>Consegna</th>
                <th>CAP</th>
                <th>Localita</th>
                <th>Comune</th>
                <th>Provincia</th>
                <th>Ultimo</th>
                <th>Penultimo</th>
                <th>Email</th>
                <th>Pec</th>
                <th>C.F.</th>
                <th>P.I.</th>
                <th>Tel.</th>
                <th>Cell.</th>
                <th>Tipo socio</th>
                <th>Stato</th>
                <th>Note</th>
                <th>Creato</th>
                <th>Modificato</th>
            </thead>

            <tbody>
            <tbody>
                @foreach ($data as $row)
                @if ($row->nome !== null)
                    <tr>
                        <td>{{ $row->nome }}</td>
                        <td>{{ $row->cognome }}</td>
                        <td>{{ $row->indirizzo }}</td>
                        <td>{{ $row->consegna }}</td>
                        <td>{{ $row->cap }}</td>
                        <td>{{ $row->localita }}</td>
                        <td>{{ $row->comune }}</td>
                        <td>{{ $row->sigla_provincia }}</td>
                        <td>{{ $row->ultimo }}</td>
                        <td>{{ $row->penultimo }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->pec }}</td>
                        <td>{{ $row->codice_fiscale }}</td>
                        <td>{{ $row->partita_iva }}</td>
                        <td>{{ $row->telefono }}</td>
                        <td>{{ $row->cellulare }}</td>
                        <td>{{ $row->tipo_socio }}</td>
                        <td>{{ $row->published }}</td>
                        <td>{{ $row->description }}</td>
                        <td>{{ $row->created_at }}</td>
                        <td>{{ $row->updated_at }}</td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <h5>Pagination:</h5>
        {{ $data->links() }}
    </div>
    @endsection
