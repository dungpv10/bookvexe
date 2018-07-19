@extends('admin.layouts.dashboard')

@section('content')

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
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border margin-bottom-10">
                    <h3 class="box-title">Danh sách thành viên</h3>
                    <button type="button" class="btn btn-primary" id="createUserBtn">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                    </button>
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


@stop
@section('js')
	<script type="text/javascript">
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
                    render: function(data, type, row, meta){
                        var userId = "'" + row['id'] + "'";
                        let urlEdit = window.location.origin + '/admin/users/' + data + '/edit';
                        let switchUrl = window.location.origin + '/admin/users/switch/' + data;
                        let actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['name'] +'!" onclick="deleteUserById('+ userId +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                        actionLink += '&nbsp;&nbsp;&nbsp;<a href="' + urlEdit + '" data-toggle="tooltip" title="Sửa '+ row['name'] +'!" ><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';
                        actionLink += '&nbsp;&nbsp;&nbsp;<a href="' + switchUrl + '" data-toggle="tooltip" title="Đăng nhập bằng '+ row['name'] +'!" ><i class="fa fa-2x fa-sign-in" aria-hidden="true"></i></a>';
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
            });
        }).fail(function(error){
            console.log(error);
        });

    });
	</script>
@stop
