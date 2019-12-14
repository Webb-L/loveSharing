@extends('admin.default')
@section('header')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endsection
@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{$title}}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('video.update',$data)}}" method="post">
                @method('PUT')
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        @if($error == '1')
                            @component('admin.component.callout',['type'=>'success','content'=>'修改成功！'])
                            @endcomponent
                        @else
                            @component('admin.component.callout',['type'=>'danger','content'=>$error])
                            @endcomponent
                        @endif
                    @endforeach
                @endif
                <div class="form-group">
                    <label for="inputName">标题</label>
                    <input type="text" id="inputName" class="form-control" name="title" value="{{$data->title}}">
                </div>
                <div class="form-group">
                    <label for="inputEmail">作者</label>
                    <input type="text" id="inputEmail" class="form-control" disabled value="{{$data->user()->first()?$data->user()->first()->name:'N/A'}}">
                </div>
                <div class="form-group">
                    <label for="inputStatus">状态</label>
                    <select name="status" class="form-control custom-select">
                        <option value="1" {{$data->status==1?'selected':''}}>不通过</option>
                        <option value="2" {{$data->status==2?'selected':''}}>通过</option>
                    </select>
                </div>
                <label for="inputProjectLeader">展示图
                    <div><img src="{{$data->displaymap}}" id="img_file" class="shadow p-1 mt-2 bg-white rounded" alt="" style="width: 230px !important;"></div>
                </label>
                <div class="form-group">
                    <input type="text" name="displaymap" id="file" style="display: none">
                    <input type="file" id="inputProjectLeader" class="form-control" style="display: none" accept="image/*">
                </div>
                <label for="inputProjectLeaderUrl">视频
                    <div><video src="{{$data->url}}" id="url_file" class="shadow p-1 mt-2 bg-white rounded" style="width: 20% !important;"></video></div>
                </label>
                <div class="form-group">
                    <input type="text" name="url" id="url" style="display: none">
                    <input type="file" id="inputProjectLeaderUrl" class="form-control" style="display: none" accept="video/mp4">
                </div>
                @csrf
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">提交</button>
                </div>
            </form>
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
    <!--  ali-oss  -->
    <script src="/js/aliyun-oss-sdk.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="/js/oss.js"></script>

    <script>
        $(()=>{
            $('#inputProjectLeader').on('change', function () {
                Swal.fire({
                    title: '提示',
                    text: '文件正在上传请耐心等待！',
                    icon: 'info',
                    confirmButtonText: '确定'
                })
                client.put('/image/' + randomStr(false, 43) + "." + $(this)[0].files[0].name.split('.')[$(this)[0].files[0].name.split('.').length - 1], $(this)[0].files[0])
                    .then(response => {
                        if (response.url) {
                            $('#img_file').attr('src',response.url);
                            $('#file').val(response.url);
                            console.log(response.url);
                            Swal.fire({
                                title: '成功',
                                text: '图片上传成功！',
                                icon: 'success',
                                confirmButtonText: '确定'
                            })
                        } else {
                            Swal.fire({
                                title: '错误',
                                text: '服务器出现小故障，请重试！',
                                icon: 'error',
                                confirmButtonText: '确认'
                            })
                        }
                    })
                    .catch(() => {
                        Swal.fire({
                            title: '错误',
                            text: '服务器出现小故障，请重试！',
                            icon: 'error',
                            confirmButtonText: '确认'
                        })
                    })
            });
            $('#inputProjectLeaderUrl').on('change', function () {
                Swal.fire({
                    title: '提示',
                    text: '文件正在上传请耐心等待！',
                    icon: 'info',
                })
                client.put('/video/' + randomStr(false, 43) + "." + $(this)[0].files[0].name.split('.')[$(this)[0].files[0].name.split('.').length - 1], $(this)[0].files[0])
                    .then(response => {
                        if (response.url) {
                            $('#url_file').attr('src',response.url);
                            $('#url').val(response.url);
                            Swal.fire({
                                title: '成功',
                                text: '视频上传成功！',
                                icon: 'success',
                                confirmButtonText: '确定'
                            })
                        } else {
                            Swal.fire({
                                title: '错误',
                                text: '服务器出现小故障，请重试！',
                                icon: 'error',
                                confirmButtonText: '取消'
                            })
                        }
                    })
                    .catch(() => {
                        Swal.fire({
                            title: '错误',
                            text: '服务器出现小故障，请重试！',
                            icon: 'error',
                            confirmButtonText: '取消'
                        })
                    })
            });

            function randomStr(randomFlag, min, max) {
                var str = "",
                    range = min,
                    arr = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
                        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k',
                        'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v',
                        'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F',
                        'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P',
                        'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
                // 随机产生
                if (randomFlag) {
                    range = Math.round(Math.random() * (max - min)) + min;
                }
                for (var i = 0; i < range; i++) {
                    let pos = Math.round(Math.random() * (arr.length - 1));
                    str += arr[pos];
                }
                return str;
            }
        })
    </script>
@endsection
