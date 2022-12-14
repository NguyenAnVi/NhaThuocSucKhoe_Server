@extends('user.layouts.app')
@section('content')
    <div class="uk-padding">
        <div class="uk-card uk-box-shadow-large uk-card-default uk-card-body uk-padding">
            <div class="uk-width-1-1 uk-card-title">Giỏ hàng</div>
            <hr>
            @if(Cart::count()>0)
                <div class="uk-width-1-1 uk-flex uk-flex-wrap uk-padding-small uk-padding-remove-horizontal">
                    <div class="uk-width-1-1 uk-width-3-4@l  uk-padding-small">
                    
                        <div class="cart-items">
                            <div class="cart-content uk-flex uk-flex-column">
                                
                                @foreach (Cart::content() as $item)
                                    <div class="cart-main uk-width-expand uk-flex uk-flex-row">
                                            <div class="uk-width-1-6">
                                                <div class="cart-p-img">
                                                    <img src="{{ getImageAt($item->options->image, 0) }}" class="uk-object-cover" width="200" height="200" style="aspect-ratio: 1 / 1">
                                                </div>
                                            </div>
                                            <div class="uk-width-1-2">
                                                <div class="cart-p-name">
                                                    <a href="/show/product/{{$item->id}}">{{ $item->name }}</a><br>
                                                </div>
                                            </div>
                                            <div class="uk-width-1-6">
                                                <div class="cart-p-price">
                                                    <p>{{ number_format($item->price) }}đ</p>
        
                                                </div>
                                            </div>
                                            <div class="uk-width-1-6">
                                                <div class="uk-width-expand">
                                                    <form action="{{ route('updateCart', $item->rowId) }}" method="post">
                                                        @csrf
                                                        <input name="new_qty" type="number" class="uk-input uk-form-width-small" value="{{ $item->qty }}" min="1">
                                                        <button type="submit" class="uk-button uk-button-primary uk-button-small uk-width-expand">Cập nhật</button>
                                                    </form>
                                                    <form action="{{ route('deleteCart') }}" method="post">
                                                        @csrf
                                                        <input name="rowId" type="text" value="{{$item->rowId}}" hidden>
                                                        <input name="user_id" type="text" value="{{$item->id}}" hidden>
                                                        <button type="submit" class="uk-button uk-button-danger uk-button-small uk-width-expand">Xóa</button>
                                                    </form>
                                                </div>
                                            </div>
                                    </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-1-1 uk-width-1-4@l uk-padding-small uk-flex uk-flex-row">
                        <div class="cart-total">
        
                            <div class="prices">
                                <div class="uk-text-bold">Tổng tiền hàng:</div>
                                <p class="prices__total text-center justify-content-center">
                                    <strong class="uk-text-primary">{{Cart::count()}}</strong> món: 
                                    <strong class="uk-text-primary">
                                        {{ Cart::subTotal() }}
                                        <i style="margin:0 auto">đ</i>
                                    </strong>
                                </p>
                                <div class="uk-text-bold">Phí vận chuyển:</div>
                                <p class="prices__total text-center justify-content-center">
                                    <span class="">
                                        <i style="margin:0 auto">{{__('Đang cập nhật...')}}</i>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- <button type="button" class="cart__submit"><a href="">@lang('main.cart.order')</a></button> --}}
                <div class="uk-width-1-1 uk-text-center">
                    <form action="{{route('checkout')}}" method="get">
                        <input type="hidden" name="id" value = {{Auth::id()}}>
                        <button type="submit" class="uk-button uk-button-primary">Đăt hàng ngay</button>
                    </form>
                </div>
            @else
                <div class="cart-main uk-width-expand uk-flex uk-flex-row">
                    <div class="">
                        Chưa có sản phẩm trong giỏ
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
