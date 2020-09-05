@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      <div class="col-sm-8">
    @foreach($myapps as $apps)
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
            <img src="{{ asset( $apps->image_src) }}"  class="img-fluid"  alt="{{ $apps->name }}">
            <div class="card-body">
              <p class="card-text">{{$apps->description}}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary" formaction="buy" idapp="{{ $apps->id }}">
                        <a class="nav-link" href="#">{{ __(' Ver detalles') }}</a>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" formaction="buy" idapp="{{ $apps->id }}">
                        <a class="nav-link" href="#">{{ __(' Seguir') }}</a>
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
            <div class="card-header">{{ __('Mis operaciones') }}</div>
            <div class="card-body">
                {{ __('Operaciones sobre mis Apps') }}

                <div class="container">
                    <div class="row row-cols-2">
                      <div class="col mt-2">  <button type="submit" class="btn btn-primary">
                        Agregar Applicacion
                     </button>
                    </div>
                      <div class="col mt-2">
                           <button type="submit" class="btn btn-warning">
                        Editar Applicacion
                     </button>
                    </div>
                      <div class="col mt-2">
                          <button type="submit" class="btn btn-danger">
                        Eliminar Applicacion
                     </button>
                    </div>
                  </div>
            </div>
        </div>
        </div>
    </div>
  </div>


@endsection
