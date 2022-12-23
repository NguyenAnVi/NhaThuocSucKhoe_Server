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

		body{
			background-color: #f9e6dd;
		}
		.uk-button, input{
			border-radius: 5px !important;
		}
		.uk-modal-dialog { border-radius: 25px !important;}
	</style>
	
	<script src="{{ asset('js/uikit.js') }}"></script>
	<script src="{{ asset('js/uikit-icons.js') }}"></script>
	<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
	@yield('css')
</head>
<body>
	<div id="app">
		<div class="vi-background-black uk-light uk-position-z-index uk-padding-large uk-padding-remove-vertical  uk-box-shadow-medium" uk-sticky=" show-on-up: true; animation: uk-animation-slide-top">
			<nav class="uk-flex uk-flex-between   uk-container">
				<div>@lang('general.hotline'): 0939.963.285</div>
				<div>@includeIf('user.partials.lang')</div>
			</nav>
		</div>
		<div class="uk-background-primary uk-light uk-position-z-index uk-padding-large uk-padding-remove-vertical  uk-box-shadow-medium" uk-sticky=" show-on-up: true; animation: uk-animation-slide-top">
			<nav class="uk-navbar uk-navbar-transparent uk-container">
					<div class="uk-navbar-left">
						<img src="{{asset('storage/images/logo/favicon.png')}}" style="max-height: 2rem; max-width: 2rem">
						<a class="uk-navbar-item uk-logo" href="{{route('home')}}">{{ config('app.name') }}</a>
						<button class="uk-button uk-button-default uk-padding-small uk-padding-remove-vertical" type="button"><span uk-icon="menu"></span></button>
						<div id="categories-menu" uk-dropdown="mode: click; animation: uk-animation-slide-top-small; animate-out:true; bg-scroll:false"></div>
					</div>
					<div class="uk-navbar-right">
  					{{-- <ul class="uk-navbar-nav">  --}}
							{{-- <li> --}}
								@includeIf('user.partials.searchbar')
							{{-- </li> --}}
							{{-- <li> --}}
								@includeIf('user.partials.cart')
							{{-- </li> --}}
							{{-- <li> --}}
								@includeIf('user.partials.auth_menu')
							{{-- </li> --}}
						{{-- </ul> --}}
					</div>
					
			</nav>
		</div>
		
		<main class="" uk-height-viewport="offset-bottom:true ; offset-top:true">

			
			<div class="">
				@yield('content')
			</div>
		</main>

		<footer class="uk-section uk-section-xsmall uk-section-primary">
			<div class="uk-container">
				<div class="uk-grid uk-text-center uk-text-left@s uk-flex-middle" data-uk-grid>
					<div class="uk-text-small uk-text-muted uk-width-1-3@s">
						{{config('app.author.email')}}
					</div>
					<div class="uk-text-center uk-width-1-3@s">
						<a target="_blank" href="https://github.com/NguyenAnVi/CT271_NLCS"
						class="uk-icon-button" data-uk-icon="github"></a>
					</div>
					<div class="uk-text-small uk-text-muted uk-text-center uk-text-right@s uk-width-1-3@s">
						Built with <a target="_blank" href="http://getuikit.com"><span data-uk-icon="uikit"></span></a>
					</div>
				</div>
			</div>
		</footer>
	</div>
</body>
<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyA3lpduJWPTiuOlzx0n4VG51RllHGVKjyc",
    authDomain: "nhathuoc-suckhoe.firebaseapp.com",
    projectId: "nhathuoc-suckhoe",
    storageBucket: "nhathuoc-suckhoe.appspot.com",
    messagingSenderId: "1034800999726",
    appId: "1:1034800999726:web:3fa0a48b9cdc9510af1ebf",
    measurementId: "G-YVNZ51VL2W"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script>

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