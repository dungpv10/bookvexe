@extends('admin.layouts.dashboard')

@section('css')
    <link href="{{asset('css/pages/user_profile.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('vendors/dropzone/dropzone.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors/dropzone/dropzone.css')}}" rel="stylesheet" type="text/css" />

@stop

@section('content')

<div class="col-md-12">
    <ul class="nav nav-tabs ul-edit responsive">
        <li class="active">
            <a href="#tab-info" data-toggle="tab">
                <i class="livicon" data-name="user" data-size="16" data-c="#01BC8C" data-hc="#01BC8C" data-loop="true"></i> Thông tin cá nhân
            </a>
        </li>
        <li>
            <a href="#tab-change-pwd" data-toggle="tab">
                <i class="livicon" data-name="key" data-size="16" data-c="#01BC8C" data-hc="#01BC8C" data-loop="true"></i> Đổi mật khẩu
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="tab-info" class="tab-pane fade in active">
            <div class="activity">
                <div class="row">
                    <div class="col-md-6">
                        <span>Ảnh đại diện</span>
                        <br />
                        <img id="img_avatar" style="max-height: 150px;" src="{{$user->getAvatar()}}" class="img-thumbnail" alt="" />
                    </div>

                    <div class="col-md-6">
                        <span>Đổi Ảnh đại diện</span>
                        <br />
                        <div class="dropzone" id="my-dropzone" name="myDropzone">

                        </div>
                    </div>
                </div>

                <br />
                <form method="POST" action="{{ route('users.update', $user->id) }}" id="frmEditUser">
                    <input name="_method" type="hidden" value="PATCH">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="row form-group">
                        <label for="Email">Email</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="row form-group">
                        <label for="name">Họ tên</label>
                        <input id="name" class="form-control" type="text" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="row form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input id="username" class="form-control" type="text" name="username" value="{{ $user->username }}">
                    </div>
                    <div class="row">
                        <label for="dob">Ngày sinh</label>
                        <div class="form-group">
                            <div class='input-group date datetimepicker'>
                                <input type='text' value="{{ $user->dob }}" name="dob" id="dob" class="form-control" />
                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label for="mobile">Số điện thoại</label>
                        <input id="mobile" class="form-control" type="text" name="mobile" value="{{ $user->mobile }}">
                    </div>
                    <div class="row form-group">
                        <label for="gender">Giới tính</label>
                        <select id="gender" class="form-control" name="gender">
                            <option value="0" {{ $user->gender == 0 ? 'selected' :'' }}>Nam</option>
                            <option value="1" {{ $user->gender == 1 ? 'selected' :'' }}>Nữ</option>
                        </select>
                    </div>
                    <div class="row form-group">
                        <label for="address">Địa chỉ</label>
                        <input id="address" class="form-control" type="text" name="address" value="{{ $user->address }}">
                    </div>

                    <div class="row text-center">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>



        <div id="tab-change-pwd" class="tab-pane fade">
            <div class="row">
                <div class="col-md-12 pd-top">
                    <form method="POST" action="/user/password" class="form-horizontal" id="frmChangePass">
                        {!! csrf_field() !!}
                        <div class="form-body">
                            <div class="form-group">
                                <label  class="col-md-3 control-label">
                                    Password cũ
                                    <span class='require'>*</span>
                                </label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                        </span>
                                        <input type="password" placeholder="Password" class="form-control" name="old_password" id="old_password"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">
                                    Password mới
                                    <span class='require'>*</span>
                                </label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                        </span>
                                        <input type="password" placeholder="Password" class="form-control" name="new_password" id="new_password"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">
                                    Nhập lại password
                                    <span class='require'>*</span>
                                </label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#000" data-hc="#000"></i>
                                        </span>
                                        <input type="password" placeholder="Password" class="form-control" name="new_password_confirmation" id="new_password_confirmation"/>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions text-center">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                &nbsp;
                                <input type="reset" class="btn btn-default hidden-xs" value="Reset"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop


@section('js')
<script type="text/javascript" src="{{asset('vendors/dropzone/dropzone.js')}}"></script>
<script type="text/javascript">
    $('#frmEditUser').bootstrapValidator({
        message: 'Dữ liệu nhập không đúng',
        fields: {
            name: {
                message: 'Tên không đúng định dạng',
                validators: {
                    notEmpty: {
                        message: 'Tên không được trống'
                    },
                    stringLength: {
                        min: 5,
                        max: 30,
                        message: 'Tên dài từ 6 tớ 30 ký tự'
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
                        min: 5,
                        max: 30,
                        message: 'Tên dài từ 6 tớ 30 ký tự'
                    }
                },
                regexp: {
                    regexp: /^[a-zA-Z0-9_]+$/,
                    message: 'Tên chỉ chữa chữ, số và dấu gạch dưới'
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email không được rỗng'
                    },
                    emailAddress: {
                        message: 'Không phải địa chỉ email'
                    }
                }
            },
            dob: {
                validators: {
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'Sai định dạng'
                    }
                }
            }
        }
    });
    $('#frmChangePass').bootstrapValidator({
        message: 'Dữ liệu nhập không đúng',
        fields: {
            old_password: {
                validators: {
                    notEmpty: {
                        message: 'Password không được bỏ trống'
                    }
                }
            },
            new_password: {
                validators: {
                    notEmpty: {
                        message: 'Password mới không được bỏ trống'
                    },
                    identical: {
                        field: 'required',
                    }
                }
            },
            new_password_confirmation: {
                validators: {
                    notEmpty: {
                        message: 'Không được bỏ trống'
                    },
                    identical: {
                        field: 'new_password',
                        message: 'Password nhập lại và password không giống nhau'
                    }
                }
            },
        }
    });

    Dropzone.options.myDropzone= {
        url: '{{ route("avatar.uploads", $user->id) }}',
        headers: {
           'X-CSRF-TOKEN': '{!! csrf_token() !!}'
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        removedfile: function(file) {
            var name = file.name;
            name =name.replace(/\s+/g, '-').toLowerCase();    /*only spaces*/
            $.ajax({
                type: 'PUT',
                url: '{{ route("avatar.delete", $user->id) }}',
                headers: {
                     'X-CSRF-TOKEN': '{!! csrf_token() !!}'
                 },
                success: function(data) {
                   $('#img_avatar').attr('src', data);
                }
            });
            var _ref;
            if (file.previewElement) {
                if ((_ref = file.previewElement) != null) {
                    _ref.parentNode.removeChild(file.previewElement);
                }
            }
          return this._updateMaxFilesReachedClass();

        },
        success: function(file, response){
            $('#img_avatar').attr('src', response);
        }
   }

</script>
@stop
