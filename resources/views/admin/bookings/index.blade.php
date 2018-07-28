@extends('admin.layouts.dashboard')

@section('content')
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::select('status', $statuses, '', ['class' => 'form-control', 'id' => 'filter_status']) !!}
        </div>
    </div>
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border margin-bottom-10">
                <h3 class="box-title">Bookings</h3>

            </div>
            <div class="table-responsive">

                <table class="table table-bordered " id="booking_table">

                </table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="viewBooking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xem thông tin booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Tên Khách hàng</th>
                            <th>Tuổi</th>
                            <th>Giới tính</th>
                            <th>Vị trí ghế</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td id="customer_name"></td>
                            <td id="customer_age"></td>
                            <td id="customer_gender"></td>
                            <td id="customer_position"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>


@stop
@section('js')
    <script type="text/javascript">
        $('#filter_status').select2();
        $(function () {
            var bookingTable = $('#booking_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('bookings.json_data') !!}',
                    data: {status: $('#filter_status').val()}
                },
                columns: [
                    {data: 'id', name: 'id', title: 'ID'},
                    {data: 'customer.customer_name', name: 'customer.customer_name', title: 'Tên khách hàng'},
                    {data: 'bus.bus_name', name: 'bus.bus_name', title: 'Tên xe'},
                    {data: 'pickup_point', name: 'pickup_point', title: 'Điểm đón'},
                    {data: 'drop_point', name: 'drop_point', title: 'Điểm trả'},
                    {data: 'status_name', name: 'status_name', title: 'Trạng thái'},
                    {data: 'created_at', name: 'created_at', title: 'Thời gian đặt'},
                    {data: 'amount', name: 'amount', title: 'Tiền vé'},
                    {data: 'board_time', name: 'board_time', title: 'Thời gian đón'},
                    {data: 'drop_time', name: 'drop_time', title: 'Thời gian trả'},
                    {
                        data: 'id',
                        name: 'id',
                        title: 'Action',
                        searchable: false,
                        className: 'text-center',
                        "orderable": false,
                        render: function (data, type, row, meta) {
                            return '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#viewBooking" data-id=' + row['id'] + '>' +
                                '<i class="fa fa-2x fa-eye" aria-hidden="true"></i>' +
                                '</button>';
                        }
                    }
                ]
            });
        });

        $('#viewBooking').on('shown.bs.modal', function (e) {
            var fillData = function (data) {
                $('#customer_name').html(data.original.data.customer.customer_name);
                $('#customer_age').html(data.original.data.customer.age);
                $('#customer_gender').html(data.original.data.customer.gender_name);
                $('#customer_position').html(data.original.data.seat_number);
            };
            var id = $(e.relatedTarget).data('id');
            $.ajax({
                method: 'GET',
                url: window.location.origin + '/admin/bookings/' + id
            }).done(function (response) {
                fillData(response.data);
            }).fail(function (error) {
                console.log(error);
            });
        });

    </script>
@stop
