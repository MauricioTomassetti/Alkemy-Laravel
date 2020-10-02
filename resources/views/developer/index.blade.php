@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-8">
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
      @foreach($myapps as $apps)
      <div class="col-md-5">
        <div class="card mb-5 shadow-sm">
          <img src="{{ asset( $apps->image_src) }}" class="img-fluid" alt="{{ $apps->name }}">
          <div class="card-body">
            <p class="card-text"> {{ $apps->price }}</p>
            <p class="card-text"> {{ $apps->name }}</p>
            <p class="card-text"> {{ $apps->description }}</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <button type="submit" class="btn btn-warning">
                  <a href="{{ route('/me/myListApp', $apps->id) }}">
                    Editar Applicacion
                </button>
                </a>
                <button type="submit" class="btn btn-danger">
                  <a href="{{ route('home') }}">
                    Eliminar Applicacion
                  </a>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-header">Mis Operaciones</div>
        <div class="card-body">
          Operaciones sobre mis aplicaciones
          <div class="container">
            <div class="row row-cols-2">
              <div class="col mt-2"> <button type="submit" class="btn btn-primary">
                  Agregar Applicacion
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection