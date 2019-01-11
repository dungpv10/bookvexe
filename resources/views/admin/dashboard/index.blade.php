@extends('admin.layouts.master_layout')

@section('css')
    {{--<link href="/vendors/fullcalendar/css/fullcalendar.css" rel="stylesheet" type="text/css" />--}}
    {{--<link href="/css/pages/calendar_custom.css" rel="stylesheet" type="text/css" />--}}
    {{--<link rel="stylesheet" media="all" href="/vendors/jvectormap/jquery-jvectormap.css" />--}}
    {{--<link rel="stylesheet" href="/vendors/animate/animate.min.css">--}}
    {{--<link rel="stylesheet" href="/css/only_dashboard.css" />--}}
@stop

@section('content')
    <div class="notika-status-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">{{$totalBuses}}</span></h2>
                            <p>Xe đăng ký mới</p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">{{$totalCancelBooking}}</span></h2>
                            <p>Vé huỷ</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">{{$totalAgents}}</span></h2>
                            <p>Agent tạo mới</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30 dk-res-mg-t-30">
                        <div class="website-traffic-ctn">
                            <h2><span class="counter">{{number_format(random_int(0, 1000000))}}</span></h2>
                            <p>doanh thu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop


@section('js')
    <script>
      var totalBuses = "{{ $totalBuses }}";
      var totalAgents = "{{ $totalAgents }}";
      var totalCancelBookings = "{{ $totalCancelBooking }}";
    </script>

@stop
