@auth('admin')
<style>
    #sidebar{
      color:white;
			z-index: 1;
      position: fixed;
			top: 0;
      bottom:0;
			left: 0;
      height:100%;
			width:60px;
			min-height: 100vh;
			transition: all 0.3s ease-out ;
      box-shadow: 0 0 20px rgba(0,0,0,0.5);
      overflow: hidden;
		}
    #sidebar > *{
      pointer-events: none;
    }
		#sidebar:hover{
			width: 240px;
      overflow: scroll;
      scrollbar-width: none;

		}
    #sidebar:hover::-webkit-scrollbar{
      display: none;
    }
    #sidebar:hover >*{
      pointer-events: visible;
    }
    .sidebar-row {
      color:white;
      border-radius: 10px;
      width: 230px;
      margin:0px 5px 5px 5px;
    }
    .sidebar-row, 
    .sidebar-row>*, 
    .sidebar-row>div>*{
      cursor: pointer;
    }

    .sidebar-row-hover{
      transition: all 0.2s ease;
    }
    .sidebar-row-hover:hover{
      background-color: var(--foreground-secondary-hovering);
      box-shadow: 0 0 2px rgba(67, 39, 224, 0.4) ;
    }
    .sidebar-header{
      display: flex;
      flex-direction: column;
      justify-content: center;
      transform: translateX(60px);
      align-items: flex-start !important;
      transition: all 0.4s ease-in;
      transition-property: transform;
    }
    #sidebar:hover .sidebar-header{
      transform: translateX(0px);
    }

  .vi-icon{
    margin:10px;
    min-width:30px;
    text-align: center;
  }
  .vi-label{
    color:white;
    margin: 5px 10px;
    width: calc(240px - 60px);
    display: flex;
    align-items:center;
    align-content: center;
  }
  .vi-label>*{
    color:white;
    margin: 0;
  }

</style>
<div id="sidebar" class="uk-foreground-secondary uk-box-shadow-large">
  <div class="uk-flex uk-flex-column uk-flex-wrap-between">
    <div uk-height-viewport="offset-bottom:true">
      <div class="sidebar-row uk-flex uk-flex-row">
        <div class="vi-label sidebar-header">
          @lang('general.greeting'), <h3 style="margin: 0;">{{Auth::guard('admin')->user()->name}}</h3>
        </div>
      </div>
      <hr>
      <div data-route="{{ route('admin.home') }}" class="sidebar-row sidebar-row-hover uk-flex uk-flex-row">
        <div class="vi-icon"><span uk-icon="icon: home; ratio:1.0;"></span></div>
        <div class="vi-label"><h5>@lang('general.home')</h5></div>
      </div>
      <div data-route="{{ route('admin.product') }}" class="sidebar-row sidebar-row-hover uk-flex uk-flex-row">
        <div class="vi-icon"><span class="uk-icon uk-icon-image" style="background-image: url('{{ asset('storage/images/icons/product.png') }}');"></span></div>
        <div class="vi-label"><h5>@lang('general.product')</h5></div>
      </div>
      <div data-route="{{ route('admin.category') }}" class="sidebar-row sidebar-row-hover uk-flex uk-flex-row">
        <div class="vi-icon"><span class="uk-icon uk-icon-image" style="background-image: url('{{ asset('storage/images/icons/category.png') }}');"></span></div>
        <div class="vi-label"><h5>@lang('general.category')</h5></div>
      </div>
      <div data-route="" class="sidebar-row sidebar-row-hover uk-flex uk-flex-row">
        <div class="vi-icon"><span uk-icon="icon: image; ratio:1.0;"></span></div>
        <div class="vi-label"><h5>@lang('general.banner')</h5></div>
      </div>
      <div data-route="{{ route('admin.order') }}" class="sidebar-row sidebar-row-hover uk-flex uk-flex-row">
        <div class="vi-icon"><span uk-icon="icon: credit-card; ratio:1.0;"></span></div>
        <div class="vi-label"><h5>@lang('general.order')</h5></div>
      </div>

      @if(Auth::guard('admin')->user()->id === 1)
      <div data-route="{{ route('admin.account') }}" class="sidebar-row sidebar-row-hover uk-flex uk-flex-row">
        <div class="vi-icon"><span uk-icon="icon: user; ratio:1.0;"></span></div>
        <div class="vi-label"><h5>@lang('general.account')</h5></div>
      </div>

      @endif
      
    </div>
    <div>
      <hr>
      <div data-route="{{ route('admin.settings') }}" class="sidebar-row sidebar-row-hover uk-flex uk-flex-row">
        <div class="vi-icon"><span uk-icon="icon: cog; ratio:1.0;"></span></div>
        <div class="vi-label"><h5>@lang('general.setting')</h5></div>
      </div>
      <div data-route="{{ route('admin.logout') }}" class="sidebar-row sidebar-row-hover uk-flex uk-flex-row">
        <div class="vi-icon"><span uk-icon="icon: sign-out; ratio:1.0;"></span></div>
        <div class="vi-label"><h5>@lang('general.logout')</h5></div>
      </div>
    </div>
  </div>
</div>
<script>
  Array.from(document.querySelectorAll('[data-route]')).map((domElement) => {
    domElement.addEventListener('click',(e) => {
    route = e.currentTarget.dataset.route;
    // console.log(e.currentTarget);
    window.location.href = route;
  });
  })
</script>
@endauth