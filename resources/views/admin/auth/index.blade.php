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
   @foreach($auth_pid as $pid)
       <div class="card">
           <div class="card-header">
               <h3 class="card-title">{{$pid->auth_d}}</h3>
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
                       <th style="width: 1%">
                           #
                       </th>
                       <th>
                           描述
                       </th>
                       <th>
                           控制器
                       </th>
                       <th>
                           方法
                       </th>
                   </tr>
                   </thead>
                   <tbody>
                        @foreach($pid->auth as $key=>$data)
                            <tr>
                                <td>{{$key+1}}.</td>
                                <td>
                                    <a>{{$data->auth_d}}</a>
                                </td>
                                <td>
                                    {{$data->auth_c}}
                                </td>
                                <td class="project_progress">
                                    {{$data->auth_a}}
                                </td>
                            </tr>
                        @endforeach
                   </tbody>
               </table>
           </div>
           <!-- /.card-body -->
       </div>
   @endforeach
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
