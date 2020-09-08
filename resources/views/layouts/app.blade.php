<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
          <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="0 0 24 24" focusable="false"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
            <strong>Alkemy Play Store</strong>
          </a>
          </div>
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
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{ Auth::user()->name }}
                          </a>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                  Salir
                              </a>
                              @if(Auth::user()->role->first()->name_role == 'Desarrollador' )

                              <a class="dropdown-item" href="{{ route('/me/myListApp',Auth::user()->slug) }}";">
                                 Administrar Aplicaciones
                                </a>
                                @endif

                                @if(Auth::user()->role->first()->name_role == 'Cliente' )

                              <a class="dropdown-item" href="{{ route('/me/client', Auth::user()->slug) }}";">
                                  Mis compras
                                </a>
                                @endif


                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                              </form>
                          </div>
                      </li>
                      @endguest
        </div>
      </div>
      <main role="main">
        <section class="jumbotron text-center">
          <div class="container">
            <h1>Bienvenido a Alkemy Play Store</h1>
            <p class="lead text-muted">Aqui podras recorrer nuestras aplicaciones, saber mas sobre cada una de ellas y adquirirlas</p>
            <p>
              @guest
              @if (Route::has('register'))
              <a href="{{ route('register') }}" class="btn btn-primary my-2">Registrarse</a>
              @endif
              <a href="{{ route('login') }}" class="btn btn-secondary my-2">Ingresar como Cliente</a>
              @endguest
            </p>
          </div>
        </section>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
