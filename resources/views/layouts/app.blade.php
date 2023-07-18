<!DOCTYPE html>
<html>
<title>10 Righe APS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
<link rel="stylesheet" href="{{ asset('css/w3.css') }}">


<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="/css/app.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<style>
    body {
        font-size: 16px;
        font-family: sans-serif;
    }

    .conte {
        color: blue;
    }

    .w3-teal {
        position: fixed;
        top: 0;
        z-index: 1;
    }

    #dropdownMenuButton1 {
        color: black;
    }
    #mySidebar{
        /*position:absolute !important;*/
    }
</style>

@include('includes.header')

<body>
    <div>
 

        <div >
            <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
                <button class="w3-button w3-teal bchiudi" onclick="w3_close()">Chiudi &times;</button>
    
                <a href="/products" class="w3-bar-item w3-button">Riviste</a>
                <a href="/admin/products" class="w3-bar-item w3-button w3-hover-green">Magazzino riviste</a>
    
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle mbut" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="true">
                        Associati
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <a class="dropdown-item" href="/list">Soci </a>
                        <a class="dropdown-item" href="/admin/add">Aggiungi socio</a>
                        <a class="dropdown-item" href="/iscrizione">Iscrizioni </a>
                        <a class="dropdown-item" href={{ '/showIscrizione' }}>Iscrixxzioni </a>
                    </ul>
                </div>
                <br>
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle mbut" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Import Export Excel
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      
                        <li><a class="dropdown-item" href="/formExcel_soci">Soci</a></li>
                        <hr>
                      
                        <li><a class="dropdown-item" href="/formExcel_iscrizioni">Iscrizioni</a></li>
                    </ul>
                </div>
            </div>
            <div>
                @include('includes.footer')
                <div id="main" >

                    <div class="w3-teal">
                        <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
                        <div class="w3-container titx">
                            <title>
                                <div class="titolo">@yeld('title', 'Dati')</div>
                            </title>

                        </div>
                    </div>

                    <div class="text-center">
                        @yield('title')
                        <br>
                        @yield('subtitle')
                    </div>
                    <div class="container conte">
                        @yield('content')
                    </div>

                </div>
              
            </div>
        </div>

    </div>


    <script>
        function w3_open() {
            document.getElementById("main").style.marginLeft = "16%";
            document.getElementById("mySidebar").style.width = "15%";
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("openNav").style.display = 'none';
            sessionStorage.setItem("stato", "aperta");
        }

        function w3_close() {
            document.getElementById("main").style.marginLeft = "0%";
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("openNav").style.display = "inline-block";
            sessionStorage.setItem("stato", "chiusa");
        }
    </script>

    <script>
        /*  let statox = sessionStorage.getItem("stato");
                                                                                                        if(statox == 'aperta'){
                                                                                                            document.getElementById("mySidebar").style.display = "block";
                                                                                                        }else{
                                                                                                            document.getElementById("mySidebar").style.display = "none"; 
                                                                                                        }*/
    </script>

</body>


</html>
