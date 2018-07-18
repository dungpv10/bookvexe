@extends('admin.layouts.dashboard')
@section('content')
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border margin-bottom-10">
                <h3 class="box-title">Danh sách kiểu xe bus</h3>
                <button class="btn btn-primary" type="button" onclick="showViewCreateBusType()">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                </button>
            </div>
            <div class="table-responsive">

                <table class="table table-bordered " id="bus_type_table">

                </table>

            </div>
        </div>
    </div>
    <div class="modal fade" id="editBusTypeModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Sửa kiểu xe</h3>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createBusTypeModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Thêm kiểu xe</h3>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">
        var busTypeTable;
        $(document).ready(function() {
            $(window).keydown(function(event){
                if( (event.keyCode == 13) ) {
                    event.preventDefault();
                    return false;
                }
            });
        });
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
                            var actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['name'] +'!" onclick="deleteBusTypeById('+ busTypeId +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="showViewEditBusType('+ busTypeId +')" data-toggle="tooltip" title="Sửa '+ row['bus_type_name'] +' !" ><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';
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
        function upLoadJs() {

            $('#frmCreateNewBusType').bootstrapValidator({});

            $('#frmEditBusType').bootstrapValidator({});

        };
        // show edit bus type
        function showViewEditBusType(id) {
            $.ajax({
                url: '{!! route('bus-type.index') !!}' +'/'+ id + '/edit',
                method: 'GET'
            }).success(function(data){
                $('#editBusTypeModal .modal-body').html(data).promise().done(function(){
                    upLoadJs();
                });
            }).error(function(data){

            });
            $("#editBusTypeModal").modal();
        }
        // Edit bus type
        function saveEditBusType(id) {
            $.ajax({
                url: $('#frmEditBusType').attr('action'),
                method: 'POST',
                data: $('#frmEditBusType').serialize()
            }).success(function(data){
                if(data.code == 200) {
                    swal(
                        'Thành công',
                        'Cập nhật xe thành công',
                        'success'
                    ).then(function(){
                        busTypeTable.ajax.reload();
                        $('#editBusTypeModal').modal('hide');
                    })
                } else {
                    swal(
                        'Thất bại',
                        'Xảy ra lỗi trong quá trình cập nhật',
                        'error'
                    ).then(function(){
                        busTypeTable.ajax.reload();
                    })
                }
            }).error(function(data){
                swal(
                    'Thất bại',
                    'Xảy ra lỗi trong quá trình cập nhật',
                    'error'
                ).then(function(){
                })
            });
        }
        // show create bus type
        function showViewCreateBusType() {
            $.ajax({
                url: '{!! route('bus-type.create') !!}',
                method: 'GET'
            }).success(function(data){
                $('#createBusTypeModal .modal-body').html(data).promise().done(function(){
                    upLoadJs();
                });
            }).error(function(data){

            });
            $("#createBusTypeModal").modal();
        }
        // create bus type
        function createBusType() {
            $.ajax({
                url: $('#frmCreateNewBusType').attr('action'),
                method: 'POST',
                data: $('#frmCreateNewBusType').serialize()
            }).success(function(data){
                if(data.code == 200) {
                    swal(
                        'Thành công',
                        'Cập nhật xe thành công',
                        'success'
                    ).then(function(){
                        busTypeTable.ajax.reload();
                        $('#createBusTypeModal').modal('hide');
                    })
                } else {
                    swal(
                        'Thất bại',
                        'Xảy ra lỗi trong quá trình cập nhật',
                        'error'
                    ).then(function(){
                        busTypeTable.ajax.reload();
                    })
                }
            }).error(function(data){
                swal(
                    'Thất bại',
                    'Xảy ra lỗi trong quá trình cập nhật',
                    'error'
                ).then(function(){
                })
            });
        }
    </script>
@stop