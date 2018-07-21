<div class="navbar-right">
    <ul class="nav navbar-nav">
        <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img style="max-height: 34px;" src="{{ auth()->user()->getAvatar() }}" width="35"
                     class="img-circle img-responsive pull-left" height="35" alt="{{ auth()->user()->name }}">
                {{--<span class="label label-success">4</span>--}}
            </a>
            <ul class="dropdown-menu dropdown-messages pull-right">
                <li class="dropdown-title">Thông tin</li>
                <li class="unread message">
                    <a href="javascript:;" class="message"> <i class="pull-right" data-toggle="tooltip"
                                                               data-placement="top" title="Mark as Read"><span
                                    class="pull-right ol livicon" data-n="adjust" data-s="10"
                                    data-c="#287b0b"></span></i>

                        <div class="message-body"><strong>Tên</strong>
                            <br>
                            {{ auth()->user()->name }}
                        </div>
                    </a>
                </li>
                <li class="unread message">
                    <a href="javascript:;" class="message">
                        <i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read"><span
                                    class="pull-right ol livicon" data-n="adjust" data-s="10"
                                    data-c="#287b0b"></span></i>
                        <div class="message-body"><strong>Email</strong>
                            <br>
                            {{ auth()->user()->email }}
                            <br>
                        </div>
                    </a>
                </li>
                <li class="unread message">
                    <a href="javascript:;" class="message">
                        <i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read">
                            <span class="pull-right ol livicon" data-n="adjust" data-s="10" data-c="#287b0b"></span>
                        </i>
                        <div class="message-body">
                            <strong>Tên đăng nhập</strong>
                            <br>
                            {{ auth()->user()->username }}
                        </div>
                    </a>
                </li>
                <li class="unread message">
                    <a href="javascript:;" class="message">
                        <i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read">
                            <span class="pull-right ol livicon" data-n="adjust" data-s="10" data-c="#287b0b"></span>
                        </i>
                        <div class="message-body">
                            <strong>Giới tính</strong>
                            <br>
                            {{ auth()->user()->gender_name }}
                        </div>
                    </a>
                </li>

                <li class="unread message">
                    <a href="/user/settings" class="message">
                        <i class="pull-right" data-toggle="tooltip" data-placement="top" title="Mark as Read">
                            <span class="pull-right ol livicon" data-n="adjust" data-s="10" data-c="#287b0b"></span>
                        </i>
                        <div class="message-body">
                            <strong>Cài đặt </strong>
                            <br>
                            Đổi password
                        </div>
                    </a>

                    {{--<a href="/user/settings">--}}
                        {{--<i class="livicon" data-name="fa-cogs" data-size="16" data-c="#01BC8C" data-hc="#01BC8C"--}}
                           {{--data-loop="true"></i><b> Cài đặt & Đổi password</b>--}}
                    {{--</a>--}}
                </li>
                <li class="footer">
                    <a href="{{ route('logout') }}">Đăng xuất</a>
                </li>
            </ul>
        </li>

    </ul>
</div>
