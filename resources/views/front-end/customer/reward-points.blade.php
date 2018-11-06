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
				<div class="widget widget-reward-points widget-has-border">
					<div class="widget-title style-1">
						<h3 class="title">XẾP HẠNG THÀNH VIÊN</h3>
					</div>
					<div class="widget-content">
						<table>
							<tbody>
								<tr>
									<td><i class="fa fa-star"></i>Cấp độ thành viên</td>
									<td>Thành Viên</td>
								</tr>
								<tr>
									<td><i class="fa fa-heart"></i>Tổng số tiền tích lũy(đ/năm)</td>
									<td>0</td>
								</tr>
								<tr>
									<td><i class="fa fa-gift"></i>Tổng số tiền tích lũy</td>
									<td>0</td>
								</tr>
								<tr>
									<td><i class="fa fa-bookmark"></i>Số điểm tích lũy khả dụng</td>
									<td>0</td>
								</tr>
								<tr>
									<td><i class="fa fa-shopping-cart"></i>Số điểm tích lũy đã sử dụng</td>
									<td>0</td>
								</tr>
							</tbody>
						</table>
						<p>Thông báo!</p>
						<p><span class="name-web">Bookvexe</span> trân trọng thông báo đến quý hành khách về chương trình đổi điểm thưởng để mua vé dự kiến sẽ được tổ chức theo đợt, vì vậy quý hành khách hãy mua vé để tích lũy thật nhiều điểm thưởng và cơ hội nhận được những ưu đãi từ hệ thống đặt vé ONLINE của <span class="name-web">Bookvexe</span>.</p>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="widget widget-notice-customer widget-has-border">
					<div class="widget-title style-1">
						<h3 class="title">CHÍNH SÁCH ĐIỂM THƯỞNG</h3>
					</div>
					<div class="widget-content">
						<label for="">Qúy khách lưu ý: <span>*</span></label>
						<p>- Chương trình bao gồm các đối tượng: Thành viên | Khách hàng thân thiết | Khách hàng VIP, với những quyền lợi và mức ưu đãi khác nhau. Mỗi khi thực hiện giao dịch mua vé thành công tại hệ thống ONLINE của <span class="name-web">Bookvexe</span>, bạn sẽ nhận ngay một số điểm thưởng nhất định.</p>
						<p>Hãy tích luỹ thật nhiều điểm thưởng để nâng cấp thành viên và đổi vé tương ứng!</p>
						<p>Điểm thưởng được dùng để thanh toán cho các giao dịch của bạn tại hệ thống đặt vé ONLINE của <span class="name-web">Bookvexe</span> với mức quy đổi 1 điểm = 1000đ</p>
						<p>Ví dụ: với giao dịch mua vé với giá 100.000 VND bạn có thể:
							<br>- Thanh toán 80.000 VND + 20 điểm thưởng
							<br>- Hoặc thanh toán với 0 VND + 100 điểm thưởng
						</p>
						<p>Lưu ý: 
							- Số điểm tối thiểu bạn có thể sử dụng là 20 điểm
							- Chính sách điểm thưởng: điểm thưởng của bạn có thời hạn sử dụng là 1 năm.</p>	
						<a class="hot-line" href="callto:"><span>Hotline:</span>  1900 878 999</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop