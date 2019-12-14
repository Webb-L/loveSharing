<!doctype html>
<html lang="{{app()->getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}} - 找回密码</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js" integrity="sha384-L2pyEeut/H3mtgCBaUNw7KWzp5n9+4pDQiExs933/5QfaTh8YStYFFkOzSoXjlTb" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        .jumbotron {
            height: 100vh;
            margin-bottom: 0  !important;
        }
    </style>
</head>
<body>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">{{config('app.name')}} - 找回密码</h1>
        <hr class="my-4">
        @if(count($errors)>0)
            @foreach($errors->all() as $error)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>警告，</strong>{{$error}}
                </div>

                <script>
                    $(".alert").alert();
                </script>
            @endforeach
        @endif
        <form action="{{url()->full()}}" method="post">
            @csrf
            <div class="form-group">
                <label for="domainName">{{config('app.name')}} 域名是什么</label>
                <input type="url" class="form-control" id="domainName" name="domainName" aria-describedby="domainNamelHelp">
                <small id="domainNamelHelp" class="form-text text-muted">{{config('app.url')}}</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">新密码</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">提交</button>
        </form>
    </div>
</div>
</body>
</html>
