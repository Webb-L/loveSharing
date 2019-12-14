<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{config('app.name')}} | {{$title}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield("header")
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">首页</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="https://webb-l.top" class="nav-link" target="_blank">联系</a>
            </li>
        </ul>

    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{route('admin')}}" class="brand-link">
            <img src="/dist/img/AdminLTELogo.png" alt="{{config('app.name')}} Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{config('app.name')}}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{\Auth::guard('admin')->user()->avatar?\Auth::guard('admin')->user()->avatar:'/dist/img/avatar5.png'}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{route('admin.edit')}}" class="d-block">{{\Auth::guard('admin')->user()->name}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" id="nav" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item has-treeview">
                        <a href="{{route('admin')}}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>仪表盘</p>
                        </a>
                    </li>
                    <li class="nav-header">前台管理</li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                会员管理
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('avatar.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>会员头像列表</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('user.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>会员列表</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('user.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>添加会员</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{route('video.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-video"></i>
                            <p>视频管理</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{route('image.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-image"></i>
                            <p>展示图管理</p>
                        </a>
                    </li>
                    <li class="nav-header">后台管理</li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon ion ion-person-add"></i>
                            <p>
                                管理员管理
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.avatar.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>管理员头像列表</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('users.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>管理员列表</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('users.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>添加管理员</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{route('role.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>角色管理</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="{{route('auth.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>权限管理</p>
                        </a>
                    </li>
                    <li class="nav-header">网站管理</li>
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{route('admin.setting')}}" class="nav-link">--}}
{{--                            <i class="nav-icon fas fa-cog"></i>--}}
{{--                            <p>设置</p>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    <li class="nav-header">其他</li>
                    <li class="nav-item">
                        <a href="{{route('admin.examine.index')}}" class="nav-link">
                            <i class="nav-icon far fa-circle text-warning"></i>
                            <p>视频审核</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('recovery.index')}}" class="nav-link">
                            <i class="nav-icon far fa-circle text-danger"></i>
                            <p>回收站</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('info.index')}}" class="nav-link">
                            <i class="nav-icon far fa-circle text-info"></i>
                            <p>信息</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{$title}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin')}}">首页</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield("main")
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.0.1
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


@yield("footer")

<script>
    $(() => {
        $('#nav p').map((i,t)=>{
            if($(t).text()=="{{$title}}") {
                $(t).parent().attr('class','nav-link active');
                $(t).parent().parent().parent().parent().attr('class','nav-item menu-open');
            }
        });

    })
</script>
</body>
</html>
