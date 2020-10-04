@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
   <div class="col-sm-9">
    @if(session('message'))
      <div class="alert alert-secondary alert-dismissible fade show" role="alert">
        <strong>Exito! </strong>{{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
      @if($messageNotAppCreated)
      @include('messages.messageNotAppCreated')
      @endif
      <div class="row">
      @foreach($myapps as $apps)
      <div class="col-4">
        <div class="card mb-4 shadow-sm">
          <img src="{{ asset( $apps->image_src) }}" class="img-fluid" alt="{{ $apps->name }}">
          <div class="card-body">
            <p class="card-text"> {{ $apps->price }}</p>
            <p class="card-text"> {{ $apps->name }}</p>
            <p class="card-text"> {{ $apps->description }}</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a href="{{ route('me.edit', $apps->slug) }}">
                <button class="btn btn-warning">
                    Editar Applicacion
                </button>
                </a>
                <a href="{{ route('home') }}">
                <button id="delete" type="submit" class="btn btn-danger">
                    Eliminar Applicacion
                </button>
            </a>
              </div>
            </div>
          </div>
        </div>
    </div>
        @endforeach
   </div>
    </div>
    <div class="col-sm-3">
      <div class="card">
        <div class="card-header">Mis Operaciones</div>
        <div class="card-body">
          Operaciones sobre mis aplicaciones
          <div class="container">
            <div class="row row-cols-2">
              <div class="col mt-2">
                <a href="{{ route('me.create') }}">
                  <button class="btn btn-primary">
                  Agregar Applicacion
                </button>
            </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
