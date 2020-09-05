@extends('layouts.app')

@section('content')
@foreach ($buyapps as $app)
<div>
<div id="form">
    <form action="#" id="{{ $app->id }}">
        <img src="{{ asset( $app->image_src) }}" alt="tag">
        <span> Nombre:{{ $app->name }} </span>
        <span> Price:{{ $app->price }} </span>
        <button type="button" class="submitForm" formaction="buy" idapp="{{ $app->id }}">Comprar</button>
        <button type="button" class="submitForm" formaction="cancel" idapp="{{ $app->id }}">Cancelar Compra</button>
    </form>
</div>
</div>
@endforeach
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready(function(e){

    $('.submitForm').click(function(){
        let id = $(this).attr('idapp');
        if (($(this).attr('formaction'))==='buy') {
            console.log(id);
            $.ajax({
                url: 'buy/',
                type: "POST",
                data: {
                        app_id: id,
                        _token: "{{csrf_token()}}"
                    },
                success: function(msg) {
                alert('Agregado');
                }
            });
        }else{
            $.ajax({
                url: 'cancelbuy/'+id,
                type: "DELETE",
                data: {
                        app_id: id,
                        _token: "{{csrf_token()}}"
                    },
                success: function(msg) {
                alert('Cancelado');
                }
            })
        }
});
</scipt>
@endsection

