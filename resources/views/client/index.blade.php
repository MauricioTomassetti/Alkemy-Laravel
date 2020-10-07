@extends('layouts.app')

@section('content')
@include('client.categoryList')
@include('layouts.messages.modalBuyApp')
@include('layouts.messages.modalCancelBuy')

<section class="container text-right">
    <a href="{{ route('list.vote')}}">
      <button type="button" class="btn btn-outline-primary">Ver las applicaciones mas votadas
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bag-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M8 1a2.5 2.5 0 0 0-2.5 2.5V4h5v-.5A2.5 2.5 0 0 0 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H2z"></path>
          <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"></path>
        </svg>
      </button>
    </a>
</section>
<br>

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
                        @if (Auth::check() && Route::currentRouteName() == 'me.client')
                            <button type="button" class="submitForm" formaction="cancel" idapp="{{ $apps->id }}" id="{{ $apps->id }}" >Cancelar Compra</button>
                        @else
                        <a href="{{ route('appDetail',$apps->slug)}}"> <button type="button">Ver detalles</button></a>
                        @endif
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
@include('client.applicationsFollow')
@include('layouts.script')
@endsection


