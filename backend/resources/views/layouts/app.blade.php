<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }}</title>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}" type="text/css">
  <!-- Scripts -->
  
</head>

<body>  
  @include('commons.navbar')

  @yield('content') 
  <div id="app"></div>
</body>
@yield('js') 

</html>