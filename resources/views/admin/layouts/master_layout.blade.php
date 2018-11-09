<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ env('APP_NAME' , 'Bet football') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="/css/owl.carousel.css">
    <link rel="stylesheet" href="/css/owl.theme.css">
    <link rel="stylesheet" href="/css/owl.transitions.css">
    <!-- meanmenu CSS
		============================================ -->
    <link rel="stylesheet" href="/css/meanmenu/meanmenu.min.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="/css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="/css/normalize.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- jvectormap CSS
		============================================ -->
    <link rel="stylesheet" href="/css/jvectormap/jquery-jvectormap-2.0.3.css">
    <!-- notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="/css/notika-custom-icon.css">
    <!-- wave CSS
		============================================ -->

    <link rel="stylesheet" href="/css/bootstrap-select/bootstrap-select.css">


    <link rel="stylesheet" href="/css/wave/waves.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="/css/main.css">

    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="/css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="/js/vendor/modernizr-2.8.3.min.js"></script>
    <link rel="stylesheet" href="/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/vendor/sweetalert2/dist/sweetalert2.css">
    <style rel="stylesheet">
        table.dataTable.no-footer {
            border-bottom: none;
            margin-bottom: 20px;
        }

        .customer-information{
            margin: 0px 0px 14px 0;
            border-bottom: 1px solid #ece5dd;
        }
    </style>
@yield('css')
<!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="/style.css">
</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Start Header Top Area -->
@include('admin.layouts.master_layout.header')
<!-- End Header Top Area -->
@include('admin.layouts.master_layout.menu')

@if(session('response'))
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="alert  alert-{{session('response')['type']}}" role="alert">
                    {{ session('response')['msg'] }}
                </div>
            </div>
        </div>
    </div>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="main-menu-area mg-tb-40">
            <div class="container">
                <div class="row">
                    <div class="alert  alert-danger" role="alert">
                        {{ $error }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif



@yield('content')
<!-- Start Footer area-->
@include('admin.layouts.master_layout.footer')
<!-- End Footer area-->
<!-- jquery
    ============================================ -->
<script src="/js/vendor/jquery-1.12.4.min.js"></script>
<!-- bootstrap JS
    ============================================ -->
<script src="/js/bootstrap.min.js"></script>
<!-- wow JS
    ============================================ -->
<script src="/js/wow.min.js"></script>
<!-- price-slider JS
    ============================================ -->
<script src="/js/jquery-price-slider.js"></script>
<!-- owl.carousel JS
    ============================================ -->
<script src="/js/owl.carousel.min.js"></script>
<!-- scrollUp JS
    ============================================ -->
<script src="/js/jquery.scrollUp.min.js"></script>
<!-- meanmenu JS
    ============================================ -->
<script src="/js/meanmenu/jquery.meanmenu.js"></script>
<!-- counterup JS
    ============================================ -->
<script src="/js/counterup/jquery.counterup.min.js"></script>
<script src="/js/counterup/waypoints.min.js"></script>
<script src="/js/counterup/counterup-active.js"></script>
<!-- mCustomScrollbar JS
    ============================================ -->
<script src="/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- jvectormap JS
    ============================================ -->
{{--<script src="/js/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>--}}
{{--<script src="/js/jvectormap/jquery-jvectormap-world-mill-en.js"></script>--}}
{{--<script src="/js/jvectormap/jvectormap-active.js"></script>--}}
<!-- sparkline JS
    ============================================ -->
<script src="/js/sparkline/jquery.sparkline.min.js"></script>
<script src="/js/sparkline/sparkline-active.js"></script>
<!-- sparkline JS
    ============================================ -->
<script src="/js/flot/jquery.flot.js"></script>
<script src="/js/flot/jquery.flot.resize.js"></script>
<script src="/js/flot/curvedLines.js"></script>
<script src="/js/flot/flot-active.js"></script>
<!-- knob JS
    ============================================ -->
<script src="/js/knob/jquery.knob.js"></script>
<script src="/js/knob/jquery.appear.js"></script>
<script src="/js/knob/knob-active.js"></script>
<!--  wave JS
    ============================================ -->
<script src="/js/wave/waves.min.js"></script>
<script src="/js/wave/wave-active.js"></script>
<!--  todo JS
    ============================================ -->
<script src="/js/todo/jquery.todo.js"></script>
<!-- plugins JS
    ============================================ -->
<script src="/js/plugins.js"></script>
<!--  Chat JS
    ============================================ -->
<script src="/js/chat/moment.min.js"></script>
<script src="/js/chat/jquery.chat.js"></script>

<script src="/js/bootstrap-select/bootstrap-select.js"></script>

<!-- main JS
    ============================================ -->
<script src="/js/main.js"></script>
<!-- tawk chat JS
    ============================================ -->
<script src="/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="/js/data-table/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(function () {
        $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
        });
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var visible = false;

    @if(\Gate::allows('admin'))
        visible = true;
            @endif


    var isAgent = false;

    @if(\Gate::allows('agent'))
        isAgent = true;
            @endif

    var isRoot = false;

    @if(\Gate::allows('root'))
        isRoot = true;
    @endif
</script>


@yield('js')
</body>

</html>
