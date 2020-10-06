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

<section>
  <div class="container text-right">
<button type="button" class="btn btn-outline-primary">Applicaciones mas votadas
  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bag-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" d="M8 1a2.5 2.5 0 0 0-2.5 2.5V4h5v-.5A2.5 2.5 0 0 0 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H2z"></path>
    <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"></path>
  </svg>
</button>
</div>
</section>


