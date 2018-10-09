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
							<li class="active"><a href="#" title="">2. Chọn Ghế</a></li>
							<li><a href="#" title="">3. Thông tin khách hàng</a></li>
							<li><a href="#" title="">4. Thanh toán</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 side-bar">
				side bar
			</div>
			<div class="col-lg-9 col-md-9">
				content
			</div>
		</div>
	</div>
</section>
@stop