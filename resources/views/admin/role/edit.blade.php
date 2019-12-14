@extends('admin.default')
@section('header')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
    </style>
@endsection
@section('main')
    <!-- general form elements disabled -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">{{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form role="form" action="{{route('role.update',$data)}}" method="post">
                @method('PUT')
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        @if($error == '1')
                            @component('admin.component.callout',['type'=>'success','content'=>'修改成功！'])
                            @endcomponent
                        @else
                            @component('admin.component.callout',['type'=>'danger','content'=>$error])
                            @endcomponent
                        @endif
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-sm-12">
                        <!-- text input -->
                        <div class="form-group">
                            <label>角色名：</label>
                            <input type="text" name="role_name" class="form-control" value="{{$data->role_name}}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                            <label>权限</label>
                            <div class="container">
                                @foreach($auth as $auths)
                                    <div>
                                        <div class="custom-control custom-checkbox a">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox{{$auths->auth_id}}">
                                            <label for="customCheckbox{{$auths->auth_id}}" class="custom-control-label">{{$auths->auth_d}}</label>
                                        </div>
                                        <div class="container">
                                            <div class="row">
                                                @foreach($auths->auth as $auth_data)
                                                    <div class="col-sm-4 b">
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" name="role_auth_ids[]" value="{{$auth_data->auth_id}}" type="checkbox" id="customCheckbox{{$auth_data->auth_id}}">
                                                            <label for="customCheckbox{{$auth_data->auth_id}}" class="custom-control-label">{{$auth_data->auth_d}}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @csrf
                <button type="submit" class="btn btn-primary">提交</button>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
@section('footer')
    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/dist/js/demo.js"></script>

    <script>
        $(() => {
            let data =  "{{$data->role_auth_ids}}".split(',');
            data.map((i)=>{
                $('#customCheckbox'+i).attr('checked','checked');
            });
            $('.a').click(function () {
                if ($($(this).children()[0]).is(':checked')) {
                    $(this).siblings().children().children().children().children().map((i, t) => {
                        $(t).attr('checked', 'checked');
                    })
                } else {
                    $(this).siblings().children().children().children().children().map((i, t) => {
                        $(t).removeAttr('checked');
                    })
                }
            });
        });
    </script>
@endsection
