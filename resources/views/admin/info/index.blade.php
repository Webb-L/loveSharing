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
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">信息 <a href="{{route('info.create')}}" class="btn btn-sm btn-success ml-3"><i
                        class="fas fa-plus"></i></a></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover projects">
                <thead>
                <tr>
                    <th>#</th>
                    <th>标题</th>
                    <th>状态</th>
                    <th>发送</th>
                    <th>接收</th>
                    <th>内容</th>
                    <th style="width:10%">发布时间</th>
                    <th style="width:8%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($news as $key=>$data)
                    <tr>
                        <td>{{$key+1}}.</td>
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
                            {{$data->created_at}}
                        </td>
                        <td class="project-actions text-left">
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
        <div class="card-footer">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    {{ $news->links() }}
                </ul>
            </nav>
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

    <script>
        $(() => {
            $('.btn-danger').click( function(){
                $.ajax({
                    method: 'delete',
                    url: '/admin/info/'+$(this).attr('id'),
                    data: {"_token": "{{csrf_token()}}"}
                }).then(response => {
                    if(response==1) location.reload();
                })
            })
        })
    </script>
@endsection
