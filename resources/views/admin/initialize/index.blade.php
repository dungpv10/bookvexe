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

    <div class="col-md-12">
        <div class="box">
            <div id='calendar'></div>

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

@stop
@section('js')

    <script src='/vendors/fullcalendar/moment.min.js'></script>
    <script src='/vendors/fullcalendar/fullcalendar.min.js'></script>

    <script>

        $(document).ready(function() {

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
                            title: '<div style="z-index: 999999">' + event.title + '</div>',
                            html : true,
                            placement: 'bottom',
                            content: event.description,
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
