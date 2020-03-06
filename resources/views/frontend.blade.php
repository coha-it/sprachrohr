@php
$config = [
    'appName' => config('app.name'),
    'locale' => $locale = app()->getLocale(),
    'locales' => config('app.locales'),
    'githubAuth' => config('services.github.client_id'),
];
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>{{ config('app.name') }}</title>

  
  <link rel="stylesheet" href="{{ mix('dist/frontend/css/semantic.min.css') }}">
  <link rel="stylesheet" href="{{ mix('dist/frontend/css/frontend.css') }}">
  @if(App::environment('production'))
    {{-- Produciton --}}
  @else
    {{-- Coding --}}
  @endif

</head>
<body>
  <div id="app"></div>

  {{-- Global configuration object --}}
  <script>
    window.config = @json($config);
  </script>

  {{-- Load the application scripts --}}
  <script src="{{ mix('dist/frontend/js/frontend.js') }}"></script>
  @if(App::environment('production'))
    {{-- Production --}}
  @else
    {{-- Coding --}}
  @endif

</body>
</html>
