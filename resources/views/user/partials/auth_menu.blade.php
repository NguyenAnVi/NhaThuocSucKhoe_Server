{{-- Authentication Links --}}
<a href=""><span uk-icon="icon:user"></span></a>  
<div class="uk-navbar-dropdown" uk-dropdown="pos: bottom-right; mode:click; animation: uk-animation-slide-top-small">
  <ul class="uk-nav uk-navbar-dropdown-nav">
    @guest
      @if (Route::has('login'))
        <li>
          <a id="login-button" data-route="{{ route('login') }}">@lang('auth.login')</a>
        </li>
        <div id="login-div" uk-modal></div>
        
      @endif
     
    @else
      <li class="uk-nav-header">
        {{__(Auth::user()->name)}}
      </li>
      <li class="uk-nav-divider"></li>
      <li>
        <a href="{{ route('orders') }}">
          @lang('button.myorders')
        </a>
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          @lang('general.auth.logout')
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    @endguest
  </ul>
</div>

<script>

  $('#login-button').on('click',function(){
    $route = $(this).data('route');
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'get',
      url: $route,
      success:function(obj){
        $('#login-div').html((JSON.parse(obj)));
        UIkit.modal('#group1').show();
      }
    });
  });

</script>
