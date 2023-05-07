{{-- <li class="vi-frame vi-gap" onclick="window.location.href='/show/category/{{$item->id}}'"> --}}
<li data-cname="{{ $item->name }}" class="category-showing-product-on-click vi-frame vi-gap">
  <div class="uk-width-1-1 uk-flex">
    <img class="uk-margin-auto uk-margin-auto-horizontal" src="{{$item->imageurl}}" width="150" height="150" alt="">
  </div>
  <h4 class="uk-margin-remove uk-text-center uk-text-break">{{$item->name}}</h3>
  {{-- <button class="uk-button uk-button-text uk-flex uk-flex-center uk-flex-middle uk-margin-right uk-text-bold uk-text-{{(['primary', 'secondary', 'success', 'warning', 'danger'])[rand(0,4)]}}">{{$item->name}}</button> --}}
</li> 