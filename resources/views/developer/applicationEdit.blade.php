@extends('layouts.app')

@section('content')
<div class="container">
 <h2 class="text-center">{{$app->nameapp}}</h2>
    <hr>
  <div class="row">
  <div class="col">
        <img class="mb-4" src="{{ asset( $app->image_src) }}" alt="" width="450" height="480">
  </div>
    <div class="col">
            <div class="card mb-6 shadow-sm text-center">
                <div class="card-body">
                <form  method="POST" action="{{ route('me.update', $app->slug) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <label for="Nombre"><strong></strong></label>
                        <input type="text" name="name" class="form-control text-center" id="name" disabled aria-describedby="nameHelp" value="{{$app->nameapp}}">
                        <small id="appName" class="form-text text-muted">El nombre de la app, no puede ser actualizada luego de crearla.</small>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="Categorie"><strong></strong></label>
                        <input type="text" name="category" class="form-control  text-center" id="category" disabled aria-describedby="categoryHelp" value={{$app->namecat}}>
                        <small id="categorie" class="form-text text-muted">La categoria de la app, no puede ser actualizada luego de crearla.</small>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="Precio"><strong>Precio de venta</strong></label>
                        <input type="number" name="price" class="form-control text-center" id="price" aria-describedby="categoryHelp" value={{$app->price}}>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label  for="chooseFile"><strong>Cargar imagen</strong></label>
                        <input type="file" name="image" id="chooseFile">
                    </div>
                    <hr>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <div>
            <div>
            {{-- 'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048' --}}
<div>

@endsection
