@extends('layouts.app')

@section('content')
@foreach ($apps as $app)
<div>This is App {{ $app->name }}</div>
@endforeach
@endsection