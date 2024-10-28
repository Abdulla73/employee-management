<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Employee Pro</title>

        @include('layout.header')
        @yield('styles')
    </head>
<body>
    @include('layout.navbar')

    <div class="main">
        @include('layout.sidebar')
        @yield('content')
    </div>

    @include('layout.footer')
    @yield('scripts')
</body>
</html>
