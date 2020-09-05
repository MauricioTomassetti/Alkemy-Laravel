@extends('layouts.app')

@section('content')

  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
    @foreach($allapps as $apps)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src="{{ asset( $apps->image_src) }}"  class="img-fluid" alt="{{ $apps->name }}">
            <div class="card-body">
                <p class="card-text"> {{ $apps->price }}</p>
                <p class="card-text"> {{ $apps->name }}</p>
                <p class="card-text"> {{ $apps->description }}</p>
              <p class="card-text"></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">

            <form id="submitFormu" method="POST" >
                @if(!Auth::check() || Auth::user()->role->first()->name_role=="Desarrollador")
                <button type="submit" class="submitForm"><a href="#"></a>Ver detalles</button>
                <button type="submit" id="{{$apps->name}}" onclick="addRow('{{$apps->name}}',{{$apps->price}})">Agregar a deseados</button>
                @endif

                 @if (Auth::user() && Auth::user()->role->first()->name_role=="Cliente")
                <button type="submit" class="submitForm" formaction="buy" idapp="{{ $apps->id }}" name={{ $apps->id}}>Comprar</button>
                <button type="submit" class="submitForm" formaction="cancel" idapp="{{ $apps->id }}" id="{{ $apps->id }}" disabled >Cancelar Compra</button>
                <button type="submit" class="submitForm"><a href="#"></a>Ver detalles</button>
                @else
                @endif
            </form>
                </div>
                </div>
             </div>
             </div>
            </div>
        @endforeach
            <div>
        </div>
    </div>
</div>
    {{-- Seccion agregar deseados --}}
    <div class="container-fluid" style="">
        <div class="float-right" id="mylist">
                <div class="card border-secondary mb-3" style="max-width: 30rem;">
                    <div class="card-header">Mis Apps siguiendo</div>
                    <div class="card-body text-secondary">
                     @guest
                        <h5 class="card-title">Recuerda <a href="{{ route('register') }}">Registrarte</a> o
                        <a href="{{ route('register') }}">Ingresar</a> para terminar tu compra.</h5>
                    @endguest
                    <h5 class="card-title">Podes ir viendo que apps estas siguiendo</h5>
                      <p class="card-text">
                        <table class="table" >
                            <thead>
                              <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio</th>
                              </tr>
                            </thead>
                            <tbody id="desirelist">
                              <tr>
                            </tr>

                        </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- Fin agregar  deseados --}}
<footer class="text-muted">
  <div class="container">
    <p class="float-right">
    </p>
  </div>
</footer>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type="text/javascript">
 $(document).ready(function(e){

    $('#submitFormu').submit(function(e){
        e.preventDefault();
        let id = $(this).attr('idapp');
        console.log(id)
       // let name = $(this).attr('btnapp');
        let dblbutton = $(this).attr('app');
        let cancel = $(this).attr('cancelbutton');

        if (($(this).attr('formaction'))==='buy') {
            $.ajax({
                url: '/api/buy',
                type: "POST",
                data: {
                        app_id: id,

                    },
                success: function(msg) {
                    $('button[name='+id+']').prop('disabled', true);
                    $('#'+id).prop('disabled', false);
                }
            });
        }
        if (($(this).attr('formaction'))==='cancel') {
            $.ajax({
                url: '/api/cancelbuy/'+id,
                type: "DELETE",
                data: {
                        app_id: id,
                        _token: "{{csrf_token()}}"
                    },
                success: function(msg) {
                    $('button[name='+id+']').prop('disabled', false);
                    $('#'+id).prop('disabled', true);
                    //$('#app').remove('disabled');
                   // $('#app').removeAttr("disabled")
                    //$('#app').prop('disabled', false);
                }
            })
        }
})
 });

 function addRow(name,price) {
            let row = $('<tr></tr')
            let dataname = $('<td></td>').text(name)
            let dataprice = $('<td></td>').text(price)
            row.append(dataname);
            row.append(dataprice);
            $('#desirelist').append(row);
            $('#'+name).prop('disabled', true);
            $( "#mylist" ).fadeIn( 3000);
        }

</script>




@endsection


