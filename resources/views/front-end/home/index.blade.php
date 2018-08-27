@extends('front-end/layouts/layouts')
@section('content')
	<section class="bg-search">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="widget widget-search has-bg">
						<div class="widget-title">
							<h2 class="title white f-50">Đặt xe- Tìm kiếm, So sánh và Tiết kiệm</h2>
							<span class="sub-title white f-20">So sánh hơn 90 công ty tại hơn 2000 địa điểm tại Việt Nam. Chúng tôi bảo đảm chất lượng tốt nhất. giá thấp nhất</span>
						</div>
						<div class="widget-content">
							<form method="post" action="#" id="search-bus" enctype="multipart/form-data">
            					<input type="hidden" name="_token" value="{{csrf_token()}}">
					            <div class="row">
					                <div class="col-md-6">
					                    <div class="form-group">
					                        <label for="start_point">Điểm xuất phát</label>
					                        <div class="input-group">
					                        	<input id="start_point" class="form-control geo_location" type="text" name="start_point"
                               value="" placeholder="Select location" required>
                               					<i class="fa fa-bus"></i>
                           					</div>
                               				<div class="wrap_location_start"></div>
					                    </div>
					                    <div class="form-group datetime-picker">
					                        <label for="start_time">Thời gian</label>
					                        <div class="wrap-datetime">
						                        <div class="input-group datepicker">
						                            <input id="start_date" class="form-control" type="text" name="start_date" value="" required>
						                            <i class="fa fa-calendar-alt"></i>
						                        </div>
						                        <div class="input-group timepicker">
						                            <input id="start_time" class="form-control" type="text" name="start_time" value="" required>
						                            <i class="fa fa-clock"></i>
						                        </div>
					                        </div>
					                    </div>
					                </div>
					                <div class="col-md-6">
					                	<div class="form-group">
					                        <label for="end_point">Điểm đến</label>
					                        <div class="input-group">
					                        	<input id="end_point" class="form-control geo_location" type="text" name="end_point"
                               value="" placeholder="Select location" required>
                               					<i class="fa fa-bus"></i>
                           					</div>
                               				<div class="wrap_location_end"></div>
					                    </div>
					                    <div class="form-group">
					                        <label for="number_customer">Số lượng khách</label>
					                        {!! Form::select('number_customer', [1,2,3,4], null, ['class' => 'form-control select2', 'id' => 'number_customer']) !!}
					                    </div>
					                </div>
					            </div>
					            <div class="row">
					            	<div class="col-md-12">
					            		<button type="submit" class="button button-submit">Tìm kiếm ngay bây giờ</button>
					            	</div>
					            </div>
					        </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="section-provided bg-primary">
		<div class="container">
			<div class="row row-center">
				<div class="col col-md-11">
					<div class="widget widget-provided">
						<div class="widget-content">
							<span>Lựa chọn rất lớn cho khách hàng. Chúng tôi có hơn 50 nhà cung cấp đáng tin cậy:</span>
							<ul class="marquee">
								<li>
									<a href="#" title="">
										<img src="{{ asset('img/front-end/logo-bus-1.png') }}" alt="">
									</a>
								</li>
								<li>
									<a href="#" title="">
										<img src="{{ asset('img/front-end/logo-bus-2.png') }}" alt="">
									</a>
								</li>
								<li>
									<a href="#" title="">
										<img src="{{ asset('img/front-end/logo-bus-1.png') }}" alt="">
									</a>
								</li>
								<li>
									<a href="#" title="">
										<img src="{{ asset('img/front-end/logo-bus-2.png') }}" alt="">
									</a>
								</li>
							</ul>
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
				<div class="col col-lg-11 col-md-12">
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
							<p>Đánh giá <span class="bold">8,8</span>/10 dựa trên hơn <span class="underline">2978</span> ý <span class="underline">kiến của khách hàng</span></p>
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
							<h2 class="title">Tuyến xe đặt phổ biến nhất</h2>
						</div>
						<div class="widget-content">
							<div class="row">
								<div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
									<article class="entry-item bg-white style-2">
										<div class="entry-thumb">
											<div class="position">
												<i class="fa fa-map-marker"></i>
												<p class="po">TP. Hồ Chí Minh - Cần thơ</p>
											</div>
											<div class="entry-thumb">
												<a href="#">
													<img src="{{ asset('img/front-end/popu-1.png') }}" alt="">
												</a>
											</div>
										</div>
										<div class="entry-content">
											<div class="row">
												<div class="col-md-6 col-sm-6 col-xs-6 ">
													<a href="#">
														<img src="{{ asset('img/front-end/logo-bus-3.png') }}" alt="">
													</a>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6 price">
													<p class="po">140.000.000</p>
													<p class="po">VNĐ/1 Chiều</p>
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
												<p class="po">Đà Nẵng - Cần thơ</p>
											</div>
											<div class="entry-thumb">
												<a href="#">
													<img src="{{ asset('img/front-end/popu-2.png') }}" alt="">
												</a>
											</div>
										</div>
										<div class="entry-content">
											<div class="row">
												<div class="col-md-6 col-sm-6 col-xs-6">
													<a href="#">
														<img src="{{ asset('img/front-end/logo-bus-3.png') }}" alt="">
													</a>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6 price">
													<p class="po">340.000.000</p>
													<p class="po">VNĐ/1 Chiều</p>
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
												<p class="po">Cà Mau - Bình Thuận</p>
											</div>
											<div class="entry-thumb">
												<a href="#">
													<img src="{{ asset('img/front-end/popu-3.png') }}" alt="">
												</a>
											</div>
										</div>
										<div class="entry-content">
											<div class="row">
												<div class="col-md-6 col-sm-6 col-xs-6">
													<a href="#">
														<img src="{{ asset('img/front-end/logo-bus-3.png') }}" alt="">
													</a>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6 price">
													<p class="po">560.000.000</p>
													<p class="po">VNĐ/1 Chiều</p>
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
												<p class="po">Bình Dương - Đà Nẵng</p>
											</div>
											<div class="entry-thumb">
												<a href="#">
													<img src="{{ asset('img/front-end/popu-4.png') }}" alt="">
												</a>
											</div>
										</div>
										<div class="entry-content">
											<div class="row">
												<div class="col-md-6 col-sm-6 col-xs-6">
													<a href="#">
														<img src="{{ asset('img/front-end/logo-bus-1.png') }}" alt="">
													</a>
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6 price">
													<p class="po">560.000.000</p>
													<p class="po">VNĐ/1 Chiều</p>
												</div>
											</div>
										</div>
									</article>
								</div>
							</div>
							<p class="sub">Giá trên chỉ mang tính tương đối. Chúng dựa trên khách hàng đặt vé được thực hiện trong 48 giờ qua và tùy thuộc vào ngày đặt vé.</p>
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
							<h2 class="title">Top 4 nhà xe được ưa chuộng nhất 2018</h2>
						</div>
						<div class="widget-content">
							<div class="row">
								<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
									<article class="entry-item match_height style-3">
										<div class="entry-thumb">
											<a href="#">
												<img src="{{ asset('img/front-end/logo-bus-3.png') }}" alt="">
											</a>
										</div>
										<div class="entry-content">
											<div>
												<p class="highlights">Hoang Long Group</p>
												<p>Tuyệt vời 8.3</p>
											</div>
										</div>
									</article>
								</div>
								<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
									<article class="entry-item match_height style-3">
										<div class="entry-thumb">
											<a href="#">
												<img src="{{ asset('img/front-end/logo-bus-3.png') }}" alt="">
											</a>
										</div>
										<div class="entry-content">
											<div>
												<p class="highlights">Futa Bus Phương Trang</p>
												<p>Tuyệt vời 8.3</p>
											</div>
										</div>
									</article>
								</div>
								<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
									<article class="entry-item match_height style-3">
										<div class="entry-thumb">
											<a href="#">
												<img src="{{ asset('img/front-end/logo-bus-3.png') }}" alt="">
											</a>
										</div>
										<div class="entry-content">
											<div>
												<p class="highlights">Mai Linh Group</p>
												<p>Tuyệt vời 8.3</p>
											</div>
										</div>
									</article>
								</div>
								<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
									<article class="entry-item match_height style-3">
										<div class="entry-thumb">
											<a href="#">
												<img src="{{ asset('img/front-end/logo-bus-3.png') }}" alt="">
											</a>
										</div>
										<div class="entry-content">
											<div>
												<p class="highlights">Hoang Long Group</p>
												<p>Tuyệt vời 8.3</p>
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
	<section class="bg-primary section-releson">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="widget wiget-choose-me">
						<div class="widget-title">
							<h2 class="title white">Tại sao chọn chúng tôi?</h2>
						</div>
						<div class="widget-content">
							<i class="fa fa-check-circle"></i>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="widget widget-releson">
						<div class="widget-content">

							<article class="entry-item">
								<div class="entry-content">
									<h3 class="entry-title white">Cung cấp nhiều lựa chọn cho khách hàng</h3>
									<p>Cung cấp dịch vụ đặt vé trực truyến với hơn 2.000 xe ô tô tại hơn  21 tỉnh thành Việt Nam, chúng tôi có thể tìm cho bạn một chiếc xe tuyệt vời ở đúng vị trí với mức giá tốt nhất</p>
								</div>
							</article>
							<article class="entry-item">
								<div class="entry-content">
									<h3 class="entry-title white">Mức độ hài lòng cao</h3>
									<p>Điểm đánh giá  8.9 / 10 Dựa trên phản hồi từ hàng nghìn khách hàng của chúng tôi</p>
								</div>
							</article>
							<article class="entry-item">
								<div class="entry-content">
									<h3 class="entry-title white">Hỗ trợ cá nhân trong quá trình đặt vé</h3>
									<p>Hỗ trợ khách hàng 24/7 qua kênh ưa thích của bạn Tư vấn -  Điện thoại -  Email </p>
								</div>
							</article>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@stop