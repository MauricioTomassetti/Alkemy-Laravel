
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid d-flex justify-content-between">
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="0 0 24 24" focusable="false">
                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                <circle cx="12" cy="13" r="4" /></svg>
            <strong>Alkemy Play Store</strong>
        </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Ingresar</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Registrarse </a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();localStorage.clear();">
                        Salir
                    </a>
                    @if(Auth::user()->roles->first()->name_role == 'Desarrollador' )

                    <a class="dropdown-item" href="{{ route('me.list',Auth::user()->name) }}" ;">
                        Administrar Aplicaciones
                    </a>
                    @endif

                    @if(Auth::user()->roles->first()->name_role == 'Cliente' )

                    <a class="dropdown-item" href="{{ route('me.client', Auth::user()->name) }}" ;">
                        Mis compras
                    </a>
                    @endif

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="form-inline my-2 my-lg-0">
                        @csrf

                    </form>
                </div>
                @endguest
</nav>