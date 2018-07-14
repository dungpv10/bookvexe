<aside class="left-side sidebar-offcanvas">
    <section class="sidebar ">
        <div class="page-sidebar  sidebar-nav">

            <div class="clearfix" style="height: 50px;"></div>
            <!-- BEGIN SIDEBAR MENU -->
            <ul class="page-sidebar-menu" id="menu">
                <li>
                    <a href="#">
                        <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                        <span class="title">Dashboard</span>
                    </a>

                </li>

                <!--Bus-->
                <li>
                    <a href="#">
                        <i class="livicon" data-name="users" data-size="18" data-c="#00bc8c" data-hc="#00bc8c" data-loop="true"></i>
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
                            <a href="{{route('bus.create')}}">
                                <i class="fa fa-angle-double-right"></i>
                                Tạo mới
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
                        <i class="livicon" data-name="users" data-size="18" data-c="#00bc8c" data-hc="#00bc8c" data-loop="true"></i>
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
                        <i class="livicon" data-name="users" data-size="18" data-c="#00bc8c" data-hc="#00bc8c" data-loop="true"></i>
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
                        <li>
                            <a href="{{route('points.create')}}">
                                <i class="fa fa-angle-double-right"></i>
                                Tạo mới
                            </a>
                        </li>

                    </ul>
                </li>
                <!--End points-->

                <!--Promotions-->
                <li>
                    <a href="#">
                        <i class="livicon" data-name="users" data-size="18" data-c="#00bc8c" data-hc="#00bc8c" data-loop="true"></i>
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



                <!--User-->
                <li>
                    <a href="#">
                        <i class="livicon" data-name="users" data-size="18" data-c="#00bc8c" data-hc="#00bc8c" data-loop="true"></i>
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
                        <li>
                            <a href="{{route('users.invite')}}">
                                <i class="fa fa-angle-double-right"></i>
                                Tạo mới
                            </a>
                        </li>
                    </ul>
                </li>
                <!--End User-->
                <li>
                    <a href="#">
                        <i class="livicon" data-name="users" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
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
                        <li>
                            <a href="{{route('roles.create')}}">
                                <i class="fa fa-angle-double-right"></i>
                                Tạo mới
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('setting.index') }}">
                        <i class="livicon" data-name="users" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                        <span class="title">Cài đặt</span>
                    </a>
                </li>


            </ul>
            <!-- END SIDEBAR MENU --> </div>
    </section>
    <!-- /.sidebar -->
</aside>