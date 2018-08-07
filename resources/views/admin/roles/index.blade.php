@extends('admin.layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
                <div class="box-header with-border margin-bottom-10">
                    <h3 class="box-title">Danh sách Quyền</h3>
                    <button type="button" class="btn btn-primary" id="createRoleBtn">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                    </button>
                    <button class="btn btn-danger" type="button" onclick="deleteManyRow()">
                        <i class="fa fa-trash" aria-hidden="true"></i> Xóa nhiều
                    </button>
                </div>


                <div class="table-responsive">

                    <table class="table table-bordered " id="role_table">

                    </table>

                </div>

            </div>
        </div>
        

    </div>
</div>
    <div class="modal fade bd-example-modal-lg" id="registerRole" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Tạo mới Quyền</h3>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">
    var roleTable;
    $(function() {
        roleTable = $('#role_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": '{!! route('roles.datatable') !!}'
            },
            columns: [
                { data: 'id', name: 'id', searchable: false, title: 'ID' },
                { data: 'name', name: 'name', title: 'Name' },
                { data: 'label', name: 'label', title: 'Label' },
                { data: 'permissions', name: 'permissions', title: 'Permissions' },
                { data: 'id', name: 'id', title: 'Thao Tác', searchable: false,className: 'text-center', "orderable": false,
                    render: function(data, type, row, meta){
                        var roleId = "'" + row['id'] + "'";
                        let urlEdit = window.location.origin + '/admin/roles/' + data + '/edit';
                        let actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['name'] +'!" onclick="deleteRoleById('+ roleId +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                        actionLink += '&nbsp;&nbsp;&nbsp;<a target="_blank" href="' + urlEdit + '" data-toggle="tooltip" title="Sửa '+ row['name'] +'!" ><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';

                        return actionLink;
                    }
                }
            ],
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   0,
                'render': function (data, type, full, meta){
                   return '<input class="chkRole" type="checkbox" name="id[]" value="'
                      + $('<div/>').text(data).html() + '">';
               }
            } ],
        });

    });
    function deleteRoleById(id) {
        swal({
            title: "Bạn có muốn xóa Role này?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: 'Bỏ qua',
            confirmButtonText: "Đồng ý",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: window.location.origin + '/admin/roles/' + id,
                    method: 'DELETE'
                }).success(function(data){
                    console.log(data);
                    if(data.code == 200)
                    {
                        swal(
                          'Đã Xoá!',
                          'Bạn đã xoá thành công Role!',
                          'success'
                        ).then(function(){
                            roleTable.ajax.reload();
                        })
                    }
                    else {
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function(){
                            roleTable.ajax.reload();
                        })
                    }
                }).error(function(data){
                    swal(
                        'Thất bại',
                        'Thao tác thất bại',
                        'error'
                    ).then(function(){
                        roleTable.ajax.reload();
                    })
                });
            // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
            } else if (result.dismiss === 'cancel') {
              swal(
                'Bỏ Qua',
                'Bạn đã không xoá role nữa',
                'error'
              )
            }
          });
    }
        var createRouter = "{{ route('roles.create') }}";
        $('#createRoleBtn').on('click', function () {
        $.get(createRouter).done(function(view){
            $('#registerRole').find('.modal-body').html(view).promise().done(function(){
                $('#registerRole').modal('show');
                $('.select2-container--default').css({width: '100%'});
            });

            $('#frmCreaterRole').bootstrapValidator({
                message: 'Dữ liệu nhập không đúng',
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
                    label: {
                        message: 'Label không đúng định dạng',
                        validators: {
                            notEmpty: {
                                message: 'Label không được trống'
                            },
                            stringLength: {
                                min: 4,
                                max: 10,
                                message: 'Label dài từ 6 tớ 30 ký tự'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_]+$/,
                                message: 'Label chỉ chữa chữ, số và dấu gạch dưới'
                            }
                        }
                    }
                }
            });

        }).fail(function(error){
            console.log(error);
        });

    });

    // delete bus in checkbox
    function deleteManyRow() {
        var listRoleId = [];
        $('.chkRole').each(function(){
            if ($(this).prop('checked')) {
                listRoleId.push($(this).val());
            }
        });
        if (listRoleId.length < 1) {
            swal("Xảy Ra Lỗi", "Bạn chưa check chọn Role nào!", "error");
            return false;
        }

        swal({
            title: "Bạn có muốn xóa những Role này?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: 'Bỏ qua',
            confirmButtonText: "Đồng ý",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '{!! route('role.multiple.delete') !!}',
                    method: 'POST',
                    data: {data:listRoleId}
                }).success(function(data){
                    console.log(data);
                    if(data.code == 200)
                    {
                        swal(
                            'Đã Xoá!',
                            'Bạn đã xoá thành công ' + data.count + ' quyền!',
                            'success'
                        ).then(function(){
                            roleTable.ajax.reload();
                        })
                    }
                    else {
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function(){
                            roleTable.ajax.reload();
                        })
                    }
                }).error(function(data){
                    swal(
                        'Thất bại',
                        'Thao tác thất bại',
                        'error'
                    ).then(function(){
                        roleTable.ajax.reload();
                    })
                });
                // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
            } else if (result.dismiss === 'cancel') {
                swal(
                    'Bỏ Qua',
                    'Bạn đã không xoá quyền nữa',
                    'error'
                )
            }
        });
    }
    </script>
@stop
