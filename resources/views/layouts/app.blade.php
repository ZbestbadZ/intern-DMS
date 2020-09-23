<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.head')
</head>
<body>
    <div id="app">
        @include('includes.header')

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <footer class="row">
        @include('includes.footer')
    </footer>
</body>
</html>
