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
          <li><a href="">abc</a></li>
          <li><a href="">xyz</a></li>
          <li><span>{{$item->name}}</span></li>
        </ul>
        <h2 class=""><a class="uk-link-reset" href="">{{$item->name}}</a></h2>
        <div class="uk-width-1-1 uk-flex uk-flex-between">
          <p class="uk-article-meta">Đã bán {{intval($item->sold)}}</p>
          <a href="" class="uk-article-meta">Report <span uk-icon="warning"></span></a>
        </div>
        <p class="uk-margin-remove uk-text-lead uk-alert uk-padding-small uk-width-1-1">
          {{toCurrency($item->price)}}
        </p>

        {{-- buttons and select number add to cart --}}
        <form action="@if (Auth::check()){{ route('addCart') }}@endif" method="post" class="uk-form-horizontal uk-margin-small">
          
          @csrf
          <div class="uk-margin">
            <div class="uk-width-1-1 uk-flex uk-flex-left uk-flex-middle" uk-grid>
              <div class="uk-width-1-4"><label class="uk-padding-small uk-padding-remove-horizontal">Số lượng</label></div>
              <div class="uk-width-3-4">
                <input type="text" name="user_id" value="{{Auth::id()}}" hidden>
                <input type="text" name="product_id" value="{{ $item->id }}" hidden>
                <input type="number" value="1" min="1" max="{{intval($item->stock)}}" class="uk-input uk-width-small" name="quantity" id="amount">
                (Kho: {{intval($item->stock)}})
              </div>
              <div class="uk-div-1-4"><label class="uk-padding-small uk-padding-remove-horizontal">Vận chuyển</label></div>
              <div class="uk-div-3-4">
                <img src="{{asset('storage/images/logo/freeship.png')}}" alt="" width="30" height="30"> Miễn phí giao hàng

              </div>
            </div>
          </div>

          <div class="">
            @if ($item->stock > 0)
              @if (Auth::check())
              <button type="submit" class="uk-button-large uk-button uk-button-secondary" href="#">Thêm vào giỏ hàng <span uk-icon="cart"></span> </button>
              @else
                <button type="button" onclick="alert('Bạn phải đăng nhập')" class="uk-button-large uk-button uk-button-secondary" href="#">Thêm vào giỏ hàng <span uk-icon="cart"></span> </button>
              @endif
            @else
              <button type="button" class="uk-button-large uk-button uk-button-secondary uk-disabled" href="#">Tạm hết hàng</button>
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
        <h3 class="uk-alert uk-alert-primary uk-padding-small uk-border-rounded uk-padding-remove-right">CHI TIET SAN PHAM</h3>
        <p>Danh muc: {{--insert breadcrumb --}}</p>
      </div>
      <div>
        <h3 class="uk-alert uk-alert-primary uk-padding-small uk-border-rounded uk-padding-remove-right">MO TA SAN PHAM</h3>
        {!!$item->detail!!}
      </div>
    </div>
    <hr class="uk-divider-vertical uk-visible@m" uk-height-match="row:false;target:#product-detail-content;" style="height:auto">
    <div class="uk-width-1-1 uk-width-expand@m uk-padding">
      {{-- other products --}}
      <div class="uk-width-1-1">
        <h3 class="uk-alert uk-padding-small uk-border-rounded uk-padding-remove-right">Sản phẩm cùng danh mục</h3>
        {{-- show thís category --}}
      </div>
      <div class="uk-width-1-1">
        <h3 class="uk-alert uk-padding-small uk-border-rounded uk-padding-remove-right">Sản phẩm tương tự</h3>
        {{-- show thís search --}}
      </div>
    </div>
  </div>
</div>