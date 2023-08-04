@include('layouts.app')
<br>
<h1 class="tit-add">Dati Socio (soci.singolo.blade)</h1>

<style>
    .iscrizione {
        margin-left: 250px;
        border: solid 1px #ccc;
        padding: 5px;
        width: 380px;
    }
</style>

<head>

    <title class="tit-add">Lista Soci .</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</head>



<div class="container-sm">

    @csrf
    <div class="singolo">
        <label class="slabel" for="usr">Id:</label>{{ $viewData['socis']->getId() }}
    </div>

    <div class="singolo">
        <label class="slabel" for="usr">Nome:</label>
        {{ $viewData['socis']->getNome() }}
    </div>

    <div class="singolo">
        <label class="slabel" for="pwd">Cognome:</label>
        {{ $viewData['socis']->getCognome() }}
    </div>

    <div class="singolo">
        <label class="slabel" for="pwd">Indirizzo:</label>
        {{ $viewData['socis']->getIndirizzo() }}
    </div>



    <div class="singolo">
        <label class="slabel" for="pwd">CAP:</label>
        {{ $viewData['socis']->getCap() }}
    </div>

    <div class="singolo">
        <label class="slabel" for="pwd">Località:</label>
        {{ $viewData['socis']->getLocalita() }}
    </div>

    <div class="singolo">
        <label class="slabel" for="pwd">Comune:</label>
        {{ $viewData['socis']->getComune() }}
    </div>

    <div class="singolo">
        <label class="slabel" for="pwd">Sigla Prov.:</label>
        {{ $viewData['socis']->getSigla_provincia() }}
    </div>

    <div class="singolo">
        <label class="slabel" for="pwd">Email:</label>
        {{ $viewData['socis']->getEmail() }}
    </div>

    <div class="singolo">
        <label class="slabel" for="pwd">PEC:</label>
        {{ $viewData['socis']->getPec() }}
    </div>

    <div class="singolo">
        <label class="slabel" for="pwd">C.F:</label>
        {{ $viewData['socis']->getCodice_fiscale() }}
    </div>

    <div class="singolo">
        <label class="slabel" for="pwd">P.Iva:</label>
        {{ $viewData['socis']->getPartita_iva() }}
    </div>

    <div class="singolo">
        <label class="slabel" for="pwd">Telefono:</label>
        {{ $viewData['socis']->getTelefono() }}
    </div>

    <div class="singolo">
        <label class="slabel" for="pwd">Cell.:</label>
        {{ $viewData['socis']->getCellulare() }}
    </div>

    <div class="singolo">
        <label class="slabel" for="pwd">Tip Socio:</label>
        {{ $viewData['socis']->getTipo_socio() }}

    </div>

    <div class="singolo">
        <label class="slabel" for="pwd">Pubblicato:</label>
        {{ $viewData['socis']->getPublished() }}
    </div>

    <div class="singolo">
        <label class="slabel" for="pwd">Consegna:</label>
        {{ $viewData['socis']->getConsegna() }}
    </div>

    <div class="singolo">
        <label class="slabel" for="pwd">Note:</label>
        {{ $viewData['socis']->getDescription() }}
    </div>

    <div class="iscrizione">
        <label class="slabel" for="pwd">Iscrizioni:</label>
    </div>

    @if (isset($viewData['iscriziones']))
            @foreach ($viewData['iscriziones'] as $view)
            <div class="iscrizione">
                {{ $view->getAnno().'- ' . $view->getDescription() }}
              
            </div>
        @endforeach
    @endif

    <form method="POST" action="{{ '/deleteSocio/' . $viewData['socis']->getId() }}">
        @csrf
        <input name="_method" type="hidden" value="DELETE">
        <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip"
            title='Delete'>Delete</button>
        <a class="btn btn-primary b-list" href={{ '/edit/' . $viewData['socis']->getId() }} role="button">Modifica</a>
        <a class="btn btn-primary b-list" href={{ '/showIscrizione/' . $viewData['socis']->getId() }}>Add iscrizione</a>
        <a class="btn btn-success b-list" href="{{ '/list' }}" role="button">Lista soci</a>
        <a class="btn btn-success b-list" href="{{ '/iscrizione' }}" role="button">Lista iscrizioni</a>
    </form>
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
