<!-- Mobile Menu start -->
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mobile-menu">
                    <nav id="dropdown">
                        <ul class="mobile-menu-nav">
                            <li><a href="">Kèo trong ngày</a>

                            </li>
                            <li><a href="">Thành viên</a>

                            </li>
                            <li><a href="">Lịch sử cộng/trừ điểm</a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile Menu end -->
<!-- Main Menu area start-->
<div class="main-menu-area mg-tb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">

                    @if(Gate::allows('dashboard_perm'))
                        <li @if(Request::is('admin/dashboard')) class="active" @endif>
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="notika-icon notika-house"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                    @endif

                    @if(Gate::allows('bus_perm'))
                    <!--Bus-->
                        <li>
                            <a data-toggle="tab" href="#bus-management"><i class="notika-icon notika-mail"></i>
                                Phương tiện
                            </a>
                        </li>
                        <!--End bus-->
                    @endif

                    @if(Gate::allows('user_perm'))
                    <!--Bus-->
                        <li>
                            <a data-toggle="tab" href="#users"><i class="notika-icon notika-mail"></i>
                                Quản lý người dùng
                            </a>
                        </li>
                        <!--End bus-->
                    @endif

                    @if(Gate::allows('setting_perm'))
                    <!--Bus-->
                        <li>
                            <a data-toggle="tab" href="#settings"><i class="notika-icon notika-mail"></i>
                                Cài đặt
                            </a>
                        </li>
                        <!--End bus-->
                    @endif

                    @if(Gate::allows('promotion_perm'))
                        <li>
                            <a href="{{ route('promotions.index') }}">
                                <i class="notika-icon notika-house"></i>
                                <span class="title">Quản lý khuyến mại</span>
                            </a>

                        </li>
                    @endif

                    @if(Gate::allows('booking_perm'))
                        <li>
                            <a href="{{ route('bookings.index') }}">
                                <i class="notika-icon notika-house"></i>
                                <span class="title">Bookings</span>
                            </a>

                        </li>
                    @endif
                </ul>

                <div class="tab-content custom-menu-content">
                    <div id="bus-management" class="tab-pane notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            @if(Gate::allows('initialize_perm'))
                                <li><a href="{{ route('initializes.index') }}">Khởi hành</a>
                                </li>
                            @endif
                            @if(Gate::allows('bus_perm'))
                                <li><a href="{{ route('bus.index') }}">Q.Lý xe</a>
                                </li>
                            @endif
                            @if(Gate::allows('route_perm'))
                                <li><a href="{{ route('routes.index') }}">Tuyến đường</a>
                                </li>
                            @endif
                            @if(Gate::allows('point_perm'))
                                <li><a href="{{ route('points.index') }}">Điểm dừng</a>
                                </li>
                            @endif
                            @if(Gate::allows('rating_perm'))
                                <li><a href="{{ route('ratings.index') }}">Đánh giá</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div id="users" class="tab-pane notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            @if(Gate::allows('user_perm'))
                                <li><a href="{{ route('users.index') }}">Thành viên</a>
                                </li>
                            @endif
                            @if(Gate::allows('agent_perm'))
                                <li><a href="{{ route('agents.index') }}">Nhà xe</a>
                                </li>
                            @endif

                            @if(Gate::allows('role_perm'))
                                <li><a href="{{ route('roles.index') }}">Nhóm quyền</a>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div id="settings" class="tab-pane notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            @if(Gate::allows('cancellation_perm'))
                                <li><a href="{{ route('cancellations.index') }}">Huỷ vé</a>
                                </li>
                            @endif

                            @if(Gate::allows('holiday_perm'))
                                <li><a href="{{ route('holidays.index') }}">Ngày nghỉ</a>
                                </li>
                            @endif
                            @if(Gate::allows('setting_perm'))
                                <li><a href="{{ route('setting.index') }}">Hệ thống</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Menu area End-->