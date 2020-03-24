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

  @if(App::environment('production'))
    {{-- Production --}}
    <link rel="stylesheet" href="{{ asset('dist/frontend/semantic/semantic.min.css') }}">
  @else
    {{-- Coding --}}
    <link rel="stylesheet" href="{{ asset('dist/frontend/semantic/semantic.css') }}">
  @endif
  <link rel="stylesheet" href="{{ mix('dist/frontend/css/frontend.css') }}">

</head>
<body>
  <div id="app"></div>

  {{-- Global configuration object --}}
  <script>
    window.config = @json($config);
  </script>

  {{-- Load the application scripts --}}
  @if(App::environment('production'))
    {{-- Production --}}
    {{-- <script src="{{ asset('dist/frontend/semantic/semantic.min.js') }}"></script> --}}
  @else
    {{-- Coding --}}
    {{-- <script src="{{ asset('dist/frontend/semantic/semantic.js') }}"></script> --}}

    {{--
      ONLY for SAFARI DEBUG
    <script>
      window.__VUE_DEVTOOLS_HOST__ = 'localhost' // default: localhost
      window.__VUE_DEVTOOLS_PORT__ = '8098' // default: 8098
    </script>
    <script src="http://localhost:8098"></script>
    --}}
  @endif
  <script src="{{ mix('dist/frontend/js/frontend.js') }}"></script>

</body>
</html>
