<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ env('APP_NAME') }}</title>

    <!-- Styles -->
    <link href="{{ asset('vendor/adminkit/dist/css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
</head>
<body>

@yield('content')

<script src="{{ asset('vendor/adminkit/dist/js/app.js') }}"></script>

</body>
</html>
