@extends('admin.layouts.dashboard')

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
                { data: 'status_name', name: 'status_name', title: 'Trạng thái', searchable: false},
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
            ]
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

	</script>
@stop
