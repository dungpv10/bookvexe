@extends('admin.dashboard')

@section('content')
    
    <section class="content-header">
        <!--section starts-->
        <h1>Users</h1>
        <ol class="breadcrumb">
            <li>
                <a href="/admin/dashboard">
                    <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i>
                    Dashboard
                </a>
            </li>
             <li>
                <a href="{{ route('users.index') }}">Users</a>
            </li>
            <li class="active">Edit User</li>
        </ol>
    </section>

    <section class="content">
        @include('includes.alert')
        <div class="row">
            <div class="col-md-12">
                
                <form method="POST" action="{{ route('users.update', $user->id) }}" id="frmEditUser">
                    <input name="_method" type="hidden" value="PATCH">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <div class="row form-group">
                        <label for="Email">Email</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ $user->email }}" placeholder="Email" required>
                    </div>

                    <div class="row form-group">
                        <label for="Name">Tên</label>
                        <input id="name" class="form-control" type="text" name="name" value="{{ $user->name }}" placeholder="Name" required>
                    </div>
                    <div class="row  form-group">
                        <label for="Role">Quyền</label>
                        <select class="form-control" name="roles" id="roles">
                            <option value="">Chọn Quyền</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row text-center">
                        <a class="btn btn-default" href="/admin/users"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                            Quay Lại</a>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Cập nhật</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
@stop
@section('js')
    <script type="text/javascript">
$(function(){
    $('#frmEditUser').bootstrapValidator({
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
                        min: 6,
                        max: 30,
                        message: 'Tên dài từ 6 tớ 30 ký tự'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: 'Tên chỉ chữa chữ, số và dấu gạch dưới'
                    }
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
            }
        }
    });
    $('#roles').select2({
        placeholder: "Chọn quyền",
    });
})
    </script>
@stop