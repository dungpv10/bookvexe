<!DOCTYPE html>
<html>

<head>
    <title>Login | BOXVEXE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- global level css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
    <!-- end of global level css -->
    <!-- page level css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/login.css') }}"/>
    <link href="{{ asset('vendors/validation/css/bootstrapValidator.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- end of page level css -->
    @yield('css')
</head>

<body>
<div class="container">
    <div class="row vertical-offset-100">
        <div class="col-sm-6 col-sm-offset-3  col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
            <div id="container_demo">
                <a class="hiddenanchor" id="toregister"></a>
                <a class="hiddenanchor" id="tologin"></a>
                <a class="hiddenanchor" id="toforgot"></a>
                <div id="wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- global js -->
<script src="{{ asset('js/jquery-1.11.3.min.js') }}" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
<!--livicons-->
<script src="{{ asset('vendors/livicons/minified/raphael-min.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/livicons/minified/livicons-1.4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/josh.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/metisMenu.js') }}" type="text/javascript"></script>
<script src="{{ asset('vendors/holder/holder.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('vendors/validation/js/bootstrapValidator.min.js') }}" ></script>
@yield('js')
<!-- end of global js -->
</body>
</html>
