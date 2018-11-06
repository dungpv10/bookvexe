@extends('front-end/layouts/layouts')
@section('content')
<section class="bg-section section-page-payment-bus">
	<div class="container">
		<div class="row match_height_as">
			<div class="col-lg-6 col-md-6">
				<div class="widget widget-info-customer widget-has-border">
					<div class="widget-title style-1">
						<h3 class="title">Quên mật khẩu</h3>
					</div>
					<div class="widget-content">
						<form method="post" action="#" id="form-customer-info" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
									<div class="form-group">
		                				<label for="email">Nhập địa chỉ email của bạn: <span>*</span></label>
		                				<input type="email" class="form-control email" name="email" value="" placeholder="Địa chỉ email">
		                			</div>
		                			<div class="back-login">
										<a href="#" title="">Quay lại đăng nhập?</a>
									</div>
									<button type="submit" class="button button-submit">Xác nhận</button>
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