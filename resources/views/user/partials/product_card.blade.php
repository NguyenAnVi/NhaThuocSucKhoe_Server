<div data-type="product" data-id="{{$item->id}}" class="category-{{$item->category_id}}">
  <div class="uk-border-rounded uk-card uk-overflow-hidden  vi-frame vi-gap">
    <div class="product-image uk-padding-small">
      <img style="aspect-ratio:1/1;" class="uk-object-cover" src="{{getImageAt($item->images, 0)}}" alt="">
    </div>
    <div class="product-title uk-padding-small uk-flex uk-flex-column uk-flex-between" style="height:8rem">
      <div style="height: 3rem; -webkit-box-orient: vertical; -webkit-line-clamp: 2; text-overflow: ellipsis; overflow:hidden;">{{$item->name}}</div>
      <div style="height:2.6rem; font-size:1.2rem">
        <span class="uk-text-bold">
          <script>
            if({{ $item->saleoff_price }}!=0)
              document.write(currency({{ $item->saleoff_price }})+`<span style="display:block; color:#aaa; font-size:1rem; font-weight:500; text-decoration-line:line-through">${currency({{ $item->price }})}</span>`)
            else
              document.write(currency({{$item->price}}))
          </script>
          
        </span>
      </div>
      <div style="height:1rem;">
        <span>Đã bán {{ $item->sold }}</span>
      </div>
      
    </div>  
  </div>
</div>