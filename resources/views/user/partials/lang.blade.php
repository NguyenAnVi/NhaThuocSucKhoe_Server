<div class="uk-flex uk-flex-wrap">
  @foreach($available_locales as $locale_name => $available_locale)
    <button  uk-tooltip="{{$locale_name}}"   
      class="uk-button uk-button-link uk-padding-small uk-padding-remove-vertical uk-padding-remove-right 
             @if($available_locale === $current_locale)uk-disabled @endif" 
            onclick="window.location.href='language/{{ $available_locale }}'">
      <img src="{{asset('logo/lang/'.$available_locale.'.png')}}" height="20" width="20 ">
    </button>
  @endforeach
</div>