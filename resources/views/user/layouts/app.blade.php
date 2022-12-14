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
	<link rel="icon" type="image/x-icon" href="{{asset('logo/favicon.png')}}">

	<!-- Styles -->
	<link href="{{ asset('css/uikit.css') }}" rel="stylesheet">
	<style>
		* { /* Firefox */
			scrollbar-width: auto;
			scrollbar-color: #1e87f0  #ffffff;
			cursor: url("{{asset('logo/cursor.cur')}}"), auto;
		}
		*::-webkit-scrollbar {width: 15px;}/* Chrome, Edge, and Safari */
		*::-webkit-scrollbar-track {background: white;border: 2px solid #1e87f0;}
		*::-webkit-scrollbar-thumb {
			background-color: #ffffff;
			border: 10px solid #1e87f0;
		}
		label[for]{
			user-select: none;
		-moz-user-select: none;
		-khtml-user-select: none;
		-webkit-user-select: none;
		-o-user-select: none;
		}
	</style>
	@yield('css')

	<script src="{{ asset('js/uikit.js') }}"></script>
	<script src="{{ asset('js/uikit-icons.js') }}"></script>
</head>
<body>
	<div id="app">
		<div class="uk-background-primary uk-light uk-position-z-index uk-padding uk-padding-remove-vertical" uk-sticky=" show-on-up: true; animation: uk-animation-slide-top">
			<nav class="uk-navbar uk-navbar-transparent uk-container">
					<div class="uk-nav-overlay uk-navbar-left">
						<img src="{{asset('logo/favicon.png')}}" style="max-height: 2rem; max-width: 2rem">
						<a class="uk-navbar-item uk-logo" href="{{route('home')}}">{{ config('app.name', 'Laravel') }}</a>
						@includeIf('user.partials.category')
					</div>
					<div class="uk-nav-overlay uk-navbar-right">
						<div class="uk-drop" uk-drop="mode: click; pos: left-center; offset: 0">
						</div>

						<ul class="uk-navbar-nav uk-iconnav"> 
							{{-- Authentication Links --}}
							@guest
								@if (Route::has('login'))
									<li>
										<a href="{{ route('login') }}">{{ __('Đăng nhập') }}</a>
									</li>
								@endif
								@if (Route::has('register'))
									<li>
										<a href="{{ route('register') }}">{{ __('Đăng ký') }}</a>
									</li>
								@endif
							@else
								{{-- Shopping cart --}}
								 <li>
									@includeIf('user.partials.cart')
								</li>

								{{-- search button --}}
								<li>
									<a class="uk-navbar-toggle" uk-search-icon uk-toggle="target: .uk-nav-overlay; animation: uk-animation-fade" href="#"></a>
								</li>

								{{-- auth --}}
								<li>
									<a href=""><span uk-icon="icon:user"></span></a>   
									<div class="uk-navbar-dropdown" uk-dropdown="pos: bottom-right; mode:click; animation: uk-animation-slide-top-small">
										<ul class="uk-nav uk-navbar-dropdown-nav">
											<li class="uk-nav-header">
												{{__(Auth::user()->name)}}
											</li>
											<li class="uk-nav-divider"></li>
											<li>
												<a href="{{ route('orders') }}">
													{{ __('Đơn hàng của tôi')}}
												</a>
												<a href="{{ route('logout') }}"
												   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
													{{ __('Đăng xuất') }}
												</a>
												<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
													@csrf
												</form>
											</li>
										</ul>
									</div>
								</li>
							@endguest
						</ul>
					</div>
					
					@includeIf('user.partials.searchbar')
			</nav>
		</div>
		
		<main class="" uk-height-viewport="offset-bottom:true ; offset-top:true">
			@includeIf('admin.partials.generalmessage')
			<div class="uk-padding-small uk-container">
				@yield('content')
			</div>
		</main>

		<footer class="uk-section uk-section-xsmall uk-section-primary">
			<div class="uk-container">
				<div class="uk-grid uk-text-center uk-text-left@s uk-flex-middle" data-uk-grid>
					<div class="uk-text-small uk-text-muted uk-width-1-3@s">
						ViB1910178@student.ctu.edu.vn
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
</html>