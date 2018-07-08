<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>bOOK - XE</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/styles/black.css')}}" rel="stylesheet" type="text/css" id="colorscheme" />
    <link href="{{asset('css/panel.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/metisMenu.css')}}" rel="stylesheet" type="text/css"/>
    <!--end of page level css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datatables/css/dataTables.bootstrap.css') }}" />

    <link href="{{ asset('css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/select2/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/validation/css/bootstrapValidator.min.css') }}" rel="stylesheet" type="text/css" />

    @yield('css')
</head>

<body class="skin-josh">
    <header class="header">
        <a href="index.html" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the margining -->
            <img src="{{asset('img/logo.png')}}" alt="logo"></a>
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <div>
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <div class="responsive_nav"></div>
                </a>
            </div>
            @include('admin.navbar_right')
        </nav>
    </header>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <!-- Left side column. contains the logo and sidebar -->
        @include('admin.sidebar')
        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            @yield('content')
        </aside>
        <!-- right-side --> 
    </div>
    <!-- ./wrapper -->
    <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Return to top" data-toggle="tooltip" data-placement="left">
        <i class="livicon" data-name="plane-up" data-size="18" data-loop="true" data-c="#fff" data-hc="white"></i>
    </a>
    <!-- global js -->
    <script src="{{asset('js/jquery-1.11.3.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
    <!--livicons-->
    <script src="{{asset('vendors/livicons/minified/raphael-min.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendors/livicons/minified/livicons-1.4.min.js')}}" type="text/javascript"></script>
   <script src="{{asset('js/josh.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/metisMenu.js')}}" type="text/javascript"> </script>
    <script src="{{asset('vendors/holder/holder.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('vendors/datatables/js/jquery.dataTables.min.js') }}" >
        
    </script>
    <script type="text/javascript" src="{{ asset('vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('vendors/validation/js/bootstrapValidator.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('vendors/select2/select2.min.js') }}" ></script>
    <script src="{{ asset("js/sweetalert2.all.js") }}"></script>
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
    </script>
    <!-- end of page level js -->
    @yield("js")
</body>
</html>