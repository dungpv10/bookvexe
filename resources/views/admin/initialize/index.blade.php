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

@stop
@section('js')

    <script src='/vendors/fullcalendar/moment.min.js'></script>
    <script src='/vendors/fullcalendar/fullcalendar.min.js'></script>

    <script>

        $(document).ready(function() {

            var getAllBus = function(callback, id, index){
                $.ajax({
                    method: 'get',
                    data: {},
                    url: "{{route('bus.all')}}"
                }).done(function(response){
                    if(response.code === 200){
                        var html = '<select class="form-control select2" id=row_' + index + '>';
                        response.data.map(function(bus){
                            return html += '<option value=' + bus.id + '>' + bus.bus_name + '</option>';
                        });
                        html += '</select>';

                        callback(html, id, index);

                        $('.select2').select2();
                        $('.select2-container--default').css({width: '100%'});
                    }
                }).fail(function(error){
                    console.log('error', error)
                });
            };

            var initializeTable = $('#initialize_table'), initializeDataTable;

            initializeDataTable = initializeTable.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('initializes.getJsonData') !!}',
                    data: function(d){}
                },
                initComplete : function(settings, json){
                    json.data.map(function(row, index){
                        var row = row['bus_id'];
                        index++;
                        return getAllBus(function(html, row, index){
                            var chooseBus = $('#choose_bus_' + index);
                            chooseBus.html(html);
                            chooseBus.select2().select2('val', row);
                            $('#row_' + index );
                        },row['bus_id'], index);
                    });

                },
                columns: [
                    { data: 'id', name: 'id', searchable: true, title: 'Mã khởi hành' },
                    { data: 'id', name: 'id', title: 'Xe', sortable: false, searchable: false,
                        render: function(data, type, row, meta){
                            return '<div id="choose_bus_' + data + '"></div>';
                        }
                    },
                    { data: 'initialize_name', name: 'initialize_name', title: 'Tên hành trình' },
                    { data: 'number_customer', name: 'number_customer', title: 'Số lượng khách' },
                    { data: 'start_time', name: 'start_time', title: 'Giờ khởi hành' },
                    { data: 'user.name', name: 'user.name', title: 'Nhân viên tạo'},
                    { data: 'driver.name', name: 'driver.name', title: 'Lái xe'},

                    { data: 'accessory.name', name: 'accessory.name', title: 'Lơ xe'},
                    { data: 'bus_id', name: 'bus_id', title: 'Lơ xe', visible: false},



                ]
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
                console.log(error);
            });

        });

    </script>
@stop
