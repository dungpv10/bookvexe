@extends('admin.layouts.master_layout')
@section('css')

@stop
@section('content')

    <div class="breadcomb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcomb-list">
                        <div class="row">
                            @if(Gate::allows('admin'))
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select class="selectpicker" id="role_id">
                                            <option value="">Chọn quyền</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            @if(Gate::allows('admin'))
                                <div class="col-md-3">
                                <button type="button" class="btn btn-primary" id="createUserBtn">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                                </button>
                                <button class="btn btn-danger" type="button" onclick="deleteManyRow()">
                                    <i class="fa fa-trash" aria-hidden="true"></i> Xóa
                                </button>
                                </div>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <h2>Danh sách thành viên</h2>
                            <p>
                                Dưới đây là danh sách các thành viên thuộc quyền quản lý của bạn
                            </p>
                        </div>
                        <div class="table-responsive">

                            <table class="table table-striped" id="user_table">

                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="registerUserModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Tạo mới thành viên</h3>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('users.store') }}" id="frmCreateUser">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <label for="Email">Họ và tên</label>
                            <div class="nk-int-st">
                                <input class="form-control" type="text" name="name" value="" placeholder="ex : Nguyễn Văn A">
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="Email">Tên đăng nhập</label>
                            <div class="nk-int-st">
                                <input class="form-control" type="text" name="username" value="" placeholder="ex : customer">
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="Email">Email</label>
                            <div class="nk-int-st">
                                <input class="form-control" type="email" name="email" value="" placeholder="abc@gmail.com">
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="Email">Số điện thoại</label>
                            <div class="nk-int-st">
                                <input class="form-control" type="text" name="mobile" value="" placeholder="">
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="gender">Giới tính</label>
                            <select class="selectpicker" name="gender">
                                <option value="0">Nam</option>
                                <option value="1">Nữ</option>
                            </select>
                        </div>

                        @if(Gate::allows('root'))
                            <div class=" form-group" id="slect_agent">

                                <label for="team_id">Agent</label>
                                {!! Form::select('agent_id', $teams, '', ['class' => 'selectpicker']) !!}
                            </div>

                        @else
                            {!! Form::hidden('agent_id', auth()->user()->agent->id) !!}
                        @endif

                        <div class=" form-group">
                            <label for="Role">Quyền</label>
                            {!! Form::select('role_id', $roleCs, '', ['class' => 'selectpicker']) !!}
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-primary" id="addUser" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Tạo
                                mới
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="editUserModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Sửa thông tin người dùng</h3>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="frmEditUser">
                        <input name="_method" type="hidden" value="PATCH">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class=" form-group ">
                            <label for="Email">Email</label>
                            <div class="nk-int-st">
                                <input id="email" class="form-control" type="email" name="email" value="">
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="name">Họ tên</label>
                            <div class="nk-int-st">
                                <input id="name" class="form-control" type="text" name="name" value="">
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="username">Tên đăng nhập</label>
                            <div class="nk-int-st">
                                <input id="username" class="form-control" type="text" name="username" value="">
                            </div>
                        </div>
                        <div class="">
                            <label for="dob">Ngày sinh</label>
                            <div class="form-group">
                                <div class='input-group date datetimepicker' style="width: 100%">
                                    <div class="nk-int-st">
                                        <input type='text' value="" name="dob" id="dob" class="form-control" />
                                    </div>
                                    <!-- <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                    </span> -->
                                </div>
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="mobile">Số điện thoại</label>
                            <div class="nk-int-st">
                                <input id="mobile" class="form-control" type="text" name="mobile" value="">
                            </div>
                        </div>
                        <div class=" form-group">
                            <label for="gender">Giới tính</label>
                            <select id="gender" class="selectpicker" name="gender">
                                <option value="0" >Nam</option>
                                <option value="1" >Nữ</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <div class="nk-int-st">
                                <input id="address" class="form-control" type="text" name="address" value="">
                            </div>
                        </div>

                        @if(Gate::allows('root'))
                            <div class="form-group" id="slect_agent">
                                <label for="team_id">Agent</label>
                                {!! Form::select('agent_id', $teams, '', ['id' => 'team_id', 'class' => 'selectpicker']) !!}
                            </div>
                        @else
                            {!! Form::hidden('agent_id', auth()->user()->agent->id) !!}
                        @endif
                        <div class=" form-group">
                            <label for="Role">Quyền</label>
                            {!! Form::select('role_id', $roleCs, '', ['class' => 'selectpicker', 'id' =>'role_id']) !!}
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check" aria-hidden="true"></i>Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
@section('js')
	<script type="text/javascript">
        //$('#role_id').select2();
    var userTable;
    $(function() {
        // $('#m_role_id').select2({
        //     theme: 'bootstrap',
        //     with: '100%'
        // });

        $('#role_id').on('change', function(){
            userTable.ajax.reload();
        });

        userTable = $('#user_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": '{!! route('users.datatable') !!}',
                "data": function ( d ) {
                    d.role_id = $('#role_id').val();
                }
            },
            columns: [
                { data: 'id', name: 'id', searchable: false, title: 'ID' },
                { data: 'name', name: 'name', title: 'Tên' },
                { data: 'mobile', name: 'mobile', title: 'Số điện thoại' },
                { data: 'email', name: 'email', title: 'Email' },
                { data: 'rName', name: 'role', title: 'Quyền', searchable: false, sortable:false },
                { data: 'status_name', name: 'status_name', title: 'Trạng thái', searchable: false,
                    render: function(data, type, row, meta) {
                        $active = '';
                        if (row['status'] == "1") {
                            $active = 'active';
                        }
                        return '<button onclick="activeUser('+ row['id'] +')" type="button" class="btn btn-lg btn-toggle ' + $active + '" data-toggle="button" aria-pressed="true" autocomplete="off"><div class="handle"></div></button>';
                    }
                },
                { data: 'created_at', name: 'created_at', title: 'Ngày tạo'},
                { data: 'updated_at', name: 'updated_at', title: 'Ngày cập nhật'},
                { data: 'id', name: 'id', title: 'Thao Tác', searchable: false,className: 'text-center', "orderable": false,
                    visible : visible,
                    render: function(data, type, row, meta){
                        var userId = "'" + row['id'] + "'";
                        let urlEdit = window.location.origin + '/admin/users/' + data + '/edit';
                        let switchUrl = window.location.origin + '/admin/users/switch/' + data;
                        let actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['name'] +'!" onclick="deleteUserById('+ userId +')"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                        actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="editUser('+ userId +')" data-toggle="tooltip" title="Sửa '+ row['name'] +'!" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                        return actionLink;
                    }
                }
            ],
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   0,
                'render': function (data, type, full, meta){
                   return '<input class="chkUser" type="checkbox" name="id[]" value="'
                      + $('<div/>').text(data).html() + '">';
               }
            } ],
        });

    });
    function deleteUserById(id) {
        swal({
            title: "Bạn có muốn xóa người dùng này?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: 'Bỏ qua',
            confirmButtonText: "Đồng ý",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: window.location.origin + '/admin/users/' + id,
                    method: 'DELETE'
                }).success(function(data){
                    console.log(data);
                    if(data.code == 200)
                    {
                        swal(
                          'Đã Xoá!',
                          'Bạn đã xoá thành công người dùng!',
                          'success'
                        ).then(function(){
                            userTable.ajax.reload();
                        })
                    }
                    else {
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function(){
                            userTable.ajax.reload();
                        })
                    }
                }).error(function(data){
                    swal(
                        'Thất bại',
                        'Thao tác thất bại',
                        'error'
                    ).then(function(){
                        userTable.ajax.reload();
                    })
                });
            // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
            } else if (result.dismiss === 'cancel') {
              swal(
                'Bỏ Qua',
                'Bạn đã không xoá người dùng nữa',
                'error'
              )
            }
          });
    }


    var createRouter = "{{ route('users.create') }}";

    $('#createUserBtn').on('click', function () {
        $('#registerUserModal').modal('show');
    });

    function validateSetup(formId) {
        $('#' + formId).bootstrapValidator({
            message: 'Dữ liệu nhập không đúng',
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
                            message: 'Tên dài từ 6 tới 30 ký tự'
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
                            min: 6,
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
                password : {
                    validators:{
                        notEmpty: {
                            message: 'Mật khẩu không được rỗng'
                        },
                        stringLength: {
                            min: 6, max: 30,
                            message: 'Mật khẩu phải dài từ 6 đến 30 ký tự'
                        }
                    }
                },
                confirmed_password : {
                    validators:{
                        notEmpty: {
                            message: 'Xác nhận mật khẩu không được rỗng'
                        },
                        identical : {
                            field: 'password',
                            message: 'Xác nhận mật khẩu không đúng'
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
    }

    function editUser(uId) {
        $.ajax({
                url: '{!! route("users.index") !!}' +'/'+ uId + '/edit',
                method: 'GET'
            }).success(function(response){
                if (response.code == 200) {
                    console.log(response);
                    $('#editUserModal').find('form').attr('action', window.location.origin + '/admin/users/' + uId );
                    $('#email').val(response.data.email);
                    $('#name').val(response.data.name);
                    $('#username').val(response.data.username);
                    $('#dob').val(response.data.dob);
                    $('#mobile').val(response.data.mobile);
                    $('#address').val(response.data.address);
                    $('#gender').val(response.data.gender).selectpicker('refresh');
                    $('#team_id').val(response.data.agent_id).selectpicker('refresh');
                    $('#role_id').val(response.data.role_id).selectpicker('refresh');
                    $("#editUserModal").modal();
                } else {
                    swal(
                        'Thất bại',
                        'Thao tác thất bại',
                        'error'
                    );
                }
            }).error(function(response){

            });
    }

    // delete bus in checkbox
    function deleteManyRow() {
        var listUserId = [];
        $('.chkUser').each(function(){
            if ($(this).prop('checked')) {
                listUserId.push($(this).val());
            }
        });
        if (listUserId.length < 1) {
            swal("Xảy Ra Lỗi", "Bạn chưa check chọn user nào!", "error");
            return false;
        }

        swal({
            title: "Bạn có muốn xóa những user này?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: 'Bỏ qua',
            confirmButtonText: "Đồng ý",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '{!! route('user.multiple.delete') !!}',
                    method: 'POST',
                    data: {data:listUserId}
                }).success(function(data){
                    console.log(data);
                    if(data.code == 200)
                    {
                        swal(
                            'Đã Xoá!',
                            'Bạn đã xoá thành công ' + data.count + ' người dùng!',
                            'success'
                        ).then(function(){
                            userTable.ajax.reload();
                        })
                    }
                    else {
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function(){
                            userTable.ajax.reload();
                        })
                    }
                }).error(function(data){
                    swal(
                        'Thất bại',
                        'Thao tác thất bại',
                        'error'
                    ).then(function(){
                        userTable.ajax.reload();
                    })
                });
                // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
            } else if (result.dismiss === 'cancel') {
                swal(
                    'Bỏ Qua',
                    'Bạn đã không xoá người dùng nữa',
                    'error'
                )
            }
        });
    }

    function controlAgent()
    {
        // $('#roles').on('change', function(){
        //     if ($(this).val() != 'staff') {
        //         $('#team_id').val('').change();
        //         $('#slect_agent').removeClass('hidden');
        //         $('#slect_agent').addClass('hidden');
        //     }
        //     else {
        //         $('#slect_agent').removeClass('hidden');
        //     }
        //
        // });
    }

    function activeUser(userId) {
        toastr.options.closeButton = true;
        $.ajax({
            url: "{{ route('user.togleStatus') }}",
            data: {id: userId},
            method: 'POST',
            success: function(data) {
                toastr.clear();
                if (data.code == 200) {
                    // Override global options
                    toastr.success('Update Thành công trạng thái người dùng', 'Thành Công', {timeOut: 3000})
                }
                else {
                    // Override global options
                    toastr.error('Update Không Thành công trạng thái người dùng', 'Thất Bại', {timeOut: 3000})
                }
            }
        })
    }

	</script>
@stop
