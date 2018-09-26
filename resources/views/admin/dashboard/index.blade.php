@extends('admin.layouts.dashboard')

@section('css')
    <link href="/vendors/fullcalendar/css/fullcalendar.css" rel="stylesheet" type="text/css" />
    <link href="/css/pages/calendar_custom.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" media="all" href="/vendors/jvectormap/jquery-jvectormap.css" />
    <link rel="stylesheet" href="/vendors/animate/animate.min.css">
    <link rel="stylesheet" href="/css/only_dashboard.css" />
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
            <!-- Trans label pie charts strats here-->
            <div class="lightbluebg no-radius">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                            <div class="square_box col-xs-7 text-right">
                                <span>Tổng doanh số</span>
                                <div class="number" id="myTargetElement1"></div>
                            </div>
                            <i class="livicon  pull-right" data-name="money" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                        </div>
                        <div class="row">
                            {{--<div class="col-xs-6">--}}
                                {{--<small class="stat-label">Last Week</small>--}}
                                {{--<h4 id="myTargetElement1.1"></h4>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-6 text-right">--}}
                                {{--<small class="stat-label">Last Month</small>--}}
                                {{--<h4 id="myTargetElement1.2"></h4>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInUpBig">
            <!-- Trans label pie charts strats here-->
            <div class="redbg no-radius">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                            <div class="square_box col-xs-7 pull-left">
                                <span>Vé hủy</span>
                                <div class="number" id="myTargetElement2"></div>
                            </div>
                            <i class="livicon pull-right" data-name="remove-circle" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                        </div>
                        <div class="row">
                            {{--<div class="col-xs-6">--}}
                                {{--<small class="stat-label">Last Week</small>--}}
                                {{--<h4 id="myTargetElement2.1"></h4>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-6 text-right">--}}
                                {{--<small class="stat-label">Last Month</small>--}}
                                {{--<h4 id="myTargetElement2.2"></h4>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-md-6 margin_10 animated fadeInDownBig">
            <!-- Trans label pie charts strats here-->
            <div class="goldbg no-radius">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                            <div class="square_box col-xs-7 pull-left">
                                <span>Xe tạo mới</span>
                                <div class="number" id="myTargetElement3"></div>
                            </div>
                            <i class="livicon pull-right" data-name="car" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                        </div>
                        <div class="row">
                            {{--<div class="col-xs-6">--}}
                                {{--<h4 id="myTargetElement3.1"></h4>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-6 text-right">--}}
                                {{--<h4 id="myTargetElement3.2"></h4>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig">
            <!-- Trans label pie charts strats here-->
            <div class="palebluecolorbg no-radius">
                <div class="panel-body squarebox square_boxs">
                    <div class="col-xs-12 pull-left nopadmar">
                        <div class="row">
                            <div class="square_box col-xs-7 pull-left">
                                <span>Agent tạo mới</span>
                                <div class="number" id="myTargetElement4"></div>
                            </div>
                            <i class="livicon pull-right" data-name="users" data-l="true" data-c="#fff" data-hc="#fff" data-s="70"></i>
                        </div>
                        <div class="row">
                            {{--<div class="col-xs-6">--}}
                                {{--<small class="stat-label">Last Week</small>--}}
                                {{--<h4 id="myTargetElement4.1"></h4>--}}
                            {{--</div>--}}
                            {{--<div class="col-xs-6 text-right">--}}
                                {{--<small class="stat-label">Last Month</small>--}}
                                {{--<h4 id="myTargetElement4.2"></h4>--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/row-->

@stop


@section('js')
    <script>
      var totalBuses = "{{ $totalBuses }}";
      var totalAgents = "{{ $totalAgents }}";
      var totalCancelBookings = "{{ $totalCancelBooking }}";
    </script>
    <script src="/js/todolist.js"></script>
    <!-- EASY PIE CHART JS -->
    <script src="/vendors/charts/easypiechart.min.js"></script>
    <script src="/vendors/charts/jquery.easypiechart.min.js"></script>
    <script src="/vendors/charts/jquery.easingpie.js"></script>
    <!--for calendar-->
    <script src="/vendors/fullcalendar/moment.min.js" type="text/javascript"></script>
    <script src="/vendors/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <!--   Realtime Server Load  -->
    <script src="/vendors/charts/jquery.flot.min.js" type="text/javascript"></script>
    <script src="/vendors/charts/jquery.flot.resize.min.js" type="text/javascript"></script>
    <!--Sparkline Chart-->
    <script src="/vendors/charts/jquery.sparkline.js"></script>
    <!-- Back to Top-->
    <script type="text/javascript" src="/vendors/countUp/countUp.js"></script>
    <!--   maps -->
    <script src="/vendors/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/vendors/jscharts/Chart.js"></script>
    <script src="/js/dashboard.js" type="text/javascript"></script>

@stop
