@extends('layouts.app')

@section('content')

@include('client.categoryList')
<div class="album py-5 bg-light">
  @include('client.index')
</div>
@if (!Auth::user())
@include('client.desired')
@endif
@include('layouts.script')

@endsection
