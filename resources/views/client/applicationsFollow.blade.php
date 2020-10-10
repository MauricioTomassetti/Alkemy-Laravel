<aside class="container-fluid">
    <div class="float-right" id="mylist">
        <div class="card border-secondary mb-3" style="max-width: 30rem;">
            <div class="card-header">Mis Apps deseadas</div>
            <div class="card-body text-secondary">
                @guest
                <h5 class="card-title">Recuerda <a href="{{ route('register') }}">Registrarte</a>o<a href="{{ route('login') }}">Ingresar</a> para poder realizar alguna compra.</h5>
                @endguest
                <h5 class="card-title">Podes ir viendo que apps te interesan</h5>
                <p class="card-text">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button id="desiredListUser" class="btn btn-link btn-block text-left" type="button" userapp="@if (Auth::check()){{Auth::user()->name}} @endif" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Mis Apps siguiendo.
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Dejar de seguir</th>
                                            </tr>
                                        </thead>
                                        <tbody id="desirelist"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</aside>