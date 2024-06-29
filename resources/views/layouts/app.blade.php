<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/js/src/app.js'])
</head>
<body>
    <div class="d-flex vh-100">
        @include('backend.partials.menu')
        <div class="d-flex flex-fill w-100 flex-column" style="transition: width 2s">
            @include('backend.partials.header')
            @include($pages)
            @include('backend.partials.footer')
        </div>
    </div>
    @include('backend.partials.menu mobile')
    <script type="module">
        @if(session()->has('message'))
            toastr.success("{{ Session::get('message') }}");
        @endif
        @if(session()->has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
        @if(session()->has('modal'))
            $(document).ready(function(){
                var _content = '{!! Session::get("content") !!}';
                $('#appForm .modal-body').html(_content);
                $('#appFormLabel').text("{{ Session::get('title') }}");
                const myModal = new bootstrap.Modal(document.getElementById('appForm'), {
                    keyboard: false
                });
                myModal.show();
            });
        @endif
    </script>
    @yield('footer_style_script')
</body>
</html>