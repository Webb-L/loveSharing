@extends('admin.default')
@section('header')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endsection
@section('main')
    <div class="error-page">
        <h2 class="headline text-danger">错误</h2>
        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-danger"></i> 因为您的权限不够，无法访问当前页面.</h3>
            <p>
                您可以去找超级管理员给予您权限
                同时，您可以 <a href="{{route('admin')}}">返回仪表盘</a> 。
            </p>
        </div>
    </div>
    <!-- /.error-page -->
@endsection
@section('footer')
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
@endsection
