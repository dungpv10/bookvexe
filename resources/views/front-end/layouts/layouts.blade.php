<!DOCTYPE html>
<html lang="html" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Author Meta -->
    <meta name="author" content="codepixer">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- meta csrf-token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Site Title -->
    <title>BOOK - XE</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <!--
    CSS
    ============================================= -->
    <link rel="stylesheet" href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datetimepicker/css/bootstrap-datetimepicker-standalone.css') }}" />
    <link href="{{ asset('css/pages/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/validation/css/bootstrapValidator.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/validation/css/bootstrapValidator.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/timepicker/css/bootstrap-timepicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/select2/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    @yield('css')
    <link rel="stylesheet" href="{{ asset('css/css/style.css') }}">
</head>
<body>

<!-- start header Area -->
@include('front-end.layouts.includes.header')
<!-- End header Area -->

@yield('content')

<!-- start footer Area -->
@include('front-end.layouts.includes.footer')
<div class="bg-tab-show-mobile"></div>
<!-- End footer Area -->
<script src="{{asset('js/jquery-1.11.3.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('vendors/validation/js/bootstrapValidator.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('vendors/datetimepicker/js/moment.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('vendors/select2/select2.min.js') }}" ></script>
<script src="{{asset('vendors/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/timepicker/js/bootstrap-timepicker.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/pages/jquery-ui.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/jquery.matchHeigth.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/jquery.marquee@1.5.0/jquery.marquee.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
@yield("js")
<script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>



