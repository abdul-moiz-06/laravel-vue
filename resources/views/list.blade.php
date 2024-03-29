<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base_url" content="{{url('/')}}"/>

    <title>Electronic</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div id="app">
    <list></list>
</div>

<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
