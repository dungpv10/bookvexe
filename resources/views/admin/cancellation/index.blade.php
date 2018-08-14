@extends('admin.layouts.dashboard')
@section('content')
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border margin-bottom-10">
                <h3 class="box-title">Danh sách kiểu xe bus</h3>
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#createCancellation">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới
                </button>
            </div>
            <div class="table-responsive">

                <table class="table table-bordered " id="cancellation_table">

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
    <div class="modal fade" id="createCancellation" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Thêm cài đặt</h3>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'cancellations.store', 'method' => 'POST']) !!}
                    <div class="form-group">
                        <label for="">Chọn xe</label>
                        {!! Form::select('bus_id', $buses, '', ['class' => 'form-control select2']) !!}
                    </div>
                    <div class="form-group">
                        <label for="">Thời gian hủy vé</label>
                        <input type="text" class="form-control datepicker" name="cancel_time" />
                    </div>

                    <div class="form-group">
                        <label for="">Chọn phương thức hủy</label>
                        {!! Form::select('cancel_type', $cancelTypes, '', ['class' => 'form-control select2', 'id' => 'choose_type_method']) !!}
                    </div>

                    <div class="form-group" id="div_percentage">
                        <label for="">Theo %</label>
                        <input type="text" class="form-control" name="percentage" />
                    </div>

                    <div class="form-group" id="div_flat" style="display: none;">
                        <label for="">Theo chi phí</label>
                        <input type="text" class="form-control" name="flat" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Thêm mới</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">
        $('#choose_type_method').on('change', function(e){
            if($(this).val() == 0 ){
                $('#div_percentage').css({display: 'block'});
                $('#div_flat').css({display: 'none'});
            }else{
                $('#div_flat').css({display: 'block'});
                $('#div_percentage').css({display: 'none'});
            }
        });

        $('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('.select2').select2();
        $('.select2-container--default').css({width: '100%'});
        var cancellationTable;

        $(function() {

            cancellationTable = $('#cancellation_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('cancellations.getJsonData') !!}'
                },
                order: [1, 'asc'],
                columns: [
                    { data: 'id', name: 'id', title: 'ID' },
                    { data: 'bus.bus_name', name: 'bus.bus_name', title: 'Xe' },
                    { data: 'cancel_time', name: 'cancel_time', title: 'Thời gian huỷ vé' },
                    { data: 'percentage', name: 'percentage', title: '% vé' },
                    { data: 'flat', name: 'flat', title: 'Phí huỷ vé' },

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
        // show edit bus type
        function showViewEditBusType(id) {
            $.ajax({
                url: '{!! route('bus-type.index') !!}' +'/'+ id + '/edit',
                method: 'GET'
            }).success(function(data){
                $('#editBusTypeModal .modal-body').html(data).promise().done(function(){
                    $('#frmEditBusType').bootstrapValidator({});
                });
            }).error(function(data){

            });
            $("#editBusTypeModal").modal();
        }
        // show create bus type
        function showViewCreateBusType() {
            $.ajax({
                url: '{!! route('bus-type.create') !!}',
                method: 'GET'
            }).success(function(data){
                $('#createBusTypeModal .modal-body').html(data).promise().done(function(){
                    $('#frmCreateNewBusType').bootstrapValidator({});
                });
            }).error(function(data){

            });
            $("#createBusTypeModal").modal();
        }
        // delete bus type in checkbox
        function deleteManyRow() {
            var listBusTypeId = [];
            $('input[type="checkbox"]').each(function(){
                if ($(this).prop('checked')) {
                    listBusTypeId.push($(this).val());
                }
            });
            swal({
                title: "Bạn có muốn xóa những xe này?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: 'Bỏ qua',
                confirmButtonText: "Đồng ý",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '{!! route('bustype.delete_multiple') !!}',
                        method: 'POST',
                        data: {data:listBusTypeId}
                    }).success(function(data){
                        console.log(data);
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
