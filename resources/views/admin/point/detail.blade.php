<div class="row">
    <div class="col-md-12">
        <div class="box">

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Tên xe</th>
                            <th scope="col">Tên tuyến đường</th>
                            <th scope="col">Kiểu điểm dừng</th>
                            <th scope="col">Điểm lên xe</th>
                            <th scope="col">Điểm xuống xe</th>
                            <th scope="col">Thời gian bắt đầu</th>
                            <th scope="col">Thời gian giảm</th>
                            <th scope="col">Dấu đất</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Giá</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $point->route->bus->bus_name }}</td>
                            <td>{{ $point->route->route_name }}</td>
                            <td>{{ $point->pointType->point_type_name }}</td>
                            <td>{{ $point->route->from_place }}</td>
                            <td>{{ $point->route->arrived_place }}</td>
                            <td>{{ $point->route->start_time }}</td>
                            <td>{{ $point->drop_time }}</td>
                            <td>{{ $point->landmark }}</td>
                            <td>{{ $point->address }}</td>
                            <td>{{ $point->route->price }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>