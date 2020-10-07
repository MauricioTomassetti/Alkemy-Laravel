<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@include('layouts.head')
</head>
<body>
   @include('layouts.navigation')
   @include('layouts.hero')
  <section>
    @yield('content')
  </section>
</body>
</html>
