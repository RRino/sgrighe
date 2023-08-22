@include('layouts.app')
<br>
<h1 class="tit-add">Dati Socio</h1>

<style>
    .iscrizione {
        margin-left: 250px;
        border: solid 1px #ccc;
        padding: 5px;
        width: 380px;
    }

    .slabelb {
        font-weight: 700;
    }
</style>

<head>

    <title class="tit-add">Lista Soci .</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</head>

@php
    use Carbon\Carbon;
    $anno = Carbon::now()->format('Y');
    $anno0 = 'a' . $anno;
    $anno1 = 'a' . $anno - 1;
    $anno2 = 'a' . $anno - 2;
    $anno3 = 'a' . $anno +1;
@endphp

<div class="container-sm">
    @foreach ($viewData['socis'] as $dati)
        <form method="POST" action="{{ '/deleteSocio/' . $dati->getId() }}">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip"
                title='Delete'>Cancella</button>
            <a class="btn btn-primary b-list" href={{ '/edit/' . $dati->getId() }} role="button">Modifica</a>
            <a class="btn btn-primary b-list" href={{ '/showIscrizione/' . $dati->getId() }}>Add iscrizione</a>
            <a class="btn btn-success b-list" href="{{ '/list' }}" role="button">Lista soci</a>
            <a class="btn btn-success b-list" href="{{ '/iscrizione' }}" role="button">Lista iscrizioni</a>
        </form>
        <br>
        @csrf
        <div class="singolo">
            <label class="slabel" for="usr">Id:</label>{{ $dati->getId() }}
        </div>

        <div class="singolo">
            <label class="slabel" for="usr">Nome:</label>
            <span class="slabelb">{{ $dati->getNome() }}</span>
        </div>

        <div class="singolo">
            <label class="slabel" for="pwd">Cognome:</label>
            <span class="slabelb">{{ $dati->getCognome() }}</span>
        </div>

        <div class="singolo">
            <label class="slabel" for="pwd">Indirizzo:</label>
            {{ $dati->getIndirizzo() }}
        </div>



        <div class="singolo">
            <label class="slabel" for="pwd">CAP:</label>
            {{ $dati->getCap() }}
        </div>

        <div class="singolo">
            <label class="slabel" for="pwd">Località:</label>
            {{ $dati->getLocalita() }}
        </div>

        <div class="singolo">
            <label class="slabel" for="pwd">Comune:</label>
            {{ $dati->getComune() }}
        </div>

        <div class="singolo">
            <label class="slabel" for="pwd">Sigla Prov.:</label>
            {{ $dati->getSigla_provincia() }}
        </div>

        <div class="singolo">
            <label class="slabel" for="pwd">Email:</label>
            {{ $dati->getEmail() }}
        </div>

        <div class="singolo">
            <label class="slabel" for="pwd">PEC:</label>
            {{ $dati->getPec() }}
        </div>

        <div class="singolo">
            <label class="slabel" for="pwd">C.F:</label>
            {{ $dati->getCodice_fiscale() }}
        </div>

        <div class="singolo">
            <label class="slabel" for="pwd">P.Iva:</label>
            {{ $dati->getPartita_iva() }}
        </div>

        <div class="singolo">
            <label class="slabel" for="pwd">Telefono:</label>
            {{ $dati->getTelefono() }}
        </div>

        <div class="singolo">
            <label class="slabel" for="pwd">Cell.:</label>
            {{ $dati->getCellulare() }}
        </div>

        <div class="singolo">
            <label class="slabel" for="pwd">Tipo Socio:</label>
            <td>{{ $dati->getTipo_socio() }}</td>

        </div>

        <div class="singolo">
            <label class="slabel" for="pwd">Pubblicato:</label>
            {{ $dati->getPublished() }}
            @if ($dati->getPublished() == false)
                Sospeso
            @endif
        </div>

        <div class="singolo">
            <label class="slabel" for="pwd">Consegna:</label>
            {{ $dati->getConsegna() }}
        </div>
        Iscrizioni
        <div class="singolo">
            <label class="slabel" for="pwd">{{ $anno +1 }}:</label>
            {{ $dati[$anno3] }}
        </div>
        <div class="singolo">
            <label class="slabel" for="pwd">{{ $anno }}:</label>
            {{ $dati[$anno0] }}
        </div>
        <div class="singolo">
            <label class="slabel" for="pwd">{{ $anno - 1 }}:</label>
            {{ $dati[$anno1] }}
        </div>
        <div class="singolo">
            <label class="slabel" for="pwd">{{ $anno - 2 }}:</label>
            {{ $dati[$anno2] }}
        </div>

        <div class="singolo">
            <label class="slabel" for="pwd">Note:</label>
            {{ $dati->getDescription() }}
        </div>
        <br>
    @endforeach
    <br>
    <br>
    <br>

</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
                title: `Sei sicuro di cancellare?`,
                text: "se lo cancelli è definitivo",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });
</script>
