<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}} - 验证邮箱</title>

</head>
<body>
<div class="jumbotron">
    <h1 class="display-4">你好, {{$user->name}}!</h1>
    <p>首先我欢迎您加入{{config('app.name')}}，因为您的账号并没有验证邮箱这样会导致你的账号无法正常使用，验证邮箱后你会得到很多功能，快点点击下面的按钮吧！</p>
    <a class="btn btn-primary btn-lg" href="{{route('confirmEmailToken',$user->email_token)}}" role="button">验证邮箱</a>
</div>
</body>
</html>
