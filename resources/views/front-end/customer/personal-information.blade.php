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
			<div class="col-lg-6 col-md-6">
				<div class="widget widget-info-customer widget-has-border">
					<div class="widget-title style-1">
						<h3 class="title">THÔNG TIN Cá Nhân</h3>
					</div>
					<div class="widget-content">
						<form method="post" action="#" id="form-customer-info" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
		                				<label for="full-name">Họ và tên: <span>*</span></label>
		                				<input type="text" class="form-control full-name" name="full-name" value="" placeholder="Họ và tên khách hàng">
		                			</div>
		                			<div class="form-group">
		                				<label for="email">Email: <span>*</span></label>
		                				<input type="text" class="form-control email" name="email" value="" placeholder="Địa chỉ email">
		                			</div>
		                			<div class="form-group">
		                				<label for="phone-1">Di động 1: <span>*</span></label>
		                				<input type="text" class="form-control phone-1" name="phone-1" value="" placeholder="Số di dộng 1">
		                			</div>
		                			<div class="form-group">
		                				<label for="state">Tỉnh/Thành phố: <span>*</span></label>
		                				<input type="text" class="form-control state" name="state" value="" placeholder="Tỉnh thành phố">
		                			</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
		                				<label for="cmtnd">Số CMTND: <span>*</span></label>
		                				<input type="text" class="form-control cmtnd" name="cmtnd" value="" placeholder="Nhập số cmtnd">
		                			</div>
		                			<div class="form-group datetime-picker">
		                				<label for="birth-day">Ngày sinh</label>
		                				<div class="wrap-datetime">
					                        <div class="input-group datepicker">
					                            <input id="birth-day" class="form-control" type="text" name="birth-day" value="" required="">
					                        </div>
				                        </div>
		                			</div>
		                			<div class="form-group">
		                				<label for="phone-2">Di động 2: <span>*</span></label>
		                				<input type="text" class="form-control phone-2" name="phone-2" value="" placeholder="Số di dộng 2">
		                			</div>
		                			<div class="form-group">
		                				<label for="district">Quyện/Huyện: <span>*</span></label>
		                				<input type="text" class="form-control district" name="district" value="" placeholder="Quyện/Huyện">
		                			</div>
								</div>
								<div class="col-md-12">
									<button type="submit" class="button button-submit">Cập nhật</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="widget widget-notice-customer widget-has-border">
					<div class="widget-title style-1">
						<h3 class="title">ĐIỀU KHOẢN LƯU Ý</h3>
					</div>
					<div class="widget-content">
						<label for="">Qúy khách lưu ý: <span>*</span></label>
						<p>-  Thông tin khách hàng phải tuyệt đối chính xác. Nếu không, sẽ không thể lên xe hoặc hủy, đổi vé.</p>
						<p>-  Mọi thắc mắc về quy trình hay các vấn đề liên quan đặt vé, hãy gọi Tổng đài của chúng tôi:</p>
						<a class="hot-line" href="callto:"><span>Hotline:</span>  1900 878 999</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop