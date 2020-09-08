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
                            <a  href="{{ route('/me/myListApp', $apps->id) }}">
                                    Editar Applicacion
                            </button>
                            </a>
                            <button type="submit" class="btn btn-danger">
                            <a href="{{ route('home') }}">
                                        Eliminar Applicacion
                                </a>
                            </button>
                            {{-- @if(!Auth::check() || Auth::user()->role->first()->name_role=="Desarrollador")

                            <button type="button" id="{{$apps->id}}"
                                onclick="addRow('{{$apps->id}}',{{$apps->price}},'{{$apps->name}}')">Agregar
                                a deseados</button>
                            @endif

                            @if (Auth::user() && Auth::user()->role->first()->name_role=="Cliente" )
                            <button type="button" class="submitForm" formaction="buy" idapp="{{ $apps->id }}"
                                name={{ $apps->id}}>Comprar</button>
                            <button type="button" class="submitForm" formaction="cancel" idapp="{{ $apps->id }}"
                                id="{{ $apps->id }}" disabled>Cancelar Compra</button>
                            @else
                            @endif --}}
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
              {{-- <div class="col mt-2">
                <button type="submit" class="btn btn-warning">
                  Editar Applicacion
                </button>
              </div>
              <div class="col mt-2">
                <button type="submit" class="btn btn-danger">
                  Eliminar Applicacion
                </button> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  @endsection