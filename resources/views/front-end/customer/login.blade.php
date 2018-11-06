@extends('front-end/layouts/layouts')
@section('content')
<section class="bg-section section-page-payment-bus">
	<div class="container">
		<div class="row match_height_as">
			<div class="col-lg-6 col-md-6">
				<div class="widget widget-info-customer widget-has-border">
					<div class="widget-title style-1">
						<h3 class="title">Đăng Nhập</h3>
					</div>
					<div class="widget-content">
						<form method="post" action="#" id="form-customer-info" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
									<div class="form-group">
		                				<label for="username">Tên đăng nhập: <span>*</span></label>
		                				<input type="text" class="form-control username" name="username" value="" placeholder="Tên đăng nhập">
		                			</div>
		                			<div class="form-group">
		                				<label for="password">Mật khẩu: <span>*</span></label>
		                				<input type="password" class="form-control password" name="password" value="" placeholder="Mật khẩu">
		                			</div>
		                			<div class="registration-diff-acc">
										<span>Đăng ký bằng tài khoản khác:</span>
										<ul class="registration-list">
											<li><a href="#" title=""><img src="{{ asset('img/front-end/icon-facebook.png') }}" alt=""></a></li>
											<li><a href="#" title=""><img src="{{ asset('img/front-end/icon-gg.png') }}" alt=""></a></li>
											<li><a href="#" title=""><img src="{{ asset('img/front-end/icon-tw.png') }}" alt=""></a></li>
										</ul>
										<a href="#" title="">Quên mật khẩu?</a>
									</div>
									<button type="submit" class="button button-submit">Đăng ký</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="widget widget-welcome-customer widget-has-border">
					<div class="widget-title style-1">
						<h3 class="title">WELCOME TO BOOKVEXE</h3>
					</div>
					<div class="widget-content">
						<img src="{{ asset('img/front-end/welcome-customer.png') }}" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop