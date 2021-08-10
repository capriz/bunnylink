<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Styles -->
    <link href="{{ asset('vendor/adminkit/dist/css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet"/>
    <link href="{{ asset('vendor/datatables/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/alertifyjs/css/alertify.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/alertifyjs/css/themes/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/alertifyjs/css/themes/default.css') }}" rel="stylesheet">

</head>
<body>

<div class="wrapper">

    @include('layouts.partials.sidebar')

    <div class="main">

        @include('layouts.partials.topbar')

        <main class="content">
            @inertia
        </main>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row text-muted">
                    <div class="col-6 text-start">
                        <p class="mb-0">
                            <a href="index.html" class="text-muted"><strong>{{ env('APP_NAME') }}</strong></a> &copy;
                            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                        </p>
                    </div>
                    <div class="col-6 text-end">
                        <ul class="list-inline">
{{--                            <li class="list-inline-item">--}}
{{--                                <a class="text-muted" href="#">Support</a>--}}
{{--                            </li>--}}
{{--                            <li class="list-inline-item">--}}
{{--                                <a class="text-muted" href="#">Help Center</a>--}}
{{--                            </li>--}}
{{--                            <li class="list-inline-item">--}}
{{--                                <a class="text-muted" href="#">Privacy</a>--}}
{{--                            </li>--}}
{{--                            <li class="list-inline-item">--}}
{{--                                <a class="text-muted" href="#">Terms</a>--}}
{{--                            </li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<script src="{{ asset('vendor/adminkit/dist/js/app.js') }}"></script>
<script src="{{ asset('vendor/alertifyjs/alertify.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ mix('/js/app.js') }}" defer></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('vendor/datatables/js/dataTables.bootstrap5.min.js') }}" defer></script>

{{--SIDEBAR ACTION--}}
<script>
    $(document).ready(function () {
        $('[href="{{ request()->fullUrl() }}"]').parent().addClass('active');
        $('[href="{{ request()->fullUrl() }}"]').parent().parent().addClass('show');
        $('[href="{{ request()->fullUrl() }}"]').parent().parent().parent().addClass('active');
        $('[href="{{ request()->fullUrl() }}"]').parent().parent().parent().children().first().attr('aria-expanded', true);
        $('[href="{{ request()->fullUrl() }}"]').parent().parent().parent().children().first().addClass('collapsed');
    });
</script>
</body>
</html>
