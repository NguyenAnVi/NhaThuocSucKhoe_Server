@extends('shared.layouts.app')
@section('content')
<div class="uk-flex uk-flex-center uk-flex-middle" uk-height-viewport="expand:true">
  <div class="uk-width-1-3">
    <img src="{{ asset('storage/images/errors/404.png') }}" style="width: 540px" alt="">
  </div>
  <div class="uk-width-1-3">
    <h3>@lang('general.msg.pagenotfound')</h3>
    @php
      try {
        $user = App\Http\Controllers\Admin\HomeController::getCurrentUser();
        if($user->role == 'ADMIN' || $user->role == 'ROOT'){
          echo '<a href="'.route('admin.home').'" class="uk-button uk-button-large uk-button-primary uk-width-auto">ADMIN HOME</a>';
        } 
      } catch (\Exception $e) {
      }
      echo '<a href="'.route('home').'" class="uk-button uk-button-large uk-button-primary uk-width-auto">HOME</a>';
    @endphp
  </div>
</div>
@endsection