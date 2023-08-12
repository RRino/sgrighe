<style>
    .nome_user_login {
        color: white;
        margin-top: 8px;
    }
    .logo{
        color: white;

    }
</style>

<title>
    <div class="titolo">@yeld('title', 'Dati')</div>
</title>

<nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-4">
    <div class="container">
        <a class="logo" href="{{-- route('home.index') --}}">10 Righe APS</a>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="/">Home</a>
                <a class="nav-link active" href="{{ route('product.index') }}">Prodotti</a>
                <a class="nav-link active" href="{{ route('home.about') }}">Chi siamo</a>
                <a class="nav-link active" href="/anagrafiche">Anagrafiche</a>
                <a class="nav-link active" href="/articoli">Articoli</a>

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
                        <a class="nav-link active" href="{{ route('myaccount.orders') }}">{{ Auth::user()->getName() }} -
                            Ordini</a>
                        <a class="nav-link active" href="#">${{ Auth::user()->getBalance() }}</a>
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
