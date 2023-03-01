<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	{{-- Title --}}
	<title>{{ config('app.name') }}</title>

	{{-- Favicon --}}
	<link rel="icon" type="image/x-icon" href="{{asset('storage/images/logo/favicon.png')}}">

	<!-- Styles -->
	<link href="{{ asset('css/uikit.css') }}" rel="stylesheet">
	<style>
		* { /* Firefox */
			cursor: url("{{asset('storage/images/cursor.cur')}}"), auto;
		}
		label[for]{
			user-select: none;
			-moz-user-select: none;
			-khtml-user-select: none;
			-webkit-user-select: none;
			-o-user-select: none;
		}

		.vi-background-black{
			background-color:black;
			color: white;
		}
		.text-background-primary{
			color: var(--background-primary);
		}

		body{
			background-color: var(--background-primary);
		}
		.uk-modal-dialog { border-radius: 25px !important;}
		.footer-content > * {
			font-size: 0.8em;
		}
		.footer-content > p > a, .footer-content, .footer-content > *{
			color: white ;
		}
		.footer-content > p {
			margin: 6px 0px;
		}
	</style>
	
	<script src="{{ asset('js/uikit.js') }}"></script>
	<script src="{{ asset('js/uikit-icons.js') }}"></script>
	<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
	@yield('css')
</head>
<body>
	<div id="app" class="">
		<div class="vi-background-black uk-light uk-position-z-index" uk-sticky=" show-on-up: true; animation: uk-animation-slide-top">
			<nav class="uk-flex uk-flex-between uk-container uk-padding-large uk-padding-remove-vertical">
				<div>@lang('general.hotline'): 0939.963.285</div>
				<div class="uk-flex uk-flex-row">
					<x-localization.lang></x-localization.lang>
				</div>
			</nav>
		</div>
		<div class="uk-foreground-primary uk-light uk-position-z-index uk-box-shadow-medium" uk-sticky=" show-on-up: true; animation: uk-animation-slide-top">
			<nav class="uk-navbar uk-container uk-container uk-padding-large uk-padding-remove-vertical">
					<div class="uk-navbar-left">
						<img src="{{asset('storage/images/logo/favicon.png')}}" style="max-height: 2rem; max-width: 2rem">
						<a class="uk-navbar-item uk-logo" href="{{route('home')}}">{{ config('app.name') }}</a>
						<button class="uk-button uk-button-default uk-padding-small uk-padding-remove-vertical" type="button"><span uk-icon="menu"></span></button>
						<div id="categories-menu" uk-dropdown="mode: click; animation: uk-animation-slide-top-small; animate-out:true; bg-scroll:false"></div>
					</div>
					<div class="uk-navbar-right">
								<x-navbar.searchbar></x-navbar.searchbar>
								<x-navbar.cart></x-navbar.cart>
								<x-navbar.auth></x-navbar.auth>
					</div>
			</nav>
		</div>
		
		<main class="" uk-height-viewport="offset-bottom:true ; offset-top:true">

			
			<div class="uk-container uk-padding-large uk-padding-remove-vertical">
				@yield('content')
			</div>
		</main>

		<footer class=" uk-foreground-primary">
			<div class="uk-container uk-padding-large">
				<div class="uk-grid uk-text-center uk-text-left@s" data-uk-grid>
					<div class="uk-width-1-5@s footer-content">
						<h5 class="uk-text-background-primary uk-text-bold">CHĂM SÓC KHÁCH HÀNG</h5>
						<p><a class="uk-button-link" href="">Trung Tâm Trợ Giúp</a></p>
						<p><a class="uk-button-link" href="">Bubu Blog</a></p>
						<p><a class="uk-button-link" href="">Bubu Mall</a></p>
						<p><a class="uk-button-link" href="">Hướng Dẫn Mua Hàng</a></p>
						<p><a class="uk-button-link" href="">Hướng Dẫn Bán Hàng</a></p>
						<p><a class="uk-button-link" href="">Vận chuyển</a></p>
						<p><a class="uk-button-link" href="">Trả hàng, hoàn tiền</a></p>
						<p><a class="uk-button-link" href="">Chăm sóc Khách hàng</a></p>
						<p><a class="uk-button-link" href="">Chính sách bảo hành</a></p>
					</div>
					<div class="uk-width-1-5@s footer-content">
						<h5 class="uk-text-background-primary uk-text-bold">VỀ BUBU PHARMA</h5>
						<p><a class="uk-button-link" href="">Giới thiệu về Bubu</a></p>
						<p><a class="uk-button-link" href="">Tuyển dụng</a></p>
						<p><a class="uk-button-link" href="">Điều khoản</a></p>
						<p><a class="uk-button-link" href="">Chính sách bảo mật</a></p>
						<p><a class="uk-button-link" href="">Chính hãng</a></p>
						<p><a class="uk-button-link" href="">Chương trình tiếp thị liên kết</a></p>
						<p><a class="uk-button-link" href="">Liên hệ với truyền thông</a></p>
					</div>
					<div class="uk-width-1-5@s footer-content">
						<h5 class="uk-text-background-primary uk-text-bold">THANH TOÁN</h5>
						<p></p>
						<div class="uk-flex uk-flex-wrap uk-child-width-1-4 ">
							<div class="uk-background-primary uk-border-rounded" style="margin: 2px 2px;padding:5px 2px; text-align:center"><img class="" src="{{asset('storage/images/payment/visa.png')}}" alt="" srcset=""></div>
							<div class="uk-background-primary uk-border-rounded" style="margin: 2px 2px;padding:5px 2px; text-align:center"><img class="" src="{{asset('storage/images/payment/tragop.png')}}" alt="" srcset=""></div>
							<div class="uk-background-primary uk-border-rounded" style="margin: 2px 2px;padding:5px 2px; text-align:center"><img class="" src="{{asset('storage/images/payment/mastercard.png')}}" alt="" srcset=""></div>
							<div class="uk-background-primary uk-border-rounded" style="margin: 2px 2px;padding:5px 2px; text-align:center"><img class="" src="{{asset('storage/images/payment/ae.png')}}" alt="" srcset=""></div>
							<div class="uk-background-primary uk-border-rounded" style="margin: 2px 2px;padding:5px 2px; text-align:center"><img class="" src="{{asset('storage/images/payment/jcb.png')}}" alt="" srcset=""></div>
							<div class="uk-background-primary uk-border-rounded" style="margin: 2px 2px;padding:5px 2px; text-align:center"><img class="" src="{{asset('storage/images/payment/cod.png')}}" alt="" srcset=""></div>
						</div>

						<h5 class="uk-text-background-primary uk-text-bold">VẬN CHUYỂN</h5>
						<p></p>
						<div class="uk-flex uk-flex-wrap uk-child-width-1-4 ">
							<div class="uk-background-primary uk-border-rounded" style="margin: 2px 2px;padding:5px 2px; text-align:center"><img class="" src="{{asset('storage/images/shipping/beexpress.png')}}" alt="" srcset=""></div>
							<div class="uk-background-primary uk-border-rounded" style="margin: 2px 2px;padding:5px 2px; text-align:center"><img class="" src="{{asset('storage/images/shipping/bestexpress.png')}}" alt="" srcset=""></div>
							<div class="uk-background-primary uk-border-rounded" style="margin: 2px 2px;padding:5px 2px; text-align:center"><img class="" src="{{asset('storage/images/shipping/ghn.jfif')}}" alt="" srcset=""></div>
							<div class="uk-background-primary uk-border-rounded" style="margin: 2px 2px;padding:5px 2px; text-align:center"><img class="" src="{{asset('storage/images/shipping/ghtk.png')}}" alt="" srcset=""></div>
							<div class="uk-background-primary uk-border-rounded" style="margin: 2px 2px;padding:5px 2px; text-align:center"><img class="" src="{{asset('storage/images/shipping/grab.png')}}" alt="" srcset=""></div>
							<div class="uk-background-primary uk-border-rounded" style="margin: 2px 2px;padding:5px 2px; text-align:center"><img class="" src="{{asset('storage/images/shipping/jt.png')}}" alt="" srcset=""></div>
							<div class="uk-background-primary uk-border-rounded" style="margin: 2px 2px;padding:5px 2px; text-align:center"><img class="" src="{{asset('storage/images/shipping/ninjavan.png')}}" alt="" srcset=""></div>
							<div class="uk-background-primary uk-border-rounded" style="margin: 2px 2px;padding:5px 2px; text-align:center"><img class="" src="{{asset('storage/images/shipping/vietnampost.png')}}" alt="" srcset=""></div>
							<div class="uk-background-primary uk-border-rounded" style="margin: 2px 2px;padding:5px 2px; text-align:center"><img class="" src="{{asset('storage/images/shipping/viettelpost.png')}}" alt="" srcset=""></div>
						</div>
					</div>
					<div class="uk-width-1-5@s footer-content">
						<h5 class="uk-text-background-primary uk-text-bold">THEO DÕI CHÚNG TÔI</h5>
						<p><a href="" class="uk-icon-button uk-background-primary uk-text-primary" uk-icon="facebook"></a>&nbsp;&nbsp;<a class="uk-button-link text-background-primary" href="">Facebook</a></p>
						<p><a href="" class="uk-icon-button uk-background-primary uk-text-primary" uk-icon="instagram"></a>&nbsp;&nbsp;<a class="uk-button-link text-background-primary" href="">Instagram</a></p>
						<p><a href="" class="uk-icon-button uk-background-primary uk-text-primary" uk-icon="pinterest"></a>&nbsp;&nbsp;<a class="uk-button-link text-background-primary" href="">Pinterest</a></p>
						<p><a href="" class="uk-icon-button uk-background-primary uk-text-primary" uk-icon="reddit"></a>&nbsp;&nbsp;<a class="uk-button-link text-background-primary" href="">Reddit</a></p>
						<p><a href="" class="uk-icon-button uk-background-primary uk-text-primary" uk-icon="tiktok"></a>&nbsp;&nbsp;<a class="uk-button-link text-background-primary" href="">TikTok</a></p>
						<p><a href="" class="uk-icon-button uk-background-primary uk-text-primary" uk-icon="youtube"></a>&nbsp;&nbsp;<a class="uk-button-link text-background-primary" href="">YouTube</a></p>
					</div>
					<div class="uk-width-1-5@s footer-content">
						<h5 class="uk-text-background-primary uk-text-bold">ĐA NỀN TẢNG</h5>
						<p></p>
						<div class="uk-flex uk-flex-wrap">
							<div class="uk-width-1-2" style="border-radius: 5px; padding: 5px 5px; background-color:white; margin:0 5px 0 0">
								<img src="{{asset('storage/images/qr/rr.png')}}" alt="">
							</div>
							<div class="uk-width-expand">
								<div style="border-radius: 5px; padding: 5px 5px; background-color:white; background-color:white; margin:0 0 5px 0"><img src="{{asset('storage/images/platform/appstore.png')}}" alt=""></div>
								<div style="border-radius: 5px; padding: 5px 5px; background-color:white; background-color:white; margin:0 0 5px 0"><img src="{{asset('storage/images/platform/googleplaystore.png')}}" alt=""></div>
								<div style="border-radius: 5px; padding: 5px 5px; background-color:white; background-color:white; margin:0 0 5px 0"><img src="{{asset('storage/images/platform/appgallery.png')}}" alt=""></div>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="uk-text-center footer-content">
					<p class="top">Trường Đại học Cần Thơ (Can Tho University)</p>
					<p>Khu II, đường 3/2, P. Xuân Khánh, Q. Ninh Kiều, TP. Cần Thơ.</p>
					<p class="bottom">Điện thoại: (84-292) 3832663 - (84-292) 3838474; Fax: (84-292) 3838474; Email: dhct@ctu.edu.vn.</p>
			
				</div>
			</div>
		</footer>
	</div>
</body>


@yield('js')
<script>
	$(document).ready(function(){
		//get categories menu
		$.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'get',
      url: '{{route('getcategoriesmenu')}}',
      success:function(obj){
        $('#categories-menu').html((JSON.parse(obj)));
      }
    });

		@if($errors->any())
		//show notification
		{!! implode('', $errors->all("UIkit.notification(':message', {pos: 'top-center', timeout : 0});")) !!}    
		@endif
	});
</script>

</html>