@extends('front-end/layouts/layouts')
@section('css')
	<!-- TODO update fontawesome miss icon-->
	<link href="{{ asset('css/jquery.seat-charts.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('content')
<section class="bg-section section-page-payment-choose-seat">
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
			<form method="post" action="#" id="form-pick-up-the-bus" enctype="multipart/form-data">
				<div class="col-lg-3 col-md-3 side-bar">
					<div class="widget widget-payment-custom-info-bus widget-custom-bg">
						<div class="widget-title">
							<h3 class="title style-2">
								Châu Đốc - Cần Thơ  Ngày 24-09-2018
							</h3>
						</div>
						<div class="widget-content">
							<div class="route-selection">
								<p>Chọn Tuyến Xe</p>
								<span><i class="fa fa-bus"></i>Chầu Đốc - Cần Thơ</span>
								<span><i class="fa fa-bus"></i>Giá vé 100.000 VNĐ</span>
							</div>
							<div class="form-group wrap-time-start">
		                        <label for="choose_start_time">Chọn giờ khởi hành</label>
		                        <div class="input-group">
		                            {!! Form::select('choose_start_time', ['05:00(Ghế)','06:00(Ghế)','07:00(Ghế)','08:00(Ghế)'], null, ['class' => 'form-control select2', 'id' => 'choose_start_time']) !!}
		                            <i class="fa fa-clock"></i>
		                        </div>
		                    </div>
		                    <div class="form-group wrap-start-point">
		                        <label for="start_point">Chọn điểm lên xe</label>
		                        <div class="input-group">
		                        	<input id="start_point" class="form-control geo_location" type="text" name="start_point"
                   value="Vĩnh Tre - Châu Đốc" required>
                   					<i class="fa fa-map-marker"></i>
               					</div>
                   				<div class="wrap_location_start"></div>
		                    </div>
		                    <div class="clear-fix">
		                    	<button type="button" class="button button-submit button-back">Quay lại</button>
								<button type="submit" class="button button-submit">Tiếp tục</button>
		                    </div>
						</div>
					</div>
					<div class="widget widget-payment-info-draw widget-custom-bg">
						<div class="widget-title">
							<h3 class="title style-2">
								Thông tin chuyến
							</h3>
						</div>
						<div class="widget-content">
							<div class="wrap-start-end-bus">
								<p class="start-end"><i class="fa fa-bus"></i>Xuất phát <span>24-09-2018</span><span>05:00</span></p>
								<div class="draw-position">
									<div class="draw-position-start"><span>Châu Đốc</span></div>
									<div class="draw-time"><span>Thời gian: 04 tiếng</span></div>
									<div class="draw-position-end"><span>Đà Nẵng</span></div>
								</div>
								<p class="start-end"><i class="fa fa-bus"></i>Lúc đến <span>24-09-2018</span><span>05:00</span></p>
							</div>
							<h4 class="name-garage">Nhà xe phương trang FUTASBUS</h4>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-9">
					<!-- <div class="widget widget-list-bus style-1">
						<div class="entry-item-bus clear-fix">
							<div class="entry-content">
								<div class="content-header">
									<div class="left">
										<h3 class="entry-title"><a href="#" title="">Nhà xe Futas Bus Phương Trang</a></h3>
										<div class="rate-item">
											<div class="wrap-star">
												<span class="star-no-rate">
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
													<i class="fa fa-star star"></i>
												</span>
												<span class="star-rate">
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
													<i class="fa fa-star star rate"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="content-footer">
									<div class="bus-nav-tab">
										<ul class="nav nav-tabs">
                                            <li class=""><a href="#tab-profile1" data-toggle="tab" title="new" aria-expanded="true">Hình ảnh</a></li>
                                            <li class=""><a href="#tab-profile2" data-toggle="tab" title="new" aria-expanded="false">Lịch trình</a></li>
                                            <li class=""><a href="#tab-profile3" data-toggle="tab" title="new" aria-expanded="false">Chính sách</a></li>
                                            <li class=""><a href="javascript:void(0)" onclick="showCustomerComment(this)">Viết đánh giá</a></li>
                                        </ul>
                                        <div class="tab-content">
                                        	<div class="tab-pane" id="tab-profile1">
                                        		<div class="galery-bus-tab">
													<h3>Hình ảnh của Xe Futas Bus Phương Trang</h3>
													<div class="owl-carousel owl-theme">
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-1.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-2.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-3.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-1.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-2.png') }}" alt="">
															</div>
														</div>
														<div class="item">
															<div class="entry-thumb">
																<img src="{{ asset('img/front-end/img-bus-3.png') }}" alt="">
															</div>
														</div>
													</div>
												</div>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile2">
                                        		<div class="schedule-tab">
                                        			<h3>Lịch trình xe Futas Bus Phương Trang từ Thanh Xuân - Hà Nội đến Thành phố Hồ Chí Minh</h3>
                                        			<table class="table">
                                        				<thead>
                                        					<tr>
	                                        					<th>Thời gian (đến)</th>
	                                        					<th>Điển đi (đến)</th>
	                                        					<th>Địa chỉ</th>
	                                        				</tr>
                                        				</thead>
                                        				<tbody>
                                        					<tr>
	                                        					<td class="bold">7.30</td>
	                                        					<td>Khuất Duy Tiến</td>
	                                        					<td>166, 168 Khuất Duy Tiến - Thanh Xuân - Hà Nội</td>
	                                        				</tr>
	                                        				<tr>
	                                        					<td class="bold">08.10</td>
	                                        					<td>Văn phòng Liêm Tuyền</td>
	                                        					<td>Quốc lộ 1A, Cạnh trạm thu phí Liêm Tuyền - Thanh Liêm - Hà Nam</td>
	                                        				</tr>
                                        				</tbody>
                                        			</table>
                                        			<span class="attention">Lưu ý:</span>
                                        			<p>Đây là lịch trình tham khảo, sẽ thay đổi tuỳ thuộc vào từng chuyến xe. Để biết thêm thông tin chi tiết, xin quý khách vui lòng liên hệ với Bookvexe qua số Hotline: 1900 7075 (miền Bắc) hoặc 1900 969681 - 1900 7070 (miền Nam)</p>
                                        		</div>
                                        	</div>
                                        	<div class="tab-pane" id="tab-profile3">
                                        		<div class="policy-tab">
                                        			<h3>Lịch trình xe Futas Bus Phương Trang từ Thanh Xuân - Hà Nội đến Thành phố Hồ Chí Minh</h3>
                                        			<table class="table">
                                        				<thead>
                                        					<tr>
	                                        					<th>Thời gian hủy</th>
	                                        					<th>Phí hủy</th>
	                                        				</tr>
                                        				</thead>
                                        				<tbody>
                                        					<tr>
	                                        					<td>Từ 0 tiếng đến 2 tiếng trước giờ khởi hành</td>
	                                        					<td>Không hoàn tiền</td>
	                                        				</tr>
	                                        				<tr>
	                                        					<td>Trước 2 tiếng trước giờ khởi hành</td>
	                                        					<td>6%</td>
	                                        				</tr>
                                        				</tbody>
                                        			</table>
                                        			<span class="attention">Lưu ý:</span>
                                        			<p>Mọi thắc mắc về quy trình hay các vấn đề liên quan đặt vé, hãy gọi Tổng đài của chúng tôi:</p>
                                        			<a class="hot-line" href="callto:"><span>Hotline:</span>  1900 878 999</a>
                                        		</div>
                                        	</div>
                                        </div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					<div class="widget widget-booking-details widget-seat-floor">
						<div class="widget-content">
							<div class="booking-details">
							    <h3>Số ghế: <ul id="selected-seats"></ul></h3>
							    <span>Tổng tiền:  <span>(<span id="total">0</span> VND)</span></span>
							</div>
							<div class="bus-seat-floor">
								<div class="front-indicator">Sơ đồ ghế</div>
								<div class="wrap row">
									<div id="seat-map" class="col-md-6 col-sm-6">
										<div class="front-indicator-floor">Tầng 1</div>
									    <div class="control-seat"><i class="fa fa-adjust"></i></div>
									</div>
									<div id="seat-map-2-floor" class="col-md-6 col-sm-6">
										<div class="front-indicator-floor">Tầng 2</div>
									    <div class="control-seat"><i class="fa"></i></div>
									</div>
								</div>
							</div>
							<div class="seat-map-note">
								<div class="selected">
									<span></span>
									Đã chọn
								</div>
								<div class="select">
									<span></span>
									Đang chọn
								</div>
								<div class="still_empty">
									<span></span>
									Còn trống
								</div>
							</div>
						</div>	
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<div class="modal fade bd-example-modal-lg" id="customer-comment" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="box-title">Viết đánh giá nhà xe Futas Bus Phương Trang</h3>
            </div>
            <div class="modal-body">
            	<form method="post" action="#" id="form-customer-comment" enctype="multipart/form-data">
        			<input type="hidden" name="_token" value="{{csrf_token()}}">
        			<p class="router">Tuyến đường: Cầu Giấy - Nam Định</p>
        			<div class="row">
                		<div class="col-md-6 col-sm-6 col-xs-12">
                			<div class="form-group">
                				<label for="full-name">Họ và tên:<span>*</span></label>
                				<input type="text" class="form-control full-name" name="full-name" value="" placeholder="Họ và tên khách hàng">
                			</div>
                			<div class="form-group">
                				<label for="full-name">Email:<span>*</span></label>
                				<input type="email" class="form-control email" name="email" value="" placeholder="Địa chỉ email">
                			</div>
                			<div class="form-group datetime-picker">
                				<label for="start_date">Chọn ngày đi:<span>*</span></label>
                				<div class="wrap-datetime">
			                        <div class="input-group datepicker">
			                            <input id="start_date" class="form-control" type="text" name="start_date" value="" required="">
			                        </div>
		                        </div>
                			</div>
                		</div>
                		<div class="col-md-6 col-sm-6 col-xs-12">
                			<div class="wrap-rate-star">
                				<span>Xin vui lòng bấm để đánh giá</span>
                				<div class="comment-form-rating">
                                    <span>Tổng quan:</span>
                                    <div class="rating">
                                        <span class="star" data-value="5">☆</span>
                                        <span class="star" data-value="4">☆</span>
                                        <span class="star" data-value="3">☆</span>
                                        <span class="star" data-value="2">☆</span>
                                        <span class="star" data-value="1">☆</span>
                                    </div>
                                    <input type="hidden" name="star-overview" class="rating-number" value="">
                                </div>
                                <div class="comment-form-rating">
                                    <span>Chất lượng:</span>
                                    <div class="rating">
                                        <span class="star" data-value="5">☆</span>
                                        <span class="star" data-value="4">☆</span>
                                        <span class="star" data-value="3">☆</span>
                                        <span class="star" data-value="2">☆</span>
                                        <span class="star" data-value="1">☆</span>
                                    </div>
                                    <input type="hidden" name="star-quality" class="rating-number" value="">
                                </div>
                                <div class="comment-form-rating">
                                    <span>Đúng giờ:</span>
                                    <div class="rating">
                                        <span class="star" data-value="5">☆</span>
                                        <span class="star" data-value="4">☆</span>
                                        <span class="star" data-value="3">☆</span>
                                        <span class="star" data-value="2">☆</span>
                                        <span class="star" data-value="1">☆</span>
                                    </div>
                                    <input type="hidden" name="star-ontime" class="rating-number" value="">
                                </div>
                                <div class="comment-form-rating">
                                    <span>Thái độ phục vụ:</span>
                                    <div class="rating">
                                        <span class="star" data-value="5">☆</span>
                                        <span class="star" data-value="4">☆</span>
                                        <span class="star" data-value="3">☆</span>
                                        <span class="star" data-value="2">☆</span>
                                        <span class="star" data-value="1">☆</span>
                                    </div>
                                    <input type="hidden" name="star-service-attitude" class="rating-number" value="">
                                </div>
                			</div>
                		</div>
            		</div>
            		<div class="row">
            			<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
                				<label for="comment">Viết đánh giá (tối thiểu 100 chữ)</label>
                				<textarea name="comment" id="comment" cols="30" rows="10" placeholder="Viết cảm nhận của bạn về chuyến đi">
                				</textarea>
                			</div>
            			</div>
            			<div class="col-md-6 col-sm-6 col-xs-12">
            				<div class="form-group">
                				<label for="rate-point">Điểm đánh giá (trên thang điểm 10)</label>
                				<input type="text" class="form-control rate-point" name="rate-point" value="9.0">
                			</div>
            			</div>
            		</div>
            		<div class="row">
            			<div class="col-md-12">
            				<div class="form-check">
							    <input type="checkbox" class="form-check-input" id="agreer-checkbox">
							    <label class="form-check-label" for="agreer-checkbox">Tôi xác nhận rằng đánh giá này hoàn toàn dựa trên trải nghiệm cá nhân của tôi khi đi chuyến này và tôi không có mối quan hệ cá nhân hay kinh doanh với các hãng xe.</label>
							</div>
							<div class="center">
								<button type="submit" class="button button-submit">Gửi Đánh Giá</button>
							</div>
            			</div>
            		</div>
            	</form>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
	<script src="{{asset('js/jquery.seat-charts.js')}}" type="text/javascript"></script>
	<script type="text/javascript">
		var firstSeatLabel = 1;

		$(document).ready(function() {
		    var $cart = $('#selected-seats'),
		    $counter = $('#counter'),
		    $total = $('#total'),
		    sc = $('#seat-map').seatCharts({
			    map: [
			        'gg_gg',
			        'hh_hh',
			        'hh_hh',
			        'hh_hh',
			        'hh___',
			        'hh_hh',
			        'hh_hh',
			        'hh_hh',
			        'hhhhh',
			    ],
			    seats: {
			        g: {
			          price   : 100.000,
			          classes : 'first-class seat-bed', //your custom CSS class
			          category: 'First Class'
			        },
			        h: {
			          price   : 40.000,
			          classes : 'economy-class seat-bed', //your custom CSS class
			          category: 'Economy Class'
			        }         
			      
			    },
			    naming : {
			        top : false,
			        getLabel : function (character, row, column) {
			          return firstSeatLabel++;
			        },
			    },
			    legend : {
			        node : $('#legend'),
			          items : [
			          [ 'g', 'available',   'First Class' ],
			          [ 'h', 'available',   'Economy Class'],
			          [ 'g', 'unavailable', 'Already Booked']
			          ]         
			    },
			    click: function () {
			        if (this.status() == 'available') {
			          var content_seat = $cart.html();
			          if (content_seat == '') {
			          	$('<li>'+this.settings.label+'</li>')
			            .attr('id', 'cart-item-'+this.settings.id)
			            .data('seatId', this.settings.id)
			            .appendTo($cart);
			          } else {
			          	$('<li>'+', '+this.settings.label+'</li>')
			            .attr('id', 'cart-item-'+this.settings.id)
			            .data('seatId', this.settings.id)
			            .appendTo($cart);
			          }
			          
			          $counter.text(sc.find('selected').length+1);
			          $total.text(recalculateTotal(sc)+this.data().price);
			          
			          return 'selected';
			        } else if (this.status() == 'selected') {
			          //update the counter
			          $counter.text(sc.find('selected').length-1);
			          //and total
			          $total.text(recalculateTotal(sc)-this.data().price);
			        
			          //remove the item from our cart
			          $('#cart-item-'+this.settings.id).remove();
			        
			          //seat has been vacated
			          return 'available';
			        } else if (this.status() == 'unavailable') {
			          //seat has been already booked
			          return 'unavailable';
			        } else {
			          return this.style();
			        }
			      }
		    });

		    sc_floor = $('#seat-map-2-floor').seatCharts({
			    map: [
			        'gg_gg',
			        'hh_hh',
			        'hh_hh',
			        'hh_hh',
			        'gg_gg',
			        'hh_hh',
			        'hh_hh',
			        'hh_hh',
			        'hhhhh',
			    ],
			    seats: {
			        g: {
			          price   : 100.000,
			          classes : 'first-class seat-bed', //your custom CSS class
			          category: 'First Class'
			        },
			        h: {
			          price   : 40.000,
			          classes : 'economy-class seat-bed', //your custom CSS class
			          category: 'Economy Class'
			        }         
			      
			    },
			    naming : {
			        top : false,
			        getLabel : function (character, row, column) {
			          return firstSeatLabel++;
			        },
			    },
			    legend : {
			        node : $('#legend'),
			          items : [
			          [ 'g', 'available',   'First Class' ],
			          [ 'h', 'available',   'Economy Class'],
			          [ 'g', 'unavailable', 'Already Booked']
			          ]         
			    },
			    click: function () {
			        if (this.status() == 'available') {
			          var content_seat = $cart.html();
			          if (content_seat == '') {
			          	$('<li>'+this.settings.label+'</li>')
			            .attr('id', 'cart-item-'+this.settings.id)
			            .data('seatId', this.settings.id)
			            .appendTo($cart);
			          } else {
			          	$('<li>'+', '+this.settings.label+'</li>')
			            .attr('id', 'cart-item-'+this.settings.id)
			            .data('seatId', this.settings.id)
			            .appendTo($cart);
			          }
			          
			          $counter.text(sc.find('selected').length+1);
			          $total.text(recalculateTotal(sc)+this.data().price);
			          
			          return 'selected';
			        } else if (this.status() == 'selected') {
			          //update the counter
			          $counter.text(sc.find('selected').length-1);
			          //and total
			          $total.text(recalculateTotal(sc)-this.data().price);
			        
			          //remove the item from our cart
			          $('#cart-item-'+this.settings.id).remove();
			        
			          //seat has been vacated
			          return 'available';
			        } else if (this.status() == 'unavailable') {
			          //seat has been already booked
			          return 'unavailable';
			        } else {
			          return this.style();
			        }
			      }
		    });

		    //this will handle "[cancel]" link clicks
		    $('#selected-seats').on('click', '.cancel-cart-item', function () {
		      //let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
		      sc.get($(this).parents('li:first').data('seatId')).click();
		    });

		    //let's pretend some seats have already been booked
		    sc.get(['1_2', '4_1', '7_1', '7_2']).status('unavailable');

		});

		function recalculateTotal(sc) {
		  var total = 0;

		  //basically find every selected seat and sum its price
		  sc.find('selected').each(function () {
		    total += this.data().price;
		  });
		  
		  return total;
		}
	</script>
@stop
