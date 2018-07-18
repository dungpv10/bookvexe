<div class="row">
    <div class="col-md-12">
        <div class="box">

            <div class="box-body">
                <div class="table-responsive-sm">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                        <tr>
                            <th scope="col">Tên xe bus</th>
                            <th scope="col">Kiểu xe buýt</th>
                            <th scope="col">Biển đăng ký buýt</th>
                            <th scope="col">Chỗ ngồi</th>
                            <th scope="col">Điểm bắt đầu</th>
                            <th scope="col">Điểm kết thúc</th>
                            <th scope="col">Thời gian bắt đầu</th>
                            <th scope="col">Thời gian kết thúc</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Dịch vụ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $busDetail->bus_name }}</td>
                            <td>{{ $busTypes[$busDetail->bus_type_id] }}</td>
                            <td>{{ $busDetail->bus_reg_number }}</td>
                            <td>{{ $busDetail->number_seats }}</td>
                            <td>{{ $busDetail->start_point }}</td>
                            <td>{{ $busDetail->end_point }}</td>
                            <td>{{ $busDetail->start_time }}</td>
                            <td>{{ $busDetail->end_time }}</td>
                            <td>{{ $busDetail->busType->status }}</td>
                            <td>{{ $busDetail->created_at }}</td>
                            <td>{{ $busDetail->amenities }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
