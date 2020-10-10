<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@include('layouts.head')
</head>
<body class="background-main">
   @include('layouts.navigation')
   @include('layouts.hero')
      @yield('content')
      @yield('appDetail')
  @include('layouts.footer')
  @include('layouts.script')
</body>
</html>
