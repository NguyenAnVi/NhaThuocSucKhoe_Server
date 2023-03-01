  @foreach($available_locales as $locale_name => $available_locale)
    <button  uk-tooltip="{{$locale_name}}" type="button"
      class="uk-button-secondary" style="padding: 2px; "
            onclick="window.location.href='language/{{ $available_locale }}'">
      <img src="{{asset('storage/images/logo/lang/'.$available_locale.'.png')}}" height="20" width="20 ">
    </button>
  @endforeach