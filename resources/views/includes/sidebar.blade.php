<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('/') }}" class="site_title"><i class="fa fa-paw"></i> <span>Thuế Hà Nội</span></a>
        </div>
        
        <div class="clearfix"></div>
        
        <!-- menu profile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Avatar of {{ Auth::user()->name }}" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        
        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <select class="form-control cusSelect" id="sideBarYear">
                    @foreach($years as $year)
                        <option value="{{$year->name}}" {{ $year->name == $currentYear ? 'selected="selected"' : '123' }}>Năm {{ $year->name }}</option>
                    @endforeach
                </select>
                <h3 style="margin-top: 15px;">User</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> Multiple link <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">Link 1</a></li>
                            <li><a href="#">Link 2</a></li>
                            <li><a href="#">Link 3</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="fa fa-laptop"></i>
                            One link
                            <span class="label label-success pull-right">Flag</span>
                        </a>
                    </li>
                    <li>
                        <a href="/user/settings">
                            <i class="fa fa-cogs" aria-hidden="true"></i>
                            Cài đặt
                        </a>
                    </li>
                    <li {{ request()->is('teams', 'teams/*', 'team', 'team/*') ? 'class=current-page' : '' }}>
                        <a href="/teams">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            Teams
                        </a>
                    </li>
                    <li {{ request()->is('taxes', 'taxes/*') ? 'class=current-page' : '' }}>
                        <a href="/taxes">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            Dữ Liệu Thuế
                        </a>
                    </li>
                    <li {{ request()->is('boithuong', 'boithuong/*') ? 'class=current-page' : '' }}>
                        <a href="/boithuong">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            Dữ Liệu Bồi Thường
                        </a>
                    </li>
                    <li {{ request()->is('no-theo-qui-trinh', 'no-theo-qui-trinh/*') ? 'class=current-page' : '' }}>
                        <a href="/no-theo-qui-trinh">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            Nợ Theo Qui Trình
                        </a>
                    </li>
                    <li {{ request()->is('taxes/no-thue', 'taxes/no-thue/*') ? 'class=current-page' : '' }}>
                        <a href="/taxes/no-thue">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            Tổng Hợp Nợ thuế
                        </a>
                    </li>
                </ul>
            </div>
            @if(Gate::allows('admin'))
            <div class="menu_section">
                <h3>Phần Cho Admin</h3>
                <ul class="nav side-menu">
                    <li>
                        <a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="#">Level One</a>
                                <li>
                                    <a>Level One<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li class="sub_menu">
                                            <a href="#">Level Two</a>
                                        </li>
                                        <li>
                                            <a href="#">Level Two</a>
                                        </li>
                                        <li>
                                            <a href="#">Level Two</a>
                                        </li>
                                    </ul>
                                </li>
                            <li>
                                <a href="#">Level One</a>
                            </li>
                        </ul>
                    </li>
                    <li  {{ request()->is('admin/dasboard') ? 'class=current-page' : '' }} >
                        <a href="/admin/dashboard"><i class="fa fa-tachometer" aria-hidden="true"></i> Admin Panel</a>
                        
                    </li>
                    <li  {{ request()->is('admin/users', 'admin/users/*') ? 'class=current-page' : '' }} >
                        <a href="/admin/users"><i class="fa fa-users" aria-hidden="true"></i>Người Dùng</a>
                        
                    </li>
                    <li {{ request()->is('admin/roles', 'admin/roles/*') ? 'class=current-page' : '' }} >
                        <a href="/admin/roles"><i class="fa fa-adjust" aria-hidden="true"></i>Quyền</a>
                        
                    </li>
                    <li {{ request()->is('admin/quans', 'admin/quans/*') ? 'class=current-page' : '' }} >
                        <a href="{{ route('quans.index') }}"><i class="fa fa-street-view" aria-hidden="true"></i>Quận - Huyện</a>
                        
                    </li>
                    <li {{ request()->is('admin/years', 'admin/years/*') ? 'class=current-page' : '' }} >
                        <a href="{{ route('years.index') }}"><i class="fa fa-calendar" aria-hidden="true"></i>QL Năm</a>
                        
                    </li>
                </ul>
            </div>
            @endif
        </div>
        <!-- /sidebar menu -->
        
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ url('/logout') }}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>