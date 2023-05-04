<div data-type="product" data-id="{{$item->id}}" class="category-{{$item->category_id}}">
  <div class="uk-border-rounded uk-card uk-overflow-hidden uk-flex">
    <div  style="height:6rem; width:6rem" class=" uk-padding-small">
      <img  style="aspect-ratio:1/1;height:6rem; width:6rem" class="uk-object-cover" src="{{getImageAt($item->images, 0)}}" alt="">
    </div>
    <div class="product-title uk-padding-small uk-flex uk-flex-column uk-flex-between" style="height:6rem">
      <div style="height: 3rem;" class="uk-overflow-hidden"><p>{{$item->name}}</p></div>
      <div style="height:1.5rem; font-size:1.2rem">
        <span class="uk-text-bold">{{$item->price}}<sup>đ</sup></span>
      </div>
      <div style="height:1rem;">
        <span>Đã bán {{ $item->sold }}</span>
      </div>
      
    </div>  
  </div>
</div>