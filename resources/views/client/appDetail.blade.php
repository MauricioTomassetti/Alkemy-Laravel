@extends('layouts.app')

@section('content')
@include('layouts.messages.modalBuyApp')

@if (!empty($message))
<div class="alert alert-success mt-2">{{ $message }}</div>
@else
<div class="container">
<h2 class="text-center">{{$application->name}}</h2>
    <hr>
  <div class="row">
  <div class="col">
        <img class="mb-4" src="{{ asset( $application->image_src) }}" alt="" width="450" height="480">
  </div>
    <div class="col d-flex justify-content-between align-items-center">
            <div class="card mb-6 shadow-sm text-center">
                <div class="card-body">
                        <label for="nombre"><strong>{{$application->description}}</strong></label>
                    <hr>
                    <label for="precio"><strong>Precio de venta {{$application->price}}</strong></label>
                    <hr>
                        <label for="votes"><strong> Cantidad de votos recibidos: {{$application->vote}}</strong></label>
                        <hr>
                        <div class="btn-group">
                            @auth
                                <button type="button" class="submitForm" formaction="buy" idapp="{{ $application->id }}" name={{ $application->id}}>Comprar!</button>
                            @endauth
                            <button type="button" id="{{$application->id}}" onclick="addRow('{{$application->id}}','{{$application->price}}','{{$application->name}}')">Agregar a deseados</button>
                        </div>
                    </div>
                </div>
            </div>
            <div>
            <div>
<div>
    @endif
@include('layouts.script')
@endsection
