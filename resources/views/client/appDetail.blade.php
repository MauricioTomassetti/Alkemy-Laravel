@extends('layouts.app')

@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $(document).ready(function(e){
            $('#buy').on('submit', function(e) {
            e.preventDefault(); 
            $.ajax({
                url: "{{route('buy')}}",
                type: "POST",
                data: {
                        app_id: $('#app_id').val(),
                        _token: "{{csrf_token()}}"
                    },
                success: function(msg) {
                alert(msg);
                }
            });
        });
        })
</script>
@foreach ($appDetail as $app)
<div>
    <form method="post" id="buy">
        <img src="{{ asset( $app->image_src) }}" alt="tag">
        <span> Nombre:{{ $app->name }} </span>
        <span> Price:{{ $app->price }} </span>
        <input type="hidden" id="app_id" value="{{ $app->id }}">
        <div>
            <button type="submit">Comprar</button>
            <button type="submit" id="cancel">Cancelar Compra</button>
        </div>

    </form>
</div>
@endforeach
@endsection