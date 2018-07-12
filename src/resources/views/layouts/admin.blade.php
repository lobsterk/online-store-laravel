<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <title>@yield('title', $_SERVER['HTTP_HOST']) </title>

</head>
<body>

<div id="app">
    @yield('content')
</div>

<script type="text/javascript" src="{{ elixir('js/app.js') }}"></script>
@yield('script')
</body>
</html>