<style>
    .nome_user_login {
        color: white;
        margin-top: 8px;
    }
</style>

<title>
    <div class="titolo">@yeld('title', 'Dati')</div>
</title>

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-4">
    <div class="container">
        <a class="navbar-brand" href="{{-- route('home.index') --}}">10 Righe APS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    
       

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="/">Home</a>
                <a class="nav-link active" href="{{ route('product.index') }}">Prodotti</a>
                <a class="nav-link active" href="{{ route('home.about') }}">Chi siamo</a>
                <a class="nav-link active" href="{{ route('cart.index') }}">
                    <i class="bi bi-cart4"></i>
                </a>
                <div class="vr bg-white mx-2 d-none d-lg-block"></div>


  

                            <!-- ----------------------------->
            
                            @guest
                            <a class="nav-link active" href="{{ route('login') }}">Login</a>
                            <a class="nav-link active" href="{{ route('register') }}">Registrati</a>
                            @else
                            <div>
                                <a class="nav-link active" href="{{ route('myaccount.orders') }}">{{ Auth::user()->getName() }} - Ordini</a>
                                <a class="nav-link active" href="#" >${{ Auth::user()->getBalance() }}</a>
                            </div>
                            <form id="logout" action="{{ route('logout') }}" method="POST">
                                <a role="button" class="nav-link active"
                                    onclick="document.getElementById('logout').submit();">Logout</a>
                                @csrf
                            </form>
                        @endguest 
                
                   <!--------------->



            </div>
        </div>
</nav>
