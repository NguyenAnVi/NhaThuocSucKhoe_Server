@extends('admin.layouts.app')
@section('content')
    <div class="uk-child-width-expand@s uk-text-center uk-align-center uk-padding" uk-grid="" style="width: 900px;">
        <div class="uk-card uk-card-default uk-card-body uk-grid-margin uk-margin" uk-grid>
            <div class="uk-width-1-3 uk-padding">
                <img class="" width="140" height="120" src="{{asset('logo/LOGO.png')}}" alt="">
                <h2>Đăng nhập (ADMIN)</h2>
            </div>
            <div class="uk-width-2-3 uk-padding">
                @error('approve')
                    <div class="uk-alert-danger" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <p>{{ $message }}</p>
                    </div>
                @enderror
                <form id="login-form" class="uk-panel uk-panel-box uk-form" method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="uk-form-row uk-margin">
                        <input value="{{old('phone')}}" autofocus tabindex="1" class="uk-input uk-width-1-1 uk-form-large @error('phone') uk-form-danger @enderror" type="text" name="phone" value="@if(isset($phone)){{$request->input('phone')}}@endif" placeholder="Nhập số điện thoại">
                        @error('phone')
                            <span class="uk-text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="uk-form-row uk-margin">
                        <input tabindex="1" class="uk-input uk-width-1-1 uk-form-large @error('password') uk-form-danger @enderror" type="password" name="password" placeholder="Nhập mật khẩu">
                    </div>
                        @error('password')
                            <span class="uk-text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                </form>
                <div class="uk-margin">
                    <button tabindex="1" class="uk-button uk-button-primary uk-button-large uk-width-expand@m" type="submit" form="login-form">Đăng nhập</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
