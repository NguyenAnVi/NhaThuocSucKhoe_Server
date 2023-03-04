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
    border-radius: 25px 0px 0px 25px;
    width: 235px;
    margin:5px 5px 5px 5px;
  }
  .sidebar-row, 
  .sidebar-row>*, 
  .sidebar-row>div>*{
    cursor: pointer;
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
  .sidebar-row-hover:hover,  .sidebar-row-hover:hover>.vi-label{
    color: var(--foreground-secondary-hovering);
    background-color: rgb(197, 197, 197);

  }
  .vi-icon{
    display: flex;
    align-items: center;
    justify-content: center;
    margin:5px;
    padding: 5px;
    min-width:30px;
    min-height: 30px;
    text-align: center;
    border-radius: 25px;
    color: white !important;
    background-color: var(--foreground-secondary-hovering) !important;
  }
  /* .sidebar-row:hover .vi-icon{
    
  } */
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

  .sidebar-row-active , .sidebar-row-active>.vi-label{
    color: var(--foreground-secondary) !important;
    background-color: white;
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
        <div class="vi-label">@lang('general.home')</div>
      </div>
      <div data-route="{{ route('admin.product') }}" class="sidebar-row sidebar-row-hover uk-flex uk-flex-row">
        <div class="vi-icon"><span class="uk-icon uk-icon-image" style="background-image: url('{{ asset('storage/images/icons/product.png') }}');"></span></div>
        <div class="vi-label">@lang('general.product')</div>
      </div>
      <div data-route="{{ route('admin.category') }}" class="sidebar-row sidebar-row-hover uk-flex uk-flex-row">
        <div class="vi-icon"><span class="uk-icon uk-icon-image" style="background-image: url('{{ asset('storage/images/icons/category.png') }}');"></span></div>
        <div class="vi-label">@lang('general.category')</div>
      </div>
      <div data-route="{{ route('admin.banner') }}" class="sidebar-row sidebar-row-hover uk-flex uk-flex-row">
        <div class="vi-icon"><span class="uk-icon uk-icon-image" style="background-image: url('{{ asset('storage/images/icons/banner.png') }}');"></span></div>
        <div class="vi-label">@lang('general.banner')</div>
      </div>
      <div data-route="{{ route('admin.image') }}" class="sidebar-row sidebar-row-hover uk-flex uk-flex-row">
        <div class="vi-icon"><span uk-icon="icon: image; ratio:1.0;"></span></div>
        <div class="vi-label">@lang('general.image')</div>
      </div>
      <div data-route="{{ route('admin.order') }}" class="sidebar-row sidebar-row-hover uk-flex uk-flex-row">
        <div class="vi-icon"><span uk-icon="icon: credit-card; ratio:1.0;"></span></div>
        <div class="vi-label">@lang('general.order')</div>
      </div>

      @if(Auth::guard('admin')->user()->id === 1)
      <div data-route="{{ route('admin.account') }}" class="sidebar-row sidebar-row-hover uk-flex uk-flex-row">
        <div class="vi-icon"><span uk-icon="icon: user; ratio:1.0;"></span></div>
        <div class="vi-label">@lang('general.account')</div>
      </div>
      @endif
      
    </div>
    <div>
      <hr>
      <div data-route="{{ route('admin.settings') }}" class="sidebar-row sidebar-row-hover uk-flex uk-flex-row">
        <div class="vi-icon"><span uk-icon="icon: cog; ratio:1.0;"></span></div>
        <div class="vi-label">@lang('general.setting')</div>
      </div>
      <div data-route="{{ route('admin.logout') }}" class="sidebar-row sidebar-row-hover uk-flex uk-flex-row">
        <div class="vi-icon"><span uk-icon="icon: sign-out; ratio:1.0;"></span></div>
        <div class="vi-label">@lang('general.logout')</div>
      </div>
    </div>
  </div>
</div>
<script>
  var route1;
  Array.from(document.querySelectorAll('[data-route]')).map((domElement) => {
    route1 = domElement.dataset.route;
    if(route1 === "{!! url()->current() !!}"){
      domElement.className += " sidebar-row-active";
    } else {
      domElement.addEventListener('click',(e) => {
        let route = e.currentTarget.dataset.route;
        window.location.href = route;
      });
    }
    
  });
</script>
@endauth