@extends('admin.layouts.dashboard')

@section('content')

    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border margin-bottom-10">
                <h3 class="box-title">Danh sách xe bus</h3>
                <button class="btn btn-primary" type="button" onclick="showViewCreateBus()"><i class="fa fa-check" aria-hidden="true"></i>Thêm mới
                </button>
            </div>
            <div class="table-responsive">

                <table class="table table-bordered " id="bus_table">

                </table>

            </div>
        </div>
    </div>
    <div class="modal fade" id="detailBusModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Thông tin chi tiết xe</h3>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editBusModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Sửa thông tin xe</h3>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="createBusModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Tạo mới xe</h3>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">
        var busTable;
        $(function() {
            busTable = $('#bus_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('bus.datatable') !!}'
                },
                columns: [
                    { data: 'bus_name', name: 'bus_name', title: 'Tên xe buýt' },
                    { data: 'bus_reg_number', name: 'bus_reg_number', title: 'Biển đăng ký buýt' },
                    { data: 'busType', name: 'busType.bus_type_name', title: 'Kiểu xe buýt', orderable : false },
                    { data: 'number_seats', name: 'number_seats', title: 'Chỗ ngồi' },
                    { data: 'start_point', name: 'start_point', title: 'Điểm bắt đầu' },
                    { data: 'start_time', name: 'start_time', title: 'Thời gian bắt đầu'},
                    { data: 'end_point', name: 'end_point', title: 'Điểm kết thúc'},
                    { data: 'end_time', name: 'end_time', title: 'Thời gian kết thúc'},
                    { data: 'id', name: 'id', title: 'Action', searchable: false,className: 'text-center', "orderable": false,
                        render: function(data, type, row, meta){
                            var busId = "'" + data + "'";
                            var urlEdit = '{!! route('bus.index') !!}' + '/' + data + '/edit';
                            var actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['bus_name'] +'!" onclick="deleteBusById('+ busId +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="showViewBusEdit('+ busId +')" data-toggle="tooltip" title="Sửa '+ row['bus_name'] +'!" ><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="showBusDetail('+ busId +')" class="show-detail" data-toggle="tooltip" title="View detail" ><i class="fa fa-2x fa-sign-in" aria-hidden="true"></i></a>';
                            return actionLink;
                        }
                    }
                ]
            });
        });
        function deleteBusById(id) {
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
                        url: '{!! route('bus.index') !!}' + '/' + id,
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
                                busTable.ajax.reload();
                            })
                        }
                        else {
                            swal(
                                'Thất bại',
                                'Thao tác thất bại',
                                'error'
                            ).then(function(){
                                busTable.ajax.reload();
                            })
                        }
                    }).error(function(data){
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function(){
                            busTable.ajax.reload();
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
        //bus type select
        $(document).on('change', '#detailBusModal', function () {
            console.log('xxx');
            $('#bus_type_id').select2({
                placeholder: "Chọn Bus Type",
            });
            //date time
            $(".datetimepicker").datetimepicker({
                format: 'LT'
            });
            $('#frmEditBus').bootstrapValidator({});
        });
        //show bus detail
        function showBusDetail(id){
            $.ajax({
                url: '{!! route('bus.index') !!}' + '/detail/' + id,
                method: 'GET'
            }).success(function(data){
                $('#detailBusModal .modal-body').html(data);
            }).error(function(data){

            });
            $("#detailBusModal").modal();
        }
        // show edit bus
        function showViewBusEdit(id) {
            $.ajax({
                url: '{!! route('bus.index') !!}' +'/'+ id + '/edit',
                method: 'GET'
            }).success(function(data){
                $('#editBusModal .modal-body').html(data);
            }).error(function(data){

            });
            $("#editBusModal").modal();
        }
        // Edit bus
        function saveEditBus(id) {
            $.ajax({
                url: $('#frmEditBus').attr('action'),
                method: 'POST',
                data: $('#frmEditBus').serialize()
            }).success(function(data){
                if(data.code == 200) {
                    swal(
                        'Thành công',
                        'Cập nhật xe thành công',
                        'success'
                    ).then(function(){
                        busTable.ajax.reload();
                        $('#editBusModal').modal('hide');
                    })
                } else {
                    swal(
                        'Thất bại',
                        'Xảy ra lỗi trong quá trình cập nhật',
                        'error'
                    ).then(function(){
                        busTable.ajax.reload();
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
        // show create bus
        function showViewCreateBus() {
            $.ajax({
                url: '{!! route('bus.create') !!}',
                method: 'GET'
            }).success(function(data){
                $('#createBusModal .modal-body').html(data);
            }).error(function(data){

            });
            $("#createBusModal").modal();
        }
        // create bus
        function createBus() {
            $.ajax({
                url: $('#frmCreateNewBus').attr('action'),
                method: 'POST',
                data: $('#frmCreateNewBus').serialize()
            }).success(function(data){
                if(data.code == 200) {
                    swal(
                        'Thành công',
                        'Cập nhật xe thành công',
                        'success'
                    ).then(function(){
                        busTable.ajax.reload();
                        $('#createBusModal').modal('hide');
                    })
                } else {
                    swal(
                        'Thất bại',
                        'Xảy ra lỗi trong quá trình cập nhật',
                        'error'
                    ).then(function(){
                        busTable.ajax.reload();
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
