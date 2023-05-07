
<style>
  .vi-rounded{
    border-radius: 15px;
  }
  .uk-thumbnav > li:hover{
    filter: contrast(70%);
  }
</style>
<div class="uk-margin-top uk-flex uk-flex-column vi-rounded uk-card-default">
  <div class="product-briefing uk-width-1-1 uk-flex uk-flex-wrap uk-flex-wrap-around uk-padding-small">
      
    <div class="uk-position-relative uk-width-1-1 uk-width-2-5@m" tabindex="-1" uk-slideshow="ratio: 7:6; animation:slide">
      <ul class="uk-slideshow-items" uk-lightbox="animation: push">
        @for ($i = 0; $i < getLength($item->images); $i++)
        <li>
          <a href="{{getImageAt($item->images, $i)}}" data-caption="{{$item->name}} - {{intval($i+1)}}">
            <img src="{{getImageAt($item->images, $i)}}" class="uk-object-contain uk-object-position-center-center" style="object-fit:contain;"  uk-height-match="target: #sls">
          </a>
        </li>
        @endfor
      </ul>
  
      <div class=" uk-width-expand uk-padding-small">
        <ul class="uk-thumbnav">
            @for ($i = 0; $i < getLength($item->images); $i++)
              <li uk-slideshow-item="{{$i}}"><a href="#"><img src="{{getImageAt($item->images, $i)}}" width="80" height="80"></a></li>
            @endfor
            
        </ul>
      </div>


    </div>    

    <div class="uk-width-1-1 uk-width-3-5@m uk-padding uk-padding-remove-vertical">
      {{-- title --}}
      <article class="uk-article">
        {{-- uk-breadcrumb --}}
        <ul class="uk-breadcrumb">
          <li><a href="">Bubu</a></li>
          <li><span>{{$item->name}}</span></li>
        </ul>
        <h2 class=""><a class="uk-link-reset" href="">{{$item->name}}</a></h2>
        <div class="uk-width-1-1 uk-flex uk-flex-between">
          <p class="uk-article-meta">@lang('general.sold') : {{intval($item->sold)}}</p>
          <a href="" class="uk-article-meta">@lang('general.report')<span uk-icon="warning"></span></a>
        </div>
        <div class="uk-width-1-1 uk-margin-remove uk-alert uk-padding-small uk-width-1-1 uk-text-bold">
          <span style="font-size: 2rem; color:red" id="price" data-saleoffprice="{{$item->saleoff_price}}" data-price="{{$item->price}}" ></span>
        </div>

        {{-- buttons and select number add to cart --}}
        <form action="@if (Auth::check()){{ route('addCart') }}@endif" method="post" class="uk-form-horizontal uk-margin-small">
          
          @csrf
          @if($item->classified==1)
          <link rel="stylesheet" href="{{ asset('css/options.css') }}">
          <div class="uk-margin">
            <div class="uk-width-1-1 uk-flex uk-flex-middle">
              <div class="uk-width-1-4">
                <label class="uk-padding-small uk-padding-remove-horizontal" id="options-name"></label>
              </div>
              <div class="uk-width-3-4"  id="options">
                 
              </div>
            </div>
            <script>
              
              $('#options').html("");
              $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: 'get',
                url: '{{ URL::to('/admin/product/options') }}/'+{{ $item->id }},
                success:function(obj){
                  let r = JSON.parse(obj)
                  if(r.status == 1){
                    // create Options with Params
                    $('#price').html(currency(minPrice(r.content)) + "-" + currency(maxPrice(r.content)));
                    r.content.forEach(item => {
                      console.log(item);
                      $('#options-name').html(item.name);
                      
                      $('#options').append(`
                        <input class="checkbox-budget" type="radio" name="option" value="${item.value}" id="option-${item.value}">
                        <label class="for-checkbox-budget" for="option-${item.value}"  data-value="${item.value}" data-stock="${item.stock}" data-price="${item.price}">
                          <span data-hover="${item.value}">${item.value}</span>
                        </label>
                      `);
                    });
                    $('.for-checkbox-budget').click(function(){
                      let stock = $(this).data('stock');
                      $('#amount').attr('max', stock);
                      $('#stock').html(stock);
                      let price = $(this).data('price');
                      $('#price').html(currency(price));
                    });
                  }
                  else UIkit.notification(r.content);
                }
              });
            </script>
          </div>
          @endif
          <div class="uk-margin">
            <div class="uk-width-1-1 uk-flex uk-flex-left uk-flex-middle" uk-grid>
              <div class="uk-width-1-4">
                <label class="uk-padding-small uk-padding-remove-horizontal">@lang('general.quantity') :</label>
              </div>
              <div class="uk-width-3-4">
                <input type="text" name="user_id" value="{{Auth::id()}}" hidden>
                <input type="text" name="product_id" value="{{ $item->id }}" hidden>
                <input type="number" value="1" min="1" max="{{intval($item->stock)}}" class="uk-input uk-width-small" name="quantity" id="amount">
                (@lang('general.stock'): <span id="stock">{{intval($item->stock)}}</span>)
              </div>
              <div class="uk-div-1-4"><label class="uk-padding-small uk-padding-remove-horizontal">@lang('general.shipping')</label></div>
              <div class="uk-div-3-4">
                <img src="{{asset('storage/images/logo/freeship.png')}}" alt="" width="30" height="30"> @lang('general.freeshipping')
              </div>
            </div>
          </div>

          <div class="">
            @if ($item->stock > 0)
              @if (Auth::check())
              <button type="submit" class="uk-button-large uk-button uk-button-secondary" href="#">@lang('general.addtocart')<span uk-icon="cart"></span> </button>
              @else
                <button type="button" onclick="alert('Bạn phải đăng nhập')" class="uk-button-large uk-button uk-button-secondary" href="#">@lang('general.addtocart')<span uk-icon="cart"></span> </button>
              @endif
            @else
              <button type="button" class="uk-button-large uk-button uk-button-secondary uk-disabled" href="#">@lang('general.outofstock')</button>
            @endif
              
            </div>
            <div class="uk-padding-small uk-padding-remove-horizontal">
              <img src="{{asset('storage/images/logo/ensure.png')}}" alt="" width="30" height="30"> Bubu đảm bảo  &nbsp; <i>30 ngày trả hàng, hoàn tiền</i>
            </div>
          </form>
        </div>
        </form>
    
       
    
      </article>


    </div>
  </div>
  {{-- detail section --}}
  <div class="product-detail uk-width-1-1 uk-card uk-card-default uk-box-shadow-large uk-margin uk-flex uk-flex-wrap uk-flex-wrap-around  vi-rounded">
    <div class="uk-width-1-1 uk-width-2-3@m uk-padding">
      {{-- detail content --}}
      <div>
        <h3 class="uk-alert uk-alert-primary uk-padding-small uk-border-rounded uk-padding-remove-right uk-text-uppercase">@lang('general.productinformation')</h3>
        <p>@lang('general.categories'): <span class="uk-text-bold">{{ $category_name }}</span></p>
        <p>@lang('general.stock'): <span class="uk-text-bold">{{ $item->stock }}</span></p>
      </div>
      <div>
        <h3 class="uk-alert uk-alert-primary uk-padding-small uk-border-rounded uk-padding-remove-right uk-text-uppercase">@lang('general.productdescription')</h3>
        {!!$item->detail!!}
      </div>
    </div>
    <hr class="uk-divider-vertical uk-visible@m" uk-height-match="row:false;target:#product-detail-content;" style="height:auto">
    <div class="uk-width-1-1 uk-width-expand@m uk-padding">
      {{-- other products --}}
      <div class="uk-width-1-1">
        <h3 class="uk-alert uk-padding-small uk-border-rounded uk-padding-remove-right">@lang('general.samecategory')</h3>
        {{-- show thís category --}}
        <div class="uk-flex uk-flex-wrap uk-child-width-1-1">
          @each ('user.partials.product_card_horizontal',$sameCat,'item', 'user.partials.feature_updating')
        </div>
      </div>
      {{-- <div class="uk-width-1-1">
        <h3 class="uk-alert uk-padding-small uk-border-rounded uk-padding-remove-right">Sản phẩm tương tự</h3>
      </div> --}}
    </div>
  </div>
</div>
@section('js')
<script>

function minPrice(arr){
  arr1 = arr.map(function(element){
    return element.price;
  })
  return Math.min.apply(null,arr1);
}
function maxPrice(arr){
  arr1 = arr.map(function(element){
    return element.price;
  })
  return Math.max.apply(null,arr1);
}




$(document).ready(function(){
  if($('#price').data('saleoffprice')!="0")
    $('#price').html(currency($('#price').data('saleoffprice'))+`    <span style="color:black; font-size:1rem; font-weight:500; text-decoration-line:line-through">${currency($('#price').data('price'))}</span>`)
  else
    $('#price').html(currency($('#price').data('price')))
  
  $('[data-type=product]').click(function (){
    let type = $(this).data('type');
    let id = $(this).data('id');
    window.location.href='/'+'show/'+type+'/'+id;
    return;
  });
});
</script>
@endsection