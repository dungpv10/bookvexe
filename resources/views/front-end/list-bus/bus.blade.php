@extends('front-end/layouts/layouts')
@section('content')
	<section class="bg-section section-page-list-bus">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 side-bar">
					<div class="widget widget-search has-bg">
						<div class="widget-content">
							<form method="post" action="#" id="search-bus" enctype="multipart/form-data">
            					<input type="hidden" name="_token" value="{{csrf_token()}}">
					            <div class="row">
					                <div class="col-md-12 col-sm-6">
					                    <div class="form-group">
					                        <label for="start_point"><i class="fa fa-bus"></i>Điểm đi</label>
					                        <div class="input-group">
					                        	<input id="start_point" class="form-control geo_location" type="text" name="start_point"
                               value="" placeholder="Thành phố Hồ Chí Minh" required>
                               					<i class="fa fa-map-marker"></i>
                           					</div>
                               				<div class="wrap_location_start"></div>
					                    </div>
					                </div>
					                <div class="col-md-12 col-sm-6">
					                	<div class="form-group">
					                        <label for="end_point"><i class="fa fa-bus"></i>Điểm đến</label>
					                        <div class="input-group">
					                        	<input id="end_point" class="form-control geo_location" type="text" name="end_point"
                               value="" placeholder="Thành phố Hà Nội" required>
                               					<i class="fa fa-map-marker"></i>
                           					</div>
                               				<div class="wrap_location_end"></div>
					                    </div>
					                </div>
			                    	<div class="col-md-12 col-sm-6">
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
			                    	<!-- <div class="col-md-12 col-sm-3">
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
			                    	<div class="col-md-12 col-sm-6">
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
					            	<div class="col-md-12 col-sm-4">
					            		<button type="submit" class="button button-submit">Tìm Kiếm</button>
					            	</div>
					            	<div class="col-md-12 col-sm-8">
					            		<p class="hight-line">Giảm tới 15% *</p>
					            		<p>Khi đặt vé khứ hồi cùng thời gian</p>
					            		<p class="margin-top-10">* Áp dụng từ 19/10/2014</p>
					            	</div>
					            </div>
					        </form>
						    <img class="icon-image" src="{{ asset('img/front-end/icon-widget.png') }}" alt="">
						</div>
					</div>
					<div class="widget widget-filter active">
						<div class="widget-title">
							<h2 class="title style-1">Bộ Lọc Tìm Kiếm theo</h2>
							<span class="show-hidden active"></span>
						</div>
						<div class="widget-content active">
							<form method="post" action="#" id="filter-bus" enctype="multipart/form-data">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<div class="wrap-filter-type">
									<p class="type">Giá</p>
									<div class="form-check">
									    <input type="checkbox" class="form-check-input" id="price-low">
									    <label class="form-check-label" for="price-low">Thấp nhất trước</label>
									</div>
									<div class="form-check">
									    <input type="checkbox" class="form-check-input" id="price-high">
									    <label class="form-check-label" for="price-high">Cao nhất trước</label>
									</div>
								</div>
								<div class="wrap-filter-type">
									<p class="type">Sao đánh giá</p>
									<div class="form-check">
									    <input type="checkbox" class="form-check-input" id="star-1">
									    <label class="form-check-label" for="star-1">1 sao</label>
									</div>
									<div class="form-check">
									    <input type="checkbox" class="form-check-input" id="star-2">
									    <label class="form-check-label" for="star-2">2 sao</label>
									</div>
									<div class="form-check">
									    <input type="checkbox" class="form-check-input" id="star-3">
									    <label class="form-check-label" for="star-3">3 sao</label>
									</div>
									<div class="form-check">
									    <input type="checkbox" class="form-check-input" id="star-4">
									    <label class="form-check-label" for="star-4">4 sao</label>
									</div>
									<div class="form-check">
									    <input type="checkbox" class="form-check-input" id="star-5">
									    <label class="form-check-label" for="star-5">5 sao</label>
									</div>
									<div class="form-check">
									    <input type="checkbox" class="form-check-input" id="star-0">
									    <label class="form-check-label" for="star-0">Không đánh giá</label>
									</div>
								</div>
								<div class="wrap-filter-type">
									<p class="type">Điểm đáng giá</p>
									<div class="form-check">
									    <input type="checkbox" class="form-check-input" id="point-9">
									    <label class="form-check-label" for="point-9">Tuyệt vời: 9+</label>
									</div>
									<div class="form-check">
									    <input type="checkbox" class="form-check-input" id="point-8">
									    <label class="form-check-label" for="point-8">Rất tốt: 8+</label>
									</div>
									<div class="form-check">
									    <input type="checkbox" class="form-check-input" id="point-7">
									    <label class="form-check-label" for="point-7">Tốt: 7+</label>
									</div>
									<div class="form-check">
									    <input type="checkbox" class="form-check-input" id="point-6">
									    <label class="form-check-label" for="point-6">Hài lòng: 6+</label>
									</div>
									<div class="form-check">
									    <input type="checkbox" class="form-check-input" id="point-5">
									    <label class="form-check-label" for="point-5">Không đánh giá</label>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-9">
					<div class="widget widget-list-bus">
						<p class="result_search">Tuyến Tp. Hồ Chí Minh - Hanoi: 1,209 kết quả - bao gồm 296  kết quả với giá tốt nhất !</p>
						<ul class="filter-type-best">
							<li class="clear-fix">
								<a class="active" href="#" title="">Giá tốt nhất</a>
								<a href="#" title="">Được đánh giá tốt nhất</a>
								<a href="#" title="">Nhiều sao nhất</a>
								<a href="#" title="">Giá thấp nhất</a>
							</li>
						</ul>
						<div class="notice-success">
							<span>Hôm nay chhỉ có một số nhà xe có giá vé cực thấp</span>
							<a href="" class="show-notice" title="">Hiển thị</a>
							<i class="fa fa-times close-notice"></i>
						</div>
						<div class="entry-item-bus clear-fix">
							<div class="entry-thumb">
								<a href="#" title=""><img src="{{ asset('img/front-end/list-bus-3.png') }}" alt=""></a>
							</div>
							<div class="entry-content">
								<div class="content-header">
									<div class="right">
										<div class="customer-rate">
											<div class="text">
												<p>Rất tốt</p>
												<span>50+ đánh giá</span>
											</div>
											<div class="number">
												<span>8.6</span>
											</div>
											<div class="wrap-star hide-des-show-mobile">
												<span class="star-rate">
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
												</span>
											</div>
										</div>
									</div>
									<div class="left">
										<h3 class="entry-title"><a href="#" title="">Nhà xe Futas Bus Phương Trang</a></h3>
										<div class="rate-item">
											<div class="wrap-star">
												<span class="star-no-rate">
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
												</span>
												<span class="star-rate">
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="content-middle">
									<div class="wrap-position-time">
										<div class="position">
											<p>07:30 0h40</p>
											<span>Khuất Duy Tiến</span>
										</div>
										<i class="fa fa-arrow-right"></i>
										<div class="position">
											<p>08:10</p>
											<span>Văn phòng Liêm Tuyền</span>
										</div>
									</div>
									<div class="wrap-detail-price">
										<ul>
											<li>Giường nằm 44 chỗ</li>
											<li>35 Ghế trống</li>
										</ul>
										<span class="price">80.000 vnđ</span>
									</div>
								</div>
								<div class="content-footer">
									<form method="post" action="#" id="reservations-bus" enctype="multipart/form-data">
									<div class="bus-nav-tab">
										<button type="submit" class="button button-submit" name="submit"><i class="fa fa-bus"></i>Đặt chỗ</button>
										<ul class="nav nav-tabs">
                                            <li class=""><a href="#tab-profile1" data-toggle="tab" title="new" aria-expanded="true">Hình ảnh</a></li>
                                            <li class=""><a href="#tab-profile2" data-toggle="tab" title="new" aria-expanded="false">Lịch trình</a></li>
                                            <li class=""><a href="#tab-profile3" data-toggle="tab" title="new" aria-expanded="false">Chính sách</a></li>
                                            <li class=""><a href="javascript:void(0)" onclick="showCustomerComment(this)">Viết đánh giá</a></li>
                                            <li class=""><a href="#tab-profile5" data-toggle="tab" title="new" aria-expanded="false">Giờ khởi hành khác</a></li>
                                        </ul>
                                        <div class="tab-content">
                                        	<div class="tab-pane" id="tab-profile1">
                                        		<div class="galery-bus-tab">
                                        			<span class="close-tab">x</span>
													<h3>Hình ảnh của Xe Futas Bus Phương Trang</h3>
													<div class="owl-carousel owl-theme">
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-1.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-2.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-3.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-1.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-2.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-3.png') }}" alt="">
															</div>
														</div>
													</div>
												</div>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile2">
                                        		<div class="schedule-tab">
                                        			<span class="close-tab">x</span>
                                        			<h3>Lịch trình xe Futas Bus Phương Trang từ Thanh Xuân - Hà Nội đến Thành phố Hồ Chí Minh</h3>
                                        			<table class="table">
                                        				<thead>
                                        					<tr>
	                                        					<th>Thời gian (đến)</th>
	                                        					<th>Điển đi (đến)</th>
	                                        					<th>Địa chỉ</th>
	                                        				</tr>
                                        				</thead>
                                        				<tbody>
                                        					<tr>
	                                        					<td class="bold">7.30</td>
	                                        					<td>Khuất Duy Tiến</td>
	                                        					<td>166, 168 Khuất Duy Tiến - Thanh Xuân - Hà Nội</td>
	                                        				</tr>
	                                        				<tr>
	                                        					<td class="bold">08.10</td>
	                                        					<td>Văn phòng Liêm Tuyền</td>
	                                        					<td>Quốc lộ 1A, Cạnh trạm thu phí Liêm Tuyền - Thanh Liêm - Hà Nam</td>
	                                        				</tr>
                                        				</tbody>
                                        			</table>
                                        			<span class="attention">Lưu ý:</span>
                                        			<p>Đây là lịch trình tham khảo, sẽ thay đổi tuỳ thuộc vào từng chuyến xe. Để biết thêm thông tin chi tiết, xin quý khách vui lòng liên hệ với Bookvexe qua số Hotline: 1900 7075 (miền Bắc) hoặc 1900 969681 - 1900 7070 (miền Nam)</p>
                                        		</div>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile3">
                                        		<div class="policy-tab">
                                        			<span class="close-tab">x</span>
                                        			<h3>Lịch trình xe Futas Bus Phương Trang từ Thanh Xuân - Hà Nội đến Thành phố Hồ Chí Minh</h3>
                                        			<table class="table">
                                        				<thead>
                                        					<tr>
	                                        					<th>Thời gian hủy</th>
	                                        					<th>Phí hủy</th>
	                                        				</tr>
                                        				</thead>
                                        				<tbody>
                                        					<tr>
	                                        					<td>Từ 0 tiếng đến 2 tiếng trước giờ khởi hành</td>
	                                        					<td>Không hoàn tiền</td>
	                                        				</tr>
	                                        				<tr>
	                                        					<td>Trước 2 tiếng trước giờ khởi hành</td>
	                                        					<td>6%</td>
	                                        				</tr>
                                        				</tbody>
                                        			</table>
                                        			<span class="attention">Lưu ý:</span>
                                        			<p>Mọi thắc mắc về quy trình hay các vấn đề liên quan đặt vé, hãy gọi Tổng đài của chúng tôi:</p>
                                        			<a class="hot-line" href="callto:"><span>Hotline:</span>  1900 878 999</a>
                                        		</div>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile5">
                                        		<div class="timestart-tab">
                                        			<span class="close-tab">x</span>
                                        			<h3>Chọn giờ khởi hành khác của Xe Futas Bus Phương Trang</h3>
                                        			<div class="time-list">
                                        				<span>Giường nằm</span>
                                        				<div class="wrap">
															<button type="button" class="button button-time" data-type="bed" data-time="07:00">07:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="08:00">08:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="09:00">09:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="10:00">10:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="11:00">11:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="12:00">12:00</button>
														</div>
                                        			</div>
                                        			<div class="time-list">
                                        				<span>Ghế ngả</span>
                                        				<div class="wrap">
															<button type="button" class="button button-time" data-type="seat" data-time="07:00">07:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="08:00">08:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="09:00">09:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="10:00">10:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="11:00">11:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="12:00">12:00</button>
														</div>
                                        			</div>
                                        			<div class="time-list">
                                        				<span>Ghế ngả VIP</span>
                                        				<div class="wrap">
															<button type="button" class="button button-time" data-type="seat-vip" data-time="07:00">07:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="08:00">08:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="09:00">09:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="10:00">10:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="11:00">11:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="12:00">12:00</button>
														</div>
                                        			</div>
                                        			<input type="hidden" id="type-bus" class="type-bus" name="type-bus" value="">
                                        			<input type="hidden" id="time-bus" class="time-bus" name="time-bus" value="">
                                        		</div>
                                        	</div>
                                        </div>
									</div>
									</form>
								</div>
							</div>
						</div>
						<div class="entry-item-bus clear-fix">
							<div class="entry-thumb">
								<a href="#" title=""><img src="{{ asset('img/front-end/list-bus-3.png') }}" alt=""></a>
							</div>
							<div class="entry-content">
								<div class="content-header">
									<div class="right">
										<div class="customer-rate">
											<div class="text">
												<p>Rất tốt</p>
												<span>50+ đánh giá</span>
											</div>
											<div class="number">
												<span>8.6</span>
											</div>
											<div class="wrap-star hide-des-show-mobile">
												<span class="star-rate">
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
												</span>
											</div>
										</div>
									</div>
									<div class="left">
										<h3 class="entry-title"><a href="#" title="">Nhà xe Futas Bus Phương Trang</a></h3>
										<div class="rate-item">
											<div class="wrap-star">
												<span class="star-no-rate">
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
												</span>
												<span class="star-rate">
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="content-middle">
									<div class="wrap-position-time">
										<div class="position">
											<p>07:30 0h40</p>
											<span>Khuất Duy Tiến</span>
										</div>
										<i class="fa fa-arrow-right"></i>
										<div class="position">
											<p>08:10</p>
											<span>Văn phòng Liêm Tuyền</span>
										</div>
									</div>
									<div class="wrap-detail-price">
										<ul>
											<li>Giường nằm 44 chỗ</li>
											<li>35 Ghế trống</li>
										</ul>
										<span class="price">80.000 vnđ</span>
									</div>
								</div>
								<div class="content-footer">
									<form method="post" action="#" id="reservations-bus" enctype="multipart/form-data">
									<div class="bus-nav-tab">
										<button type="submit" class="button button-submit" name="submit"><i class="fa fa-bus"></i>Đặt chỗ</button>
										<ul class="nav nav-tabs">
                                            <li class=""><a href="#tab-profile1" data-toggle="tab" title="new" aria-expanded="true">Hình ảnh</a></li>
                                            <li class=""><a href="#tab-profile2" data-toggle="tab" title="new" aria-expanded="false">Lịch trình</a></li>
                                            <li class=""><a href="#tab-profile3" data-toggle="tab" title="new" aria-expanded="false">Chính sách</a></li>
                                            <li class=""><a href="javascript:void(0)" onclick="showCustomerComment(this)">Viết đánh giá</a></li>
                                            <li class=""><a href="#tab-profile5" data-toggle="tab" title="new" aria-expanded="false">Giờ khởi hành khác</a></li>
                                        </ul>
                                        <div class="tab-content">
                                        	<div class="tab-pane" id="tab-profile1">
                                        		<div class="galery-bus-tab">
                                        			<span class="close-tab">x</span>
													<h3>Hình ảnh của Xe Futas Bus Phương Trang</h3>
													<div class="owl-carousel owl-theme">
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-1.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-2.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-3.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-1.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-2.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-3.png') }}" alt="">
															</div>
														</div>
													</div>
												</div>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile2">
                                        		<div class="schedule-tab">
                                        			<span class="close-tab">x</span>
                                        			<h3>Lịch trình xe Futas Bus Phương Trang từ Thanh Xuân - Hà Nội đến Thành phố Hồ Chí Minh</h3>
                                        			<table class="table">
                                        				<thead>
                                        					<tr>
	                                        					<th>Thời gian (đến)</th>
	                                        					<th>Điển đi (đến)</th>
	                                        					<th>Địa chỉ</th>
	                                        				</tr>
                                        				</thead>
                                        				<tbody>
                                        					<tr>
	                                        					<td class="bold">7.30</td>
	                                        					<td>Khuất Duy Tiến</td>
	                                        					<td>166, 168 Khuất Duy Tiến - Thanh Xuân - Hà Nội</td>
	                                        				</tr>
	                                        				<tr>
	                                        					<td class="bold">08.10</td>
	                                        					<td>Văn phòng Liêm Tuyền</td>
	                                        					<td>Quốc lộ 1A, Cạnh trạm thu phí Liêm Tuyền - Thanh Liêm - Hà Nam</td>
	                                        				</tr>
                                        				</tbody>
                                        			</table>
                                        			<span class="attention">Lưu ý:</span>
                                        			<p>Đây là lịch trình tham khảo, sẽ thay đổi tuỳ thuộc vào từng chuyến xe. Để biết thêm thông tin chi tiết, xin quý khách vui lòng liên hệ với Bookvexe qua số Hotline: 1900 7075 (miền Bắc) hoặc 1900 969681 - 1900 7070 (miền Nam)</p>
                                        		</div>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile3">
                                        		<div class="policy-tab">
                                        			<span class="close-tab">x</span>
                                        			<h3>Lịch trình xe Futas Bus Phương Trang từ Thanh Xuân - Hà Nội đến Thành phố Hồ Chí Minh</h3>
                                        			<table class="table">
                                        				<thead>
                                        					<tr>
	                                        					<th>Thời gian hủy</th>
	                                        					<th>Phí hủy</th>
	                                        				</tr>
                                        				</thead>
                                        				<tbody>
                                        					<tr>
	                                        					<td>Từ 0 tiếng đến 2 tiếng trước giờ khởi hành</td>
	                                        					<td>Không hoàn tiền</td>
	                                        				</tr>
	                                        				<tr>
	                                        					<td>Trước 2 tiếng trước giờ khởi hành</td>
	                                        					<td>6%</td>
	                                        				</tr>
                                        				</tbody>
                                        			</table>
                                        			<span class="attention">Lưu ý:</span>
                                        			<p>Mọi thắc mắc về quy trình hay các vấn đề liên quan đặt vé, hãy gọi Tổng đài của chúng tôi:</p>
                                        			<a class="hot-line" href="callto:"><span>Hotline:</span>  1900 878 999</a>
                                        		</div>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile5">
                                        		<div class="timestart-tab">
                                        			<span class="close-tab">x</span>
                                        			<h3>Chọn giờ khởi hành khác của Xe Futas Bus Phương Trang</h3>
                                        			<div class="time-list">
                                        				<span>Giường nằm</span>
                                        				<div class="wrap">
															<button type="button" class="button button-time" data-type="bed" data-time="07:00">07:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="08:00">08:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="09:00">09:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="10:00">10:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="11:00">11:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="12:00">12:00</button>
														</div>
                                        			</div>
                                        			<div class="time-list">
                                        				<span>Ghế ngả</span>
                                        				<div class="wrap">
															<button type="button" class="button button-time" data-type="seat" data-time="07:00">07:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="08:00">08:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="09:00">09:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="10:00">10:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="11:00">11:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="12:00">12:00</button>
														</div>
                                        			</div>
                                        			<div class="time-list">
                                        				<span>Ghế ngả VIP</span>
                                        				<div class="wrap">
															<button type="button" class="button button-time" data-type="seat-vip" data-time="07:00">07:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="08:00">08:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="09:00">09:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="10:00">10:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="11:00">11:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="12:00">12:00</button>
														</div>
                                        			</div>
                                        			<input type="hidden" id="type-bus" class="type-bus" name="type-bus" value="">
                                        			<input type="hidden" id="time-bus" class="time-bus" name="time-bus" value="">
                                        		</div>
                                        	</div>
                                        </div>
									</div>
									</form>
								</div>
							</div>
						</div>
						<div class="entry-item-bus clear-fix">
							<div class="entry-thumb">
								<a href="#" title=""><img src="{{ asset('img/front-end/list-bus-3.png') }}" alt=""></a>
							</div>
							<div class="entry-content">
								<div class="content-header">
									<div class="right">
										<div class="customer-rate">
											<div class="text">
												<p>Rất tốt</p>
												<span>50+ đánh giá</span>
											</div>
											<div class="number">
												<span>8.6</span>
											</div>
											<div class="wrap-star hide-des-show-mobile">
												<span class="star-rate">
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
												</span>
											</div>
										</div>
									</div>
									<div class="left">
										<h3 class="entry-title"><a href="#" title="">Nhà xe Futas Bus Phương Trang</a></h3>
										<div class="rate-item">
											<div class="wrap-star">
												<span class="star-no-rate">
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
												</span>
												<span class="star-rate">
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="content-middle">
									<div class="wrap-position-time">
										<div class="position">
											<p>07:30 0h40</p>
											<span>Khuất Duy Tiến</span>
										</div>
										<i class="fa fa-arrow-right"></i>
										<div class="position">
											<p>08:10</p>
											<span>Văn phòng Liêm Tuyền</span>
										</div>
									</div>
									<div class="wrap-detail-price">
										<ul>
											<li>Giường nằm 44 chỗ</li>
											<li>35 Ghế trống</li>
										</ul>
										<span class="price">80.000 vnđ</span>
									</div>
								</div>
								<div class="content-footer">
									<form method="post" action="#" id="reservations-bus" enctype="multipart/form-data">
									<div class="bus-nav-tab">
										<button type="submit" class="button button-submit" name="submit"><i class="fa fa-bus"></i>Đặt chỗ</button>
										<ul class="nav nav-tabs">
                                            <li class=""><a href="#tab-profile1" data-toggle="tab" title="new" aria-expanded="true">Hình ảnh</a></li>
                                            <li class=""><a href="#tab-profile2" data-toggle="tab" title="new" aria-expanded="false">Lịch trình</a></li>
                                            <li class=""><a href="#tab-profile3" data-toggle="tab" title="new" aria-expanded="false">Chính sách</a></li>
                                            <li class=""><a href="javascript:void(0)" onclick="showCustomerComment(this)">Viết đánh giá</a></li>
                                            <li class=""><a href="#tab-profile5" data-toggle="tab" title="new" aria-expanded="false">Giờ khởi hành khác</a></li>
                                        </ul>
                                        <div class="tab-content">
                                        	<div class="tab-pane" id="tab-profile1">
                                        		<div class="galery-bus-tab">
                                        			<span class="close-tab">x</span>
													<h3>Hình ảnh của Xe Futas Bus Phương Trang</h3>
													<div class="owl-carousel owl-theme">
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-1.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-2.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-3.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-1.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-2.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-3.png') }}" alt="">
															</div>
														</div>
													</div>
												</div>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile2">
                                        		<div class="schedule-tab">
                                        			<span class="close-tab">x</span>
                                        			<h3>Lịch trình xe Futas Bus Phương Trang từ Thanh Xuân - Hà Nội đến Thành phố Hồ Chí Minh</h3>
                                        			<table class="table">
                                        				<thead>
                                        					<tr>
	                                        					<th>Thời gian (đến)</th>
	                                        					<th>Điển đi (đến)</th>
	                                        					<th>Địa chỉ</th>
	                                        				</tr>
                                        				</thead>
                                        				<tbody>
                                        					<tr>
	                                        					<td class="bold">7.30</td>
	                                        					<td>Khuất Duy Tiến</td>
	                                        					<td>166, 168 Khuất Duy Tiến - Thanh Xuân - Hà Nội</td>
	                                        				</tr>
	                                        				<tr>
	                                        					<td class="bold">08.10</td>
	                                        					<td>Văn phòng Liêm Tuyền</td>
	                                        					<td>Quốc lộ 1A, Cạnh trạm thu phí Liêm Tuyền - Thanh Liêm - Hà Nam</td>
	                                        				</tr>
                                        				</tbody>
                                        			</table>
                                        			<span class="attention">Lưu ý:</span>
                                        			<p>Đây là lịch trình tham khảo, sẽ thay đổi tuỳ thuộc vào từng chuyến xe. Để biết thêm thông tin chi tiết, xin quý khách vui lòng liên hệ với Bookvexe qua số Hotline: 1900 7075 (miền Bắc) hoặc 1900 969681 - 1900 7070 (miền Nam)</p>
                                        		</div>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile3">
                                        		<div class="policy-tab">
                                        			<span class="close-tab">x</span>
                                        			<h3>Lịch trình xe Futas Bus Phương Trang từ Thanh Xuân - Hà Nội đến Thành phố Hồ Chí Minh</h3>
                                        			<table class="table">
                                        				<thead>
                                        					<tr>
	                                        					<th>Thời gian hủy</th>
	                                        					<th>Phí hủy</th>
	                                        				</tr>
                                        				</thead>
                                        				<tbody>
                                        					<tr>
	                                        					<td>Từ 0 tiếng đến 2 tiếng trước giờ khởi hành</td>
	                                        					<td>Không hoàn tiền</td>
	                                        				</tr>
	                                        				<tr>
	                                        					<td>Trước 2 tiếng trước giờ khởi hành</td>
	                                        					<td>6%</td>
	                                        				</tr>
                                        				</tbody>
                                        			</table>
                                        			<span class="attention">Lưu ý:</span>
                                        			<p>Mọi thắc mắc về quy trình hay các vấn đề liên quan đặt vé, hãy gọi Tổng đài của chúng tôi:</p>
                                        			<a class="hot-line" href="callto:"><span>Hotline:</span>  1900 878 999</a>
                                        		</div>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile5">
                                        		<div class="timestart-tab">
                                        			<span class="close-tab">x</span>
                                        			<h3>Chọn giờ khởi hành khác của Xe Futas Bus Phương Trang</h3>
                                        			<div class="time-list">
                                        				<span>Giường nằm</span>
                                        				<div class="wrap">
															<button type="button" class="button button-time" data-type="bed" data-time="07:00">07:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="08:00">08:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="09:00">09:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="10:00">10:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="11:00">11:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="12:00">12:00</button>
														</div>
                                        			</div>
                                        			<div class="time-list">
                                        				<span>Ghế ngả</span>
                                        				<div class="wrap">
															<button type="button" class="button button-time" data-type="seat" data-time="07:00">07:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="08:00">08:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="09:00">09:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="10:00">10:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="11:00">11:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="12:00">12:00</button>
														</div>
                                        			</div>
                                        			<div class="time-list">
                                        				<span>Ghế ngả VIP</span>
                                        				<div class="wrap">
															<button type="button" class="button button-time" data-type="seat-vip" data-time="07:00">07:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="08:00">08:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="09:00">09:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="10:00">10:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="11:00">11:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="12:00">12:00</button>
														</div>
                                        			</div>
                                        			<input type="hidden" id="type-bus" class="type-bus" name="type-bus" value="">
                                        			<input type="hidden" id="time-bus" class="time-bus" name="time-bus" value="">
                                        		</div>
                                        	</div>
                                        </div>
									</div>
									</form>
								</div>
							</div>
						</div>
						<div class="entry-item-bus clear-fix">
							<div class="entry-thumb">
								<a href="#" title=""><img src="{{ asset('img/front-end/list-bus-3.png') }}" alt=""></a>
							</div>
							<div class="entry-content">
								<div class="content-header">
									<div class="right">
										<div class="customer-rate">
											<div class="text">
												<p>Rất tốt</p>
												<span>50+ đánh giá</span>
											</div>
											<div class="number">
												<span>8.6</span>
											</div>
											<div class="wrap-star hide-des-show-mobile">
												<span class="star-rate">
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
												</span>
											</div>
										</div>
									</div>
									<div class="left">
										<h3 class="entry-title"><a href="#" title="">Nhà xe Futas Bus Phương Trang</a></h3>
										<div class="rate-item">
											<div class="wrap-star">
												<span class="star-no-rate">
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
												</span>
												<span class="star-rate">
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="content-middle">
									<div class="wrap-position-time">
										<div class="position">
											<p>07:30 0h40</p>
											<span>Khuất Duy Tiến</span>
										</div>
										<i class="fa fa-arrow-right"></i>
										<div class="position">
											<p>08:10</p>
											<span>Văn phòng Liêm Tuyền</span>
										</div>
									</div>
									<div class="wrap-detail-price">
										<ul>
											<li>Giường nằm 44 chỗ</li>
											<li>35 Ghế trống</li>
										</ul>
										<span class="price">80.000 vnđ</span>
									</div>
								</div>
								<div class="content-footer">
									<form method="post" action="#" id="reservations-bus" enctype="multipart/form-data">
									<div class="bus-nav-tab">
										<button type="submit" class="button button-submit" name="submit"><i class="fa fa-bus"></i>Đặt chỗ</button>
										<ul class="nav nav-tabs">
                                            <li class=""><a href="#tab-profile1" data-toggle="tab" title="new" aria-expanded="true">Hình ảnh</a></li>
                                            <li class=""><a href="#tab-profile2" data-toggle="tab" title="new" aria-expanded="false">Lịch trình</a></li>
                                            <li class=""><a href="#tab-profile3" data-toggle="tab" title="new" aria-expanded="false">Chính sách</a></li>
                                            <li class=""><a href="javascript:void(0)" onclick="showCustomerComment(this)">Viết đánh giá</a></li>
                                            <li class=""><a href="#tab-profile5" data-toggle="tab" title="new" aria-expanded="false">Giờ khởi hành khác</a></li>
                                        </ul>
                                        <div class="tab-content">
                                        	<div class="tab-pane" id="tab-profile1">
                                        		<div class="galery-bus-tab">
                                        			<span class="close-tab">x</span>
													<h3>Hình ảnh của Xe Futas Bus Phương Trang</h3>
													<div class="owl-carousel owl-theme">
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-1.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-2.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-3.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-1.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-2.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-3.png') }}" alt="">
															</div>
														</div>
													</div>
												</div>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile2">
                                        		<div class="schedule-tab">
                                        			<span class="close-tab">x</span>
                                        			<h3>Lịch trình xe Futas Bus Phương Trang từ Thanh Xuân - Hà Nội đến Thành phố Hồ Chí Minh</h3>
                                        			<table class="table">
                                        				<thead>
                                        					<tr>
	                                        					<th>Thời gian (đến)</th>
	                                        					<th>Điển đi (đến)</th>
	                                        					<th>Địa chỉ</th>
	                                        				</tr>
                                        				</thead>
                                        				<tbody>
                                        					<tr>
	                                        					<td class="bold">7.30</td>
	                                        					<td>Khuất Duy Tiến</td>
	                                        					<td>166, 168 Khuất Duy Tiến - Thanh Xuân - Hà Nội</td>
	                                        				</tr>
	                                        				<tr>
	                                        					<td class="bold">08.10</td>
	                                        					<td>Văn phòng Liêm Tuyền</td>
	                                        					<td>Quốc lộ 1A, Cạnh trạm thu phí Liêm Tuyền - Thanh Liêm - Hà Nam</td>
	                                        				</tr>
                                        				</tbody>
                                        			</table>
                                        			<span class="attention">Lưu ý:</span>
                                        			<p>Đây là lịch trình tham khảo, sẽ thay đổi tuỳ thuộc vào từng chuyến xe. Để biết thêm thông tin chi tiết, xin quý khách vui lòng liên hệ với Bookvexe qua số Hotline: 1900 7075 (miền Bắc) hoặc 1900 969681 - 1900 7070 (miền Nam)</p>
                                        		</div>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile3">
                                        		<div class="policy-tab">
                                        			<span class="close-tab">x</span>
                                        			<h3>Lịch trình xe Futas Bus Phương Trang từ Thanh Xuân - Hà Nội đến Thành phố Hồ Chí Minh</h3>
                                        			<table class="table">
                                        				<thead>
                                        					<tr>
	                                        					<th>Thời gian hủy</th>
	                                        					<th>Phí hủy</th>
	                                        				</tr>
                                        				</thead>
                                        				<tbody>
                                        					<tr>
	                                        					<td>Từ 0 tiếng đến 2 tiếng trước giờ khởi hành</td>
	                                        					<td>Không hoàn tiền</td>
	                                        				</tr>
	                                        				<tr>
	                                        					<td>Trước 2 tiếng trước giờ khởi hành</td>
	                                        					<td>6%</td>
	                                        				</tr>
                                        				</tbody>
                                        			</table>
                                        			<span class="attention">Lưu ý:</span>
                                        			<p>Mọi thắc mắc về quy trình hay các vấn đề liên quan đặt vé, hãy gọi Tổng đài của chúng tôi:</p>
                                        			<a class="hot-line" href="callto:"><span>Hotline:</span>  1900 878 999</a>
                                        		</div>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile5">
                                        		<div class="timestart-tab">
                                        			<span class="close-tab">x</span>
                                        			<h3>Chọn giờ khởi hành khác của Xe Futas Bus Phương Trang</h3>
                                        			<div class="time-list">
                                        				<span>Giường nằm</span>
                                        				<div class="wrap">
															<button type="button" class="button button-time" data-type="bed" data-time="07:00">07:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="08:00">08:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="09:00">09:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="10:00">10:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="11:00">11:00</button>
															<button type="button" class="button button-time" data-type="bed" data-time="12:00">12:00</button>
														</div>
                                        			</div>
                                        			<div class="time-list">
                                        				<span>Ghế ngả</span>
                                        				<div class="wrap">
															<button type="button" class="button button-time" data-type="seat" data-time="07:00">07:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="08:00">08:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="09:00">09:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="10:00">10:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="11:00">11:00</button>
															<button type="button" class="button button-time" data-type="seat" data-time="12:00">12:00</button>
														</div>
                                        			</div>
                                        			<div class="time-list">
                                        				<span>Ghế ngả VIP</span>
                                        				<div class="wrap">
															<button type="button" class="button button-time" data-type="seat-vip" data-time="07:00">07:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="08:00">08:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="09:00">09:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="10:00">10:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="11:00">11:00</button>
															<button type="button" class="button button-time" data-type="seat-vip" data-time="12:00">12:00</button>
														</div>
                                        			</div>
                                        			<input type="hidden" id="type-bus" class="type-bus" name="type-bus" value="">
                                        			<input type="hidden" id="time-bus" class="time-bus" name="time-bus" value="">
                                        		</div>
                                        	</div>
                                        </div>
									</div>
									</form>
								</div>
							</div>
						</div>
						@include('front-end.element.paginator') 
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="modal fade bd-example-modal-lg" id="customer-comment" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="box-title">Viết đánh giá nhà xe Futas Bus Phương Trang</h3>
                </div>
                <div class="modal-body">
                	<form method="post" action="#" id="form-customer-comment" enctype="multipart/form-data">
            			<input type="hidden" name="_token" value="{{csrf_token()}}">
            			<p class="router">Tuyến đường: Cầu Giấy - Nam Định</p>
            			<div class="row">
	                		<div class="col-md-6 col-sm-6 col-xs-12">
	                			<div class="form-group">
	                				<label for="full-name">Họ và tên:<span>*</span></label>
	                				<input type="text" class="form-control full-name" name="full-name" value="" placeholder="Họ và tên khách hàng">
	                			</div>
	                			<div class="form-group">
	                				<label for="full-name">Email:<span>*</span></label>
	                				<input type="email" class="form-control email" name="email" value="" placeholder="Địa chỉ email">
	                			</div>
	                			<div class="form-group datetime-picker">
	                				<label for="start_date">Chọn ngày đi:<span>*</span></label>
	                				<div class="wrap-datetime">
				                        <div class="input-group datepicker">
				                            <input id="start_date" class="form-control" type="text" name="start_date" value="" required="">
				                        </div>
			                        </div>
	                			</div>
	                		</div>
	                		<div class="col-md-6 col-sm-6 col-xs-12">
	                			<div class="wrap-rate-star">
	                				<span>Xin vui lòng bấm để đánh giá</span>
	                				<div class="comment-form-rating">
	                                    <span>Tổng quan:</span>
	                                    <div class="rating">
	                                        <span class="star" data-value="5">☆</span>
	                                        <span class="star" data-value="4">☆</span>
	                                        <span class="star" data-value="3">☆</span>
	                                        <span class="star" data-value="2">☆</span>
	                                        <span class="star" data-value="1">☆</span>
	                                    </div>
	                                    <input type="hidden" name="star-overview" class="rating-number" value="">
	                                </div>
	                                <div class="comment-form-rating">
	                                    <span>Chất lượng:</span>
	                                    <div class="rating">
	                                        <span class="star" data-value="5">☆</span>
	                                        <span class="star" data-value="4">☆</span>
	                                        <span class="star" data-value="3">☆</span>
	                                        <span class="star" data-value="2">☆</span>
	                                        <span class="star" data-value="1">☆</span>
	                                    </div>
	                                    <input type="hidden" name="star-quality" class="rating-number" value="">
	                                </div>
	                                <div class="comment-form-rating">
	                                    <span>Đúng giờ:</span>
	                                    <div class="rating">
	                                        <span class="star" data-value="5">☆</span>
	                                        <span class="star" data-value="4">☆</span>
	                                        <span class="star" data-value="3">☆</span>
	                                        <span class="star" data-value="2">☆</span>
	                                        <span class="star" data-value="1">☆</span>
	                                    </div>
	                                    <input type="hidden" name="star-ontime" class="rating-number" value="">
	                                </div>
	                                <div class="comment-form-rating">
	                                    <span>Thái độ phục vụ:</span>
	                                    <div class="rating">
	                                        <span class="star" data-value="5">☆</span>
	                                        <span class="star" data-value="4">☆</span>
	                                        <span class="star" data-value="3">☆</span>
	                                        <span class="star" data-value="2">☆</span>
	                                        <span class="star" data-value="1">☆</span>
	                                    </div>
	                                    <input type="hidden" name="star-service-attitude" class="rating-number" value="">
	                                </div>
	                			</div>
	                		</div>
                		</div>
                		<div class="row">
                			<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="form-group">
	                				<label for="comment">Viết đánh giá (tối thiểu 100 chữ)</label>
	                				<textarea name="comment" id="comment" cols="30" rows="10" placeholder="Viết cảm nhận của bạn về chuyến đi">
	                				</textarea>
	                			</div>
                			</div>
                			<div class="col-md-6 col-sm-6 col-xs-12">
                				<div class="form-group">
	                				<label for="rate-point">Điểm đánh giá (trên thang điểm 10)</label>
	                				<input type="text" class="form-control rate-point" name="rate-point" value="9.0">
	                			</div>
                			</div>
                		</div>
                		<div class="row">
                			<div class="col-md-12">
                				<div class="form-check">
								    <input type="checkbox" class="form-check-input" id="agreer-checkbox">
								    <label class="form-check-label" for="agreer-checkbox">Tôi xác nhận rằng đánh giá này hoàn toàn dựa trên trải nghiệm cá nhân của tôi khi đi chuyến này và tôi không có mối quan hệ cá nhân hay kinh doanh với các hãng xe.</label>
								</div>
								<div class="center">
									<button type="submit" class="button button-submit">Gửi Đánh Giá</button>
								</div>
                			</div>
                		</div>
                	</form>
                </div>
            </div>
        </div>
    </div>
@stop