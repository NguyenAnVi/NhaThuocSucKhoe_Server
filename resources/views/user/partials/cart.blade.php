<?php
use App\Http\Controllers\User\CartController;
?>
<a href=""><span uk-icon="icon:cart"></span></a>
<div id="cart" class="uk-width-3-4 uk-width-1-2@l uk-box-shadow-large" style="max-height: 77vh; overflow:auto"
  uk-dropdown="pos: bottom-right; mode: click; animation: uk-animation-slide-top-small; uk-flex-column uk-flex">
  
        {!! App\Http\Controllers\User\CartController::get_cart_partial() !!}
    <div class="uk-width-1-1 uk-text-right">
        <button type="button" class="uk-button uk-button-primary"  onclick="window.location.href='{{route('showCart')}}'">
            Kiểm tra giỏ hàng
        </button>
    </div>
</div>