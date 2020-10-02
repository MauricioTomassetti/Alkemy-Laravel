@extends('layouts.app')

@section('content')

<section class="container">
    <div class="row">
    @if ($message)
         @include('messages.messageSuccess')
    @endif
        @foreach($buyapps as $apps)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <img src="{{ asset( $apps->image_src) }}" class="img-fluid" alt="{{ $apps->name }}">
                <div class="card-body">
                    <p class="card-text"> {{ $apps->price }}</p>
                    <p class="card-text"> {{ $apps->name }}</p>
                    <p class="card-text"> {{ $apps->description }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            @if (Auth::user() && Auth::user()->role->first()->name_role=="Cliente")
                            <button type="button" class="submitForm" formaction="cancel" idapp="{{ $apps->id }}"
                                id="{{ $apps->id }}" >Cancelar Compra</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div>
        </div>
    </div>
</section>
@include('layouts.script')
@endsection
