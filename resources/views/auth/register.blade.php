@extends('auth.layouts')
@section('content')
    @include('partials.errors')
    @include('partials.status')
    <div id="register">
        <form action="/register" autocomplete="on" method="post" id="frmRegister">
            {{ csrf_field() }}
            <h3 class="black_bg">
                <img src="/img/logo.png" alt="josh logo"></h3>
            <p class="form-group">
                <label style="margin-bottom:0px;" for="name" class="youmail">
                    <i class="livicon" data-name="user" data-size="16" data-loop="true"
                       data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                    Họ và tên
                </label>
                <input id="name" name="name" type="text" placeholder="John"/>
            </p>

            <div class="form-group">
                <label style="margin-bottom:0px;" for="email" class="youmail">
                    Tên đăng nhập
                </label>
                <input id="username" name="username" placeholder="funnycat"/>
            </div>
            <div class="form-group">
                <label style="margin-bottom:0px;" for="email" class="youmail">
                    <i class="livicon" data-name="mail" data-size="16" data-loop="true"
                       data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                    E-mail
                </label>
                <input id="email" name="email" type="email"
                       placeholder="abc@mail.com"/>
            </div>

            <div class="form-group">
                <label style="margin-bottom:0px;" for="password" class="youpasswd">
                    <i class="livicon" data-name="key" data-size="16" data-loop="true"
                       data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                    Mật khẩu
                </label>
                <input id="password" name="password" type="password"
                       placeholder="eg. X8df!90EO"/>
            </div>

            <div class="form-group">
                <label style="margin-bottom:0px;" for="password_confirmation" class="youpasswd">
                    <i class="livicon" data-name="key" data-size="16" data-loop="true"
                       data-c="#3c8dbc" data-hc="#3c8dbc"></i>
                    Xác nhận mật khẩu
                </label>
                <input id="password_confirmation" name="password_confirmation"
                       type="password" placeholder="eg. X8df!90EO"/>
            </div>

            <p class="signin button">
                <input type="submit" class="btn btn-success" value="Đăng ký "/>
            </p>

        </form>
    </div>
@stop
@section('js')
<script>
    $(function(){
        $('#frmRegister').bootstrapValidator({
            message: 'Dữ liệu nhập không đúng',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {
                    message: 'Tên không đúng định dạng',
                    validators: {
                        notEmpty: {
                            message: 'Tên không được trống'
                        },
                        stringLength: {
                            min: 4,
                            max: 10,
                            message: 'Tên dài từ 6 tớ 30 ký tự'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: 'Tên chỉ chữa chữ, số và dấu gạch dưới'
                        }
                    }
                },
                username: {
                    message: 'Tên không đúng định dạng',
                    validators: {
                        notEmpty: {
                            message: 'Tên không được trống'
                        },
                        stringLength: {
                            min: 4,
                            max: 10,
                            message: 'Tên dài từ 6 tớ 30 ký tự'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_]+$/,
                            message: 'Tên chỉ chữa chữ, số và dấu gạch dưới'
                        }
                    }
                },
                email: {
                    message: 'Email không đúng định dạng',
                    validators: {
                        notEmpty: {
                            message: 'Email không được trống'
                        },
                        emailAddress: {
                            message: 'Không phải là 1 địa chỉ email'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'password không được trống'
                        }
                    }
                },
                password_confirmation: {
                    validators: {
                        identical: {
                            compare: function() {
                                return form.querySelector('[name="password"]').value;
                            },
                            message: 'The password and its confirm are not the same'
                        }
                    }
                }
            }
        });
    })
</script>
@stop