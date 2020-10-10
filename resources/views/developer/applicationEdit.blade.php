@extends('layouts.app')
@section('content')
<div class="container">
    <h2 class="text-center">{{ $app->nameapp }}</h2>
    <hr>
    <div class="row">
        <div class="col" id="card">
            <div class="card mb-4 shadow-sm">
                <img src="{{ asset( $app->image_src) }}" class="card-img" alt="{{ $app->name }}">
            </div>
        </div>
        <div class="col">
            <div class="card mb-6 shadow-sm text-center">
                <div class="card-body">
                    <form method="POST" action="{{ route('me.update', $app->slug) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="Nombre"><strong></strong></label>
                            <input type="text" name="name" class="form-control text-center" id="name" disabled aria-describedby="nameHelp" value="{{ $app->nameapp }}">
                            <small id="appName" class="form-text text-muted">El nombre de la app, no puede ser actualizada luego de crearla.</small>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="Categorie"><strong></strong></label>
                            <input type="text" name="category" class="form-control  text-center" id="category" disabled aria-describedby="categoryHelp" value={{ $app->namecat }}>
                            <small id="categorie" class="form-text text-muted">La categoria de la app, no puede ser actualizada luego de crearla.</small>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="Precio"><strong>Precio de venta</strong></label>
                            <input type="number" name="price" step="any" min="0.1" max="9999.99" class="form-control text-center" id="price" aria-describedby="categoryHelp" value={{ $app->price }}>
                        </div>
                        <div class="form-group">
                            <label for="Precio"><strong>Descripcion</strong></label>
                            <textarea name="description" maxlength='500' class="form-control" cols="80" rows="5" placeholder="Descripcion de la app.." style=" resize: none;"></textarea>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="chooseFile"><strong>Cargar imagen</strong></label><br>
                            <input type="file" name="image" id="chooseFile">
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary">Actualizar aplicacion</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection