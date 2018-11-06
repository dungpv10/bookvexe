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
				<div class="widget widget-ticket-history widget-has-border">
					<div class="widget-title style-1">
						<h3 class="title">Lịch sử mua vé</h3>
					</div>
					<div class="widget-content">
						<form method="post" action="#" id="form-ticket-history" enctype="multipart/form-data">
							<div class="form-group datetime-picker">
                				<label for="birth-day">Thời gian:</label>
                				<div class="wrap-datetime">
			                        <div class="input-group datepicker">
			                            <input id="time" class="form-control" type="text" name="time" value="" required="">
			                            <i class="fa fa-calendar-alt"></i>
			                        </div>
		                        </div>
                			</div>
                			<div class="form-group">
		                        <label for="route">Phân loại:</label>
		                        <div class="input-group">
		                        	<input id="route" class="form-control route" type="text" name="route" value="" placeholder="Chọn tuyến đường" required="" autocomplete="off">
                   					<i class="fa fa-bus"></i>
               					</div>
		                    </div>
		                    <div class="form-group">
		                    	<label for="route" class="label-submit">&nbsp;</label>
		                        <div class="input-group">
				                    <button type="submit" class="button button-submit">Tìm kiếm</button>
				                </div>
			                </div>
						</form>
						<table class="table style-1">
							<thead>
								<tr>
									<th>STT</th>
									<th>Mã</th>
									<th>SL</th>
									<th>Tuyến</th>
									<th>Ngày đi</th>
									<th>Giờ đi</th>
									<th>Tổng tiền</th>
									<th>Ngày đặt</th>
									<th>Thanh tóan</th>
									<th>Trạng thái</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>J8I3OL</td>
									<td>2</td>
									<td>Bac Binh Minh => Sai Gon</td>
									<td>19/10/2018</td>
									<td>01:00</td>
									<td>115.000</td>
									<td>17/10/2018 10:16:48</td>
									<td>Thẻ VCB</td>
									<td>Chờ thanh toán</td>
									<td><a href="#" title="">Xem chi tiết</a></td>
								</tr>
								<tr>
									<td>2</td>
									<td>J8I3OL</td>
									<td>2</td>
									<td>Bac Binh Minh => Sai Gon</td>
									<td>19/10/2018</td>
									<td>01:00</td>
									<td>115.000</td>
									<td>17/10/2018 10:16:48</td>
									<td>Thẻ VCB</td>
									<td>Chờ thanh toán</td>
									<td><a href="#" title="">Xem chi tiết</a></td>
								</tr>
								<tr>
									<td>3</td>
									<td>J8I3OL</td>
									<td>2</td>
									<td>Bac Binh Minh => Sai Gon</td>
									<td>19/10/2018</td>
									<td>01:00</td>
									<td>115.000</td>
									<td>17/10/2018 10:16:48</td>
									<td>Thẻ VCB</td>
									<td>Chờ thanh toán</td>
									<td><a href="#" title="">Xem chi tiết</a></td>
								</tr>
								<tr>
									<td>4</td>
									<td>J8I3OL</td>
									<td>2</td>
									<td>Bac Binh Minh => Sai Gon</td>
									<td>19/10/2018</td>
									<td>01:00</td>
									<td>115.000</td>
									<td>17/10/2018 10:16:48</td>
									<td>Thẻ VCB</td>
									<td>Chờ thanh toán</td>
									<td><a href="#" title="">Xem chi tiết</a></td>
								</tr>
								<tr>
									<td>5</td>
									<td>J8I3OL</td>
									<td>2</td>
									<td>Bac Binh Minh => Sai Gon</td>
									<td>19/10/2018</td>
									<td>01:00</td>
									<td>115.000</td>
									<td>17/10/2018 10:16:48</td>
									<td>Thẻ VCB</td>
									<td>Chờ thanh toán</td>
									<td><a href="#" title="">Xem chi tiết</a></td>
								</tr>
								<tr>
									<td>6</td>
									<td>J8I3OL</td>
									<td>2</td>
									<td>Bac Binh Minh => Sai Gon</td>
									<td>19/10/2018</td>
									<td>01:00</td>
									<td>115.000</td>
									<td>17/10/2018 10:16:48</td>
									<td>Thẻ VCB</td>
									<td>Chờ thanh toán</td>
									<td><a href="#" title="">Xem chi tiết</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@stop