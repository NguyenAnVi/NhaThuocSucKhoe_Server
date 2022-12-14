@extends('user.layouts.app')
@section('content')
    <div class="uk-child-width-expand@s uk-text-center uk-align-center uk-padding" uk-grid style="width: 900px;">
        <div class="uk-card uk-card-body uk-card-default uk-grid-margin uk-margin " uk-grid>
            <div class="uk-width-expand@s uk-width-1-3@m uk-padding">
                <img class="" width="140" height="120" src="{{asset('logo/LOGO.png')}}" alt="">
                <h2>Đăng ký</h2>
            </div>
            <div class="uk-width-expand@s uk-width-2-3@m uk-padding">
                <form id="register-form" class="uk-panel uk-panel-box uk-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="uk-form-row uk-margin">
                        <input value="{{old('name')}}" class="uk-input uk-width-1-1 uk-form-large @error('name') uk-form-danger @enderror" 
                            type="text" name="name" placeholder="Họ và tên" required>
                    </div>
                    @error('name')
                    <span class="uk-text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="uk-form-row uk-margin">
                        <input value="{{old('phone')}}" class="uk-input uk-width-1-1 uk-form-large @error('phone') uk-form-danger @enderror" type="phone" name="phone" placeholder="Điện thoại" required>
                    </div>
                    @error('phone')
                    <span class="uk-text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    
                    <div class="uk-form-row uk-margin">
                        <input value="{{old('password')}}" class="uk-input uk-width-1-1 uk-form-large @error('password') uk-form-danger @enderror" type="password" name="password" placeholder="Nhập mật khẩu mới" required>
                    </div>@error('password')
                    <span class="uk-text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </form>
                <div class="uk-margin">
                    <button class="uk-button uk-button-primary uk-button-large uk-width-expand@m" type="submit" form="register-form">Đăng ký</button>
                    <button class="uk-button uk-button-secondary uk-width-expand@m" type="submit" form="login-form"
                            onclick="event.preventDefault(); document.getElementById('login-form').submit();">Đăng nhập</button>
                </div>
                <form id="login-form" action="{{ route('login') }}" method="GET" style="display: none;"></form>
            </div>
        </div>
    </div>
@endsection
