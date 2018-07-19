@extends('auth.layouts')
@section('content')
    @include('partials.errors')
    @include('partials.status')
    <div id="register">
        <form action="/register" autocomplete="on" method="post">
            <h3 class="black_bg">
                <img src="/img/logo.png" alt="josh logo"></h3>
            <p class="form-group">
                <label style="margin-bottom:0px;" for="name" class="youmail">
                    <i class="livicon" data-name="user" data-size="16" data-loop="true"
                       data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                    Họ và tên
                </label>
                <input id="name" name="name" required type="text" placeholder="John"/>
            </p>

            <div class="form-group">
                <label style="margin-bottom:0px;" for="email" class="youmail">
                    <i class="livicon" data-name="mail" data-size="16" data-loop="true"
                       data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                    E-mail
                </label>
                <input id="email" name="email" required type="email"
                       placeholder="abc@mail.com"/>
            </div>

            <div class="form-group">
                <label style="margin-bottom:0px;" for="password" class="youpasswd">
                    <i class="livicon" data-name="key" data-size="16" data-loop="true"
                       data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                    Mật khẩu
                </label>
                <input id="password" name="password" required type="password"
                       placeholder="eg. X8df!90EO"/>
            </div>

            <div class="form-group">
                <label style="margin-bottom:0px;" for="password_confirmation" class="youpasswd">
                    <i class="livicon" data-name="key" data-size="16" data-loop="true"
                       data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                    Xác nhận mật khẩu
                </label>
                <input id="password_confirmation" name="password_confirmation" required
                       type="password" placeholder="eg. X8df!90EO"/>
            </div>

            <p class="signin button">
                <input type="submit" class="btn btn-success" value="Đăng ký "/>
            </p>

        </form>
    </div>
@stop
