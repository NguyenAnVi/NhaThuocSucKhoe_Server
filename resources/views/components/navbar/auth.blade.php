{{-- Authentication Links --}}
@guest
    {{-- <button id="login-button" data-route="{{ route('login') }}" class="uk-button uk-button-default uk-padding-remove-vertical uk-padding-small" type="button">@lang('auth.login')</button> --}}
    <button onclick="window.location.href='{{route('login') }}';" class="uk-button uk-button-primary uk-padding-remove-vertical uk-padding-small" type="button">@lang('auth.login')</button>
    <div id="login-div" uk-modal></div>
@else
<button class="uk-button uk-button-primary uk-padding-remove-vertical uk-padding-small" type="button"><span uk-icon="icon:user"></span></button>
<div class="uk-navbar-dropdown" uk-dropdown="pos: bottom-right; mode:click; animation: uk-animation-slide-top-small">
  <ul class="uk-nav uk-navbar-dropdown-nav">
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
  </ul>
</div>


@endguest

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
