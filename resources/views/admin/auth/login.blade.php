@extends('admin.layouts.app')
@section('css')
<style>
.login {
  display:block;
  overflow: hidden;
  box-shadow: 0px 5px 10px rgba(169, 169, 169, 0.367);
}

</style>
@endsection
@section('content')
        <form class="login uk-width-1-2@m uk-align-center uk-foreground-secondary uk-border-rounded-10 uk-margin-large-top uk-margin-large-bottom uk-padding uk-padding-remove-bottom" action="" method="POST">
            @csrf
            <h3 class="uk-text-center uk-text-background-primary uk-article-title uk-margin-small uk-margin-bottom">@lang('auth.login')</h3>
            <input class="uk-input uk-input-primary uk-margin-small-bottom" value="{{ old('phone') }}" name="phone" type="text" placeholder="@lang('auth.msg.type_phone')">
            <input class="uk-input uk-input-primary @error('password') uk-input-danger  @enderror" name="password" type="password" placeholder="@lang('auth.msg.type_password')">
            <div class="uk-margin uk-text-right">
              <button class="uk-button uk-button-secondary uk-width-expand uk-padding-remove" type="submit">@lang('auth.login')</button>
              <div style="height: 5em" class="uk-flex uk-flex-bottom uk-flex-between">
                <div>
                  <span class="uk-text-background-primary">@lang('auth.msg.donthaveaccount')</span>
                  <a class="uk-text-background-primary" href="{{route('register')}}">&nbsp; @lang('auth.register')</a>
                </div>
              </div>
            </div>
          </form>
@endsection