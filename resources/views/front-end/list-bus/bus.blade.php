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
					                    <div class="row">
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
					                    	<div class="col-md-12 col-sm-6">
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
					<div class="widget widget-filter">
						<div class="widget-title">
							<h2 class="title style-1">Bộ Lọc Tìm Kiếm theo</h2>
						</div>
						<div class="widget-content">
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
									<div class="right">
										<div class="customer-rate">
											<div class="text">
												<p>Rất tốt</p>
												<span>50+ đánh giá</span>
											</div>
											<div class="number">
												<span>8.6</span>
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
									<div class="bus-nav-tab">
										<ul class="nav nav-tabs">
                                            <li class=""><a href="#tab-profile1" data-toggle="tab" title="new" aria-expanded="true">Hình ảnh</a></li>
                                            <li class=""><a href="#tab-profile2" data-toggle="tab" title="new" aria-expanded="false">Lịch trình</a></li>
                                            <li class=""><a href="#tab-profile3" data-toggle="tab" title="new" aria-expanded="false">Chính sách</a></li>
                                            <li class=""><a href="#tab-profile4" data-toggle="tab" title="new" aria-expanded="false">Viết đánh giá</a></li>
                                            <li class=""><a href="#tab-profile5" data-toggle="tab" title="new" aria-expanded="false">Giờ khởi hành khác</a></li>
                                            <form method="post" action="#" id="reservations-bus" enctype="multipart/form-data">
		        								<input type="hidden" name="_token" value="{{csrf_token()}}">
		        								<button type="submit" class="button button-submit" name="submit"><i class="fa fa-bus"></i>Đặt chỗ</button>
		        							</form>
                                        </ul>
                                        <div class="tab-content">
                                        	<div class="tab-pane" id="tab-profile1">
                                        		<p>content-1</p>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile2">
                                        		<p>content-2</p>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile3">
                                        		<p>content-3</p>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile4">
                                        		<p>content-4</p>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile5">
                                        		<p>content-5</p>
                                        	</div>
                                        </div>
									</div>
								</div>
							</div>
						</div>
						<div class="entry-item-bus clear-fix">
							<div class="entry-thumb">
								<a href="#" title=""><img src="{{ asset('img/front-end/list-bus-3.png') }}" alt=""></a>
							</div>
							<div class="entry-content">
								<div class="content-header">
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
									<div class="right">
										<div class="customer-rate">
											<div class="text">
												<p>Rất tốt</p>
												<span>50+ đánh giá</span>
											</div>
											<div class="number">
												<span>8.6</span>
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
									<div class="bus-nav-tab">
										<ul class="nav nav-tabs">
                                            <li class=""><a href="#tab-profile1" data-toggle="tab" title="new" aria-expanded="true">Hình ảnh</a></li>
                                            <li class=""><a href="#tab-profile2" data-toggle="tab" title="new" aria-expanded="false">Lịch trình</a></li>
                                            <li class=""><a href="#tab-profile3" data-toggle="tab" title="new" aria-expanded="false">Chính sách</a></li>
                                            <li class=""><a href="#tab-profile4" data-toggle="tab" title="new" aria-expanded="false">Viết đánh giá</a></li>
                                            <li class=""><a href="#tab-profile5" data-toggle="tab" title="new" aria-expanded="false">Giờ khởi hành khác</a></li>
                                            <form method="post" action="#" id="reservations-bus" enctype="multipart/form-data">
		        								<input type="hidden" name="_token" value="{{csrf_token()}}">
		        								<button type="submit" class="button button-submit" name="submit"><i class="fa fa-bus"></i>Đặt chỗ</button>
		        							</form>
                                        </ul>
                                        <div class="tab-content">
                                        	<div class="tab-pane" id="tab-profile1">
                                        		<p>content-1</p>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile2">
                                        		<p>content-2</p>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile3">
                                        		<p>content-3</p>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile4">
                                        		<p>content-4</p>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile5">
                                        		<p>content-5</p>
                                        	</div>
                                        </div>
									</div>
								</div>
							</div>
						</div>
						<div class="entry-item-bus clear-fix">
							<div class="entry-thumb">
								<a href="#" title=""><img src="{{ asset('img/front-end/list-bus-3.png') }}" alt=""></a>
							</div>
							<div class="entry-content">
								<div class="content-header">
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
									<div class="right">
										<div class="customer-rate">
											<div class="text">
												<p>Rất tốt</p>
												<span>50+ đánh giá</span>
											</div>
											<div class="number">
												<span>8.6</span>
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
									<div class="bus-nav-tab">
										<ul class="nav nav-tabs">
                                            <li class=""><a href="#tab-profile1" data-toggle="tab" title="new" aria-expanded="true">Hình ảnh</a></li>
                                            <li class=""><a href="#tab-profile2" data-toggle="tab" title="new" aria-expanded="false">Lịch trình</a></li>
                                            <li class=""><a href="#tab-profile3" data-toggle="tab" title="new" aria-expanded="false">Chính sách</a></li>
                                            <li class=""><a href="#tab-profile4" data-toggle="tab" title="new" aria-expanded="false">Viết đánh giá</a></li>
                                            <li class=""><a href="#tab-profile5" data-toggle="tab" title="new" aria-expanded="false">Giờ khởi hành khác</a></li>
                                            <form method="post" action="#" id="reservations-bus" enctype="multipart/form-data">
		        								<input type="hidden" name="_token" value="{{csrf_token()}}">
		        								<button type="submit" class="button button-submit" name="submit"><i class="fa fa-bus"></i>Đặt chỗ</button>
		        							</form>
                                        </ul>
                                        <div class="tab-content">
                                        	<div class="tab-pane" id="tab-profile1">
                                        		<p>content-1</p>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile2">
                                        		<p>content-2</p>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile3">
                                        		<p>content-3</p>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile4">
                                        		<p>content-4</p>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile5">
                                        		<p>content-5</p>
                                        	</div>
                                        </div>
									</div>
								</div>
							</div>
						</div>
						@include('front-end.element.paginator') 
					</div>
				</div>
			</div>
		</div>
	</section>
@stop