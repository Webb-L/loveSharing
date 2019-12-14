@extends('admin.default')
@section('header')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endsection
@section('main')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">用户列表</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>头像</th>
                    <th>名称</th>
                    <th>邮箱</th>
                    <th>角色</th>
                    <th>创建时间</th>
                    <th>上次修改时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user_list as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td><img src="{{$data->avatar?$data->avatar:'/dist/img/avatar5.png'}}" width="45" class="rounded-circle" alt=""></td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>
                            @if($data->role)
                                @if($data->role_id===0)
                                    <a class="badge badge-success text-white">超级管理员</a>
                                @else
                                    {{$data->role->role_name}}
                                @endif
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{$data->created_at}}</td>
                        <td>{{$data->updated_at}}</td>
                        <td>
                            @if($data->role_id!==0)
                                <a href="{{route('users.edit',$data)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                <button type="button" id="{{$data->id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    {{ $user_list->links() }}
                </ul>
            </nav>
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
    <!-- DataTables -->
    <script src="/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/dist/js/demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $(() => {
            $('.btn-danger').click(function (e) {
                Swal.fire({
                    title: '你确定吗?',
                    text: "删除后无法找回。",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '确认删除',
                    cancelButtonText: '取消'
                }).then((result) => {
                    if (result.dismiss !== "cancel") {
                        axios.delete('/admin/admin/users/' + $(this).attr('id'))
                            .then(response => {
                                if (response.data === 1) {
                                    location.reload();
                                }
                            })
                    }
                })
            })
        })
    </script>
@endsection
