<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	{{-- Title --}}
	<title>{{ config('app.name', 'Nhà thuốc Sức Khỏe') }}</title>

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

		<div class="uk-foreground-primary uk-light uk-position-z-index uk-box-shadow-medium" uk-sticky=" show-on-up: true; animation: uk-animation-slide-top">
			<nav class="uk-navbar uk-container uk-container uk-padding-large uk-padding-remove-vertical">
					<div class="uk-navbar-left">
						<img src="{{asset('storage/images/logo/favicon.png')}}" style="max-height: 2rem; max-width: 2rem">
						<a class="uk-navbar-item uk-logo" href="{{route('home')}}">{{ config('app.name') }}</a>
					</div>
					<div class="uk-navbar-right">
					</div>
			</nav>
		</div>
		
		<main class="" uk-height-viewport="offset-bottom:true ; offset-top:true">

			
			<div class="uk-container uk-padding-large uk-padding-remove-vertical">
				@yield('content')
			</div>
		</main>

		<footer class=" uk-foreground-primary">
			<div class="uk-container uk-padding-small">
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