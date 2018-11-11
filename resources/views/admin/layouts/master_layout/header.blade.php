<div class="header-top-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="logo-area">
                    <a href="#">
                        <img src="/img/logo.png" alt=""/>
                    </a>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="header-top-menu">
                    <ul class="nav navbar-nav notika-top-nav">
                        @if(Gate::allows('sub_admin') || Gate::allows('normal_user'))

                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false"
                                   class="nav-link dropdown-toggle">
                                    <span style="font-size: 13px;">Bạn đang có : <span
                                                class="font-weight-bold">{{ auth()->user()->points }}</span> đ</span>
                                </a>

                            </li>

                            <li class="nav-item nc-al"><a href="#" data-toggle="dropdown" role="button"
                                                          aria-expanded="false"
                                                          class="nav-link dropdown-toggle">
                                    <div class="spinner4 spinner-4"></div>

                                </a>
                            </li>
                        @endif
                        <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false"
                                                class="nav-link dropdown-toggle"><span>
                                        <i class="notika-icon notika-menus"></i></span></a>
                            <div role="menu" class="dropdown-menu message-dd task-dd animated zoomIn">
                                <div class="hd-mg-tt">
                                    <h2>Thông tin cơ bản</h2>
                                </div>
                                <div class="hd-message-info hd-task-info">
                                    <div class="skill">
                                        <div class="customer-information">
                                            <div class="lead-content">
                                                <p>Tên đầy đủ : {{ auth()->user()->name }}</p>
                                            </div>
                                        </div>
                                        <div class="customer-information">
                                            <div class="lead-content">
                                                <p>Email : {{ auth()->user()->email }}</p>
                                            </div>
                                        </div>
                                        <div class="customer-information">
                                            <div class="lead-content">
                                                <p>Tên đăng nhập : {{ auth()->user()->username }}</p>
                                            </div>
                                        </div>
                                        <div class=" progress-bt">
                                            <div class="lead-content">
                                                <p>Giới tính : {{ auth()->user()->gender_name }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hd-mg-va">
                                    <a onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                       > Đăng
                                        xuất</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="GET"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
