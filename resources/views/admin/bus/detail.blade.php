<div class="row">
    <div class="col-md-12">
        <div class="box">

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
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

        <div class="box">
            <div class="box-header with-border margin-bottom-10">
                <h3 class="box-title">Hình ảnh xe</h3>
            </div>
            <div class="box-body">
                <div class="row custom_row">
                    @if ($busDetail->images->isEmpty())
                        <p>Không có hình ảnh xe</p>
                    @else
                        @foreach( $busDetail->images as $image )
                            <div class="col-md-4">
                                <img class="image_bus" src="{{ asset('images/' . $image->image_path) }}" alt="{{ $image->image_path }}">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>

        {{--view seat of bus--}}
        @if (!empty($layout))
        <div class="box">
            <div class="box-header with-border margin-bottom-10">
                <h3 class="box-title">Chi tiết ghế ngồi</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    @if ($layout['left_seat'] < 3 && $layout['right_seat'] < 3)
                        <div class="detail_seat col-md-6" data-left-seat="{{ $layout['left_seat'] }}" data-left-total-seat="{{ $layout['left_total_seat'] }}"
                             data-right-seat="{{ $layout['right_seat'] }}" data-right-total-seat="{{ $layout['right_total_seat'] }}"
                         data-residual-seat="{{ $layout['residual_seat'] }}" data-last-seat="{{ $layout['last_row_seat'] }}" data-type-seat="{{ $layout['seat_type'] }}" data-sleeper-seat="{{ $layout['sleeper_seat'] }}" data-type='1'>
                            <div class="row row-seat">
                                <div class="left_seat custom-col-40"></div>
                                <div class="custom-col-20"></div>
                                <div class="right_seat custom-col-40"></div>
                            </div>
                            <div class="residual_seat row row-seat"></div>
                            <div class="last_seat row row-seat"></div>
                        </div>
                    @else
                        <div class="detail_seat col-md-9" data-left-seat="{{ $layout['left_seat'] }}" data-left-total-seat="{{ $layout['left_total_seat'] }}"
                             data-right-seat="{{ $layout['right_seat'] }}" data-right-total-seat="{{ $layout['right_total_seat'] }}"
                             data-residual-seat="{{ $layout['residual_seat'] }}" data-last-seat="{{ $layout['last_row_seat'] }}" data-type-seat="{{ $layout['seat_type'] }}" data-sleeper-seat="{{ $layout['sleeper_seat'] }}" data-type='3'>
                            <div class="row row-seat">
                                <div class="left_seat custom-col-30"></div>
                                <div class="custom-col-10"></div>
                                <div class="right_seat custom-col-30"></div>
                            </div>
                            <div class="residual_seat row row-seat fix-width-70"></div>
                            <div class="last_seat row row-seat fix-width-70"></div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
        @endif
    </div>
</div>
