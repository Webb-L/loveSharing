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
@endsection
@section('main')
    <!-- general form elements disabled -->
    <div class="row">
        <div class="col-sm-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form" action="{{route('info.store')}}" method="post">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                @if($error == '1')
                                    @component('admin.component.callout',['type'=>'success','content'=>'发送成功！'])
                                    @endcomponent
                                @else
                                    @component('admin.component.callout',['type'=>'danger','content'=>$error])
                                    @endcomponent
                                @endif
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>标题</label>
                                    <input type="text" class="form-control" name="title" maxlength="15">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>内容</label>
                                    <textarea class="form-control" rows="3" name="description" maxlength="100"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>发送给</label>
                                    <select name="user_id" class="form-control">
                                        <option value="0">全部会员</option>
                                        @foreach($user as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>信息提示类型</label>
                                    <select name="type" class="form-control">
                                        <option value="success">成功</option>
                                        <option value="info">消息</option>
                                        <option value="warning">警告</option>
                                        <option value="error">错误</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="form-group mt-5">
                                <button type="submit" class="btn btn-primary">发送</button>
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/dist/js/demo.js"></script>
@endsection
