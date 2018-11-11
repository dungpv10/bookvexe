@extends('admin.layouts.master_layout')
@section('css')
  <style>
    .bootstrap-tagsinput{
      background-color: none;
      border: none;
      box-shadow: none;
      width : 100%;
    }
    .bootstrap-tagsinput input{
      width: 100%;
    }
  </style>
@stop
@section('content')
    <div class="breadcomb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcomb-list">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::select('bus_type', ['' => 'Chọn kiểu xe'] + $busTypes, null, ['class' => 'selectpicker', 'id' => 'bus_type']) !!}
                                </div>
                            </div>
                            @if(Gate::allows('root'))
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! Form::select('agent_id', $agents, null, ['class' => 'selectpicker', 'id' => 'filter_agent_id']) !!}
                                    </div>
                                </div>
                            @endif

                            @if(Gate::allows('admin'))
                                <div class="col-md-3">
                                <button class="btn btn-primary" type="button" onclick="showViewCreateBus()">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm mới
                                </button>
                                <button class="btn btn-danger" type="button" onclick="deleteManyRow()">
                                    <i class="fa fa-trash" aria-hidden="true"></i> Xóa
                                </button>
                                </div>
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
                            <h2>Danh sách xe</h2>
                            <p>
                                Dưới đây là danh sách các xe thuộc quyền quản lý của bạn
                            </p>
                        </div>
                        <div class="table-responsive">

                            <table class="table table-striped" id="bus_table">

                            </table>

                        </div>
                    </div>
                </div>
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
        var dataLocation = function (request, response) {
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
                success: function (data) {
                    response($.map(data.geonames, function (item) {
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
        $(document).ready(function () {
            $(window).keydown(function (event) {
                if ((event.keyCode == 13)) {
                    event.preventDefault();
                    return false;
                }
            });
            // $('.select2').select2({});
            $('#bus_type').add('#filter_agent_id').on('change', function () {
                busTable.ajax.reload();
            });

            $(document).on('click', '.add-image', function () {
                var html = $(".clone").html();
                $(".increment").after(html);
            });

            $(document).on("click", ".remove-image", function () {
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
        $(function () {
            busTable = $('#bus_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '{!! route('bus.datatable') !!}',
                    "data": function (d) {
                        d.bus_type_id = $('#bus_type').val();
                        d.agent_id = $('#filter_agent_id').val();
                    }
                },
                order: [1, 'asc'],
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        title: '',
                        searchable: false,
                        className: 'text-center delete-checkbox',
                        "orderable": false,
                        visible: visible,
                        render: function (data, type, row, meta) {
                            var checkbox = '<input type="checkbox" name="id[]" value="' + data + '">';
                            return checkbox;
                        }
                    },
                    {data: 'bus_name', name: 'bus_name', title: 'Tên xe'},
                    {data: 'bus_reg_number', name: 'bus_reg_number', title: 'Biển xe'},
                    {data: 'busType', name: 'busType.bus_type_name', title: 'Kiểu xe', orderable: false},
                    {data: 'number_seats', name: 'number_seats', title: 'Chỗ ngồi'},
                    {data: 'start_point', name: 'start_point', title: 'Điểm b.đầu'},
                    {data: 'end_point', name: 'end_point', title: 'Điểm k.thúc'},

                    {data: 'user.name', name: 'user.name', title: 'N.tạo'},
                    {data: 'userUpdate', name: 'userUpdate', title: 'N.cập nhật'},


                    {data: 'created_at', name: 'created_at', title: 'T.gian tạo'},
                    {data: 'updated_at', name: 'updated_at', title: 'T.gian cập nhật'},

                    {
                        data: 'start_time', name: 'start_time', title: 'T.gian k.hành',
                        render: function (data, type, row, meta) {
                            var element = data.split(":");
                            if (element.length > 2) {
                                return element[0] + ':' + element[1];
                            }
                            return data;
                        }
                    },

                    {
                        data: 'end_time', name: 'end_time', title: 'T.gian k.thúc',
                        render: function (data, type, row, meta) {
                            var element = data.split(":");
                            if (element.length > 2) {
                                return element[0] + ':' + element[1];
                            }
                            return data;
                        }
                    },
                    {data: 'agentName', name: 'agentName', title: 'Tên nhà xe', orderable: false},
                    {
                        data: 'id',
                        name: 'id',
                        title: 'Action',
                        searchable: false,
                        className: 'text-center',
                        "orderable": false,
                        visible: visible,
                        render: function (data, type, row, meta) {
                            var busId = "'" + data + "'";
                            var actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá ' + row['bus_name'] + '!" onclick="deleteBusById(' + busId + ')"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="showViewEditBus(' + busId + ')" data-toggle="tooltip" title="Sửa ' + row['bus_name'] + '!" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="showBusDetail(' + busId + ')" class="show-detail" data-toggle="tooltip" title="View detail" ><i class="fa fa-sign-in" aria-hidden="true"></i></a>';
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
                    }).success(function (data) {
                        console.log(data);
                        if (data.code == 200) {
                            swal(
                                'Đã Xoá!',
                                'Bạn đã xoá thành công người dùng!',
                                'success'
                            ).then(function () {
                                busTable.ajax.reload();
                            })
                        }
                        else {
                            swal(
                                'Thất bại',
                                'Thao tác thất bại',
                                'error'
                            ).then(function () {
                                busTable.ajax.reload();
                            })
                        }
                    }).error(function (data) {
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function () {
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
        function showBusDetail(id) {
            $.ajax({
                url: '{!! route('bus.index') !!}' + '/detail/' + id,
                method: 'GET'
            }).success(function (data) {
                $('#detailBusModal .modal-body').html(data).promise().done(function () {
                    var seatDetail = $('.detail_seat');
                    var leftSeat = seatDetail.attr('data-left-seat');
                    var leftTotalSeat = seatDetail.attr('data-left-total-seat');
                    var rightSeat = seatDetail.attr('data-right-seat');
                    var rightTotalSeat = seatDetail.attr('data-right-total-seat');
                    var residualSeat = seatDetail.attr('data-residual-seat');
                    var lastSeat = seatDetail.attr('data-last-seat');
                    var typeSeat = seatDetail.attr('data-type-seat');
                    var type = seatDetail.attr('data-type');
                    sleeperSeat = seatDetail.attr('data-sleeper-seat');
                    buildElementSeatHead($('.left_seat'), leftSeat, leftTotalSeat, 'left', typeSeat, type, sleeperSeat);
                    buildElementSeatHead($('.right_seat'), rightSeat, rightTotalSeat, 'right', typeSeat, type, sleeperSeat);
                    buildElementSeatResidual($('.residual_seat'), residualSeat, typeSeat, type, sleeperSeat);
                    buildElementSeatLast($('.last_seat'), lastSeat, typeSeat, type, sleeperSeat);
                });
            }).error(function (data) {

            });
            $("#detailBusModal").modal();
        }

        // show edit bus
        function showViewEditBus(id) {
            $.ajax({
                url: '{!! route('bus.index') !!}' + '/' + id + '/edit',
                method: 'GET'
            }).success(function (data) {
                $('#editBusModal .modal-body').html(data).promise().done(function () {
                    // $('#bus_type_id').select2({
                    //     placeholder: "Chọn Bus Type",
                    // });
                    // $('.select2-container--default').css({width: '100%'});
                    $('#bus_type_id').selectpicker();
                    $(".datetimepicker input").timepicker();

                    $('#amenities').tagsinput();

                    $("#start_point").autocomplete({
                        source: dataLocation,
                        minLength: 0,
                        delay: 0,
                        appendTo: ".wrap_location_start",
                        close: function () {
                            //UI plugin not removing loading gif, lets force it
                            $('#start_point').removeClass("ui-autocomplete-loading");
                        }
                    });

                    $("#end_point").autocomplete({
                        source: dataLocation,
                        minLength: 0,
                        delay: 0,
                        appendTo: ".wrap_location_end",
                        close: function () {
                            //UI plugin not removing loading gif, lets force it
                            $('#end_point').removeClass("ui-autocomplete-loading");
                        }
                    });

                    $('#frmEditBus').bootstrapValidator({
                        fields: {
                            bus_name: {
                                validators: {
                                    callback: {
                                        message: 'Tên xe đã tồn tại, nhập tên khác !',
                                        callback: function () {
                                            var busName = $('#bus_name').val();
                                            for (var key in busNames) {
                                                if (busNames.hasOwnProperty(key)) {
                                                    if (busNames[key] == busName) return false;
                                                }
                                            }
                                            return true;
                                        }
                                    }
                                }
                            },
                            bus_reg_number: {
                                validators: {
                                    callback: {
                                        message: 'Biển số xe đã tồn tại, nhập tên khác !',
                                        callback: function () {
                                            var busReg = $('#bus_reg_number').val();
                                            for (var key in busRegs) {
                                                if (busRegs.hasOwnProperty(key)) {
                                                    if (busRegs[key] == busReg) return false;
                                                }
                                            }
                                            return true;
                                        }
                                    }
                                }
                            },
                        }
                    });
                });
            }).error(function (data) {

            });
            $("#editBusModal").modal();
        }

        // show create bus
        function showViewCreateBus() {
            $.ajax({
                url: '{!! route('bus.create') !!}',
                method: 'GET'
            }).success(function (data) {
                $('#createBusModal .modal-body').html(data).promise().done(function () {
                    // $('#bus_type_id').select2({
                    //     placeholder: "Chọn Bus Type",
                    // });
                    // $('.select2-container--default').css({width: '100%'});

                    $(".datetimepicker input").timepicker();
                    $('#bus_type_id').selectpicker();
                    $('#amenities').tagsinput();

                    $("#start_point").autocomplete({
                        source: dataLocation,
                        minLength: 0,
                        delay: 0,
                        appendTo: ".wrap_location_start",
                        close: function () {
                            //UI plugin not removing loading gif, lets force it
                            $('#start_point').removeClass("ui-autocomplete-loading");
                        }
                    });

                    $("#end_point").autocomplete({
                        source: dataLocation,
                        minLength: 0,
                        delay: 0,
                        appendTo: ".wrap_location_end",
                        close: function () {
                            //UI plugin not removing loading gif, lets force it
                            $('#end_point').removeClass("ui-autocomplete-loading");
                        }
                    });

                    $('#frmCreateNewBus').bootstrapValidator({
                        fields: {
                            bus_name: {
                                validators: {
                                    callback: {
                                        message: 'Tên xe đã tồn tại, nhập tên khác !',
                                        callback: function () {
                                            var busName = $('#bus_name').val();
                                            for (var key in busNames) {
                                                if (busNames.hasOwnProperty(key)) {
                                                    if (busNames[key] == busName) return false;
                                                }
                                            }
                                            return true;
                                        }
                                    }
                                }
                            },
                            bus_reg_number: {
                                validators: {
                                    callback: {
                                        message: 'Biển số xe đã tồn tại, nhập tên khác !',
                                        callback: function () {
                                            var busReg = $('#bus_reg_number').val();
                                            for (var key in busRegs) {
                                                if (busRegs.hasOwnProperty(key)) {
                                                    if (busRegs[key] == busReg) return false;
                                                }
                                            }
                                            return true;
                                        }
                                    }
                                }
                            },
                        }
                    });
                });
            }).error(function (data) {
            });
            $("#createBusModal").modal();
        };

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
                        col1.append('<div class="col-md-12 no-padding"><div class="' + typeChange + '"></div></div>');
                    }
                    if (position == 'right') {
                        if (type == 3) {
                            col3.append('<div class="col-md-12 no-padding"><div class="' + typeChange + '"></div></div>');
                        } else {
                            col2.append('<div class="col-md-12 no-padding"><div class="' + typeChange + '"></div></div>');
                        }
                    }
                }
            }
            if (rowSeat == 2) {
                var rightChange = sleeper - totalSeat / 2;
                if (type == 3) {
                    for (var i = 1; i <= totalSeat / 2; i++) {
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
                            col1.append('<div class="col-md-12 no-padding"><div class="' + typeChangeLeft + '"></div></div>');
                            col2.append('<div class="col-md-12 no-padding"><div class="' + typeChangeRight + '"></div></div>');
                        }
                        if (position == 'right') {
                            col2.append('<div class="col-md-12 no-padding"><div class="' + typeChangeLeft + '"></div></div>');
                            col3.append('<div class="col-md-12 no-padding"><div class="' + typeChangeRight + '"></div></div>');
                        }
                    }
                } else {
                    for (var i = 1; i <= totalSeat / 2; i++) {
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
                        col1.append('<div class="col-md-12 no-padding"><div class="' + typeChangeLeft + '"></div></div>');
                        col2.append('<div class="col-md-12 no-padding"><div class="' + typeChangeRight + '"></div></div>');
                    }
                }

            }
            if (rowSeat == 3) {
                var middleChange = sleeper - totalSeat / 3;
                var rightChange = sleeper - totalSeat / 3 * 2;
                for (var i = 1; i <= totalSeat / 3; i++) {
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
                    col1.append('<div class="col-md-12 no-padding"><div class="' + typeChangeLeft + '"></div></div>');
                    col2.append('<div class="col-md-12 no-padding"><div class="' + typeChangeMiddle + '"></div></div>');
                    col3.append('<div class="col-md-12 no-padding"><div class="' + typeChangeRight + '"></div></div>');
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
                    element.append('<div class="custom-col-10"><div class="' + typeChange + '"></div></div>');
                } else {
                    element.append('<div class="custom-col-80"></div>');
                    element.append('<div class="custom-col-20"><div class="' + typeChange + '"></div></div>');
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
                    element.append('<div class="custom-col-14"><div class="' + typeChange + '"></div></div>');
                } else {
                    element.append('<div class="custom-col-20"><div class="' + typeChange + '"></div></div>');
                }
            }
        }

        // delete bus in checkbox
        function deleteManyRow() {
            var listBusId = [];
            $('input[type="checkbox"]').each(function () {
                if ($(this).prop('checked')) {
                    listBusId.push($(this).val());
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
                        url: '{!! route('bus.delete_multiple') !!}',
                        method: 'POST',
                        data: {data: listBusId}
                    }).success(function (data) {
                        console.log(data);
                        if (data.code == 200) {
                            swal(
                                'Đã Xoá!',
                                'Bạn đã xoá thành công người dùng!',
                                'success'
                            ).then(function () {
                                busTable.ajax.reload();
                            })
                        }
                        else {
                            swal(
                                'Thất bại',
                                'Thao tác thất bại',
                                'error'
                            ).then(function () {
                                busTable.ajax.reload();
                            })
                        }
                    }).error(function (data) {
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        ).then(function () {
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
    </script>
@stop
