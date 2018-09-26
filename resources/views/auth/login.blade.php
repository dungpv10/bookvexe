@extends('auth.layouts')
@section('content')
    <!-- login form -->
    <div id="login" class="animate form">
        <form action="{{ route('login') }}" autocomplete="on" method="post">
            <h3 class="black_bg">
                <img src="/img/logo.png" alt="josh logo">
            </h3>
            <p>
                @include('includes.alert')
            </p>
            <p>
                {!! csrf_field() !!}
                <label style="margin-bottom:0px;" for="username" class="uname"> <i class="livicon"
                                                                                   data-name="user"
                                                                                   data-size="16"
                                                                                   data-loop="true"
                                                                                   data-c="#3c8dbc"
                                                                                   data-hc="#3c8dbc"></i>
                    Tên đăng nhập
                </label>
                <input id="username" name="username" required type="text" placeholder="username"
                       value="{{ old('username') }}"/>
            </p>
            <p>
                <label style="margin-bottom:0px;" for="password" class="youpasswd"> <i class="livicon"
                                                                                       data-name="key"
                                                                                       data-size="16"
                                                                                       data-loop="true"
                                                                                       data-c="#3c8dbc"
                                                                                       data-hc="#3c8dbc"></i>
                    Mật khẩu
                </label>
                <input id="password" name="password" required type="password"
                       placeholder="eg. X8df!90EO"/>
            </p>
            <p class="keeplogin">
                <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping"/>
                <label for="loginkeeping">Ghi nhớ đăng nhập</label>
            </p>
            <p class="login button">
                <input type="submit" value="Đăng nhập" class="btn btn-success"/>
            </p>
            <p class="change_link">
                <a href="#toforgot">
                    <button type="button"
                            class="btn btn-responsive botton-alignment btn-warning btn-sm">Quên mật khẩu
                    </button>
                </a>

                <a href="{{ route('register') }}" class="btn btn-responsive botton-alignment btn-success btn-sm"
                        style="float:right;text-decoration : none; color: #fff">Đăng ký
                </a>

            </p>
        </form>
    </div>

    <!-- register form -->


    <!-- forgot password form -->
    <div id="forgot" class="animate form">
        <form action="/password/email" autocomplete="on" method="post">
            <h3 class="black_bg">
                <img src="img/logo.png" alt="josh logo">Password</h3>
            <p>
                Enter your email address below and we'll send a special reset password link to your
                inbox.
            </p>
            <p>
                <label style="margin-bottom:0px;" for="emailsignup1" class="youmai">
                    <i class="livicon" data-name="mail" data-size="16" data-loop="true" data-c="#3c8dbc"
                       data-hc="#3c8dbc"></i>
                    Your email
                </label>
                <input id="emailsignup1" name="email" value="{{ old('email') }}" required type="email"
                       placeholder="your@mail.com"/>
            </p>
            <p class="login button">
                {!! csrf_field() !!}
                <input type="submit" value="Send Password Reset Link" class="btn btn-success"/>
            </p>
            <p class="change_link">
                <a href="#tologin" class="to_register">
                    <button type="button"
                            class="btn btn-responsive botton-alignment btn-warning btn-sm">Back
                    </button>
                </a>
            </p>
        </form>
    </div>
    @stop
