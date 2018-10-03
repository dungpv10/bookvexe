@extends('front-end/layouts/layouts')
@section('content')
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
							                    	<div class="col-md-6 col-sm-6">
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
							                    	<div class="col-md-6 col-sm-6">
							                    		<div class="form-group datetime-picker">
									                        <label for="end_time">Ngày đến</label>
									                        <div class="wrap-datetime">
										                        <div class="input-group datepicker">
										                            <input id="end_date" class="form-control" type="text" name="end_date" value="" required>
										                            <i class="fa fa-calendar-alt"></i>
										                        </div>
									                        </div>
									                    </div>
							                    	</div>
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
	<section class="bg-section padding-bottom-none">
		<div class="container">
			<div class="row row-center">
				<div class="col col-md-11">
					<div class="widget widget-customer-review">
						<div class="widget-content">
							<span class="margin-right-15">Được đánh giá</span>
							<div class="rate-item">
								<div class="wrap-star">
									<span class="star-no-rate">
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
							<span class="percent">90%</span>
							<span>Dựa trên 290,000 đánh giá của khách hàng</span>
						</div>
					</div>
					<div class="widget widget-ads">
						<div class="widget-content">
							<a href="#" title=""><img src="{{ asset('img/front-end/ads.png') }}" alt=""></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="bg-section section-promotion">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="widget widget-promotion">
						<div class="widget-title">
							<h2 class="title center">Top deal hôm nay</h2>
						</div>
						<div class="widget-content">
							<div class="owl-carousel owl-theme">
								<div class="item">
									<article class="entry-item style-1">
										<div class="entry-thumb">
											<a href="#" title="">
												<img src="{{ asset('img/front-end/pro-1.png') }}" alt="">
											</a>
										</div>
										<div class="entry-content">
											<h6 class="entry-title">
												<a href="#" title="">Bạn muốn có một kỳ kì nghỉ đáng nhớ với bạn bè</a>
											</h6>
											<p>Hãy bấm để tìm kiếm những ưu đãi cho kì nghỉ của bạn</p>
										</div>
									</article>
								</div>
								<div class="item">
									<article class="entry-item style-1">
										<div class="entry-thumb">
											<a href="#" title="">
												<img src="{{ asset('img/front-end/pro-2.png') }}" alt="">
											</a>
										</div>
										<div class="entry-content">
											<h6 class="entry-title">
												<a href="#" title="">Bạn muốn có một kỳ kì nghỉ đáng nhớ với bạn bè</a>
											</h6>
											<p>Hãy bấm để tìm kiếm những ưu đãi cho kì nghỉ của bạn</p>
										</div>
									</article>
								</div>
								<div class="item">
									<article class="entry-item style-1">
										<div class="entry-thumb">
											<a href="#" title="">
												<img src="{{ asset('img/front-end/pro-3.png') }}" alt="">
											</a>
										</div>
										<div class="entry-content">
											<h6 class="entry-title">
												<a href="#" title="">Bạn muốn có một kỳ kì nghỉ đáng nhớ với bạn bè</a>
											</h6>
											<p>Hãy bấm để tìm kiếm những ưu đãi cho kì nghỉ của bạn</p>
										</div>
									</article>
								</div>
								<div class="item">
									<article class="entry-item style-1">
										<div class="entry-thumb">
											<a href="#" title="">
												<img src="{{ asset('img/front-end/pro-1.png') }}" alt="">
											</a>
										</div>
										<div class="entry-content">
											<h6 class="entry-title">
												<a href="#" title="">Bạn muốn có một kỳ kì nghỉ đáng nhớ với bạn bè</a>
											</h6>
											<p>Hãy bấm để tìm kiếm những ưu đãi cho kì nghỉ của bạn</p>
										</div>
									</article>
								</div>
								<div class="item">
									<article class="entry-item style-1">
										<div class="entry-thumb">
											<a href="#" title="">
												<img src="{{ asset('img/front-end/pro-2.png') }}" alt="">
											</a>
										</div>
										<div class="entry-content">
											<h6 class="entry-title">
												<a href="#" title="">Bạn muốn có một kỳ kì nghỉ đáng nhớ với bạn bè</a>
											</h6>
											<p>Hãy bấm để tìm kiếm những ưu đãi cho kì nghỉ của bạn</p>
										</div>
									</article>
								</div>
								<div class="item">
									<article class="entry-item style-1">
										<div class="entry-thumb">
											<a href="#" title="">
												<img src="{{ asset('img/front-end/pro-1.png') }}" alt="">
											</a>
										</div>
										<div class="entry-content">
											<h6 class="entry-title">
												<a href="#" title="">Bạn muốn có một kỳ kì nghỉ đáng nhớ với bạn bè</a>
											</h6>
											<p>Hãy bấm để tìm kiếm những ưu đãi cho kì nghỉ của bạn</p>
										</div>
									</article>
								</div>
								<div class="item">
									<article class="entry-item style-1">
										<div class="entry-thumb">
											<a href="#" title="">
												<img src="{{ asset('img/front-end/pro-1.png') }}" alt="">
											</a>
										</div>
										<div class="entry-content">
											<h6 class="entry-title">
												<a href="#" title="">Bạn muốn có một kỳ kì nghỉ đáng nhớ với bạn bè</a>
											</h6>
											<p>Hãy bấm để tìm kiếm những ưu đãi cho kì nghỉ của bạn</p>
										</div>
									</article>
								</div>
								<div class="item">
									<article class="entry-item style-1">
										<div class="entry-thumb">
											<a href="#" title="">
												<img src="{{ asset('img/front-end/pro-2.png') }}" alt="">
											</a>
										</div>
										<div class="entry-content">
											<h6 class="entry-title">
												<a href="#" title="">Bạn muốn có một kỳ kì nghỉ đáng nhớ với bạn bè</a>
											</h6>
											<p>Hãy bấm để tìm kiếm những ưu đãi cho kì nghỉ của bạn</p>
										</div>
									</article>
								</div>
								<div class="item">
									<article class="entry-item style-1">
										<div class="entry-thumb">
											<a href="#" title="">
												<img src="{{ asset('img/front-end/pro-1.png') }}" alt="">
											</a>
										</div>
										<div class="entry-content">
											<h6 class="entry-title">
												<a href="#" title="">Bạn muốn có một kỳ kì nghỉ đáng nhớ với bạn bè</a>
											</h6>
											<p>Hãy bấm để tìm kiếm những ưu đãi cho kì nghỉ của bạn</p>
										</div>
									</article>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="container">
			<div class="row row-center">
				<div class="col col-lg-12 col-md-12">
					<div class="widget widget-rate">
						<div class="widget-title">
							<h2 class="title center">Đánh giá của khách hàng về Dịch vụ của chúng tôi</h2>
						</div>
						<div class="widget-content">
							<div class="row">
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
									<div class="rate-item">
										<div class="rate-header">
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
											<span class="time">16 hours ago</span>
										</div>
										<div class="rate-content">
											<p class="highlights">Nguyễn Ngọc Vy</p>
											<p>Dịch vụ tốt, tôi cảm thấy hài lòng.</p>
										</div>
										<div class="rate-footer">
											<span>Ho Chi Minh city.</span>
										</div>
									</div>	
								</div>
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
									<div class="rate-item">
										<div class="rate-header">
											<div class="wrap-star">
												<span class="star-no-rate">
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
												</span>
												<span class="star-rate">
													<i class="fa fa-star star rate-highlights"></i>
													<i class="fa fa-star star rate-highlights"></i>
													<i class="fa fa-star star rate-highlights"></i>
													<i class="fa fa-star star rate-highlights"></i>
													<i class="fa fa-star star rate-highlights"></i>
												</span>
											</div>
											<span class="time">17 hours ago</span>
										</div>
										<div class="rate-content">
											<p class="highlights">Vương Lý Hoàng Lan</p>
											<p>Booking Online dễ dàng. Tuyệt.</p>
										</div>
										<div class="rate-footer">
											<span>Can Tho City.</span>
										</div>
									</div>	
								</div>
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
									<div class="rate-item">
										<div class="rate-header">
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
											<span class="time">23 hours ago</span>
										</div>
										<div class="rate-content">
											<p class="highlights">Trần Trọng Trình</p>
											<p>Nhiều sự lựa chọn. Rất tốt</p>
										</div>
										<div class="rate-footer">
											<span>Ho Chi Minh city.</span>
										</div>
									</div>	
								</div>
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
									<div class="rate-item">
										<div class="rate-header">
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
											<span class="time">23 hours ago</span>
										</div>
										<div class="rate-content">
											<p class="highlights">Lê Văn Tám</p>
											<p>Về quê giờ rất dễ dàng. Cám ơn</p>
										</div>
										<div class="rate-footer">
											<span>Ca Mau city.</span>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="bg-section section-popular">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="widget widget-popular">
						<div class="widget-title">
							<h2 class="title center">Tuyến xe đặt phổ biến nhất</h2>
						</div>
						<div class="widget-content">
							<div class="row">
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
									<article class="entry-item bg-white style-2">
										<div class="entry-thumb">
											<div class="position">
												<i class="fa fa-map-marker"></i>
												<p>TP. Hồ Chí Minh - Cần thơ</p>
											</div>
											<div class="entry-thumb">
												<a href="#">
													<img src="{{ asset('img/front-end/popu-1.png') }}" alt="">
												</a>
											</div>
										</div>
										<div class="entry-content">
											<div class="match_height">
												<div class="icon">
													<a href="#">
														<img src="{{ asset('img/front-end/logo-bus-3.png') }}" alt="">
													</a>
												</div>
												<div class="price">
													<div>
														<p class="po">140.000.000</p>
														<p>VNĐ/1 Chiều</p>
													</div>
												</div>
											</div>
										</div>
									</article>
								</div>
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
									<article class="entry-item bg-white style-2">
										<div class="entry-thumb">
											<div class="position">
												<i class="fa fa-map-marker"></i>
												<p>Đà Nẵng - Cần thơ</p>
											</div>
											<div class="entry-thumb">
												<a href="#">
													<img src="{{ asset('img/front-end/popu-2.png') }}" alt="">
												</a>
											</div>
										</div>
										<div class="entry-content">
											<div class="match_height">
												<div class="icon">
													<a href="#">
														<img src="{{ asset('img/front-end/logo-bus-3.png') }}" alt="">
													</a>
												</div>
												<div class="price">
													<div>
														<p class="po">430.000.000</p>
														<p>VNĐ/1 Chiều</p>
													</div>
												</div>
											</div>
										</div>
									</article>
								</div>
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
									<article class="entry-item bg-white style-2">
										<div class="entry-thumb">
											<div class="position">
												<i class="fa fa-map-marker"></i>
												<p>Cà Mau - Bình Thuận</p>
											</div>
											<div class="entry-thumb">
												<a href="#">
													<img src="{{ asset('img/front-end/popu-3.png') }}" alt="">
												</a>
											</div>
										</div>
										<div class="entry-content">
											<div class="match_height">
												<div class="icon">
													<a href="#">
														<img src="{{ asset('img/front-end/logo-bus-3.png') }}" alt="">
													</a>
												</div>
												<div class="price">
													<div>
														<p class="po">560.000.000</p>
														<p>VNĐ/1 Chiều</p>
													</div>
												</div>
											</div>
										</div>
									</article>
								</div>
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
									<article class="entry-item bg-white style-2">
										<div class="entry-thumb">
											<div class="position">
												<i class="fa fa-map-marker"></i>
												<p>Bình Dương - Đà Nẵng</p>
											</div>
											<div class="entry-thumb">
												<a href="#">
													<img src="{{ asset('img/front-end/popu-4.png') }}" alt="">
												</a>
											</div>
										</div>
										<div class="entry-content">
											<div class="match_height">
												<div class="icon">
													<a href="#">
														<img src="{{ asset('img/front-end/logo-bus-1.png') }}" alt="">
													</a>
												</div>
												<div class="price">
													<div>
														<p class="po">560.000.000</p>
														<p>VNĐ/1 Chiều</p>
													</div>
												</div>
											</div>
										</div>
									</article>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="section-garapopulor">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="widget widget-garapopulor">
						<div class="widget-title">
							<h2 class="title center">Địa điểm phổ biến</h2>
						</div>
						<div class="widget-content">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<article class="entry-item style-3">
										<div class="entry-title">
											<h3>Thành phố Hồ Chí Minh</h3>
										</div>
										<div class="entry-content-top clear-fix">
											<span>232.571 người đang tìm tuyến xe hôm nay</span>
											<a href="#" title="">Tuyến xe khác tại thành phố Hồ Chí Minh</a>
										</div>
										<div class="entry-content-bottom clear-fix">
											<div class="entry-thumb">
												<a href="#">
													<img src="{{ asset('img/front-end/halong.png') }}" alt="">
												</a>
											</div>	
											<div class="entry-content">
												<ul>
													<li>
														<a href="#" title="">Phương Trang Futabus</a>
														<span class="price-wrap">Từ <span>1.489.137 ₫</span> </span>
													</li>
													<li>
														<a href="#" title="">Phương Trang Futabus</a>
														<span class="price-wrap">Từ <span>1.489.137 ₫</span> </span>
													</li>
													<li>
														<a href="#" title="">Phương Trang Futabus</a>
														<span class="price-wrap">Từ <span>1.489.137 ₫</span> </span>
													</li>
												</ul>
											</div>
										</div>
									</article>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<article class="entry-item style-3">
										<div class="entry-title">
											<h3>Đà Lạt</h3>
										</div>
										<div class="entry-content-top clear-fix">
											<span>232.571 người đang tìm tuyến xe hôm nay</span>
											<a href="#" title="">Tuyến xe khác tại thành phố Đà Lạt</a>
										</div>
										<div class="entry-content-bottom clear-fix">
											<div class="entry-thumb">
												<a href="#">
													<img src="{{ asset('img/front-end/halong.png') }}" alt="">
												</a>
											</div>	
											<div class="entry-content">
												<ul>
													<li>
														<a href="#" title="">Phương Trang Futabus</a>
														<span class="price-wrap">Từ <span>1.489.137 ₫</span> </span>
													</li>
													<li>
														<a href="#" title="">Phương Trang Futabus</a>
														<span class="price-wrap">Từ <span>1.489.137 ₫</span> </span>
													</li>
													<li>
														<a href="#" title="">Phương Trang Futabus</a>
														<span class="price-wrap">Từ <span>1.489.137 ₫</span> </span>
													</li>
												</ul>
											</div>
										</div>
									</article>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<article class="entry-item style-3">
										<div class="entry-title">
											<h3>Phan Thiết</h3>
										</div>
										<div class="entry-content-top clear-fix">
											<span>232.571 người đang tìm tuyến xe hôm nay</span>
											<a href="#" title="">Tuyến xe khác tại thành phố Phan Thiết</a>
										</div>
										<div class="entry-content-bottom clear-fix">
											<div class="entry-thumb">
												<a href="#">
													<img src="{{ asset('img/front-end/halong.png') }}" alt="">
												</a>
											</div>	
											<div class="entry-content">
												<ul>
													<li>
														<a href="#" title="">Phương Trang Futabus</a>
														<span class="price-wrap">Từ <span>1.489.137 ₫</span> </span>
													</li>
													<li>
														<a href="#" title="">Phương Trang Futabus</a>
														<span class="price-wrap">Từ <span>1.489.137 ₫</span> </span>
													</li>
													<li>
														<a href="#" title="">Phương Trang Futabus</a>
														<span class="price-wrap">Từ <span>1.489.137 ₫</span> </span>
													</li>
												</ul>
											</div>
										</div>
									</article>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<article class="entry-item style-3">
										<div class="entry-title">
											<h3>Nha Trang</h3>
										</div>
										<div class="entry-content-top clear-fix">
											<span>232.571 người đang tìm tuyến xe hôm nay</span>
											<a href="#" title="">Tuyến xe khác tại thành phố Nha Trang</a>
										</div>
										<div class="entry-content-bottom clear-fix">
											<div class="entry-thumb">
												<a href="#">
													<img src="{{ asset('img/front-end/halong.png') }}" alt="">
												</a>
											</div>	
											<div class="entry-content">
												<ul>
													<li>
														<a href="#" title="">Phương Trang Futabus</a>
														<span class="price-wrap">Từ <span>1.489.137 ₫</span> </span>
													</li>
													<li>
														<a href="#" title="">Phương Trang Futabus</a>
														<span class="price-wrap">Từ <span>1.489.137 ₫</span> </span>
													</li>
													<li>
														<a href="#" title="">Phương Trang Futabus</a>
														<span class="price-wrap">Từ <span>1.489.137 ₫</span> </span>
													</li>
												</ul>
											</div>
										</div>
									</article>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop