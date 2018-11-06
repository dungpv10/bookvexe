@extends('front-end/layouts/layouts')
@section('content')
<section class="bg-section section-page-payment-method-bus">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="widget widget-payment-step">
					<div class="widget-content">
						<ul class="list-step">
							<li><a href="#" title="">1. Chọn Tuyến</a></li>
							<li><a href="#" title="">2. Chọn Ghế</a></li>
							<li><a href="#" title="">3. Thông tin khách hàng</a></li>
							<li class="active"><a href="#" title="">4. Thanh toán</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row match_height_as">
			<div class="col-lg-6 col-md-6">
				<div class="widget widget-info-ticket widget-has-border">
					<div class="widget-title style-1">
						<h3 class="title">THÔNG TIN đặt vé</h3>
					</div>
					<div class="widget-content">
						<table class="table">
							<tbody>
								<tr>
									<td>Tuyến:</td>
									<td>Châu Đốc - Cần Thơ</td>
								</tr>
								<tr>
									<td>Ngày đi:</td>
									<td>05:00 24-09-2018</td>
								</tr>
								<tr>
									<td>Ghế/giường:</td>
									<td>03, 11</td>
								</tr>
								<tr>
									<td>Điểm lên xe:</td>
									<td>VP Châu Đốc, 69 Văn Rang, P. Chấu Phú A, Thành phố Châu Đốc.Tỉnh Phan Rang</td>
								</tr>
								<tr>
									<td>Họ và tên:</td>
									<td>Lê Minh Ánh</td>
								</tr>
								<tr>
									<td>Email:</td>
									<td>leminhanh@gmail.com</td>
								</tr>
								<tr>
									<td>Số điện thoại:</td>
									<td>0903498989</td>
								</tr>
								<tr>
									<td>Tổng tiền:</td>
									<td>200,000 VND</td>
								</tr>
							</tbody>
						</table>
						<button type="button" class="button button-submit button-back">Quay lại</button>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="widget widget-select-payment widget-has-border">
					<div class="widget-title style-1">
						<h3 class="title">chọn cổng thanh toán</h3>
					</div>
					<div class="widget-content">
						<form method="post" action="#" id="form-payment-method" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="row match_height">
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="entry-item-payment-method">
										<p class="name-method">Thanh toán thẻ tín dụng, ghi nợ</p>
										<div class="wrap">
											<img src="{{ asset('img/front-end/payment-visa.png') }}" alt="">
										</div>
										<input type="radio" name="visa">
									</div>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="entry-item-payment-method">
										<p class="name-method">Thanh toán thẻ ATM Nội Địa</p>
										<div class="wrap">
											<img src="{{ asset('img/front-end/payment-visa.png') }}" alt="">
										</div>
										<input type="radio" name="visa">
									</div>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="entry-item-payment-method">
										<p class="name-method">Thanh toán thẻ Napas</p>
										<div class="wrap">
											<img src="{{ asset('img/front-end/napas.png') }}" alt="">
										</div>
										<input type="radio" name="visa">
									</div>
								</div>
							</div>
							<button type="submit" class="button button-submit">Thanh toán</button>
						</form>
						<a class="hot-line" href="callto:"><span>Hotline:</span>  1900 878 999</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop