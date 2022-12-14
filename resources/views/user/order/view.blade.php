@extends('user.layouts.app')
@section('content')
	<div class="uk-padding">
		<div class="uk-card uk-box-shadow-large uk-card-default uk-card-body uk-padding">
			<div class="uk-width-1-1 uk-card-title">Đơn hàng của tôi</div>
			<hr>
			<div>


				<ul uk-accordion>
					<li class="uk-open">
							<a class="uk-accordion-title uk-background-secondary uk-light uk-box-shadow-medium uk-border-rounded uk-padding-small">Chờ xác nhận</a>
							<div class="uk-accordion-content uk-box-shadow-small">
								@include('user.partials.orders', ['items' => $pending])
							</div>
					</li>
					<li>
						<a class="uk-accordion-title uk-background-secondary uk-light uk-box-shadow-medium uk-border-rounded uk-padding-small">Đang chuẩn bị</a>
						<div class="uk-accordion-content uk-box-shadow-small">
							@include('user.partials.orders', ['items' => $processing])
						</div>
					</li>
					<li>
						<a class="uk-accordion-title uk-background-secondary uk-light uk-box-shadow-medium uk-border-rounded uk-padding-small">Đang giao hàng</a>
						<div class="uk-accordion-content uk-box-shadow-small">
							@include('user.partials.orders', ['items' => $delivering])
						</div>
					</li>
					<li>
						<a class="uk-accordion-title uk-background-secondary uk-light uk-box-shadow-medium uk-border-rounded uk-padding-small">Đã giao hàng</a>
						<div class="uk-accordion-content uk-box-shadow-small">
							@include('user.partials.orders', ['items' => $delivered])
						</div>
					</li>
					<li>
						<a class="uk-accordion-title uk-background-secondary uk-light uk-box-shadow-medium uk-border-rounded uk-padding-small">Đã hủy</a>
						<div class="uk-accordion-content uk-box-shadow-small">
							@include('user.partials.orders', ['items' => $cancelled])
						</div>
					</li>
			</ul>
		</div>
	</div>
	<script>
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
	</script>
@endsection
