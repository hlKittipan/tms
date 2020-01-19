<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
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
    <link href="{{ new_asset('css/custom.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    @include('backends.layouts.nav')

    <main class="py-4">
        @yield('content')
    </main>
    <footer>
        <div class=" col-md-12 text-center">
            Copyright © 2018 Twenty four seven hours Tour Limited All rights reserved.
        </div>
    </footer>
</div>
<!-- Scripts -->
<script src="{{ new_asset('js/app.js') }}" ></script>
    @yield('script')
</body>
</html>
