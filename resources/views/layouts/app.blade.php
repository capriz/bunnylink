<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet"/>
    <link href="{{ asset('vendor/datatables/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/alertifyjs/css/alertify.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/alertifyjs/css/themes/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/alertifyjs/css/themes/default.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/adminkit/dist/css/app.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
</head>
<body>
@inertia

<script src="{{ asset('vendor/alertifyjs/alertify.min.js') }}"></script>
<script src="{{ mix('/js/app.js') }}" defer></script>
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('vendor/datatables/js/dataTables.bootstrap5.min.js') }}" defer></script>

{{--SIDEBAR ACTION--}}
<script>
</script>
</body>
</html>
