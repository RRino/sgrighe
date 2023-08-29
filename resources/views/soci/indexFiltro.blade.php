@extends('layouts.app')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

@section('title', $viewData['title'])

@section('content')
    <div class="container-fluid">
        <div class="card mb-4">
            <div class="card-header">
                <a class="btn btn-primary filt" href="{{ '/formFiltroAnno' }}" role="button">Filtro anno rinnovo</a>
                
                <a class="btn btn-primary " href="{{ '/etichette_anno' }}" role="button">Etichette</a>
                <a class="btn btn-primary " href="{{ '/bollettini_anno' }}" role="button">Bollettini</a>
                <a class="btn btn-success " href="{{ '/list' }}" role="button">Lista soci</a>
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
                    <div class="card-header"> Manage socis
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Sel</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Cognome</th>
                                    <th scope="col">Indirizzo</th>
                                    <th scope="col">CAP</th>
                                    <th scope="col">Localita</th>
                                    <th scope="col">Comune</th>
                                    <th scope="col">Prov.</th>
                      
                                    <th scope="col">Pubblicato</th>
                                    <th scope="col">Anno</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viewData['soci'] as $soci)
                                    <tr>
                                        <td><input type="checkbox" class="checkbox" data-id="{{ $soci->id }}"></td>

                                        <td>{{ $soci->getId(). $soci->getNome() }}</td>
                                        <td><a href="/singolo/{{ $soci->getId() }}">{{ $soci->getCognome() }}</a></td>

                                        <td>{{ $soci->getIndirizzo() }}</td>
                                        <td>{{ $soci->getCap() }}</td>
                                        <td>{{ $soci->getLocalita() }}</td>
                                        <td>{{ $soci->getComune() }}</td>
                                        <td>{{ $soci->getSigla_provincia() }}</td>
                                        <td>{{ $soci->getPublished() }}</td>
                                        <td>{{ $soci->anno}}</td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endsection
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
            console.log('clicf.');
            var studentIdArr = [];
            $(".checkbox:checked").each(function() {
                studentIdArr.push($(this).attr('data-id'));
            });
            if (studentIdArr.length <= 0) {
                alert("Scegliere almeno un nome [ ]");
            } else {
                //if (confirm("Sicuro?")) {
                var stuId = studentIdArr.join(",");
                console.log('stuidf'+stuId);
                $.ajax({
                    url: "{{ url('salvaChck') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: 'ids=' + stuId,
                    success: function(data) {
                        console.log('dtf '.data);
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
            console.log('st-' + eticIdArr);
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
