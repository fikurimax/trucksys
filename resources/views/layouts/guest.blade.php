<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Truksis') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Custom style -->
        <style>
            body {
                background-image: url('{{ asset("images/background.jpg") }}') !important;
                background-repeat: no-repeat;
                background-attachment: scroll;
            }
        </style>
    </head>
    <body>
        <div id="bg-overlay"></div>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
