<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" ref="token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="{{mix('css/element-ui.css')}}">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
</head>
<body>
<div id="app">

</div>
</body>
<script src="{{mix('js/app.js')}}"></script>
</html>
