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
        <div class="card-header d-flex align-items-center">
            <h3 class="card-title">{{$title}}</h3>
            <a href="{{route('role.create')}}" class="btn btn-sm btn-success ml-3"><i class="fas fa-plus"></i></a>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table table-condensed table-hover">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th style="width: 25%">名称</th>
                    <th>权限</th>
                    <th style="width: 10%">操作</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($role_list as $key=>$data)
                        <tr>
                            <td>{{$key+1}}.</td>
                            <td>{{$data->role_name}}</td>
                            <td>
                                @foreach(App\Admin\Auth::all()->whereBetween('auth_id',explode(',',$data->role_auth_ids)) as $auth)
                                    {{$auth->auth_d}}
                                @endforeach
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('role.edit',$data)}}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                    <button type="button" id="{{$data->role_id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                </div>
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
                    {{ $role_list->links() }}
                </ul>
            </nav>
        </div>
    </div>
    <!-- /.card -->
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
                        axios.delete('/admin/role/' + $(this).attr('id'))
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
