@extends('user.layouts.app')
@section('content')
	<div class="uk-padding">
		<div class="uk-card uk-box-shadow-large uk-card-default uk-card-body uk-padding">
			<div class="uk-width-1-1 uk-card-title">@lang('general.myorders')</div>
			<hr>
			<div>
				<ul uk-accordion>
					<li class="uk-open">
							<a class="uk-accordion-title uk-foreground-secondary uk-light uk-box-shadow-medium uk-border-rounded uk-padding-small">@lang('general.orderstatus.pending')</a>
							<div class="uk-accordion-content uk-box-shadow-small">
								@include('user.partials.orders', ['items' => $pending])
							</div>
					</li>
					<li>
						<a class="uk-accordion-title uk-foreground-secondary uk-light uk-box-shadow-medium uk-border-rounded uk-padding-small">@lang('general.orderstatus.processing')</a>
						<div class="uk-accordion-content uk-box-shadow-small">
							@include('user.partials.orders', ['items' => $processing])
						</div>
					</li>
					<li>
						<a class="uk-accordion-title uk-foreground-secondary uk-light uk-box-shadow-medium uk-border-rounded uk-padding-small">@lang('general.orderstatus.delivering')</a>
						<div class="uk-accordion-content uk-box-shadow-small">
							@include('user.partials.orders', ['items' => $delivering])
						</div>
					</li>
					<li>
						<a class="uk-accordion-title uk-foreground-secondary uk-light uk-box-shadow-medium uk-border-rounded uk-padding-small">@lang('general.orderstatus.delivered')</a>
						<div class="uk-accordion-content uk-box-shadow-small">
							@include('user.partials.orders', ['items' => $delivered])
						</div>
					</li>
					<li>
						<a class="uk-accordion-title uk-foreground-secondary uk-light uk-box-shadow-medium uk-border-rounded uk-padding-small">@lang('general.orderstatus.cancelledbycustomer')</a>
						<div class="uk-accordion-content uk-box-shadow-small">
							@include('user.partials.orders', ['items' => $cancelled_by_user])
						</div>
					</li>
					<li>
						<a class="uk-accordion-title uk-foreground-secondary uk-light uk-box-shadow-medium uk-border-rounded uk-padding-small">@lang('general.orderstatus.cancelledbyshop')</a>
						<div class="uk-accordion-content uk-box-shadow-small">
							@include('user.partials.orders', ['items' => $cancelled_by_shop])
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
