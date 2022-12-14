<div class="uk-padding-small uk-flex uk-flex-column">
  <div class="uk-breadcrumb">

  </div>
  <div class="product-briefing uk-width-1-1
              uk-flex uk-flex-wrap uk-flex-wrap-around">
    <div class="uk-width-1-1 uk-width-2-5@m ">
      
      <div class="uk-position-relative" tabindex="-1" uk-slideshow="ratio: 16:10; animation:slide">

        <ul class="uk-slideshow-items" uk-lightbox="animation: push">
          @for ($i = 0; $i < getLength($item->images); $i++)
          <li>
            <a href="{{getImageAt($item->images, $i)}}" data-caption="{{$item->name}} - {{intval($i+1)}}">
              <img src="{{getImageAt($item->images, $i)}}" class="uk-object-contain uk-object-position-center-center" >
            </a>
          </li>
          @endfor
        </ul>
    
        <div class=" uk-position-bottom-center-out uk-width-expand uk-padding-small">
          <ul class="uk-thumbnav">
              @for ($i = 0; $i < getLength($item->images); $i++)
                <li  uk-slideshow-item="{{$i}}"><a href="#"><img src="{{getImageAt($item->images, $i)}}" width="80" height="80"></a></li>
              @endfor
              
          </ul>
        </div>


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
        <h1 class="uk-article-title"><a class="uk-link-reset" href="">{{$item->name}}</a></h1>
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
            <div class="uk-width-1-1 uk-flex uk-flex-left">
              <label class="uk-padding-small">Số lượng</label>
              <input type="text" name="user_id" value="{{Auth::id()}}" hidden>
              <input type="text" name="product_id" value="{{ $item->id }}" hidden>
              <input type="number" value="1" min="1" max="{{intval($item->stock)}}" class="uk-input uk-width-small" name="quantity" id="amount">
              <p class="uk-padding-small uk-inline uk-margin-remove">Có {{intval($item->stock)}} sản phẩm có sẵn.</p>
            </div>
          </div>

          <div class="uk-grid-small uk-child-width-auto" uk-grid>
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
          </form>
        </div>
        </form>
    
       
    
      </article>


    </div>
  </div>
  {{-- detail section --}}
  <div class="product-detail uk-width-1-1 uk-card uk-card-default uk-box-shadow-large uk-margin uk-flex uk-flex-wrap uk-flex-wrap-around">
    <div class="uk-width-1-1 uk-width-2-3@m uk-padding">
      {{-- detail content --}}
      <div>
        <h3 class="uk-alert uk-alert-primary uk-padding-small uk-border-rounded uk-padding-remove-right" uk-grid>CHI TIET SAN PHAM</h3>
        <p>Danh muc: {{--insert breadcrumb --}}</p>
      </div>
      <div>
        <h3 class="uk-alert uk-alert-primary uk-padding-small uk-border-rounded uk-padding-remove-right" uk-grid>MO TA SAN PHAM</h3>
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