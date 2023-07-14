@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">



<style>
    .nrighe {
        width: 200px;
    }
</style>



@section('title', $viewData['title'])


@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">
                <a class="btn btn-primary btn-sm filt" href="{{ '/formFiltroAnno' }}" role="button">Filtro anno rinnovo</a>
                <a class="btn btn-primary btn-sm adds" href="{{ '/formAdd' }}" role="button">Aggiungi Socio x</a>

                <button class="btn btn-secondary btn-sm saveEtt">Etichette da Sel.</button>
                <button class="btn btn-success btn-sm saveAll">Bollettini da Sel.</button>
                <a class="btn btn-secondary btn-sm" href="{{ '/etichette_anno' }}" role="button">Etichette anno</a>
                <a class="btn btn-primary btn-sm" href="{{ '/bollettini_anno' }}" role="button">Bollettini anno</a>

                <a class="btn btn-primary btn-sm" href="{{ '/iscrizione' }}" role="button">Iscrizioni</a>

            </div>
            <div class="card-body">
                @if ($errors->any())
                    <ul class="alert alert-danger list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                @endif



                <div class="card">
                    <div class="card-header"> 
                        <form class="nrighe" action="/paginazione" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="nom" class="">N.righe</label>
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="nom" name="rows"
                                        value="{{ session('pag') }}" placeholder="Numero righe e Invio">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="colo">



                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Sel</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col"><a href="/list/cognome">Cognome</a></th>
                                        <th scope="col"><a href="/list/indirizzo">Indirizzo</a></th>
                                        <th scope="col">CAP</th>
                                        <th scope="col"><a href="/list/localita">Località</a></th>
                                        <th scope="col"><a href="/list/comune">Comune</a></th>
                                        <th scope="col"><a href="/list/sigla_provincia">Prov.</a></th>

                                        <th scope="col">Pubblicato</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viewData['socis'] as $soci)
                                        <tr>
                                            <td><input type="checkbox" class="checkbox" data-id="{{ $soci->getId() }}"></td>

                                            <td>{{ $soci->getNome() }}</td>

                                            <td><a href="/singolo/{{ $soci->getId() }}">{{ $soci->getCognome() }}</a></td>

                                            <td>{{ $soci->getIndirizzo() }}</td>
                                            <td>{{ $soci->getCap() }}</td>
                                            <td>{{ $soci->getLocalita() }}</td>
                                            <td>{{ $soci->getComune() }}</td>
                                            <td>{{ $soci->getSigla_provincia() }}</td>
                                            @if ($soci->getPublished() == 'Abilitato')
                                                <td><a style="color:green"
                                                        href="/changeStatus/{{ $soci->getId() }}">{{ $soci->getPublished() }}</a>
                                                @else
                                                <td><a style="color:red"
                                                        href="/changeStatus/{{ $soci->getId() }}">{{ $soci->getPublished() }}</a>
                                            @endif

                                            </td>



                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $viewData['socis']->links() }}
                    </div>
                @endsection
                <br>
                <br>
            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            @if ($errors->any())
                alert(' Selezionare almeno un Utente [x]');
            @endif



            $('.saveAll').on('click', function(e) {
                console.log('clic');
                var studentIdArr = [];
                $(".checkbox:checked").each(function() {
                    studentIdArr.push($(this).attr('data-id'));
                });
                if (studentIdArr.length <= 0) {
                    alert("Scegliere almeno un nome [ ]");
                } else {
                    //if (confirm("Sicuro?")) {
                    var stuId = studentIdArr.join(",");
                    console.log(stuId);
                    $.ajax({
                        url: "{{ url('salvaChck') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'ids=' + stuId,
                        success: function(data) {
                            console.log('dt '.data);
                            window.location.href = "/bollettini/1";


                            /* if (data['status'] == true) {
                                 $(".checkbox:checked").each(function() {
                                     //$(this).parents("tr").remove();
                                     $( ".checkbox" ).prop( "checked", false );
                                 });
                                 alert(data['message']);
                             } else {
                                 
                                 alert('Error occured.');
                                 $( ".checkbox" ).prop( "checked", false );
                             }*/
                        },


                        error: function(data) {
                            alert(data.responseText);
                        }
                    });
                    //}
                }
            });


            $('.saveEtt').on('click', function(e) {
                console.log('clic');
                var eticIdArr = [];
                $(".checkbox:checked").each(function() {
                    eticIdArr.push($(this).attr('data-id'));

                });
                console.log('st ' + eticIdArr);
                if (eticIdArr.length <= 0) {
                    alert("Scegliere almeno un nome [ ]");
                } else {
                    //if (confirm("Sicuro?")) {
                    var etiId = eticIdArr.join(",");
                    console.log('s ' + etiId);
                    $.ajax({
                        url: "{{ url('salvaChck') }}",
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: 'ids=' + etiId,
                        success: function(data) {

                            window.location.href = "/etichette/1";

                        },


                        error: function(data) {
                            alert(data.responseText);
                        }
                    });
                    //}
                }
            });


        });
    </script>

    <script>
        $(function() {

            $('.form-check-input').change(function() {

                var status = $(this).prop('checked') == true ? 1 : 0;

                var user_id = $(this).data('id');

                $.ajax({

                    type: "GET",

                    dataType: "json",

                    url: '/changeStatus',

                    data: {
                        'status': status,
                        'user_id': user_id
                    },

                    success: function(data) {

                        console.log(data.success)

                    }

                });

            })

        })
    </script>
