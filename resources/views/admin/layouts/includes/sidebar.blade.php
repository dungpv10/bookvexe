<aside class="left-side sidebar-offcanvas">
    <section class="sidebar ">
        <div class="page-sidebar  sidebar-nav">

            <div class="clearfix" style="height: 50px;"></div>
            <!-- BEGIN SIDEBAR MENU -->
            <ul class="page-sidebar-menu" id="menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                        <span class="title">Dashboard</span>
                    </a>

                </li>

                <!--Bus-->
                <li>
                    <a href="#">
                        <i class="livicon" data-name="car" data-size="22" data-c="#00bc8c" data-hc="#00bc8c" data-loop="true"></i>
                        <span class="title">Quản lý xe</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{route('bus.index')}}">
                                <i class="fa fa-angle-double-right"></i>
                                Danh sách
                            </a>
                        </li>
                        <li>
                            <a href="{{route('bus-type.index')}}">
                                <i class="fa fa-angle-double-right"></i>
                                Loại xe
                            </a>
                        </li>


                    </ul>
                </li>
                <!--End bus-->



                <!--Route-->
                <li>
                    <a href="#">
                        <i class="livicon" data-name="vector-line" data-size="22" data-c="#F89A14" data-hc="#F89A14" data-loop="true"></i>
                        <span class="title">Quản lý tuyến đường</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{route('routes.index')}}">
                                <i class="fa fa-angle-double-right"></i>
                                Danh sách
                            </a>
                        </li>
                        <li>
                            <a href="{{route('routes.create')}}">
                                <i class="fa fa-angle-double-right"></i>
                                Tạo mới
                            </a>
                        </li>

                    </ul>
                </li>
                <!--End route-->

                <!--Points-->
                <li>
                    <a href="#">
                        <i class="livicon" data-name="pin-on" data-size="22" data-c="#5bc0de" data-hc="#5bc0de" data-loop="true"></i>
                        <span class="title">Quản lý điểm dừng</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{route('points.index')}}">
                                <i class="fa fa-angle-double-right"></i>
                                Danh sách
                            </a>
                        </li>
                    </ul>
                </li>
                <!--End points-->

                <!--Promotions-->
                <li>
                    <a href="#">
                        <i class="livicon" data-name="star-full" data-size="22" data-c="#EF6F6C" data-hc="#EF6F6C" data-loop="true"></i>
                        <span class="title">Quản lý khuyến mại</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{route('promotions.index')}}">
                                <i class="fa fa-angle-double-right"></i>
                                Danh sách
                            </a>
                        </li>
                        <li>
                            <a href="{{route('promotions.create')}}">
                                <i class="fa fa-angle-double-right"></i>
                                Tạo mới
                            </a>
                        </li>

                    </ul>
                </li>
                <!--End promotions-->

                <li>
                    <a href="#">
                        <i class="livicon" data-name="spinner-four" data-size="18" data-c="#00bc8c" data-hc="#00bc8c" data-loop="true"></i>
                        <span class="title">Bookings</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{route('bookings.index')}}">
                                <i class="fa fa-angle-double-right"></i>
                                Danh sách
                            </a>
                        </li>
                    </ul>
                </li>



                <!--User-->
                <li>
                    <a href="#">
                        <i class="livicon" data-name="user" data-size="22" data-c="#418bca" data-hc="#418bca" data-loop="true"></i>
                        <span class="title">Thành viên</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{route('users.index')}}">
                                <i class="fa fa-angle-double-right"></i>
                                Danh sách
                            </a>
                        </li>
                        {{--<li>--}}
                            {{--<a href="{{route('users.invite')}}">--}}
                                {{--<i class="fa fa-angle-double-right"></i>--}}
                                {{--Tạo mới--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    </ul>
                </li>
                <!--End User-->
                @if(Gate::allows('admin'))
                    <li>
                        <a href="#">
                            <i class="livicon" data-name="recycled" data-size="18" data-c="#F89A14" data-hc="#F89A14" data-loop="true"></i>
                            <span class="title">Quyền</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{route('roles.index')}}">
                                    <i class="fa fa-angle-double-right"></i>
                                    Danh sách
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!--End User-->
                    

                    <li>
                        <a href="{{ route('setting.index') }}">
                            <i class="livicon" data-name="gear" data-size="18" data-c="#5bc0de" data-hc="#5bc0de" data-loop="true"></i>
                            <span class="title">Cài đặt</span>
                        </a>
                    </li>
                @endif

            </ul>
            <!-- END SIDEBAR MENU --> </div>
    </section>
    <!-- /.sidebar -->
</aside>
