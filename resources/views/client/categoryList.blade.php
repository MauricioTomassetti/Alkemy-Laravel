@extends('layouts.app')

@section('content')
@foreach ($categories as $app)
<div>This is App {{ $app->name }}</div>
@endforeach
@endsection