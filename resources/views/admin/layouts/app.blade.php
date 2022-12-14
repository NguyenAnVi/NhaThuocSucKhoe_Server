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
			scrollbar-color: #ffffff #222222;
			cursor: url("{{asset('logo/cursor.cur')}}"), auto;
		}
		*::-webkit-scrollbar {width: 15px;}/* Chrome, Edge, and Safari */
		*::-webkit-scrollbar-track {background: #222222;}
		*::-webkit-scrollbar-thumb {
			background-color: #ffffff;
			border-radius: 25px;
			border: 10px double #222222;
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
		<div class="uk-background-secondary uk-light uk-position-z-index uk-padding uk-padding-remove-vertical" uk-sticky=" show-on-up: true; animation: uk-animation-slide-top">
			<nav class="uk-navbar uk-navbar-transparent">
				<div data-uk-navbar>
					<div class="uk-navbar-left">
						<img src="{{asset('logo/favicon.png')}}" style="max-height: 2rem; max-width: 2rem">
						<a class="uk-navbar-item uk-logo" href="{{route('admin.home')}}">{{ config('app.name', 'Laravel') }}</a>
						@includeWhen(Auth::guard('admin')->check(), 'admin.partials.sidebar')
					</div>
				</div>
			</nav>
		</div>
		
		<main class="" uk-height-viewport="offset-bottom:true ; offset-top:true">
			@includeIf('admin.partials.generalmessage')
			<div class="uk-padding">
				@yield('content')
			</div>
		</main>

		<footer class="uk-section uk-section-xsmall uk-section-secondary">
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
