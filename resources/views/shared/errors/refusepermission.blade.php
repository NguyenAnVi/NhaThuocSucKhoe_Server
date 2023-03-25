@extends('shared.layouts.app')
@section('content')
<div class="uk-flex uk-flex-middle" uk-height-viewport="expand: true;"> 
  <div>
    <img class="" style="width: 760px" src="{{ asset('storage/images/errors/access-denied.png') }}" alt="">
  </div>
  <div>
      <h3>@lang('admin.message.rootpermission')</h3>
      <a href="{{ route('logout') }}" class="uk-button uk-button-large uk-button-primary">@lang('auth.logout')</a>
  </div>
</div>
@endsection