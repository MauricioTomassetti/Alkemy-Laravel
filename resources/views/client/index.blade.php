@extends('layouts.app')

@section('content')

@include('client.categoryList')

@include('layouts.messages.modalApp')

<section class="container">
    <div class="row">
        @forelse($allapps as $apps)
        <div class="col-md-4" id="card-{{ $apps->id }}">
            <div class="card card-app mt-2">
                <img src="{{ asset( $apps->image_src) }}" class="card-img-top" alt="{{ $apps->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $apps->name }}</h5>
                    <hr>
                    <h6 class="card-subtitle mb-2 text-muted">$ {{ $apps->price }}</h6>
                    <p class="card-text description">{{ $apps->description }}</p>
                </div>
                <div class="card-footer">
                    @auth
                    @if (Auth::user()->roles->first()->name_role == 'Cliente' && Route::currentRouteName() != 'me.client')
                    <a href="{{ route('me.appDetail',$apps->slug)}}"> <button type="button" class="btn btn-primary ">Ver detalles</button></a>
                    @endif
                    @if (Auth::user()->roles->first()->name_role == 'Cliente' && Route::currentRouteName() == 'me.client')
                    <button type="button" class="btn btn-secondary submitForm" formaction="cancel" idapp="{{ $apps->id }}" name="{{ $apps->id }}">Cancelar compra</button>
                    @endif
                    @endauth
                    @guest
                    <a href="{{ route('guest.appDetail',$apps->slug)}}"> <button type="button" class="btn btn-primary ">Ver detalles</button></a>
                    @endguest
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12 text-center">
            <div class="alert alert-success mt-2">{{ $message }}</div>
        </div>
        @endforelse
    </div>
    </div>
    <div class="d-flex justify-content-center">
        {!! $allapps->links() !!}
    </div>
</section>

@include('client.applicationsFollow')

@endsection