@extends('layouts.app')

@section('content')
<div class="container">
 <h2 class="text-center">Agregar una app al store</h2>
<hr>
  <div class="row justify-content-center"">
    <div class="col-8 text-center">
            <div class="card mb-6 shadow-sm text-center">
                <div class="card-body">
                <form  method="POST" action="{{ route('me.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nombre-title"><h4 name="nombre-title">Nombre de la App</h4></label>
                        <input type="text" name="name" class="form-control text-center" id="name" aria-describedby="nameHelp">
                        <small  class="form-text text-muted">Recuerde que una vez creada la aplicacion, no podra cambiar su nonmbre</small>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="category-title"><h4 name="category-title">Seleccione una categoria</h4></label><br>
                        {{-- <input type="text" name="category" class="form-control  text-center" id="category" disabled aria-describedby="categoryHelp" value={{$app->namecat}}> --}}
                        <select name="category_id">
                            @foreach ($listCategory as $category)
                                <option value={{$category->id}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Recuerde que al seleccionar la cateogria, no podra volver a cambiarse</small>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="price-title"><h4 name="price-title">Ingrese el precio de venta</h4></label>
                        <input type="number" name="price" step="any" min="0.1" max="9999.99" class="form-control text-center" id="price" aria-describedby="categoryHelp">
                    </div>
                    <hr>
                    <label for="description-title"><h4 name="description-title">Ingrese una descripcion para su appliacion</h4></label>
                    <div class="form-group">
                        <textarea name="description" cols="80" rows="5" placeholder="Descripcion de la app.." style=" resize: none;"></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="image"><h4 name="image">Cargar imagen de la app</h4></label>
                        <input type="file" name="image" id="chooseFile">
                    </div>
                    <hr>
                       <button type="submit" class="btn btn-primary">Cargar app al store</button>
                    </form>
                    </div>

                </div>
            </div>
  </div>
</div>

    {{-- 'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048' --}}

@endsection
