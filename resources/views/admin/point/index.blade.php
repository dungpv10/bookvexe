@extends('admin.layouts.dashboard')

@section('content')
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::select('point_type_id', ['' => 'Chọn kiểu điểm dừng'] + $pointTypes->toArray(), null, ['class' => 'form-control', 'id' => 'point_type_id_search']) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border margin-bottom-10">
                <h3 class="box-title">Danh sách điểm dừng</h3>
                <button class="btn btn-primary" type="button" onclick="showViewCreatePoint()">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                </button>
            </div>
            <div class="table-responsive">

                <table class="table table-bordered " id="point_table">

                </table>

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
                    q: request.term,
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
            $('#point_type_id_search').select2({});
            $('#point_type_id_search').on('change', function(){
                pointTable.ajax.reload();
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
                    }
                },
                columns: [
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
                    { data: 'landmark', name: 'landmark', title: 'Dấu đất'},
                    { data: 'address', name: 'address', title: 'Địa chỉ'},
                    { data: 'id', name: 'id', title: 'Action', searchable: false,className: 'text-center', "orderable": false,
                        render: function(data, type, row, meta){
                            var pointId = "'" + data + "'";
                            var actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['boardingPoint'] +'!" onclick="deletePointById('+ pointId +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="showViewEditPoint('+ pointId +')" data-toggle="tooltip" title="Sửa '+ row['boardingPoint'] +'!" ><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="showDetailPoint('+ pointId +')" class="show-detail" data-toggle="tooltip" title="View detail" ><i class="fa fa-2x fa-sign-in" aria-hidden="true"></i></a>';
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
            $.ajax({
                url: '{!! route('points.create') !!}',
                method: 'GET'
            }).success(function(data){
                $('#createPointModal .modal-body').html(data).promise().done(function(){
                    $('#point_type_id').select2({
                        placeholder: "Chọn kiểu điểm dừng",
                    });
                    $('#route_id').select2({
                        placeholder: "Chọn tuyến đường",
                    });
                    $('.select2-container--default').css({width: '100%'});

                    $(".datetimepicker input").timepicker();

                    $('#frmCreateNewPoint').bootstrapValidator({});

                    $( ".geo_location" ).autocomplete({
                        source: dataLocation,
                        minLength: 0,
                        delay: 0,
                        appendTo: ".wrap_location",
                        close: function() {
                            //UI plugin not removing loading gif, lets force it
                            $( '.geo_location' ).removeClass( "ui-autocomplete-loading" );
                        }
                    });

                });
            }).error(function(data){

            });
            $("#createPointModal").modal();
        }
        // SHOW edit bus
        function showViewEditPoint(id) {
            $.ajax({
                url: '{!! route('points.index') !!}' +'/'+ id + '/edit',
                method: 'GET'
            }).success(function(data){
                $('#editPointModal .modal-body').html(data).promise().done(function(){
                    $('#point_type_id').select2({
                        placeholder: "Chọn kiểu điểm dừng",
                    });
                    $('#route_id').select2({
                        placeholder: "Chọn tuyến đường",
                    });
                    $('.select2-container--default').css({width: '100%'});

                    $(".datetimepicker input").timepicker();

                    $('#frmEditPoint').bootstrapValidator({});

                    $( ".geo_location" ).autocomplete({
                        source: dataLocation,
                        minLength: 0,
                        delay: 0,
                        appendTo: ".wrap_location",
                        close: function() {
                            //UI plugin not removing loading gif, lets force it
                            $( '.geo_location' ).removeClass( "ui-autocomplete-loading" );
                        }
                    });
                });
            }).error(function(data){

            });
            $("#editPointModal").modal();
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
    </script>
@stop
