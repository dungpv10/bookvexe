@extends('admin.layouts.master_layout')
@section('css')

@stop
@section('content')

    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <h2>Danh sách khách hàng</h2>
                            <p>
                                Dưới đây là danh sách các khách hàng thuộc quyền quản lý của bạn
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

@stop
@section('js')
    <script type="text/javascript">

        var userTable;
        $(function() {

            $('#role_id').on('change', function(){
                userTable.ajax.reload();
            });

            $('.datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD'
            });

            userTable = $('#user_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('customer.datatable') !!}',
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
                            let actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['name'] +'!" onclick="deleteUserById('+ userId +')"><i class="fa fa-trash" aria-hidden="true"></i></a>';
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
