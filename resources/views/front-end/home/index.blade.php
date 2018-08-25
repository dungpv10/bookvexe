@extends('front-end/layouts/layouts')
@section('content')
	<section class="bg-search">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="widget has-bg">
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
					                        <input id="start_point" class="form-control geo_location" type="text" name="start_point"
                               value="" placeholder="Select location" required>
                               				<div class="wrap_location_end"></div>
					                    </div>
					                    <div class="form-group">
					                        <label for="start_time">Thời gian</label>
					                        <div class="input-group date datetimepicker">
					                            <input id="start_time" class="form-control" type="text" name="start_time" value="" required>
					                            <span class="input-group-addon">
					                                        <span class="glyphicon glyphicon-time"></span>
					                                    </span>
					                        </div>
					                    </div>
					                </div>
					                <div class="col-md-6">
					                	<div class="form-group">
					                        <label for="end_point">Điểm đến</label>
					                        <input id="end_point" class="form-control geo_location" type="text" name="end_point"
                               value="" placeholder="Select location" required>
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
					<div class="widget">
						<div class="widget-content">
							<span>Lựa chọn rất lớn cho khách hàng. Chúng tôi có hơn 50 nhà cung cấp đáng tin cậy:</span>
							<ul>
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
	<section class="bg-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="widget widget-promotion">
						<div class="widget-content">
							<div class="row">

								<div class="col-md-4">
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
								<div class="col-md-4">
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
								<div class="col-md-4">
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
@stop