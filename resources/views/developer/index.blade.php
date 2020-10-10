@extends('layouts.app')
@section('content')
<section class="container-fluid">
    <h2 class="text-center">Panel de administración de applicaciones</h2>
    <hr>
</section>
<section class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="row">
                @forelse($myApps as $apps)
                <div class="col-md-4" id="card-{{ $apps->id }}">
                    <div class="card card-app mt-2">
                        <img src="{{ asset( $apps->image_src) }}" class="card-img-top" alt="{{ $apps->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $apps->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">$ {{ $apps->price }}</h6>
                            <p class="card-text description">{{ $apps->description }}</p>...Continuar leyendo
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('me.detail',$apps->slug)}}"> <button type="button" class="btn btn-primary ">Detalles</button></a>
                            <a href="{{ route('me.edit', $apps->slug) }}"><button type="button" class="btn btn-secondary">Editar</button></a>
                            <a href="{{ route('me.delete', $apps->slug) }}"><button id="delete" class="ml-1 btn btn-danger" onclick="return confirm('Si elimina la apliacion {{ $apps->name }} no podra recuperarla, ¿Desea continuar?');">Eliminar</button></a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12 text-center">
                    <div class="alert alert-success mt-2">{{ $message }}</div>
                @endforelse
                </div>
            </div>
            <div class="col-md">
                <div class="card">
                    <div class="card-header"><strong>Menu Apps</strong></div>
                    <div class="card-body">
                        <div class="btn-group justify-content-between align-items-center">
                            <a href="{{ route('me.create') }}"><button class="mt-2 btn btn-primary">Agregar Aplicacion</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection