<?php
use App\Http\Controllers\User\CartController;
?>
{{-- Shopping cart --}}
{{-- <a href=""><span uk-icon="icon:cart"></span></a> --}}
<button class="uk-button uk-button-default uk-padding-remove-vertical uk-padding-small" type="button"><span uk-icon="icon:cart"></span> @lang('general.cart')</button>
<div id="cart" class="uk-width-3-4 uk-width-1-2@l uk-box-shadow-large" style="max-height: 77vh; overflow:auto"
  uk-dropdown="pos: bottom-right; mode: click; animation: uk-animation-slide-top-small; uk-flex-column uk-flex">
  @guest
    @lang('auth.login_required')
  @else
    {!! App\Http\Controllers\User\CartController::get_cart_partial() !!}
    <div class="uk-width-1-1 uk-text-right">
        <button type="button" class="uk-button uk-button-primary"  onclick="window.location.href='{{route('showCart')}}'">
            @lang('general.checkout')
        </button>
    </div>
  @endguest
    
</div>