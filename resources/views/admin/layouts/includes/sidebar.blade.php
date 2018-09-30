<aside class="left-side sidebar-offcanvas">
    <section class="sidebar ">
        <div class="page-sidebar  sidebar-nav">

            <div class="clearfix" style="height: 50px;"></div>
            <!-- BEGIN SIDEBAR MENU -->

                <ul class="page-sidebar-menu" id="menu">
                @if(Gate::allows('dashboard'))
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                        <span class="title">Dashboard</span>
                    </a>

                </li>
                @endif
                <!--Bus-->
                <li>
                    <a href="{{route('bus.index')}}">
                        <i class="livicon" data-name="car" data-size="22" data-c="#00bc8c" data-hc="#00bc8c" data-loop="true"></i>
                        <span class="title">Quản lý xe</span>
                    </a>

                </li>
                <!--End bus-->



                <!--Route-->
                <li>
                    <a href="{{route('routes.index')}}">
                        <i class="livicon" data-name="vector-line" data-size="22" data-c="#F89A14" data-hc="#F89A14" data-loop="true"></i>
                        <span class="title">Quản lý tuyến đường</span>
                    </a>

                </li>
                <!--End route-->

                <!--Points-->
                <li>
                    <a href="{{route('points.index')}}">
                        <i class="livicon" data-name="pin-on" data-size="22" data-c="#5bc0de" data-hc="#5bc0de" data-loop="true"></i>
                        <span class="title">Quản lý điểm dừng</span>
                    </a>

                </li>
                <!--End points-->

                <!--Promotions-->
                <li>
                    <a href="{{route('promotions.index')}}">
                        <i class="livicon" data-name="biohazard" data-size="22" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                        <span class="title">Quản lý khuyến mại</span>
                    </a>
                </li>
                <!--End promotions-->

                <li>
                    <a href="{{route('bookings.index')}}">
                        <i class="livicon" data-name="magic" data-size="18" data-c="#00bc8c" data-hc="#00bc8c" data-loop="true"></i>
                        <span class="title">Bookings</span>
                    </a>

                </li>


                <!--End promotions-->
                <li>
                    <a href="{{route('cancellations.index')}}">
                        <i class="livicon" data-name="ban" data-size="18" data-c="#F89A14" data-hc="#F89A14" data-loop="true"></i>
                        <span class="title">Cài đặt huỷ vé</span>
                    </a>
                </li>


                    <!--End promotions-->
                <li>
                    <a href="{{ route('initializes.index') }}">
                        <i class="livicon" data-name="inbox" data-size="18" data-c="#EF6F6C" data-hc="#EF6F6C" data-loop="true"></i>
                        <span class="title">Quản lý khởi hành</span>

                    </a>
                </li>

                <!--User-->
                <li>
                    <a href="{{route('users.index')}}">
                        <i class="livicon" data-name="user" data-size="22" data-c="#418bca" data-hc="#418bca" data-loop="true"></i>
                        <span class="title">Thành viên</span>
                    </a>
                </li>


                    <li>
                        <a href="{{route('ratings.index')}}">
                            <i class="livicon" data-name="star-full" data-size="18" data-c="#00bc8c" data-hc="#00bc8c" data-loop="true"></i>
                            <span class="title">Đánh giá</span>
                        </a>
                    </li>


                <li>
                    <a href="{{route('agents.index')}}">
                        <i class="livicon" data-name="presentation" data-size="18" data-c="#EF6F6C" data-hc="#EF6F6C" data-loop="true"></i>
                        <span class="title">Nhà xe</span>
                    </a>

                </li>
                <!--End User-->
                @if(Gate::allows('root'))

                        <li>
                            <a href="{{route('holidays.index')}}">
                                <i class="livicon" data-name="alarm" data-size="18" data-c="#6CC66C" data-hc="#6CC66C" data-loop="true"></i>
                                <span class="title">Cài đặt ngày nghỉ</span>
                            </a>
                        </li>


                    <li>
                        <a href="{{route('roles.index')}}">
                            <i class="livicon" data-name="recycled" data-size="18" data-c="#F89A14" data-hc="#F89A14" data-loop="true"></i>
                            <span class="title">Quyền</span>
                        </a>
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
