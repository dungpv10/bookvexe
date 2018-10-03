<header id="header" class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="header-left">
                    <div class="logo">
                        <a href="#" title="book xe">
                            <img src="{{ asset('img/front-end/logo.png') }}" alt="logo">
                        </a>
                    </div>
                    <div class="menu">
                        <ul class="menu-primary">
                            <li><a href="#" title="Trang chủ" class="active">Trang chủ</a></li>
                            <li><a href="#" title="Chuyến đi">Chuyến đi</a></li>
                            <li><a href="#" title="Ưu đãi">Ưu đãi</a></li>
                            <li><a href="#" title="Về chúng tôi">Về chúng tôi</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-sm-6">
                <div class="menu-mobile-con">
                    <i class="fa fa-bars"></i>
                </div>
                <div class="header-rigth">
                    <div class="menu menu-mobile">
                        <ul class="menu-primary">
                            <li><a href="#" title="Trang chủ" class="active">Trang chủ</a></li>
                            <li><a href="#" title="Chuyến đi">Chuyến đi</a></li>
                            <li><a href="#" title="Ưu đãi">Ưu đãi</a></li>
                            <li><a href="#" title="Về chúng tôi">Về chúng tôi</a></li>
                        </ul>
                    </div>
                    <div class="wrap-line">
                        <select class="selectpicker choose-language" data-width="fit">
                            <option disabled selected value style="display:none" data-content='<img style="margin-right: 5px;" class="language-image" src="{{ asset("img/front-end/vn-flag.png") }}" alt=""> Ngôn Ngữ'>Ngôn Ngữ</option>
                            <option data-content='<img style="margin-right: 5px;" class="language-image" src="{{ asset("img/front-end/vn-flag.png") }}" alt=""> Việt Nam'>Việt Nam</option>
                            <option  data-content='<img style="margin-right: 5px;" class="language-image" src="{{ asset("img/front-end/vn-flag.png") }}" alt=""> Engnish'>Engnish</option>
                        </select>
                        <a href="callto:" class="call-support" title="Hỗ trợ"><i class="fa fa-phone"></i>Tổng đài hỗ trợ 18001091</a>
                    </div>
                    <div class="wrap-line">
                        <a href="#" title="Thông tin"><i class="fa fa-info-circle"></i></a>
                    </div>
                    <div class="wrap-line">
                        <select class="selectpicker list-support" data-width="fit">
                            <option disabled selected value style="display:none">Dịch vụ chăm sóc khách hàng</option>
                            <option>Dịch vụ chăm sóc khách hàng 1</option>
                            <option>Dịch vụ chăm sóc khách hàng 2</option>
                        </select>
                        <span></span>
                        <select class="selectpicker list-support" data-width="fit">
                            <option disabled selected value style="display:none">Đăng nhập và tài khoản</option>
                            <option>Đăng nhập</option>
                            <option>Thông tin tài khoản</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>