@extends('admin.layouts.dashboard')
@section('css')

    <link href='/vendors/fullcalendar/css/fullcalendar.min.css' rel='stylesheet' />
    <link href='/vendors/fullcalendar/css/fullcalendar.print.css' rel='stylesheet' media='print' />
    <style>
        .fc-day-grid-event{
            text-align:center;
        }
    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css"
          rel="stylesheet"/>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header with-border margin-bottom-10">
                    <h3 class="box-title">Quản lý khởi hành</h3>
{{--                    @if(\Gate::allows('agent'))--}}
                    <button type="button" class="btn btn-primary" id="createInitializeBtn">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                    </button>
                    {{--@endif--}}
                </div>
                <table class="table table-bordered" id="initialize_table">

                </table>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border margin-bottom-10">
                <h3 class="box-title">Lịch khởi hành</h3>
            </div>
            <div id='calendar'></div>

        </div>
    </div>


    <div class="modal fade" id="changeBus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chọn xe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" value="" id = "initialize_id"/>
                        {!! Form::select('driver_id', $buses, '', ['class' => 'form-control select2', 'id' => 'bus_id']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="updateBusId">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createInitializeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            {!! Form::open(['route' => 'initializes.store', 'id' => '', 'method' => 'POST']) !!}
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo mới giờ khởi hành</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="initialize_name">Tên chuyến</label>
                        {!! Form::text('initialize_name', '', ['class' => 'form-control', 'id' => 'initialize_name']) !!}
                    </div>
                    <div class="form-group">
                        <label for="start_time">Giờ khởi hành</label>
                        {!! Form::text('start_time', '', ['class' => 'form-control datepicker']) !!}
                    </div>
                    <div class="form-group">
                        <label for="number_customer">Số khách hàng</label>
                        {!! Form::number('number_customer', '', ['class' => 'form-control', 'id' => 'number_customer']) !!}
                    </div>

                    <div class="form-group">
                        <label for="driver_id">Lái xe</label>
                        {!! Form::select('driver_id', $allUserOfAgent, '', ['class' => 'form-control select2']) !!}

                    </div>

                    <div class="form-group">
                        <label for="car_accessory_id">Phụ xe</label>

                        {!! Form::select('car_accessory_id', $allUserOfAgent, '', ['class' => 'form-control select2']) !!}
                    </div>

                    <div class="form-group">
                        <label for="bus_id">Chọn xe</label>
                        {!! Form::select('bus_id', $buses, '', ['class' => 'form-control select2']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary" id="updateBusId">Cập nhật</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('js')

    <script src='/vendors/fullcalendar/moment.min.js'></script>
    <script src='/vendors/fullcalendar/fullcalendar.min.js'></script>

    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"--}}
            {{--type="text/javascript"></script>--}}
    <script type="text/javascript">
        $('.datepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        var initializeTable = $('#initialize_table'), initializeDataTable, createInitializeModal = $('#createInitializeModal'),createInitializeBtn = $('#createInitializeBtn');
        $(document).ready(function() {

            createInitializeBtn.on('click', function(){
                createInitializeModal.modal('show');
            });

            $('.select2').select2();
            $('.select2-container--default').css({width: '100%'});

            var busIdElm = $('#bus_id'), initializeId = $('#initialize_id'), changeBusModal = $('#changeBus');
            changeBusModal.on('shown.bs.modal', function(e){
                var relatedTarget = $(e.relatedTarget);

                busIdElm.val(relatedTarget.data('bus_id'));
                initializeId.val(relatedTarget.data('id'));
                busIdElm.select2().select2('val', relatedTarget.data('bus_id'));
            });



            initializeDataTable = initializeTable.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('initializes.getJsonData') !!}'
                },

                columns: [
                    { data: 'id', name: 'id', searchable: true, title: 'Mã khởi hành' },
                    { data: 'bus.bus_name', name: 'bus.bus_name', searchable: true, title: '', visible: false },

                    { data: 'bus_name', name: 'bus_name', title: 'Xe', sortable: false, searchable: false,
                        render: function(data, type, row, meta){
                            return '<button data-id=' + row['id'] + ' data-bus_id = ' + row['bus_id'] + ' data-toggle="modal" data-target="#changeBus" class="btn btn-default">' + row['bus']['bus_name'] + '</button>';
                        }
                    },
                    { data: 'initialize_name', name: 'initialize_name', title: 'Tên hành trình' },
                    { data: 'number_customer', name: 'number_customer', title: 'Số lượng khách' },
                    { data: 'start_time', name: 'start_time', title: 'Giờ khởi hành' },
                    { data: 'user.name', name: 'user.name', title: 'Nhân viên tạo'},
                    { data: 'driver.name', name: 'driver.name', title: 'Lái xe'},

                    { data: 'accessory.name', name: 'accessory.name', title: 'Lơ xe'},
                    { data: 'status_name', name: 'status_name', title: 'Trạng thái'},
                    { data: 'bus_id', name: 'bus_id', title: 'Lơ xe', visible: false},

                    {data : 'action', name: 'action', searchable: false, orderable: false, title: 'Thao tác',
                        render: function(data, type, row, meta){
                            var initializeId = row['id'];
                            var actionLink = '<a href="javascript:;" data-toggle="tooltip" title="Xoá '+ row['boardingPoint'] +'!" onclick="deleteInitialize('+ initializeId +')"><i class=" fa-2x fa fa-trash" aria-hidden="true"></i></a>';
                            actionLink += '&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="editInitialize('+ initializeId +')" data-toggle="tooltip" title="Sửa '+ row['initialize_name'] +'!" ><i class="fa fa-2x fa-pencil-square-o" aria-hidden="true"></i></a>';
                            return actionLink;
                        }
                    }

                ]
            });


            var updateBusId = $('#updateBusId');



            updateBusId.on('click', function(e){
                e.preventDefault();

                $.ajax({
                    method: 'PUT',
                    url : "{{ route('initializes.index') }}/" + initializeId.val(),
                    data: {
                        bus_id: busIdElm.val()
                    }
                }).done(function(response){
                    if(response.code === 200){
                        changeBusModal.modal('hide');
                        initializeDataTable.ajax.reload();

                    }else{
                        actionFail();
                    }

                }).fail(function(error){
                    actionFail();
                });
            });

            function getCurrentDate(){
                var date = new Date();
                var currentYear = date.getFullYear();
                var currentMonth = date.getMonth() + 1;
                var currentDay = date.getDate();

                return currentYear + '-' + (currentMonth < 10 ? '0' + currentMonth : currentMonth) + '-' + (currentDay < 10 ? '0' + currentDay : currentDay);
            }
            var getEventRoute = "{{ route('initializes.get_events') }}";
            var events = [];

            $.ajax({
                method: 'GET',
                url : getEventRoute
            }).done(function(data){
                events = data.events;
                var eventObj = [];
                events.forEach(function(event){
                    eventObj.push(event);
                });
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,basicWeek,basicDay'
                    },
                    defaultDate: getCurrentDate(),
                    navLinks: true, // can click day/week names to navigate views
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    events: eventObj,
                    eventRender: function(event, element) {
                        element.popover({
                            trigger: "click",
                            container:'body',
                            content: '<div style="z-index: 999999">' + event.description + '</div>',
                            html : true,
                            placement: 'bottom'
                        });
                        element.find('span.fc-event-title').html(element.find('span.fc-event-title').text());

                    }
                });
            }).fail(function(error){
                actionFail();
            });

        });

        var actionFail = function(){
            swal(
                'Thất bại',
                'Thao tác thất bại',
                'error'
            ).then(function(){
                initializeDataTable.ajax.reload();
            })
        };

        var deleteInitialize = function(initializeId){
            swal({
                title: "Bạn có muốn xóa?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonText: 'Bỏ qua',
                confirmButtonText: "Đồng ý",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '{!! route('initializes.index') !!}' + '/' + initializeId,
                        method: 'DELETE'
                    }).success(function(data){
                        if(data.code == 200)
                        {
                            swal(
                                'Đã Xoá!',
                                'Bạn đã xoá thành công người dùng!',
                                'success'
                            ).then(function(){
                                initializeDataTable.ajax.reload();
                            })
                        }
                        else {
                            swal(
                                'Thất bại',
                                'Thao tác thất bại',
                                'error'
                            ).then(function(){
                                initializeDataTable.ajax.reload();
                            })
                        }
                    }).error(function(data){
                        actionFail();
                    });
                } else if (result.dismiss === 'cancel') {
                    swal(
                        'Bỏ Qua',
                        'Bạn đã không xoá nữa',
                        'error'
                    )
                }
            });
        };

        var editInitialize = function(initializeId){

        }
    </script>
@stop
