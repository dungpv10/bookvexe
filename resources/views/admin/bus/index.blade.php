@extends('admin.layouts.dashboard')

@section('content')
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::select('bus_type', ['' => 'Chọn kiểu xe'] + $busTypes, null, ['class' => 'form-control', 'id' => 'bus_type']) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border margin-bottom-10">
                <h3 class="box-title">Danh sách xe bus</h3>
                <button class="btn btn-primary" type="button" onclick="showViewCreateBus()">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                </button>
            </div>
            <div class="table-responsive">

                <table class="table table-bordered " id="bus_table">

                </table>

            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="detailBusModal" role="dialog">
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
    <div class="modal fade bd-example-modal-lg" id="editBusModal" role="dialog">
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
        var sleeperSeat;
        $(document).ready(function() {
            $(window).keydown(function(event){
                if( (event.keyCode == 13) ) {
                    event.preventDefault();
                    return false;
                }
            });
            $('#bus_type').select2({});
            $('#bus_type').on('change', function(){
                busTable.ajax.reload();
            });

            $(document).on('click', '.add-image',function(){
                var html = $(".clone").html();
                $(".increment").after(html);
            });

            $(document).on("click",".remove-image",function(){
                $(this).parents(".control-group").remove();
            });

            $(document).on('click', '.remove_edit', function () {
                var parent = $(this).parents(".remove_image_edit");
                var image = parent.find(".image_bus");
                var image_path = image.attr("data-name");
                parent.find("input").val(image_path);
                image.hide();
                parent.find("i").hide();
                parent.addClass('remove');
            })
        });
        $(function() {
            busTable = $('#bus_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('bus.datatable') !!}',
                    "data": function ( d ) {
                        d.bus_type_id = $('#bus_type').val();
                    }
                },
                columns: [
                    { data: 'bus_name', name: 'bus_name', title: 'Tên xe buýt' },
                    { data: 'bus_reg_number', name: 'bus_reg_number', title: 'Biển đăng ký buýt' },
                    { data: 'busType', name: 'busType.bus_type_name', title: 'Kiểu xe buýt', orderable : false },
                    { data: 'number_seats', name: 'number_seats', title: 'Chỗ ngồi' },
                    { data: 'start_point', name: 'start_point', title: 'Điểm bắt đầu'},
                    { data: 'start_time', name: 'start_time', title: 'Thời gian bắt đầu',
                        render: function(data, type, row, meta){
                            var element = data.split(":");
                            return element[0] + ':' + element[1];
                        }
                    },
                    { data: 'end_point', name: 'end_point', title: 'Điểm kết thúc'},
                    { data: 'end_time', name: 'end_time', title: 'Thời gian kết thúc',
                        render: function(data, type, row, meta){
                            var element = data.split(":");
                            return element[0] + ':' + element[1];
                        }
                    },
                    { data: 'id', name: 'id', title: 'Action', searchable: false,className: 'text-center', "orderable": false,
                        render: function(data, type, row, meta){
                            var busId = "'" + data + "'";
                            var actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['bus_name'] +'!" onclick="deleteBusById('+ busId +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="showViewEditBus('+ busId +')" data-toggle="tooltip" title="Sửa '+ row['bus_name'] +'!" ><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';
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
        //show bus detail
        function showBusDetail(id){
            $.ajax({
                url: '{!! route('bus.index') !!}' + '/detail/' + id,
                method: 'GET'
            }).success(function(data){
                $('#detailBusModal .modal-body').html(data).promise().done(function(){
                    var seatDetail = $('.detail_seat');
                    var leftSeat= seatDetail.attr('data-left-seat');
                    var leftTotalSeat= seatDetail.attr('data-left-total-seat');
                    var rightSeat= seatDetail.attr('data-right-seat');
                    var rightTotalSeat= seatDetail.attr('data-right-total-seat');
                    var residualSeat= seatDetail.attr('data-residual-seat');
                    var lastSeat= seatDetail.attr('data-last-seat');
                    var typeSeat = seatDetail.attr('data-type-seat');
                    var type = seatDetail.attr('data-type');
                    sleeperSeat = seatDetail.attr('data-sleeper-seat');
                    buildElementSeatHead($('.left_seat'), leftSeat, leftTotalSeat, 'left', typeSeat, type, sleeperSeat);
                    buildElementSeatHead($('.right_seat'), rightSeat, rightTotalSeat, 'right', typeSeat, type, sleeperSeat);
                    buildElementSeatResidual($('.residual_seat'), residualSeat, typeSeat, type, sleeperSeat);
                    buildElementSeatLast($('.last_seat'), lastSeat, typeSeat, type, sleeperSeat);
                });
            }).error(function(data){

            });
            $("#detailBusModal").modal();
        }
        // show edit bus
        function showViewEditBus(id) {
            $.ajax({
                url: '{!! route('bus.index') !!}' +'/'+ id + '/edit',
                method: 'GET'
            }).success(function(data){
                $('#editBusModal .modal-body').html(data).promise().done(function(){
                    $('#bus_type_id').select2({
                        placeholder: "Chọn Bus Type",
                    });
                    $('.select2-container--default').css({width: '100%'});
                    $(".datetimepicker").datetimepicker({
                        format: 'LT'
                    });

                    $('#amenities').tagsinput();

                    $('#frmEditBus').bootstrapValidator({});
                });
            }).error(function(data){

            });
            $("#editBusModal").modal();
        }
        // show create bus
        function showViewCreateBus() {
            $.ajax({
                url: '{!! route('bus.create') !!}',
                method: 'GET'
            }).success(function(data){
                $('#createBusModal .modal-body').html(data).promise().done(function(){
                    $('#bus_type_id').select2({
                        placeholder: "Chọn Bus Type",
                    });
                    $('.select2-container--default').css({width: '100%'});
                    $(".datetimepicker").datetimepicker({
                        format: 'LT'
                    });

                    $('#amenities').tagsinput();

                    $('#frmCreateNewBus').bootstrapValidator({});
                });
            }).error(function(data){

            });
            $("#createBusModal").modal();
        }
        // add element seat for detail#
        function buildElementSeatHead(element, rowSeat, totalSeat, position, typeSeat, type, sleeper) {
            var col1 = '';
            var col2 = '';
            var col3 = '';
            if (type == '3') {
                element.append('<div class="row row-seat custom-col-30 cont-seat-1"></div>');
                element.append('<div class="row row-seat custom-col-30 cont-seat-2"></div>');
                element.append('<div class="row row-seat custom-col-30 cont-seat-3"></div>');
                col1 = element.find('.cont-seat-1');
                col2 = element.find('.cont-seat-2');
                col3 = element.find('.cont-seat-3');
            } else {
                element.append('<div class="row row-seat custom-col-50 cont-seat-1"></div>');
                element.append('<div class="row row-seat custom-col-50 cont-seat-2"></div>');
                col1 = element.find('.cont-seat-1');
                col2 = element.find('.cont-seat-2');
            }
            if (rowSeat == 1) {
                for (var i = 1; i <= totalSeat; i++) {
                    var typeChange = typeSeat;
                    if (sleeper > 0) {
                        typeChange = 'sleeper';
                        sleeper = sleeper - 1;
                        sleeperSeat = sleeper
                    }
                    if (position == 'left') {
                        col1.append('<div class="col-md-12 no-padding"><div class="'+typeChange+'"></div></div>');
                    }
                    if (position == 'right') {
                        if (type == 3) {
                            col3.append('<div class="col-md-12 no-padding"><div class="'+typeChange+'"></div></div>');
                        } else {
                            col2.append('<div class="col-md-12 no-padding"><div class="'+typeChange+'"></div></div>');
                        }
                    }
                }
            }
            if (rowSeat == 2) {
                var rightChange = sleeper - totalSeat/2;
                if (type == 3) {
                    for (var i = 1; i <= totalSeat/2; i++) {
                        var typeChangeLeft = typeSeat;
                        var typeChangeRight = typeSeat;
                        if (sleeper > 0) {
                            typeChangeLeft = 'sleeper';
                            if (rightChange > 0) {
                                typeChangeRight = 'sleeper';
                                rightChange = rightChange - 1;
                                sleeper = sleeper - 1;
                            }
                            sleeper = sleeper - 1;
                            sleeperSeat = sleeper
                        }
                        if (position == 'left') {
                            col1.append('<div class="col-md-12 no-padding"><div class="'+typeChangeLeft+'"></div></div>');
                            col2.append('<div class="col-md-12 no-padding"><div class="'+typeChangeRight+'"></div></div>');
                        }
                        if (position == 'right') {
                            col2.append('<div class="col-md-12 no-padding"><div class="'+typeChangeLeft+'"></div></div>');
                            col3.append('<div class="col-md-12 no-padding"><div class="'+typeChangeRight+'"></div></div>');
                        }
                    }
                } else {
                    for (var i = 1; i <= totalSeat/2; i++) {
                        var typeChangeLeft = typeSeat;
                        var typeChangeRight = typeSeat;
                        if (sleeper > 0) {
                            typeChangeLeft = 'sleeper';
                            if (rightChange > 0) {
                                typeChangeRight = 'sleeper';
                                rightChange = rightChange - 1;
                                sleeper = sleeper - 1;
                            }
                            sleeper = sleeper - 1;
                            sleeperSeat = sleeper
                        }
                        col1.append('<div class="col-md-12 no-padding"><div class="'+typeChangeLeft+'"></div></div>');
                        col2.append('<div class="col-md-12 no-padding"><div class="'+typeChangeRight+'"></div></div>');
                    }
                }

            }
            if (rowSeat == 3) {
                var middleChange = sleeper - totalSeat/3;
                var rightChange = sleeper - totalSeat/3 * 2;
                for (var i = 1; i <= totalSeat/3; i++) {
                    var typeChangeLeft = typeSeat;
                    var typeChangeMiddle = typeSeat;
                    var typeChangeRight = typeSeat;
                    if (sleeper > 0) {
                        typeChangeLeft = 'sleeper';
                        if (middleChange > 0) {
                            typeChangeMiddle = 'sleeper';
                            middleChange = middleChange - 1;
                            sleeper = sleeper - 1;
                        }
                        if (rightChange > 0) {
                            typeChangeRight = 'sleeper';
                            rightChange = rightChange - 1;
                            sleeper = sleeper - 1;
                        }
                        typeChange = 'sleeper';
                        sleeper = sleeper - 1;
                        sleeperSeat = sleeper
                    }
                    col1.append('<div class="col-md-12 no-padding"><div class="'+typeChangeLeft+'"></div></div>');
                    col2.append('<div class="col-md-12 no-padding"><div class="'+typeChangeMiddle+'"></div></div>');
                    col3.append('<div class="col-md-12 no-padding"><div class="'+typeChangeRight+'"></div></div>');
                }
            }
        }
        function buildElementSeatResidual(element, residualSeat, typeSeat, type, sleeper) {
            for (var i = 1; i <= residualSeat; i++) {
                var typeChange = typeSeat;
                if (sleeper > 0) {
                    typeChange = 'sleeper';
                    sleeper = sleeper - 1;
                    sleeperSeat = sleeper
                }
                if (type == 3) {
                    element.append('<div class="custom-col-90"></div>');
                    element.append('<div class="custom-col-10"><div class="'+typeChange+'"></div></div>');
                } else {
                    element.append('<div class="custom-col-80"></div>');
                    element.append('<div class="custom-col-20"><div class="'+typeChange+'"></div></div>');
                }
            }
        }
        function buildElementSeatLast(element, lastSeat, typeSeat, type, sleeper) {
            for (var i = 1; i <= lastSeat; i++) {
                var typeChange = typeSeat;
                if (sleeper > 0) {
                    typeChange = 'sleeper';
                    sleeper = sleeper - 1;
                    sleeperSeat = sleeper
                }
                if (type == 3) {
                    element.append('<div class="custom-col-14"><div class="'+typeChange+'"></div></div>');
                } else {
                    element.append('<div class="custom-col-20"><div class="'+typeChange+'"></div></div>');
                }
            }
        }
    </script>
@stop
