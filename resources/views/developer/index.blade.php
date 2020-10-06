@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
   <div class="col-sm-9">
   <div class="col align-self-center">
   @if (!empty($messageCreateAppSuccess))
    <div class="alert alert-success mt-2">{{ $messageCreateAppSuccess }}</div>
    </div>
    @endif

    @if (!empty($message))
    <div class="alert alert-success mt-2">{{ $message }}</div>
    </div>
    @else
    </div>
      <div class="row">
      @foreach($myApps as $apps)
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
                <a href="{{ route('me.delete', $apps->slug) }}">
                <button id="delete" class="btn btn-danger" onclick="return confirm('Si elimina la apliacion {{ $apps->name }} no podra recuperarla, ¿Desea continuar?');">
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
   @endif
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
