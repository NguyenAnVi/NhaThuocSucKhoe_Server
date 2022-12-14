<div data-type="product" data-id="{{$item->id}}" 
    class="category-{{$item->category_id}} uk-padding-small uk-padding-remove-left uk-padding-remove-top">
  <div class="uk-card uk-card-secondary uk-border-rounded uk-overflow-hidden">
    <div class="product-image uk-padding-small">
      <img style="aspect-ratio:1/1;" class="uk-object-cover" src="{{getImageAt($item->images, 0)}}" alt="">
    </div>
    <div class="product-title uk-padding-small uk-flex uk-flex-column uk-flex-between" style="height:5rem">
      <div style="height: 3rem;" class="uk-overflow-hidden"><p>{{$item->name}}</p></div>
      <div style="height:2rem;" class="uk-flex uk-flex-between">
        <div><p>{{$item->price}}</p></div><div><p class="uk-emphasis">Đã bán 0</p></div>
      </div>
      
    </div>  
  </div>
</div>