@extends('admin.default')
@section('header')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="/plugins/ekko-lightbox/ekko-lightbox.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@endsection
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <div class="card-title">
                        {{$title}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($avatar_list as $data)
                            <div class="col-sm-2">
                                <a href="{{$data->avatar?$data->avatar:'/dist/img/avatar5.png'}}" data-toggle="lightbox" data-title="{{$data->name}}" data-gallery="gallery">
                                    <img src="{{$data->avatar?$data->avatar:'/dist/img/avatar5.png'}}" class="img-fluid mb-2 w-100" alt="white sample"/>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            {{ $avatar_list->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery UI -->
    <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Ekko Lightbox -->
    <script src="/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/dist/js/demo.js"></script>
    <!-- Filterizr-->
    <script src="/plugins/filterizr/jquery.filterizr.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({gutterPixels: 3});
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>
@endsection
