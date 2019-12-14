@extends('admin.default')
@section('header')
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endsection
@section('main')
    <h1>不可使用</h1>
    <div class="container-fluid">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h5 class="m-0">头像缓存清理</h5>
            </div>
            <div class="card-body">
                <p class="card-text">资源清理后不能恢复，清理前请考虑好。</p>
                <a href="#" class="btn btn-info">确认清理</a>
            </div>
        </div>
        <div class="card card-success card-outline">
            <div class="card-header">
                <h5 class="m-0">展示图缓存清理</h5>
            </div>
            <div class="card-body">
                <p class="card-text">资源清理后不能恢复，清理前请考虑好。</p>
                <a href="#" class="btn btn-success">确认清理</a>
            </div>
        </div>
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h5 class="m-0">视频缓存清理</h5>
            </div>
            <div class="card-body">
                <p class="card-text">资源清理后不能恢复，清理前请考虑好。</p>
                <a href="#" class="btn btn-warning">确认清理</a>
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

    <!--  ali-oss  -->
    <script src="/js/aliyun-oss-sdk.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="/js/oss.js"></script>

    <script>
    </script>
@endsection
