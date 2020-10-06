@extends('layouts.app')
@section('content')
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
                    </div>
                </div>
            </div>
            <div>
            <div>
<div>
@endsection