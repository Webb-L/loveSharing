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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{$title}}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover projects">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>展示图</th>
                    <th>标题</th>
                    <th>作者</th>
                    <th>审核状态</th>
                    <th>申请时间</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $key=>$val)
                        <tr>
                            <td>{{$key+1}}.</td>
                            <td><img src="{{$val->displaymap}}" width="120" alt=""></td>
                            <td>{{$val->title}}</td>
                            <td>{{$val->user()->first()?$val->user()->first()->name:'N/A'}}</td>
                            <td>{{$val->status==2?'通过':'不通过'}}</td>
                            <td>{{$val->created_at}}</td>
                            <td class="project-actions text-center">
                                <a class="btn btn-success btn-sm" id="{{$val->id}}" href="javascript:;">
                                    <i class="fas fa-check">
                                    </i>
                                    通过
                                </a>
                                <a class="btn btn-danger btn-sm" id="{{$val->id}}" href="javascript:;">
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
        $(()=>{
            $('.btn-success').click(function(){
                $data = {
                    status:2,
                    "_token":"{{csrf_token()}}"
                }
                $.post('/admin/examine/'+$(this).attr('id'),$data)
                    .then(response=>{
                        if(response) {
                            location.reload()
                        }
                    })
            });

            $('.btn-danger').click(function () {
                $data = {
                    status:2,
                    "_token":"{{csrf_token()}}"
                }
                $.post('/admin/examine/del/'+$(this).attr('id'),$data)
                    .then(response=>{
                        if(response) {
                            location.reload()
                        }
                    })
            })
        })
    </script>
@endsection
