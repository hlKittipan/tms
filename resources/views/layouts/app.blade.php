<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <style type="text/css">
        @font-face {
            font-family: "Nunito";
            src: url('{{ new_asset('fonts/Nunito-Regular.ttf') }}');
        }
    </style>

    <!-- Font awesome -->
    <link href="{{ new_asset('css/all.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ new_asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ new_asset('css/font/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">

    <script src="https://unpkg.com/swiper/js/swiper.js"></script>
    <script src="https://unpkg.com/swiper/js/swiper.min.js"></script>
</head>
<body>
    <div id="app">
        @include('layouts.nav')

        <main class="py-4 navbar-top">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
    <!-- Scripts -->
    <script src="{{ new_asset('js/app.js') }}" ></script>
    @yield('script')
</body>
</html>
