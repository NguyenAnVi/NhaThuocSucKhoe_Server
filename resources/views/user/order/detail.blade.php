@extends('user.layouts.app')

@section('css')
<style>
	.background_border{
		padding: 1rem;
		border-inline-start: 1px solid rgb(170, 170, 170);
	}
</style>

@endsection
@section('content')

	<div class="uk-padding">
		<div class="uk-card uk-box-shadow-large uk-card-default uk-card-body uk-padding">
			<div class="uk-width-1-1 uk-card-title">Chi tiết đơn hàng</div>
			<hr>
		   
			<div class="uk-width-1-1 uk-flex uk-flex-wrap uk-padding-small uk-padding-remove-horizontal" id="parent-card">
				<div class="uk-width-1-1 uk-width-3-5@l  uk-padding-small"  uk-height-match="target:#parent-card" >
					<h5 class="uk-text-bold">Sản phẩm</h5>
					<div class="cart-content uk-flex uk-flex-column ">
						<div class="cart-main uk-width-expand uk-flex uk-flex-row uk-text-bold">
							<div class="uk-width-1-2">
								<div class="cart-p-name">
									<p>Tên sản phẩm</p><br>
								</div>
							</div>
							<div class="uk-width-1-4">
								<div class="cart-p-price">
									<p>Giá</p>

								</div>
							</div>
							<div class="uk-width-1-4">
								<div class="uk-width-expand">
									Số lượng
								</div>
							</div>
						</div>
						@foreach ($items as $item)
							<div class="cart-main uk-width-expand uk-flex uk-flex-row">
									<div class="uk-width-1-2">
										<div class="cart-p-name">
											<p href="/show/product/{{$item->id}}">{{ $item->product_name }}</p><br>
										</div>
									</div>
									<div class="uk-width-1-4">
										<div class="cart-p-price">
											<p>{{ number_format($item->price) }}đ</p>

										</div>
									</div>
									<div class="uk-width-1-4">
										<div class="uk-width-expand">
											{{ $item->qty }}
										</div>
									</div>
							</div>
						@endforeach
						
					</div>
				</div>
				<div class="uk-width-1-1 uk-width-2-5@l uk-padding-small background_border" >
					<form class="uk-form" id="order-form" method="POST" action="{{route('cancelOrder')}}">
						@csrf
						<div class=" uk-flex uk-flex-column uk-flex-wrap-between uk-flex-between">
							<div class="uk-flex-stretch">
								<h5 class="uk-text-bold">Thanh toán và vận chuyển</h5>

								<input type="hidden" name="order_id" value="{{$order->id}}">
								
								<div class="uk-text-bold">Họ và tên người nhận: </div>
								<input disabled class="uk-input" type="text" name="name" id="name" value="{{$order->receiver_name}}">

								<div class="uk-text-bold">Địa chỉ người nhận: </div>
								<input disabled class="uk-input" type="text" name="address" id="address" value="{{urldecode($order->address)}}">

								<div class="uk-text-bold">Số điện thoại liên hệ: </div>
								<input disabled class="uk-input" type="text" name="phone" id="phone" value="{{$order->receiver_phone}}">

								<hr>

								<div class="uk-text-bold">Trạng thái đơn hàng:</div>
								<input disabled class="uk-input" type="text" name="status" value="{{$order->status}}">

								<div class="uk-text-bold">Đơn vị vận chuyển:</div>
								<input disabled class="uk-input" type="text" name="shipping_method" value="{{$order->shipping_method}}">

								<div class="uk-text-bold">Phương thức thanh toán:</div>
								<input disabled class="uk-input" type="text" name="payment_method" value="{{$order->payment_method}}">
								
							</div>

							<div class=" uk-padding-small uk-padding-remove-horizontal">
								<hr>
								<div class="uk-flex uk-flex-between">
									<div>Tổng tiền hàng: </div> 
									<div><strong data-uid="{{$order->user_id}}" id="subtotal-info"></strong></div>
								</div>
								<div class="uk-flex uk-flex-between">
									<div>Phí vận chuyển: </div>
									<div><strong id="shipping-info"></strong></div>
								</div>
								<div class="uk-flex uk-flex-between">
									<div>Giảm giá: </div>
									<div><strong id="saleoff-info">0 đ</strong></div>
								</div>
								<div class="uk-flex uk-flex-between">
									<div><h4>Tổng thanh toán: </h4> </div>
									<div><h4><strong class="uk-text-primary" id="total-info"></strong></h4></div>
								</div>
							</div>
							
						</div>
					</form>
				</div>
			</div>
			
			<div class="uk-width-1-1 uk-text-center">
					<button type="submit" form="order-form" class="uk-button uk-button-danger">Hủy đơn hàng</button>
			</div>
		  
		</div>
	</div>
	<script src="{{asset('js/jquery-3.6.1.min.js')}}"></script>
	<script>
		
		var subTotal = {{$order->subtotal}};
		var shippingFee = {{$order->shipping_fee}};
		var saleoff = 0;
		$('#subtotal-info').html(toCurrency(subTotal));
		$('#shipping-info').html(toCurrency(shippingFee));
		$(document).ready(function () {
			initialize();
		});

		function initialize() {
			calculateTotal();
			// checkSubTotal();
			// checkShippingFee();
		}

		function toCurrency(num){
			if(!Number.isInteger(parseInt(num)))num = 0; 
			return(
				Number(num).toLocaleString(
					'vi-VN', 
					{
						style: 'currency',
						currency: 'VND',
					}
				)
			);
		}

		function calculateTotal(){
			let result = toCurrency(parseInt(subTotal)+parseInt(shippingFee)+parseInt(saleoff));
			$('#total-info').html(result);
		}
	</script>
@endsection