@extends('layouts.app')

@section('content')
@foreach ($applicationsCategory as $app)
<div>{{ $app->name }}</div>
@endforeach
@endsection