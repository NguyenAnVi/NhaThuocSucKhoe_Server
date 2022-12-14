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
			<div class="uk-width-1-1 uk-card-title">Đặt hàng</div>
			<hr>
		   
			<div class="uk-width-1-1 uk-flex uk-flex-wrap uk-padding-small uk-padding-remove-horizontal" id="parent-card">
				<div class="uk-width-1-1 uk-width-3-5@l  uk-padding-small"  uk-height-match="target:#parent-card" >
					<h5 class="uk-text-bold">Sản phẩm</h5>
					<div class="cart-content uk-flex uk-flex-column ">
						<div class="cart-main uk-width-expand uk-flex uk-flex-row uk-text-bold">
							<div class="uk-width-1-6">
								<div class="cart-p-img">
								</div>
							</div>
							<div class="uk-width-1-2">
								<div class="cart-p-name">
									<p>Tên sản phẩm</p><br>
								</div>
							</div>
							<div class="uk-width-1-6">
								<div class="cart-p-price">
									<p>Giá</p>

								</div>
							</div>
							<div class="uk-width-1-6">
								<div class="uk-width-expand">
									Số lượng
								</div>
							</div>
						</div>
						@foreach ($cart as $item)
							<div class="cart-main uk-width-expand uk-flex uk-flex-row">
									<div class="uk-width-1-6">
										<div class="cart-p-img">
											<img src="{{ getImageAt($item->options->image, 0) }}" class="uk-object-cover" width="70" height="70" style="aspect-ratio: 1 / 1">
										</div>
									</div>
									<div class="uk-width-1-2">
										<div class="cart-p-name">
											<p href="/show/product/{{$item->id}}">{{ $item->name }}</p><br>
										</div>
									</div>
									<div class="uk-width-1-6">
										<div class="cart-p-price">
											<p>{{ number_format($item->price) }}đ</p>

										</div>
									</div>
									<div class="uk-width-1-6">
										<div class="uk-width-expand">
											{{ $item->qty }}
										</div>
									</div>
							</div>
						@endforeach
						
					</div>
				</div>
				<div class="uk-width-1-1 uk-width-2-5@l uk-padding-small background_border" >
					<form class="uk-form" id="place-order-form" method="POST" action="{{route('placeOrder')}}">
						@csrf
						<div class=" uk-flex uk-flex-column uk-flex-wrap-between uk-flex-between">
							<div class="uk-flex-stretch">
								<h5 class="uk-text-bold">Thanh toán và vận chuyển</h5>

								<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
								
								<div class="uk-text-bold">Họ và tên người nhận: </div>
								<input required autocomplete="name" class="uk-input" type="text" name="name" id="name" value="{{Auth::user()->name}}">

								<div class="uk-text-bold">Địa chỉ người nhận: </div>
								<input required autocomplete="address-level1" class="uk-input" type="text" name="address" id="address" value="{{Auth::user()->address}}">

								<div class="uk-text-bold">Số điện thoại liên hệ: </div>
								<input required autocomplete="tel" class="uk-input" type="text" name="phone" id="phone" value="{{Auth::user()->phone}}">

								<hr>

								<div class="uk-text-bold">Chọn đơn vị vận chuyển:</div>
								<select onchange="checkShippingFee()" name="shipping_method" id="shipping-method" class="uk-select">
									<option value="none">Chọn...</option>
									<option value="GHN">Giao hàng nhanh</option>
									<option value="GHTK">Giao hàng tiết kiệm</option>
								</select>

								<div class="uk-text-bold">Chọn phương thức thanh toán:</div>
								<select onchange="if(document.getElementById('payment-method').value=='CREDIT') {alert('Tính năng sớm ra mắt.'); document.getElementById('payment-method').value=''}" name="payment_method" id="payment-method" class="uk-select">
									<option value="">Chọn...</option>
									<option value="COD">{{__('Thanh toán khi nhận hàng')}}</option>
									<option value="CREDIT">{{__('Thanh toán bằng thẻ')}}</option>
								</select>
							</div>

							<div class=" uk-padding-small uk-padding-remove-horizontal">
								<hr>
								<div class="uk-flex uk-flex-between">
									<div>Tổng tiền hàng: </div> 
									<div><strong data-uid="{{Auth::user()->id}}" id="subtotal-info"></strong></div>
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
					<button type="submit" form="place-order-form" class="uk-button uk-button-primary">Đặt hàng</button>
			</div>
		  
		</div>
	</div>
	<script src="{{asset('js/jquery-3.6.1.min.js')}}"></script>
	<script>
		
		var subTotal = 0;
		var shippingFee = 0;
		var saleoff = 0;
		$(document).ready(function () {
			
			initialize();
		});

		function initialize() {
			checkSubTotal();
			checkShippingFee();
		}
		function checkSubTotal() { 
			let uid = $('#subtotal-info').data('uid');

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				type: 'get',
				url: '{{route("getSubTotal")}}',
				data: {
					'user_id' : uid,
				},
				success:function(obj){ 
					subTotal = parseInt(obj);
					$('#subtotal-info').html(toCurrency(obj));
					calculateTotal();
				}
			});
		 }
		function checkShippingFee() {
			let val = $('#shipping-method').find(":selected").val();

			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				type: 'get',
				url: '{{route("getshippingfee")}}',
				data: {
					'shipping_method' : val,
				},
				success:function(obj){
					shippingFee = parseInt((obj));
					$('#shipping-info').html(toCurrency(obj));
					calculateTotal();
				}
				
			});
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