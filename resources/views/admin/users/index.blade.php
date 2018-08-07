@extends('admin.layouts.dashboard')
@section('css')
<style type="text/css">
 body {
  font-family: 'Montserrat', 'Lato', 'Open Sans', 'Helvetica Neue', Helvetica, Calibri, Arial, sans-serif;
  color: #6b7381;
  background: #f2f2f2;
}
.jumbotron {
  background: #6b7381;
  color: #bdc1c8;
}
.jumbotron h1 {
  color: #fff;
}
.example {
  margin: 4rem auto;
}
.example > .row {
  margin-top: 2rem;
  height: 5rem;
  vertical-align: middle;
  text-align: center;
  border: 1px solid rgba(189, 193, 200, 0.5);
}
.example > .row:first-of-type {
  border: none;
  height: auto;
  text-align: left;
}
.example h3 {
  font-weight: 400;
}
.example h3 > small {
  font-weight: 200;
  font-size: .75em;
  color: #939aa5;
}
.example h6 {
  font-weight: 700;
  font-size: .65rem;
  letter-spacing: 3.32px;
  text-transform: uppercase;
  color: #bdc1c8;
  margin: 0;
  line-height: 5rem;
}
.example .btn-toggle {
  top: 50%;
  transform: translateY(-50%);
}
.btn-toggle {
  margin: 0 4rem;
  padding: 0;
  position: relative;
  border: none;
  height: 1.5rem;
  width: 3rem;
  border-radius: 1.5rem;
  color: #6b7381;
  background: #bdc1c8;
}
.btn-toggle:focus,
.btn-toggle.focus,
.btn-toggle:focus.active,
.btn-toggle.focus.active {
  outline: none;
}
.btn-toggle:before,
.btn-toggle:after {
  line-height: 1.5rem;
  width: 4rem;
  text-align: center;
  font-weight: 600;
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 2px;
  position: absolute;
  bottom: 0;
  transition: opacity .25s;
}
.btn-toggle:before {
  content: 'Off';
  left: -4rem;
}
.btn-toggle:after {
  content: 'On';
  right: -4rem;
  opacity: .5;
}
.btn-toggle > .handle {
  position: absolute;
  top: 0.1875rem;
  left: 0.1875rem;
  width: 1.125rem;
  height: 1.125rem;
  border-radius: 1.125rem;
  background: #fff;
  transition: left .25s;
}
.btn-toggle.active {
  transition: background-color 0.25s;
}
.btn-toggle.active > .handle {
  left: 1.6875rem;
  transition: left .25s;
}
.btn-toggle.active:before {
  opacity: .5;
}
.btn-toggle.active:after {
  opacity: 1;
}
.btn-toggle.btn-sm:before,
.btn-toggle.btn-sm:after {
  line-height: -0.5rem;
  color: #fff;
  letter-spacing: .75px;
  left: 0.41250000000000003rem;
  width: 2.325rem;
}
.btn-toggle.btn-sm:before {
  text-align: right;
}
.btn-toggle.btn-sm:after {
  text-align: left;
  opacity: 0;
}
.btn-toggle.btn-sm.active:before {
  opacity: 0;
}
.btn-toggle.btn-sm.active:after {
  opacity: 1;
}
.btn-toggle.btn-xs:before,
.btn-toggle.btn-xs:after {
  display: none;
}
.btn-toggle:before,
.btn-toggle:after {
  color: #6b7381;
}
.btn-toggle.active {
  background-color: #29b5a8;
}
.btn-toggle.btn-lg {
  margin: 0 5rem;
  padding: 0;
  position: relative;
  border: none;
  height: 2.5rem;
  width: 5rem;
  border-radius: 2.5rem;
}
.btn-toggle.btn-lg:focus,
.btn-toggle.btn-lg.focus,
.btn-toggle.btn-lg:focus.active,
.btn-toggle.btn-lg.focus.active {
  outline: none;
}
.btn-toggle.btn-lg:before,
.btn-toggle.btn-lg:after {
  line-height: 2.5rem;
  width: 5rem;
  text-align: center;
  font-weight: 600;
  font-size: 1rem;
  text-transform: uppercase;
  letter-spacing: 2px;
  position: absolute;
  bottom: 0;
  transition: opacity .25s;
}
.btn-toggle.btn-lg:before {
  content: 'Off';
  left: -5rem;
}
.btn-toggle.btn-lg:after {
  content: 'On';
  right: -5rem;
  opacity: .5;
}
.btn-toggle.btn-lg > .handle {
  position: absolute;
  top: 0.3125rem;
  left: 0.3125rem;
  width: 1.875rem;
  height: 1.875rem;
  border-radius: 1.875rem;
  background: #fff;
  transition: left .25s;
}
.btn-toggle.btn-lg.active {
  transition: background-color 0.25s;
}
.btn-toggle.btn-lg.active > .handle {
  left: 2.8125rem;
  transition: left .25s;
}
.btn-toggle.btn-lg.active:before {
  opacity: .5;
}
.btn-toggle.btn-lg.active:after {
  opacity: 1;
}
.btn-toggle.btn-lg.btn-sm:before,
.btn-toggle.btn-lg.btn-sm:after {
  line-height: 0.5rem;
  color: #fff;
  letter-spacing: .75px;
  left: 0.6875rem;
  width: 3.875rem;
}
.btn-toggle.btn-lg.btn-sm:before {
  text-align: right;
}
.btn-toggle.btn-lg.btn-sm:after {
  text-align: left;
  opacity: 0;
}
.btn-toggle.btn-lg.btn-sm.active:before {
  opacity: 0;
}
.btn-toggle.btn-lg.btn-sm.active:after {
  opacity: 1;
}
.btn-toggle.btn-lg.btn-xs:before,
.btn-toggle.btn-lg.btn-xs:after {
  display: none;
}
.btn-toggle.btn-sm {
  margin: 0 0.5rem;
  padding: 0;
  position: relative;
  border: none;
  height: 1.5rem;
  width: 3rem;
  border-radius: 1.5rem;
}
.btn-toggle.btn-sm:focus,
.btn-toggle.btn-sm.focus,
.btn-toggle.btn-sm:focus.active,
.btn-toggle.btn-sm.focus.active {
  outline: none;
}
.btn-toggle.btn-sm:before,
.btn-toggle.btn-sm:after {
  line-height: 1.5rem;
  width: 0.5rem;
  text-align: center;
  font-weight: 600;
  font-size: 0.55rem;
  text-transform: uppercase;
  letter-spacing: 2px;
  position: absolute;
  bottom: 0;
  transition: opacity .25s;
}
.btn-toggle.btn-sm:before {
  content: 'Off';
  left: -0.5rem;
}
.btn-toggle.btn-sm:after {
  content: 'On';
  right: -0.5rem;
  opacity: .5;
}
.btn-toggle.btn-sm > .handle {
  position: absolute;
  top: 0.1875rem;
  left: 0.1875rem;
  width: 1.125rem;
  height: 1.125rem;
  border-radius: 1.125rem;
  background: #fff;
  transition: left .25s;
}
.btn-toggle.btn-sm.active {
  transition: background-color 0.25s;
}
.btn-toggle.btn-sm.active > .handle {
  left: 1.6875rem;
  transition: left .25s;
}
.btn-toggle.btn-sm.active:before {
  opacity: .5;
}
.btn-toggle.btn-sm.active:after {
  opacity: 1;
}
.btn-toggle.btn-sm.btn-sm:before,
.btn-toggle.btn-sm.btn-sm:after {
  line-height: -0.5rem;
  color: #fff;
  letter-spacing: .75px;
  left: 0.41250000000000003rem;
  width: 2.325rem;
}
.btn-toggle.btn-sm.btn-sm:before {
  text-align: right;
}
.btn-toggle.btn-sm.btn-sm:after {
  text-align: left;
  opacity: 0;
}
.btn-toggle.btn-sm.btn-sm.active:before {
  opacity: 0;
}
.btn-toggle.btn-sm.btn-sm.active:after {
  opacity: 1;
}
.btn-toggle.btn-sm.btn-xs:before,
.btn-toggle.btn-sm.btn-xs:after {
  display: none;
}
.btn-toggle.btn-xs {
  margin: 0 0;
  padding: 0;
  position: relative;
  border: none;
  height: 1rem;
  width: 2rem;
  border-radius: 1rem;
}
.btn-toggle.btn-xs:focus,
.btn-toggle.btn-xs.focus,
.btn-toggle.btn-xs:focus.active,
.btn-toggle.btn-xs.focus.active {
  outline: none;
}
.btn-toggle.btn-xs:before,
.btn-toggle.btn-xs:after {
  line-height: 1rem;
  width: 0;
  text-align: center;
  font-weight: 600;
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 2px;
  position: absolute;
  bottom: 0;
  transition: opacity .25s;
}
.btn-toggle.btn-xs:before {
  content: 'Off';
  left: 0;
}
.btn-toggle.btn-xs:after {
  content: 'On';
  right: 0;
  opacity: .5;
}
.btn-toggle.btn-xs > .handle {
  position: absolute;
  top: 0.125rem;
  left: 0.125rem;
  width: 0.75rem;
  height: 0.75rem;
  border-radius: 0.75rem;
  background: #fff;
  transition: left .25s;
}
.btn-toggle.btn-xs.active {
  transition: background-color 0.25s;
}
.btn-toggle.btn-xs.active > .handle {
  left: 1.125rem;
  transition: left .25s;
}
.btn-toggle.btn-xs.active:before {
  opacity: .5;
}
.btn-toggle.btn-xs.active:after {
  opacity: 1;
}
.btn-toggle.btn-xs.btn-sm:before,
.btn-toggle.btn-xs.btn-sm:after {
  line-height: -1rem;
  color: #fff;
  letter-spacing: .75px;
  left: 0.275rem;
  width: 1.55rem;
}
.btn-toggle.btn-xs.btn-sm:before {
  text-align: right;
}
.btn-toggle.btn-xs.btn-sm:after {
  text-align: left;
  opacity: 0;
}
.btn-toggle.btn-xs.btn-sm.active:before {
  opacity: 0;
}
.btn-toggle.btn-xs.btn-sm.active:after {
  opacity: 1;
}
.btn-toggle.btn-xs.btn-xs:before,
.btn-toggle.btn-xs.btn-xs:after {
  display: none;
}
.btn-toggle.btn-secondary {
  color: #6b7381;
  background: #bdc1c8;
}
.btn-toggle.btn-secondary:before,
.btn-toggle.btn-secondary:after {
  color: #6b7381;
}
.btn-toggle.btn-secondary.active {
  background-color: #ff8300;
}

</style>>
@stop
@section('content')
    @if(Gate::allows('admin'))
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <select class="form-control" id="role_id">
                    <option value="">Chọn quyền</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->label }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border margin-bottom-10">
                    <h3 class="box-title">Danh sách thành viên</h3>
                    @if(Gate::allows('admin'))
                        <button type="button" class="btn btn-primary" id="createUserBtn">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                        </button>
                        <button class="btn btn-danger" type="button" onclick="deleteManyRow()">
                            <i class="fa fa-trash" aria-hidden="true"></i> Xóa nhiều
                        </button>
                    @endif
                </div>


                <div class="table-responsive">

                    <table class="table table-bordered " id="user_table">

                    </table>

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
                </div>
            </div>
        </div>
    </div>

@stop
@section('js')
	<script type="text/javascript">
        $('#role_id').select2();
    var userTable;
    $(function() {
        $('#m_role_id').select2({
            theme: 'bootstrap',
            with: '100%'
        });

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
                        let actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['name'] +'!" onclick="deleteUserById('+ userId +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                        actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="editUser('+ userId +')" data-toggle="tooltip" title="Sửa '+ row['name'] +'!" ><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';
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
        $.get(createRouter).done(function(view){
            $('#registerUserModal').find('.modal-body').html(view).promise().done(function(){
                $('#registerUserModal').modal('show');
                $('#roles').select2({
                    placeholder: "Chọn quyền thành viên",
                });
                $('#team_id').select2({
                    placeholder: "Chọn Agent",
                });

                $('.select2-container--default').css({width: '100%'});
                controlAgent();

            });
            validateSetup('frmCreateUser');

        }).fail(function(error){
            console.log(error);
        });

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
            }).success(function(data){
                $('#editUserModal .modal-body').html(data).promise().done(function(){

                    validateSetup('frmEditUser');

                    $('#roles').select2({
                        placeholder: "Chọn quyền",
                    });
                    $('.select2-container--default').css({width: '100%'});
                    $('.datetimepicker').datetimepicker({
                        format: 'YYYY-MM-DD'
                    });
                    controlAgent();
                    $('#team_id').select2({
                        placeholder: "Chọn Agent",
                    });
                });
            }).error(function(data){

            });
            $("#editUserModal").modal();
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
