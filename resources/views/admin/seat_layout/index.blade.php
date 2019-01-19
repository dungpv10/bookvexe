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
                                    {!! Form::select('bus', $bus, Session::has('busId') ? Session::get('busId') : null, ['class' => 'selectpicker', 'id' => 'bus']) !!}
                                </div>
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
                            <h2>Quản lý ghế ngồi trên xe</h2>
                            <p>
                                Dưới đây là quản lý chỗ ngồi trên xe
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="seat_setup_bus">
                                    <form action="{{ route('layout_bus.update') }}" class="update_seat" id="update_seat" method="post">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" id="bus_id" name="bus_id" value="">
                                        <div class="form-group">
                                            <label for="seat_type">Kiểu ghế</label>
                                            <div class="nk-int-st">
                                                {!! Form::select('seat_type_id', config('bus.seat_type'), null, ['class' => 'selectpicker', 'id' => 'seat_type_id']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sleeper_seat">Số ghế ngủ</label>
                                            <div class="nk-int-st">
                                            <input id="sleeper_seat" class="form-control" type="text" name="sleeper_seat"
                                                   value="" placeholder="Số ghế ngủ" required>
                                                 </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="total_seat">Tổng số ghế</label>
                                            <div class="nk-int-st">
                                            <input id="total_seat" class="form-control" type="text" name="total_seat"
                                                   value="" placeholder="Tổng số ghế" required>
                                                 </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="layout_id">Kiển hiện thị</label>
                                            <div class="nk-int-st">
                                                {!! Form::select('layout_id', config('bus.layout_type'), null, ['class' => 'selectpicker', 'id' => 'layout_id']) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="last_row_seat">Số ghế cuối cùng</label>
                                            <div class="nk-int-st">
                                            <input id="last_row_seat" class="form-control" type="text" name="last_row_seat"
                                                   value="" placeholder="Số ghế cuối cùng" required>
                                                 </div>
                                        </div>
                                        <button class="btn btn-primary waves-effect" type="submit">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Cập nhật
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="seat_show" id="seat_container">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop
@section('js')
    <script type="text/javascript">
        var layoutList = {
            0 :'1 x 1',
            1 :'1 x 2',
            3 :'2 x 1',
            4 :'2 x 2',
            5 :'2 x 3'
        };
        var seatTypeList = {
            0 :'seater',
            1 :'sleeper',
            2 :'seater',
        };
        $( document ).ready(function() {
            var busId = $("#bus").val();
            if (busId) {
                callAjax(busId);
            }
        });
        $('#bus').on('change', function () {
            var busId = $('#bus').val();
            $("#bus_id").val(busId);
            if (busId) {
                callAjax(busId);
            }
        });
        $('#seat_type_id, #sleeper_seat, #total_seat, #layout_id, #last_row_seat').on('change', function(){
            dataForm = $('#update_seat').serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});
            convertLayout(dataForm);
        });

        function callAjax(busId) {
            $.ajax({
                url: '{!! route('layout_bus.index') !!}' + '/' + busId,
                method: 'GET'
            }).success(function (data) {
                setDataToForm(data.seatData);
                setLayout(data.convertLayout);
            }).error(function (data) {

            });
        }

        function convertLayout(dataForm) {
            var result = [];
            result['last_row_seat'] = dataForm.last_row_seat;
            result['seat_type'] = seatTypeList[dataForm.seat_type_id];
            totalSeat = dataForm.total_seat - dataForm.last_row_seat;
            layout = layoutList[dataForm.layout_id].split("x");
            result['residual_seat'] = totalSeat % (parseInt(layout[0]) + parseInt(layout[1]));
            result['left_seat'] = parseInt(layout[0]);
            result['right_seat'] = parseInt(layout[1]);
            result['left_total_seat'] = (totalSeat - result['residual_seat']) / (parseInt(layout[0]) + parseInt(layout[1])) * parseInt(layout[0]);
            result['right_total_seat'] = (totalSeat - result['residual_seat']) / (parseInt(layout[0]) + parseInt(layout[1])) * parseInt(layout[1]);
            result['sleeper_seat'] = dataForm.sleeper_seat;
            setLayout(result);

        }

        function setDataToForm(seatData) {
            $('#seat_type_id').val(seatData.seat_type_id);
            $('#sleeper_seat').val(seatData.sleeper_seat);
            $('#total_seat').val(seatData.total_seat);
            $('#layout_id').val(seatData.layout_id);
            $('#last_row_seat').val(seatData.last_row_seat);
            $('#seat_type_id').selectpicker('refresh');
            $('#layout_id').selectpicker('refresh');
        }
        function setLayout(layoutData) {
            var type = 1;
            if (layoutData.left_seat < 3 && layoutData.right_seat < 3) {
                $('#seat_container').html('<div class="detail_seat col-md-6"><div class="row row-seat">'
                        +'<div class="left_seat custom-col-40"></div>'
                        +'<div class="custom-col-20"></div>'
                        +'<div class="right_seat custom-col-40"></div>'
                        +'</div>'
                        +'<div class="residual_seat row row-seat"></div>'
                        +'<div class="last_seat row row-seat"></div>'
                        +'</div>');
            } else {
                $('#seat_container').html('<div class="detail_seat col-md-9"><div class="row row-seat">'
                        +'<div class="left_seat custom-col-30"></div>'
                        +'<div class="custom-col-10"></div>'
                        +'<div class="right_seat custom-col-30"></div>'
                        +'</div>'
                        +'<div class="residual_seat row row-seat fix-width-70"></div>'
                        +'<div class="last_seat row row-seat fix-width-70"></div>'
                        +'</div>');
                type = 3;
            }
            var leftSeat = layoutData.left_seat;
            var leftTotalSeat = layoutData.left_total_seat;
            var rightSeat = layoutData.right_seat;
            var rightTotalSeat = layoutData.right_total_seat;
            var residualSeat = layoutData.residual_seat;;
            var lastSeat = layoutData.last_row_seat;
            var typeSeat = layoutData.seat_type;
            sleeperSeat = layoutData.sleeper_seat;
            buildElementSeatHead($('.left_seat'), leftSeat, leftTotalSeat, 'left', typeSeat, type, sleeperSeat);
            buildElementSeatHead($('.right_seat'), rightSeat, rightTotalSeat, 'right', typeSeat, type, sleeperSeat);
            buildElementSeatResidual($('.residual_seat'), residualSeat, typeSeat, type, sleeperSeat);
            buildElementSeatLast($('.last_seat'), lastSeat, typeSeat, type, sleeperSeat);
        }

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

    </script>
@stop