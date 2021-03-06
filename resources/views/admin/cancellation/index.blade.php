@extends('admin.layouts.master_layout')
@section('content')

<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                      <div class="col-md-3">
                          <div class="form-group">
                              {!! Form::select('filter_cancel_type', array_replace(['' => 'Chọn theo loại phí'],$cancelTypes), '', ['class' => 'selectpicker', 'id' => 'filter_cancel_type']) !!}
                          </div>
                      </div>
                      <div class="col-md-3">
                          <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#createCancellation">
                              <i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới
                          </button>
                      </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="data-table-list">
                    <div class="basic-tb-hd">
                        <h2>Danh sách xe</h2>
                        <p>
                            Dưới đây là danh sách các xe thuộc quyền quản lý của bạn
                        </p>
                    </div>
                    <div class="table-responsive">

                        <table class="table table-striped" id="cancellation_table">

                        </table>

                    </div>
                </div>
            </div>
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
                    {!! Form::open(['route' => 'cancellations.store', 'method' => 'POST', 'id' => 'createSetting']) !!}
                    {{--Todo --}}
                    {{--<div class="form-group">--}}
                        {{--<label for="">Chọn xe</label>--}}
                        {{--{!! Form::select('bus_id', $buses, '', ['class' => 'form-control select2']) !!}--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <label for="">Thời gian hủy vé</label>
                        <input type="number" class="form-control" name="cancel_time" />
                    </div>

                    <div class="form-group">
                        <label for="">Chọn phương thức hủy</label>
                        {!! Form::select('cancel_type', $cancelTypes, '', ['class' => 'form-control select2', 'id' => 'choose_type_method']) !!}
                    </div>

                    <div class="form-group" id="div_percentage">
                        <label for="">Theo %</label>
                        <input type="number" class="form-control" name="percentage" />
                    </div>

                    <div class="form-group" id="div_flat">
                        <label for="">Số tiền</label>
                        <input type="number" class="form-control" name="flat" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Thêm mới</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCancellation" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Sửa cài đặt</h3>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'PUT', 'id' => 'updateSetting']) !!}
                    {{--Todo --}}
                    {{--<div class="form-group">--}}
                        {{--<label for="">Chọn xe</label>--}}
                        {{--{!! Form::select('bus_id', $buses, '', ['class' => 'form-control select2', 'id' => 'edit_bus_id']) !!}--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <label for="">Thời gian hủy vé</label>
                        <input type="number" class="form-control" name="cancel_time" id="edit_cancel_time"/>
                    </div>

                    <div class="form-group">
                        <label for="">Chọn phương thức hủy</label>
                        {!! Form::select('cancel_type', $cancelTypes, '', ['class' => 'form-control choose_type_method select2', 'id' => 'edit_cancel_type']) !!}
                    </div>

                    <div class="form-group" id="div_percentage">
                        <label for="">Theo %</label>
                        <input type="number" class="form-control" name="percentage" id="edit_percentage" />
                    </div>

                    <div class="form-group" id="div_flat">
                        <label for="">Số tiền</label>
                        <input type="number" class="form-control" name="flat" id="edit_flat" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Sửa</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@stop
@section('js')
    <script type="text/javascript">
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
                    url : '{!! route('cancellations.getJsonData') !!}',
                    data: function(d){
                        d.cancel_type = $('#filter_cancel_type').val();
                    }
                },

                columns: [
                    { data: 'id', name: 'id', title: 'ID' },
                    // { data: 'bus.bus_name', name: 'bus.bus_name', title: 'Xe' },
                    { data: 'cancel_time', name: 'cancel_time', title: 'Thời gian huỷ vé',
                        render: function(data, type, row, meta){
                            return '<input type="number" data-bus-id="'+row['bus_id']+'" class="form-control cancel_time_'+row['id']+'" style="display: inline-block; max-width: 80px; margin-bottom: 5px;" name="cancel_time" value="'+row['cancel_time']+'"><span> h</span>' +
                                '<button class="btn btn-primary" type="button" id="update_cancel_time" onclick="updateCancelTime('+row['id']+')">Update</button>';
                        }
                    },
                    { data: 'percentage', name: 'percentage', title: '% vé' },
                    { data: 'flat', name: 'flat', title: 'Phí huỷ vé' },
                    { data: 'cancel_type', name: 'cancel_type', title: 'Phí huỷ vé', visible: false },
                    { data: 'userCreate', name: 'userCreate', title: 'Người tạo'},
                    { data: 'userUpdate', name: 'userUpdate', title: 'Người cập nhật'},
                    { data: 'created_at', name: 'created_at', title: 'Ngày tạo'},
                    { data: 'updated_at', name: 'updated_at', title: 'Ngày cập nhật'},

                    { data: 'cancel_type_name', name: 'cancel_type_name', title: 'Loại phí', searchable: false, orderable: false,
                        render: function(data, type, row, meta){
                            return row['cancel_type'] === 0 ? 'Theo %' : 'Theo tiền';
                        }
                    },

                    { data: 'id', name: 'id', title: 'Action', searchable: false,className: 'text-center', "orderable": false,
                        render: function(data, type, row, meta){
                            var id = "'" + data + "'";
                            var actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['name'] +'!" onclick="deleteSetting('+ id +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="editSetting('+ id +')" data-toggle="tooltip" title="Sửa '+ row['bus_type_name'] +' !" ><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';
                            return actionLink;
                        }
                    }
                ]
            });

            $('#filter_cancel_type').on('change', function(){
               cancellationTable.ajax.reload();
            });
        });
        function deleteSetting(id) {
            swal({
                title: "Bạn có muốn xóa cài đặt này?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: 'Bỏ qua',
                confirmButtonText: "Đồng ý",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '{!! route('cancellations.index') !!}' + '/' + id,
                        method: 'DELETE'
                    }).success(function(data){
                        if(data.code == 200)
                        {
                            swal(
                                'Đã Xoá!',
                                'Bạn đã xoá thành công !',
                                'success'
                            ).then(function(){
                                cancellationTable.ajax.reload();
                            })
                        }
                        else {
                            swal(
                                'Thất bại',
                                'Thao tác thất bại',
                                'error'
                            ).then(function(){
                                cancellationTable.ajax.reload();
                            })
                        }
                    }).error(function(data){
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function(){
                            cancellationTable.ajax.reload();
                        })
                    });
                    // result.dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
                } else if (result.dismiss === 'cancel') {
                    swal(
                        'Bỏ Qua',
                        'Bỏ qua xoá cài đặt huỷ vé',
                        'error'
                    )
                }
            });
        }
        // update cancel time
        function updateCancelTime(id) {
            $.ajax({
                url: window.location.origin + '/admin/cancellations/' + id,
                method: 'PUT',
                data: {
                    cancel_time: jQuery('.cancel_time_' + id).val(),
                    // bus_id: jQuery('.cancel_time_' + id).attr('data-bus-id')
                },
            }).success(function(data){
                swal(
                    'Thành công',
                    'Thao tác thành công',
                    'success'
                );
                cancellationTable.ajax.reload();
            }).error(function(error){
                swal(
                    'Thất bại',
                    'Thao tác thất bại',
                    'error'
                );
            });
        }
        // show edit bus type
        function editSetting(id) {
            $.ajax({
                url: '{!! route('cancellations.index') !!}' +'/'+ id + '/edit',
                method: 'GET'
            }).success(function(data){
                //$('#edit_bus_id').select2().select2('val', data.data.bus_id);
                $('#edit_cancel_time').val(data.data.cancel_time);


                $('#edit_cancel_type').select2().select2('val', data.data.cancel_type);
                $('#edit_percentage').val(data.data.percentage);
                $('#edit_flat').val(data.data.flat);

                $('#updateSetting').attr('action', window.location.origin + '/admin/cancellations/' + data.data.id);
                $('.select2-container--default').css({width: '100%'});

                $("#editCancellation").modal('show');
            }).error(function(error){
                console.log(error);
                swal(
                    'Thất bại',
                    'Thao tác thất bại',
                    'error'
                );
            });

        }

        $('#createSetting').bootstrapValidator({
            fields : {
                bus_id: {
                    validators : {
                        notEmpty: {
                            message : 'Vui lòng chọn xe'
                        }
                    }
                },
                cancel_type : {
                    validators : {
                        notEmpty: {
                            message : 'Vui lòng chọn loại giảm giá'
                        }
                    }
                },
            }
        });

    </script>
@stop
