@extends('layouts.app')

@section('appDetail')

@include('layouts.messages.modalApp')

@if (!Auth::check() || Auth::user()->roles->first()->name_role == 'Cliente')
@include('client.categoryList')
@endif
<article class="container">
    @if(!empty($message))
    <div class="alert alert-success mt-2">{{ $message }}</div>
    @else
    <div class="card mb-3" style="max-width: 100%;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="{{ asset( $application->image_src) }}" class="card-img" alt="{{ $application->name }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $application->name }}</h5>
                    <p class="card-text">{{ $application->description }}</p>
                    <hr>
                    <p class="card-text">Cantidad de votos: {{ $application->vote }}</p>
                    <p class="card-text"><small class="text-muted"> Precio de venta: {{ $application->price }}</small></p>
                    <div class="btn-group">
                        @auth
                        @if($user_rol="Cliente" && Auth::user()->roles->first()->name_role != 'Desarrollador')
                        <button type="button" class="btn btn-primary submitForm" formaction="buy" idapp="{{ $application->id }}" name="{{ $application->id }}">Comprar!</button>
                        @if(!empty($showButtonDesired) && $showButtonDesired)
                        <button class="ml-2 btn btn-secondary desired" data-container="body" idapp="{{ $application->slug }}"> Agregar a deseados</button>
                        @endif
                        @endif
                        @endauth
                        @guest
                        <button type="button" class="ml-1 btn btn-secondary pop" data-container="body" id="{{ $application->id }}" onclick="addRow('{{ $application->id }}','{{ $application->price }}','{{ $application->name }}')">Agregar a deseados</button>
                        </button>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</article>
@endsection