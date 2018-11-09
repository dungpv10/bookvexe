<section class="bg-search">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="widget widget-search has-bg">
                    <div class="widget-content">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="wrap-commitment">
                                    <h3 class="title"><i class="fa fa-suitcase"></i>Chúng tôi cam kết</h3>
                                    <ul>
                                        <li><i class="fa fa-check-circle"></i>Không tính phí phát sinh</li>
                                        <li><i class="fa fa-check-circle"></i>Không tính phí sửa đổi</li>
                                        <li><i class="fa fa-check-circle"></i>Hỗ trợ qua điện thoại 24/7</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12">
                                <form method="post" action="#" id="search-bus" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="start_point"><i class="fa fa-bus"></i>Điểm đi</label>
                                                <div class="input-group">
                                                    <input id="start_point" class="form-control geo_location" type="text" name="start_point"
                                                           value="" placeholder="Thành phố Hồ Chí Minh" required>
                                                    <i class="fa fa-map-marker"></i>
                                                </div>
                                                <div class="wrap_location_start"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="form-group datetime-picker">
                                                        <label for="start_time">Ngày khởi hành</label>
                                                        <div class="wrap-datetime">
                                                            <div class="input-group datepicker">
                                                                <input id="start_date" class="form-control" type="text" name="start_date" value="" required>
                                                                <i class="fa fa-calendar-alt"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6 col-sm-6">
                                                    <div class="form-group datetime-picker">
                                                        <label for="end_time">Ngày đến</label>
                                                        <div class="wrap-datetime">
                                                            <div class="input-group datepicker">
                                                                <input id="end_date" class="form-control" type="text" name="end_date" value="" required>
                                                                <i class="fa fa-calendar-alt"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="end_point"><i class="fa fa-bus"></i>Điểm đến</label>
                                                <div class="input-group">
                                                    <input id="end_point" class="form-control geo_location" type="text" name="end_point"
                                                           value="" placeholder="Thành phố Hà Nội" required>
                                                    <i class="fa fa-map-marker"></i>
                                                </div>
                                                <div class="wrap_location_end"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="number_customer">Số người</label>
                                                {!! Form::select('number_customer', [1,2,3,4], null, ['class' => 'form-control select2', 'id' => 'number_customer']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="agreer-checkbox">
                                                <label class="form-check-label" for="agreer-checkbox">Tôi đồng ý đặt xe</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row action">
                                        <div class="col-md-3 col-sm-4">
                                            <button type="submit" class="button button-submit">Tìm Kiếm</button>
                                        </div>
                                        <div class="col-md-9 col-sm-8">
                                            <p class="hight-line">Giảm tới 15% *</p>
                                            <p>Khi đặt vé khứ hồi cùng thời gian</p>
                                            <p class="margin-top-10">* Áp dụng từ 19/10/2014</p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <img class="icon-image" src="{{ asset('img/front-end/icon-widget.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
