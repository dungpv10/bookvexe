<!DOCTYPE html>
<html lang="zxx" class="no-js">
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

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
    CSS
    ============================================= -->
    <link rel="stylesheet" href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/datetimepicker/css/bootstrap-datetimepicker-standalone.css') }}" />
    <link href="{{ asset('css/pages/jquery-ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/validation/css/bootstrapValidator.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendors/validation/css/bootstrapValidator.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/timepicker/css/bootstrap-timepicker.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/home/css/owl.carousel.css">
    <link rel="stylesheet" href="/home/css/main.css">
    @yield('css')
</head>
<body>

<!-- start header Area -->
@include('front-end.layouts.includes.header')
<!-- End header Area -->

@yield('content')

<!-- start footer Area -->
@include('front-end.layouts.includes.footer')
<!-- End footer Area -->

<script src="{{asset('js/jquery-1.11.3.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('vendors/validation/js/bootstrapValidator.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('vendors/datetimepicker/js/moment.min.js') }}" ></script>
<script src="{{asset('vendors/datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('vendors/timepicker/js/bootstrap-timepicker.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/pages/jquery-ui.js') }}"></script>
<script src="/home/js/owl.carousel.min.js"></script>
<script src="/home/js/main.js"></script>
@yield("js")
</body>
</html>



