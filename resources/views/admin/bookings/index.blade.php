@extends('admin.layouts.dashboard')

@section('content')
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::select('status', $statuses, '', ['class' => 'form-control filter_status', 'id' => 'filter_status']) !!}
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


            <div class="modal fade" id="changeProcessStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thay đổi trạng thái</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::select('status', $statuses, '', ['class' => 'form-control filter_status', 'id' => 'booking_status']) !!}
                        {!! Form::hidden('booking_id', '', ['class' => 'booking_id']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="updateStatus">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>




@stop
@section('js')
    <script type="text/javascript">
        $(function () {
            var filterStatus = $('#filter_status');
            $('.filter_status').select2();
            $('.select2-container--default').css({width: '100%'});

            var bookingTable = $('#booking_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! route('bookings.json_data') !!}',
                    data: function (d) {
                        d.status = filterStatus.val()
                    }
                },
                columns: [
                    {data: 'id', name: 'id', title: 'ID'},
                    {data: 'customer.customer_name', name: 'customer.customer_name', title: 'Tên khách hàng'},
                    {data: 'bus.bus_name', name: 'bus.bus_name', title: 'Tên xe'},
                    {data: 'pickup_point', name: 'pickup_point', title: 'Điểm đón'},
                    {data: 'drop_point', name: 'drop_point', title: 'Điểm trả'},
                    {data: 'created_at', name: 'created_at', title: 'Thời gian đặt'},
                    {data: 'amount', name: 'amount', title: 'Tiền vé'},
                    {data: 'board_time', name: 'board_time', title: 'Thời gian đón'},
                    {data: 'drop_time', name: 'drop_time', title: 'Thời gian trả'},
                    {data: 'payment_status', name: 'payment_status', title: '', visible: false},
                    {
                        data: 'status_name',
                        name: 'status_name',
                        title: 'Trạng thái',
                        sortable: false,
                        render: function (data, type, row, meta) {
                            var paymentStatus = row['payment_status'];
                            var classBtn = paymentStatus == 0 ? 'btn-default'
                                : (paymentStatus == 1 ? 'btn-primary' : (paymentStatus == 2 ? 'btn-success' : 'btn-danger'));
                            return '<button data-id="' + row['id'] + '" data-status="' + paymentStatus + '" class="btn ' + classBtn + '" data-toggle="modal" data-target="#changeProcessStatus">' +
                                '<i class="fa fa-2x fa-pencil-square-o"></i> ' + row['status_name'] +
                                '</button>';
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        title: 'Action',
                        searchable: false,
                        className: 'text-center',
                        "orderable": false,
                        render: function (data, type, row, meta) {
                            return '<a style="cursor: pointer" data-toggle="modal" data-target="#viewBooking" data-id=' + row['id'] + '>' +
                                '<i class="fa fa-2x fa-eye" aria-hidden="true"></i>' +
                                '</a>';
                        }
                    }
                ]
            });
            filterStatus.on('change', function () {
                bookingTable.ajax.reload();
            });


            $('#viewBooking').on('shown.bs.modal', function (e) {
                var fillData = function (data) {
                    $('#customer_name').html(data.customer.customer_name);
                    $('#customer_age').html(data.customer.age);
                    $('#customer_gender').html(data.customer.gender_name);
                    $('#customer_position').html(data.seat_number);
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

            var changeProcessStatus = $('#changeProcessStatus'),
                bookingId = $('.booking_id'),
                bookingStatus = $('#booking_status');

            changeProcessStatus.on('shown.bs.modal', function(e){
                var relatedTarget = $(e.relatedTarget);
                bookingId.val(relatedTarget.data('id'));
                bookingStatus.select2().select2('val', relatedTarget.data('status'));
            });

            $('#updateStatus').on('click', function (e) {
                var status = $('#booking_status').val(), id = $('.booking_id').val();

                $.ajax({
                    method : 'POST',
                    url : window.location.origin + '/admin/bookings/update-status/' + id,
                    data : {status : status}
                })
                    .done(function(response){
                    console.log(response);
                    changeProcessStatus.modal('hide');
                    bookingTable.ajax.reload();
                })
                    .fail(function(error){
                        swal(
                            'Thất bại',
                            'Thao tác thất bại',
                            'error'
                        );
                });
            });
        });
    </script>
@stop
