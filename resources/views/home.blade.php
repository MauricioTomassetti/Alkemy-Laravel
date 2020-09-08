@extends('layouts.app')

@section('content')

@include('client.categoryList')
<div class="album py-5 bg-light">
  @include('client.index')
</div>

@include('client.desired')
@include('layouts.script')

@endsection