<section class="jumbotron text-center">
          <div class="container">
            <h1>Bienvenido a Alkemy Play Store</h1>
            <p class="lead text-muted">Recorre nuestras applicaciones</p>
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

