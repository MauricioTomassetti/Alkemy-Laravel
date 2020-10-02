@extends('layouts.app')

@section('content')

<section class="container">
    <div class="row">
    @if ($message)
         @include('messages.messageSuccess')
    @endif
        @foreach($applicationsCategory as $apps)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img src="{{ asset( $apps->image_src) }}" class="img-fluid" alt="{{ $apps->name }}">
                <div class="card-body">
                    <p class="card-text"> {{ $apps->price }}</p>
                    <p class="card-text"> {{ $apps->name }}</p>
                    <p class="card-text"> {{ $apps->description }}</p>
                    <p class="card-text"></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">

                                @if(!Auth::check() || Auth::user()->role->first()->name_role=="Desarrollador")
                               
       <button type="button"> <a  href="{{ route('appDetail',$apps->name)}}">Ver detalles</button></a>
                                    
        <button type="button" id="{{$apps->id}}" onclick="addRow('{{$apps->id}}','{{$apps->price}}','{{$apps->name}}')">Agregara deseados</button>
                               
                                @endif

                                @if (Auth::user() && Auth::user()->role->first()->name_role=="Cliente")
                                
                        <button type="button" class="submitForm" formaction="buy" idapp="{{ $apps->id }}" name={{ $apps->id}}>Comprar</button>

                        <button type="button" class="submitForm" formaction="cancel" idapp="{{ $apps->id }}" id="{{ $apps->id }}" disabled>Cancelar Compra</button>
                                                        
                        <button type="button"><a href="{{ route('appDetail',$apps->id)}}">Ver detalles</button></a>
                                @else
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@include('client.desired')
@include('layouts.script')
@endsection