{{-- Authentication Links --}}
<a href=""><span uk-icon="icon:user"></span></a>  
<div class="uk-navbar-dropdown" uk-dropdown="pos: bottom-right; mode:click; animation: uk-animation-slide-top-small">
  <ul class="uk-nav uk-navbar-dropdown-nav">
    @guest
      @if (Route::has('login'))
        <li>
          <a href="{{ route('login') }}">{{ __('general.auth.login') }}</a>
        </li>
      @endif
      @if (Route::has('register'))
        <li>
          <a href="{{ route('register') }}">{{ __('general.auth.register') }}</a>
        </li>
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
