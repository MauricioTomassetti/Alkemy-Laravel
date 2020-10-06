@extends('layouts.app')

@section('content')

@include('client.categoryList')
@include('layouts.messages.modalBuyApp')
@include('layouts.messages.modalCancelBuy')

<section class="container">
    <div class="row">
    @if (!empty($message))
    <div class="alert alert-success mt-2">{{ $message }}</div>
    @else
    @foreach($allapps as $apps)
        <div class="col-md-4" id="card-{{ $apps->id }}">
            <div class="card mb-4 shadow-sm">
                <img src="{{ asset( $apps->image_src) }}" class="img-fluid" alt="{{ $apps->name }}">
                <div class="card-body">
                    <p class="card-text"> {{ $apps->price }}</p>
                    <p class="card-text"> {{ $apps->name }}</p>
                    <div class="success-message-buy-{{ $apps->id }}"></div>
                    <p class="card-text"> {{ $apps->description }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">       
                        @if (Auth::user() && Auth::user()->role->first()->name_role=="Cliente" && Route::currentRouteName() == 'home' )     
                            <button type="button" class="submitForm" formaction="buy" idapp="{{ $apps->id }}" name={{ $apps->id}}>Comprar</button>
                        @endif
                        @if (Auth::user() && Auth::user()->role->first()->name_role=="Cliente" && Route::currentRouteName() == 'me.client')
                        <button type="button" class="submitForm" formaction="cancel" idapp="{{ $apps->id }}" id="{{ $apps->id }}" >Cancelar Compra</button>
                        @endif

                        @guest
                            <button type="button" id="{{$apps->id}}" onclick="addRow('{{$apps->id}}','{{$apps->price}}','{{$apps->name}}')">Agregar a deseados</button>
                        @endguest
                        <a href="{{ route('appDetail',$apps->slug)}}"> <button type="button">Ver detalles</button></a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
        <div>
        </div>
    </div>
        <div class="d-flex justify-content-center">
            {!! $allapps->links() !!}
        </div>
</section>
@include('layouts.script')
@guest
      @include('client.applicationsFollow')
@endguest
@endsection

