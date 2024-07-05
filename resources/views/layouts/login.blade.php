<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Scripts -->
    @vite(['resources/sass/login.scss', 'resources/js/login.js'])
</head>
<body>
    <div class="vh-100">
        @yield('body')
    </div>
    @yield('footer_style_script')
    @if(Session::has('message'))
        <script type="module">
            toastr.options = {
                "closeButton" : true,
                "progressBar" : true
            }
            toastr.success("{{ session('message') }}");
        </script>
    @endif
</body>
</html>