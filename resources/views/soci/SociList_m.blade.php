@include('layouts.app')

<div class="container">

    <br>
    <h1 class='tit-add'>Lista Soci</h1>

    @section('content')


    @stop
    <a class="btn btn-primary filt" href="{{ '/formFiltroAnno' }}" role="button">Filtro anno rinnovo</a>
    <a class="btn btn-primary adds" href="{{ '/add' }}" role="button">Aggiungi Socio</a>
    <a class="btn btn-primary " href="{{ '/iscrizione' }}" role="button">Lista Iscrizione</a>
    @if (auth()->check() && auth()->user()->is_admin == 1)
        <a class="btn btn-primary " href="{{ '/excel_soci' }}" role="button">Excel</a>
    @else
        <a class="btn btn-secondary " href="{{ '/home' }}" role="button">Login x Excel</a>
    @endif

    <!-- richiama PdfController funzione pdfbollettini la qiuale crea i bollettini 
          con i dati id ricavti dalla tabella serizios record id 1 -->
    <a class="btn btn-primary " href="{{ '/bollettini_anno' }}" role="button">Bollettini anno</a>

    
    <!-- salva i chckbox selezionati nella tabella Serizios id 1 -->
    <button  class="btn btn-primary saveAll" >Bollettini da chckbox</button>

    <hr>
    <table class="table">
        <tr class="head">
            <td width="50px"><input type="checkbox" id="master"></td>
            <td>Sele</td>
            <td>ID</td>
            <td>Nome</td>
            <td>Cognome</td>
            <td>Indirizzo</td>
            <td>N.</td>
            <td>CAP</td>
            <td>Località</td>
            <td>Comune</td>
            <td>Prov.</td>
            <td>Ultimo</td>
            <td>Penultimo</td>
            <!--<td>Email</td>
            <td>Pec</td>
            <td>C.F</td>
            <td>P.I</td>
            <td>Tel.</td>
            <td>Cell.</td>
            <td>Tipo socio</td>-->
            <td>Stato</td>

        </tr>
        @foreach ($socis as $anag)
            <tr class="colo-list">
              <td><input type="checkbox" class="checkbox" data-id="{{$anag->id}}"></td>
                <td>{{ $anag->id }}</td>
                <td><a href={{ '/singolo/' . $anag->id }}>{{ $anag->nome }}</a></td>
                <td>{{ $anag->cognome }}</td>
                <td>{{ $anag->indirizzo }}</td>
                <td>{{ $anag->civico }}</td>
                <td>{{ $anag->cap }}</td>
                <td>{{ $anag->localita }}</td>
                <td>{{ $anag->comune }}</td>
                <td>{{ $anag->sigla_provincia }}</td>
                <td>{{ $anag->ultimo }}</td>
                <td>{{ $anag->penultimo }}</td>
                <!-- <td>{{ $anag->email }}</td>
                <td>{{-- $anag->pec --}}</td>
                <td>{{-- $anag->codice_fiscale --}}</td>
                <td>{{-- $anag->partita_iva --}}</td>
                <td>{{-- $anag->telefono --}}</td>
                <td>{{-- $anag->cellulare --}}</td>
                <td>{{-- $anag->tipo_socio --}}</td>-->
                <td>{{ $anag->published }}</td>

            </tr>
        @endforeach


    </table>

    <h5>Pagine:</h5>
    {{ $socis->links() }}

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type = "text/javascript" >
 $(document).ready(function() {

    @if($errors->any())
    alert(' Selezionare almeno un Utente [x]');
    @endif



     $('.saveAll').on('click', function(e) {
        console.log('clic');
         var studentIdArr = [];
         $(".checkbox:checked").each(function() {
             studentIdArr.push($(this).attr('data-id'));
         });
         if (studentIdArr.length <= 0) {
             alert("Choose min one item to remove.");
         } else {
             //if (confirm("Sicuro?")) {
                 var stuId = studentIdArr.join(",");
                 console.log(stuId);
                 $.ajax({
                     url: "{{url('salvaChck')}}",
                     type: 'POST',
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     data: 'ids=' + stuId,
                     success: function(data) {
                         console.log('dt '.data);
                         window.location.href = "bollettini/1";
                      

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

 }); 

</script>
<!--
var name = path.split('/').pop();
var fullPath = "{{-- route('download.file',':path') --}}";
axios.get("/encrypt?value=" + name).then(response => fullPath = fullPath.replace(':path', response.data));

E il tuo file di route web.php potrebbe apparire così:

Route::get('/encrypt/{value}', function($value) {
  return Crypt::encrypt($value);
});
-->

<!--
    Client Side:

<!DOCTYPE html>
<html>
  
<head>
    <title>
        Passing JavaScript variables to PHP
    </title>
</head>
      
<body>
    <h1 style="color:green;">
        GeeksforGeeks
    </h1>
      
    <form method="get" name="form" action="destination.php">
        <input type="text" placeholder="Enter Data" name="data">
        <input type="submit" value="Submit">
    </form>
</body>
  
</html>


Server Side(PHP): On the server side PHP page, we request for the data submitted by the form and display the result.

<?php
//$result = $_GET['data'];
//echo $result;
?>
-->