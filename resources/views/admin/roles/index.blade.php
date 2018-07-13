@extends('admin.layouts.dashboard')

@section('content')
    <div class="col-md-12">

        <div class="table-responsive">

            <table class="table table-bordered " id="role_table">

            </table>

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
            ]
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
    </script>
@stop
