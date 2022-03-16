@php

use Illuminate\Support\Facades\App;

// $locale = App::currentLocale();
$locale = App::getLocale();


@endphp

<!doctype html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
{{-- <html lang="{{ app()->getLocale() }}"> --}}


<html lang={{ $locale }}>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        {{--  @include('partials.appNav')  --}}

        @include('partials.homeNavbar')

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @yield('script')
</body>
</html>
