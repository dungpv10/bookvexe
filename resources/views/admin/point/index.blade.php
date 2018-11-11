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
                                    {!! Form::select('point_type_id', ['' => 'Chọn kiểu điểm dừng'] + $pointTypes->toArray(), null, ['class' => 'selectpicker', 'id' => 'point_type_id_search']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="selectpicker" id="bus_id">
                                        <option value="">Chọn Bus</option>
                                        @foreach($buses as $bus)
                                            <option value="{{ $bus->id }}">{{ $bus->bus_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @if(Gate::allows('admin'))
                                <button class="btn btn-primary" type="button" onclick="showViewCreatePoint()">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới
                                </button>
                                <button class="btn btn-danger" type="button" onclick="deleteManyRow()">
                                    <i class="fa fa-trash" aria-hidden="true"></i> Xóa
                                </button>
                            @endif
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
                            <h2>Danh sách điểm dừng</h2>
                            <p>
                                Dưới đây là danh sách các điểm dừng thuộc quyền quản lý của bạn
                            </p>
                        </div>
                        <div class="table-responsive">

                            <table class="table table-striped" id="point_table">

                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="createPointModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Tạo mới điểm dừng</h3>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('points.store') }}" id="frmCreateNewPoint" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="point_type_id">Kiểu điểm dừng</label>
                                    {!! Form::select('point_type_id', $pointTypes, null, ['class' => 'selectpicker']) !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="landmark">Dấu đất</label>
                                    <div class="nk-int-st">
                                        <input id="landmark" class="form-control geo_location" type="text" name="landmark" value="" placeholder="Dấu đất" required >
                                        <div class="wrap_location_landmark"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="route_id">Tuyến đường</label>
                                    {!! Form::select('route_id', $routes, null, ['class' => 'selectpicker']) !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Địa chỉ</label>
                                    <div class="nk-int-st">
                                        <input id="address" class="form-control geo_location" type="text" name="address" value="" placeholder="Địa chỉ" required >
                                        <div class="wrap_location_address"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="drop_time">Thời gian giảm</label>
                                    <div class="input-group date datetimepicker" style="width: 100%;">
                                        <div class="nk-int-st">
                                            <input class="form-control" type="text" name="drop_time" value=""
                                               placeholder="Thời gian giảm" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="editPointModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Sửa điểm dừng</h3>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="frmEditPoint" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PATCH">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="point_type_id">Kiểu điểm dừng</label>
                                    {!! Form::select('point_type_id', $pointTypes, '', ['class' => 'selectpicker', 'id' => 'point_type_id_eidt']) !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="landmark">Dấu đất</label>
                                    <div class="nk-int-st">
                                        <input id="landmark_eidt" class="form-control geo_location" type="text" name="landmark" value="" placeholder="Dấu đất" required >
                                        <div class="wrap_location_landmark"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="route_id">Tuyến đường</label>
                                    {!! Form::select('route_id', $routes, '', ['class' => 'selectpicker', 'id' => 'route_id_eidt']) !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Địa chỉ</label>
                                    <div class="nk-int-st">
                                        <input id="address_eidt" class="form-control geo_location" type="text" name="address" value="" placeholder="Địa chỉ" required >
                                        <div class="wrap_location_address"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="drop_time">Thời gian giảm</label>
                                    <div class="input-group date datetimepicker" style="width: 100%">
                                        <div class="nk-int-st">
                                            <input id="drop_time_eidt" class="form-control" type="text" name="drop_time" value=""
                                               placeholder="Thời gian giảm" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit" aria-hidden="true"></i>Cập nhật
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="detailPointModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Thông tin chi tiết điểm dừng</h3>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript">
        var pointTable;
        var dataLocation = function( request, response ) {
            $.ajax({
                url: "http://ws.geonames.org/searchJSON",
                dataType: "jsonp",
                data: {
                    style: "MEDIUM",
                    maxRows: 10,
                    featureClass: "P",
                    country: "VN,KH",
                    name: request.term,
                    username: "vuvanky"
                },
                success: function( data ) {
                    response( $.map( data.geonames, function( item ) {
                        return {
                            label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryCode,
                            value: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryCode,
                            lat: item.lat,
                            lng: item.lng
                        }
                    }));
                }
            });
        };
        $(document).ready(function() {
            // $('#point_type_id_search').select2({});
            // $('#bus_id').select2({});
            $('#point_type_id_search,#bus_id').on('change', function(){
                pointTable.ajax.reload();
            });
            $(".datetimepicker input").timepicker();

            $('#frmCreateNewPoint').bootstrapValidator({});

            $('#frmEditPoint').bootstrapValidator({});

            $( "#landmark" ).autocomplete({
                source: dataLocation,
                minLength: 0,
                delay: 0,
                appendTo: ".wrap_location_landmark",
                close: function() {
                    //UI plugin not removing loading gif, lets force it
                    $( '#landmark' ).removeClass( "ui-autocomplete-loading" );
                }
            });

            $( "#address" ).autocomplete({
                source: dataLocation,
                minLength: 0,
                delay: 0,
                appendTo: ".wrap_location_address",
                close: function() {
                    //UI plugin not removing loading gif, lets force it
                    $( '#address' ).removeClass( "ui-autocomplete-loading" );
                }
            });

            $( "#landmark_eidt" ).autocomplete({
                source: dataLocation,
                minLength: 0,
                delay: 0,
                appendTo: ".wrap_location_landmark",
                close: function() {
                    //UI plugin not removing loading gif, lets force it
                    $( '#landmark' ).removeClass( "ui-autocomplete-loading" );
                }
            });

            $( "#address_eidt" ).autocomplete({
                source: dataLocation,
                minLength: 0,
                delay: 0,
                appendTo: ".wrap_location_address",
                close: function() {
                    //UI plugin not removing loading gif, lets force it
                    $( '#address' ).removeClass( "ui-autocomplete-loading" );
                }
            });
        });
        $(function() {
            pointTable = $('#point_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('point.datatable') !!}',
                    "data": function ( d ) {
                        d.point_type_id = $('#point_type_id_search').val();
                        d.bus_id = $('#bus_id').val();
                    }
                },
                order: [7, 'asc'],
                columns: [
                    { data: 'id', name: 'id', title: '', searchable: false, className: 'text-center delete-checkbox', orderable: false,
                        visible : visible,
                        render: function(data, type, row, meta){
                            var checkbox = '<input type="checkbox" name="id[]" value="' + data + '">';
                            return checkbox;
                        }
                    },
                    { data: 'busName', name: 'busName', title: 'Tên xe', orderable: false},
                    { data: 'routeName', name: 'route.route_name', title: 'Tên tuyến đường' },
                    { data: 'pointType', name: 'pointType.point_type_name', title: 'Kiểu điểm dừng' },
                    { data: 'boardingPoint', name: 'route.from_place', title: 'Điểm lên xe'},
                    { data: 'dropPoint', name: 'route.arrived_place', title: 'Điểm xuống xe'},
                    { data: 'drop_time', name: 'drop_time', title: 'Thời gian giảm',
                        render: function(data, type, row, meta){
                            var element = data.split(":");
                            if (element.length > 2){
                                return element[0] + ':' + element[1];
                            }
                            return data;
                        }
                    },
                    { data: 'landmark', name: 'landmark', title: 'Landmark'},
                    { data: 'address', name: 'address', title: 'Địa chỉ'},
                    { data: 'agentName', name: 'agentName', title: 'Tên đại lý', orderable : false},
                    { data: 'userCreate', name: 'userCreate', title: 'Người tạo', orderable : false},
                    { data: 'userUpdate', name: 'userUpdate', title: 'Người cập nhật', orderable : false},
                    { data: 'created_at', name: 'created_at', title: 'Thời gian tạo'},
                    { data: 'updated_at', name: 'updated_at', title: 'Thời gian cập nhật'},

                    { data: 'id', name: 'id', title: 'Action', searchable: false,className: 'text-center', "orderable": false,
                        visible: visible,
                        render: function(data, type, row, meta){
                            var pointId = "'" + data + "'";
                            var actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['boardingPoint'] +'!" onclick="deletePointById('+ pointId +')"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="showViewEditPoint('+ pointId +')" data-toggle="tooltip" title="Sửa '+ row['boardingPoint'] +'!" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="showDetailPoint('+ pointId +')" class="show-detail" data-toggle="tooltip" title="View detail" ><i class="fa fa-sign-in" aria-hidden="true"></i></a>';
                            return actionLink;
                        }
                    }
                ]
            });
        });
        // DELETE point
        function deletePointById(id) {
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
                        url: '{!! route('points.index') !!}' + '/' + id,
                        method: 'DELETE'
                    }).success(function(data){
                        if(data.code == 200)
                        {
                            swal(
                                'Đã Xoá!',
                                'Bạn đã xoá thành công người dùng!',
                                'success'
                            ).then(function(){
                                pointTable.ajax.reload();
                            })
                        }
                        else {
                            swal(
                                'Thất bại',
                                'Thao tác thất bại',
                                'error'
                            ).then(function(){
                                pointTable.ajax.reload();
                            })
                        }
                    }).error(function(data){
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function(){
                            pointTable.ajax.reload();
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
        // SHOW create point
        function showViewCreatePoint() {
            $("#createPointModal").modal();
        }
        // SHOW edit bus
        function showViewEditPoint(id) {
            $.ajax({
                url: '{!! route('points.index') !!}' +'/'+ id + '/edit',
                method: 'GET'
            }).success(function(response){
                if (response.code == 200) {
                    $('#editPointModal').find('form').attr('action', window.location.origin + '/admin/points/' + id );
                    $('#point_type_id_eidt').val(response.data.point_type_id).selectpicker('refresh');
                    $('#landmark_eidt').val(response.data.landmark);
                    $('#address_eidt').val(response.data.address);
                    $('#drop_time_eidt').val(response.data.drop_time);
                    $('#route_id_eidt').val(response.data.route_id).selectpicker('refresh');
                    $("#editPointModal").modal();
                } else {
                    swal(
                        'Thất bại',
                        'Thao tác thất bại',
                        'error'
                    );
                }
            }).error(function(data){

            });
        }
        // SHOW detail point
        function showDetailPoint(id){
            $.ajax({
                url: '{!! route('points.index') !!}' + '/' + id,
                method: 'GET'
            }).success(function(data){
                $('#detailPointModal .modal-body').html(data)
            }).error(function(data){

            });
            $("#detailPointModal").modal();
        }
        // delete bus in checkbox
        function deleteManyRow() {
            var listPointId = [];
            $('input[type="checkbox"]').each(function(){
                if ($(this).prop('checked')) {
                    listPointId.push($(this).val());
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
                        url: '{!! route('point.delete_multiple') !!}',
                        method: 'POST',
                        data: {data:listPointId}
                    }).success(function(data){
                        console.log(data);
                        if(data.code == 200)
                        {
                            swal(
                                'Đã Xoá!',
                                'Bạn đã xoá thành công người dùng!',
                                'success'
                            ).then(function(){
                                pointTable.ajax.reload();
                            })
                        }
                        else {
                            swal(
                                'Thất bại',
                                'Thao tác thất bại',
                                'error'
                            ).then(function(){
                                pointTable.ajax.reload();
                            })
                        }
                    }).error(function(data){
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function(){
                            pointTable.ajax.reload();
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
