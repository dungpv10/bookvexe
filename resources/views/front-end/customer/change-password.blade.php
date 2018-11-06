@extends('front-end/layouts/layouts')
@section('content')
<section class="bg-section section-page-payment-bus">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="widget widget-payment-step">
					<div class="widget-content">
						<ul class="list-step style-1">
							<li><a href="#" title=""><i class="fa fa-user"></i>Thông Tin Cá Nhân</a></li>
							<li><a href="#" title=""><i class="fa fa-lock"></i>Đổi Mật Khẩu</a></li>
							<li class="active"><a href="#" title=""><i class="fa fa-undo"></i>Lịch Sử Mua Vé</a></li>
							<li><a href="#" title=""><i class="fa fa-star"></i>Điểm Thưởng</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row match_height_as">
			<div class="col-lg-12 col-md-12">
				<div class="widget widget-info-customer widget-has-border">
					<div class="widget-title style-1">
						<h3 class="title">Đổi Mật Khẩu</h3>
					</div>
					<div class="widget-content">
						<form method="post" action="#" id="form-customer-info" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12">
		                			<div class="form-group">
		                				<label for="email">Email: <span>*</span></label>
		                				<input type="email" class="form-control email" name="email" value="" placeholder="Địa chỉ email">
		                			</div>
		                			<div class="form-group">
		                				<label for="password">Mật khẩu cũ: <span>*</span></label>
		                				<input type="password" class="form-control password" name="password" value="" placeholder="Mật khẩu cũ">
		                			</div>
		                			<div class="form-group">
		                				<label for="new-password">Mật khẩu mới: <span>*</span></label>
		                				<input type="password" class="form-control new-password" name="new-password" value="" placeholder="Mật khẩu mới">
		                			</div>
		                			<div class="form-group">
		                				<label for="confirm-password">Nhập lại mật khẩu mới: <span>*</span></label>
		                				<input type="password" class="form-control confirm-password" name="confirm-password" value="" placeholder="Nhập lại mật khẩu mới">
		                			</div>
		                			<button type="submit" class="button button-submit">Cập nhật</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop