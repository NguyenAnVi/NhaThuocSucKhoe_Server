<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	{{-- Title --}}
	<title>{{ config('app.name') }} - admin</title>

	{{-- Favicon --}}
	<link rel="icon" type="image/x-icon" href="{{asset('logo/favicon.png')}}">

	<!-- Styles -->
	<link href="{{ asset('css/uikit.css') }}" rel="stylesheet">
	<style>
		/* * {
			scrollbar-width: auto;
			scrollbar-color: #ffffff #222222;
			cursor: url("{{asset('logo/cursor.cur')}}"), auto;
		}
		*::-webkit-scrollbar {width: 15px;}
		*::-webkit-scrollbar-track {background: #222222;}
		*::-webkit-scrollbar-thumb {
			background-color: #ffffff;
			border-radius: 25px;
			border: 10px double #222222;
		} */
		label[for]{
			user-select: none;
        -moz-user-select: none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        -o-user-select: none;
		}
		#content {
			z-index: -1;
			@auth('admin') padding-left: 60px; @endauth
		}
		/* #content>main{
			overflow-x: hidden;
			overflow-y: scroll;
		} */
		
	</style>
	@yield('css')

	<script src="{{ asset('js/uikit.js') }}"></script>
	<script src="{{ asset('js/uikit-icons.js') }}"></script>
</head>
<body>
	<div id="app">
			
			<div id="content" class="uk-width-1-1" uk-height-viewport="expand:true;">
				{{-- <div class="uk-background-secondary uk-light uk-position-z-index uk-padding uk-padding-remove-vertical" uk-sticky=" show-on-up: true; animation: uk-animation-slide-top">
					<nav class="uk-navbar uk-navbar-transparent">
						<div data-uk-navbar>
							<div class="uk-navbar-left">
								<img src="{{asset('storage/images/logo/favicon.png')}}" style="max-height: 2rem; max-width: 2rem">
								<a class="uk-navbar-item uk-logo" href="{{route('admin.home')}}">{{ config('app.name', 'Laravel') }}</a>
								@includeWhen(Auth::guard('admin')->check(), 'admin.partials.sidebar')
							</div>
						</div>
					</nav>
				</div> --}}
				
				<main uk-height-viewport="offset-bottom:true">
					{{-- @includeIf('admin.partials.generalmessage') --}}
					<div class="uk-padding">
						@yield('content')
					</div>
				</main>
				<footer class="uk-section uk-section-xsmall uk-background-secondary">
					<div class="uk-padding uk-padding-remove-vertical">
						<div class="uk-grid uk-text-center uk-text-left@s uk-flex-middle" data-uk-grid>
							<div class="uk-text-small uk-text-muted uk-width-1-3@s">
								ViB1910178@student.ctu.edu.vn
							</div>
							
						</div>
					</div>
				</footer>
			</div>

	</div>
	<x-admin.sidebar ></x-admin.sidebar>
	<x-admin.notification></x-admin.notification>

</body>
@yield('js')
</html>

