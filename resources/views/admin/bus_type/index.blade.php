@extends('admin.layouts.dashboard')
@section('content')
    <div class="col-md-12">
        {{--create new bus type--}}
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Thêm kiểu xe bus</h3>
            </div>
            <form action="{{ route('bus-type.store') }}" method="POST" enctype="multipart/form-data" id="frmCreateNewBusType">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="bus_type_name">Kiểu xe bus</label>
                            <input type="text" class="form-control" name="bus_type_name" data-parsley-pattern="^[a-zA-Z\ . ! @ # $ % ^ &amp; * () + = , \/]+$" id="bus_type_name" placeholder="Nhập kiểu xe bus" required>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                </div>
            </form>
        </div>
        {{--list bus type--}}
        <div class="box">
            <div class="box-header with-border margin-bottom-10">
                <h3 class="box-title">Danh sách kiểu xe bus</h3>
            </div>
            <div class="table-responsive">

                <table class="table table-bordered " id="bus_type_table">

                </table>

            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">
        $('#frmCreateNewBusType').bootstrapValidator({});
        var busTypeTable;
        $(function() {

            busTypeTable = $('#bus_type_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('bus-type.datatable') !!}'
                },
                columns: [
                    { data: 'bus_type_name', name: 'bus_type_name', title: 'Kiểu xe buýt' },
                    { data: 'cv_status', name: 'cv_status', title: 'Trạng thái' },
                    { data: 'id', name: 'id', title: 'Action', searchable: false,className: 'text-center', "orderable": false,
                        render: function(data, type, row, meta){
                            var busTypeId = "'" + data + "'";
                            var urlEdit = '{!! route('bus-type.index') !!}' + '/' + data + '/edit';
                            var actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['name'] +'!" onclick="deleteBusTypeById('+ busTypeId +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="' + urlEdit + '" data-toggle="tooltip" title="Sửa '+ row['bus_type_name'] +' !" ><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';
                            return actionLink;
                        }
                    }
                ]
            });
        });
        function deleteBusTypeById(id) {
            swal({
                title: "Bạn có muốn xóa bus này?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: 'Bỏ qua',
                confirmButtonText: "Đồng ý",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '{!! route('bus-type.index') !!}' + '/' + id,
                        method: 'DELETE'
                    }).success(function(data){
                        if(data.code == 200)
                        {
                            swal(
                                'Đã Xoá!',
                                'Bạn đã xoá thành công người dùng!',
                                'success'
                            ).then(function(){
                                busTypeTable.ajax.reload();
                            })
                        }
                        else {
                            swal(
                                'Thất bại',
                                'Thao tác thất bại',
                                'error'
                            ).then(function(){
                                busTypeTable.ajax.reload();
                            })
                        }
                    }).error(function(data){
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function(){
                            busTypeTable.ajax.reload();
                        })
                    });
                    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                } else if (result.dismiss === 'cancel') {
                    swal(
                        'Bỏ Qua',
                        'Bạn đã không xoá bus nữa',
                        'error'
                    )
                }
            });
        }
    </script>
@stop