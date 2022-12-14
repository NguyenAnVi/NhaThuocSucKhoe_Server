@extends('user.layouts.app')
@section('content')
    <div class="uk-child-width-expand@s uk-text-center uk-align-center uk-padding" uk-grid="" style="width: 900px;">
        <div class="uk-card uk-card-default uk-card-body uk-grid-margin uk-margin" uk-grid>
            <div class="uk-width-1-3 uk-padding">
                <img class="" width="140" height="120" src="{{asset('logo/LOGO.png')}}" alt="">
                <h2>Đăng nhập</h2>
            </div>
            <div class="uk-width-2-3 uk-padding">
                @error('approve')
                    <div class="uk-alert-danger" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <p>{{ $message }}</p>
                    </div>
                @enderror
                <form id="login-form" class="uk-panel uk-panel-box uk-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="uk-form-row uk-margin">
                        <input class="uk-input uk-width-1-1 uk-form-large @error('phone') uk-form-danger @enderror" value="{{ old('phone') }}" type="text" name="phone" value="@if(isset($phone)){{$request->input('phone')}}{{$request->input('general_message')}}@endif" placeholder="Nhập số điện thoại">
                        @error('phone')
                            <div class="uk-text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="uk-form-row uk-margin">
                        <input class="uk-input uk-width-1-1 uk-form-large @error('password') uk-form-danger @enderror" value="{{ old('password') }}" type="password" name="password" placeholder="Nhập mật khẩu">
                        @error('password')
                            <div class="uk-text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- <div class="uk-form-row uk-text-small"> --}}
                        {{-- <label class="uk-float-left"><input type="checkbox"> Remember Me</label> --}}
                        {{-- <a class="uk-float-right uk-link uk-link-muted" href="#">Forgot Password?</a> --}}
                    {{-- </div> --}}
                </form>
                <div class="uk-margin">
                    <button class="uk-button uk-button-primary uk-button-large uk-width-expand@m" type="submit" form="login-form">Đăng nhập</button>
                    <button class="uk-button uk-button-secondary uk-width-expand@m" type="submit" form="register-form"
                            onclick="event.preventDefault(); document.getElementById('register-form').submit();">Đăng ký</button>                            
                </div>
                <form id="register-form" action="{{ route('register') }}" method="GET" style="display: none;">
                </form>
            </div>
        </div>
    </div>
@endsection
