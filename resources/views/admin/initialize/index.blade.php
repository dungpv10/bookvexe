@extends('admin.layouts.dashboard')
@section('css')

    <link href='/vendors/fullcalendar/css/fullcalendar.min.css' rel='stylesheet' />
    <link href='/vendors/fullcalendar/css/fullcalendar.print.css' rel='stylesheet' media='print' />
    <style>
        .fc-day-grid-event{
            text-align:center;
        }
    </style>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header with-border margin-bottom-10">
                    <h3 class="box-title">Quản lý khởi hành</h3>
                    <button type="button" class="btn btn-primary" id="createAgentBtn">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>Thêm mới
                    </button>
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
                        <select class="form-control select2" id="bus_id">
                            <option value="">Chọn xe</option>
                            @foreach($buses as $bus)
                                <option value="{{ $bus->id }}">{{ $bus->bus_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="updateBusId">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>


@stop
@section('js')

    <script src='/vendors/fullcalendar/moment.min.js'></script>
    <script src='/vendors/fullcalendar/fullcalendar.min.js'></script>

    <script>
        var initializeTable = $('#initialize_table'), initializeDataTable;
        $(document).ready(function() {

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
