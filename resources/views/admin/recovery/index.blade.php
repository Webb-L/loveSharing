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
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">视频回收站</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover projects">
                <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        标题
                    </th>
                    <th>
                        作者
                    </th>
                    <th>
                        删除时间
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($video as $data)
                    <tr>
                        <td>{{$data->id}}.</td>
                        <td>
                            <a>{{$data->title}}</a>
                        </td>
                        <td>
                            {{$data->user()->first()?$val->user()->first()->name:'N/A'}}
                        </td>
                        <td class="project_progress">
                            {{$data->deleted_at}}
                        </td>
                        <td class="project-actions text-left">
                            <a class="btn btn-info video btn-sm" id="{{$data->id}}" href="#">
                                <i class="fas fa-check">
                                </i>
                                恢复
                            </a>
                            <a class="btn btn-danger btn-sm video" id="{{$data->id}}" href="#">
                                <i class="fas fa-trash">
                                </i>
                                删除
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="card card-success">
        <div class="card-header">
            <h3 class="card-title">管理员回收站</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover projects">
                <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        名称
                    </th>
                    <th>
                        邮箱
                    </th>
                    <th>
                        删除时间
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($admin_user as $data)
                    <tr>
                        <td>{{$data->id}}.</td>
                        <td>
                            <a>{{$data->name}}</a>
                        </td>
                        <td>
                            {{$data->email}}
                        </td>
                        <td class="project_progress">
                            {{$data->deleted_at}}
                        </td>
                        <td class="project-actions text-left">
                            <a class="btn btn-success btn-sm" id="{{$data->id}}" href="#">
                                <i class="fas fa-check">
                                </i>
                                恢复
                            </a>
                            <a class="btn btn-danger btn-sm admin" id="{{$data->id}}" href="#">
                                <i class="fas fa-trash">
                                </i>
                                删除
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">消息回收站</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover projects">
                <thead>
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        标题
                    </th>
                    <th>
                        状态
                    </th>
                    <th>
                        发送
                    </th>
                    <th>
                        接收
                    </th>
                    <th style="width:45%">
                        内容
                    </th>
                    <th>
                        删除时间
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($news as $data)
                    <tr>
                        <td>{{$data->id}}.</td>
                        <td>
                            <a>{{$data->title}}</a>
                        </td>
                        <td>
                            <a>{{$data->type}}</a>
                        </td>
                        <td>
                            {{$data->admin()->first()?$data->admin()->first()->name:'N/A'}}
                        </td>
                        <td>
                            {{$data->user()->first()?$data->user()->first()->name:'N/A'}}
                        </td>
                        <td>
                            {{$data->description}}
                        </td>
                        <td class="project_progress">
                            {{$data->deleted_at}}
                        </td>
                        <td class="project-actions text-left">
                            <a class="btn btn-warning btn-sm" id="{{$data->id}}" href="#">
                                <i class="fas fa-check">
                                </i>
                                恢复
                            </a>
                            <a class="btn btn-danger btn-sm news" id="{{$data->id}}" href="#">
                                <i class="fas fa-trash">
                                </i>
                                删除
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
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

    <script>
        $(() => {
            $('.btn-info').click(function () {
                recovery(0, $(this));
            });
            $('.btn-success').click(function () {
                recovery(1, $(this));
            });
            $('.btn-warning').click(function () {
                recovery(2, $(this));
            });

            function recovery(type, ele) {
                $data = {
                    type: type,
                    "_token": "{{csrf_token()}}"
                }
                $.post('/admin/recovery/' + ele.attr('id'), $data)
                    .then(response => {
                        if (response == 1) location.reload();
                    })
            }

            $('.video').click(function () {
                del(0,$(this));
            })
            $('.admin').click(function () {
                del(0,$(this));
            })
            $('.news').click(function () {
                del(0,$(this));
            })
            function del(type, ele) {
                $data = {
                    type: type,
                    "_token": "{{csrf_token()}}"
                }
                $.post('/admin/recovery/delete/' + ele.attr('id'), $data)
                    .then(response => {
                        if (response == 1) location.reload();
                    })
            }
        })
    </script>
@endsection
