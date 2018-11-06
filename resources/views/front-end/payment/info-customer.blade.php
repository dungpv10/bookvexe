@extends('front-end/layouts/layouts')
@section('content')
<section class="bg-section section-page-payment-bus">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="widget widget-payment-step">
					<div class="widget-content">
						<ul class="list-step">
							<li><a href="#" title="">1. Chọn Tuyến</a></li>
							<li><a href="#" title="">2. Chọn Ghế</a></li>
							<li class="active"><a href="#" title="">3. Thông tin khách hàng</a></li>
							<li><a href="#" title="">4. Thanh toán</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row match_height_as">
			<div class="col-lg-6 col-md-6">
				<div class="widget widget-info-customer widget-has-border">
					<div class="widget-title style-1">
						<h3 class="title">THÔNG TIN KHÁCH HÀNG</h3>
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
		                				<label for="coupon">Nhập mã khuyến mại (Nếu có)</label>
		                				<input type="text" class="form-control coupon" name="coupon" value="" placeholder="Nhập mã khuyến mại của bạn">
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
									<div class="form-check">
									    <input type="checkbox" class="form-check-input" id="agreer-checkbox">
									    <label class="form-check-label" for="agreer-checkbox">Chấp nhận <a href="#" title="">Điều Khoản Đặt Xe</a> của chúng tôi</label>
									</div>
									<button type="button" class="button button-submit button-back">Quay lại</button>
									<button type="submit" class="button button-submit">Tiếp tục</button>
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
						<p>-  Qúy khách vui lòng mang email có chưa mã vé đến văn phòng  để đổi vé lên xe trước giờ xuất bến <span>60 phút</span> để chúng tôi trung chuyển.</p>
						<p>-  Thông tin khách hàng phải tuyệt đối chính xác. Nếu không, sẽ không thể lên xe hoặc hủy, đổi vé.</p>
						<p>-  Qúy khách không được dổi/ trả vé vào những ngày Lễ, Tết ( Ngày thường, quý khách được quyền chuyển đổi hoặc hủy vé <span>một lần</span> duy nhất trước giờ xe chạy 24 giờ). Phí hủy vé 10%.</p>
						<p>-  Mọi thắc mắc về quy trình hay các vấn đề liên quan đặt vé, hãy gọi Tổng đài của chúng tôi:</p>
						<a class="hot-line" href="callto:"><span>Hotline:</span>  1900 878 999</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop