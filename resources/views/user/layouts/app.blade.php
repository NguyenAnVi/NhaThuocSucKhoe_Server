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
			scrollbar-width: 0px;
			scrollbar-color: var(--foregroundprimary)  #ffffff;
			cursor: url("{{asset('storage/images/cursor.cur')}}"), auto;
		}
		*::-webkit-scrollbar {width: 0px;}/* Chrome, Edge, and Safari */
		*::-webkit-scrollbar-track {background: rgb(236, 236, 236);}
		*::-webkit-scrollbar-thumb {
			background-color: #ffffff;
			border: 10px solid var(--foregroundprimary);
		}
		label[for]{
			user-select: none;
		-moz-user-select: none;
		-khtml-user-select: none;
		-webkit-user-select: none;
		-o-user-select: none;
		}

		body{
			background-image:url('{{asset('storage/images/background.jpg')}}');
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
		}
		
	</style>
	@yield('css')


	<script src="{{ asset('js/uikit.js') }}"></script>
	<script src="{{ asset('js/uikit-icons.js') }}"></script>
	<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
</head>
<body>
	<div id="app">
		<div class="uk-background-primary uk-light uk-position-z-index uk-padding-large uk-padding-remove-vertical  uk-box-shadow-medium" uk-sticky=" show-on-up: true; animation: uk-animation-slide-top">
			<nav class="uk-flex uk-flex-between  uk-container">
				<div>Hotline đặt hàng (Miễn phí): 0939.963.285</div>
				<div>@includeIf('user.partials.lang')</div>
			</nav>
			<nav class="uk-navbar uk-navbar-transparent uk-container">
					<div class="uk-nav-overlay uk-navbar-left">
						<img src="{{asset('storage/images/logo/favicon.png')}}" style="max-height: 2rem; max-width: 2rem">
						<a class="uk-navbar-item uk-logo" href="{{route('home')}}">{{ config('app.name') }}</a>
						@includeIf('user.partials.category')
					</div>
					<div class="uk-nav-overlay uk-navbar-right">
  					<ul class="uk-navbar-nav uk-iconnav"> 

							<li>
								@includeIf('user.partials.cart')
							</li>
							<li>
								@includeIf('user.partials.auth_menu')
							</li>
							{{-- search button --}}
							<li>
								<a class="uk-navbar-toggle" uk-search-icon uk-toggle="target: .uk-nav-overlay; animation: uk-animation-fade" href="#"></a>
							</li>

						</ul>
					</div>
					@includeIf('user.partials.searchbar')
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
						{{config('author.email')}}
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


@yield('js')

@if($errors->any())
<script>
	$(document).ready(function(){
		{!! implode('', $errors->all("UIkit.notification(':message', {pos: 'bottom-right'});")) !!}    
	});
</script>
@endif

	
</html>