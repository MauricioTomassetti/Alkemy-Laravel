<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@include('layouts.head')
</head>
<body>
  <div id="app">
   @include('layouts.navigation')
  </div>
  <main role="main">
    @include('layouts.hero')
  </main>
  <main class="py-4">
    @yield('content')
  </main>
</body>
</html>
