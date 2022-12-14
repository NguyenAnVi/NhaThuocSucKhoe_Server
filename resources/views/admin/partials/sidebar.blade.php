<a class="uk-navbar-toggle uk-navbar-toggle-animate" uk-navbar-toggle-icon href="#" aria-label="Open Menu"  uk-toggle="target: #offcanvas-nav-primary"></a>
<div id="offcanvas-nav-primary" uk-offcanvas="overlay: true ; mode:slide">
	<div style="z-index: 10" class="uk-offcanvas-bar uk-flex uk-flex-column">
		<button type="button" class="uk-offcanvas-close" uk-close></button>
		<!--Authentication Links-->
		@auth('admin')
		<div class="uk-padding uk-card uk-card-secondary uk-card-body">
			<header class="uk-comment-header">
				<div class="uk-grid-medium uk-flex-middle" uk-grid>
					<div class="uk-width-auto">
						<img class="uk-comment-avatar" src="{{asset('logo/avt.png')}}" width="50" height="50">
					</div>
					<div class="uk-width-expand">
						<h2 class="uk-comment-title uk-margin-remove">{{Auth::guard('admin')->user()->name}}</h2>
						<ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
							<li>{{Auth::guard('admin')->user()->phone}}</li>
							<li><a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Đăng xuất') }}</a></li>
							<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</ul>
					</div>
				</div>
			</header>
		</div>
		@endauth
		<ul class="uk-nav-default" uk-accordion>
			@if(Auth::guard('admin')->user()->id === 1)
			<li class="uk-parent uk-card-hover uk-card uk-card-secondary uk-padding-remove">
				<a class="uk-accordion-title">Quyền root</a>
				<ul class="uk-list uk-accordion-content">
					<li><button class="uk-button-small uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom" onclick="window.location.href='{{route('admin.hr')}}'">QL nhân sự</button></li>
					<li><button class="uk-button-small uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom" onclick="window.location.href='{{route('admin.customer')}}'">QL khách hàng</button></li>
				</ul>
			</li>
			@endif

			<li class="uk-parent uk-card-hover uk-card uk-card-secondary uk-padding-remove">
				<a class="uk-accordion-title">Quyền admin</a>
				<ul class="uk-list uk-accordion-content">
					<li><button class="uk-button-small uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom" onclick="window.location.href='{{route('admin.product')}}'">QL sản phẩm</button></li>
					<li><button class="uk-button-small uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom" onclick="window.location.href='{{route('admin.category')}}'">QL danh mục</button></li>
					<li><button class="uk-button-small uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom" onclick="window.location.href='{{route('admin.saleoff')}}'">QL KM</button></li>
					<li><button class="uk-button-small uk-button uk-button-default uk-width-1-1 uk-margin-small-bottom" onclick="window.location.href=''">QL hóa đơn</button></li>
				</ul>
			</li>
        </ul>
	</div>
</div>