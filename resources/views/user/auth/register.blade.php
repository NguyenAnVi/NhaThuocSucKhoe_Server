@extends('user.layouts.app')
@section('css')
<style>
.form-register {
  display:block;
  overflow: hidden;
  box-shadow: 0px 5px 10px rgba(169, 169, 169, 0.367);
}
</style>
@endsection
@section('content')

  <form id="p1" class="form-register uk-width-1-2@m uk-align-center uk-foreground-primary uk-border-rounded-10 uk-margin-large-top uk-margin-large-bottom uk-padding uk-padding-remove-bottom" style="display: none;">
    <h3 class="uk-text-center uk-text-background-primary uk-article-title uk-margin-small uk-margin-bottom">@lang('auth.register')</h3>

    <div class="uk-margin-bottom">
      <div class="uk-width-1-1">
        <input class="uk-input uk-search-input uk-width-expand uk-margin-" id="phone-number" type="text" placeholder="@lang('auth.msg.type_phone')">
      </div>
    </div>
    <div class="uk-margin-bottom uk-width-expand">
      <button id="phone-number-check-button" class="uk-width-expand uk-button uk-button-primary" type="button">@lang('general.check')</button>
    </div>
    <div class="uk-margin-bottom" id="phone-number-check-result"></div>
    

    <div class="uk-margin-bottom uk-flex uk-flex-center" id="recaptcha-container"></div>
    <button type="button" id="sendotp-button"  class="uk-button uk-button-primary uk-width-1-1 uk-margin-bottom" onclick="module.sendOTP();">Send OTP</button>
    <div style="height: 5em" class="uk-flex uk-flex-center uk-flex-right">
      <span class="uk-text-background-primary">@lang('auth.msg.alreadyhaveaccount')</span><a class="uk-link uk-text-background-primary" href="{{route('login')}}">&nbsp; @lang('auth.login')</a>
    </div>
  </form>

  <form id="p2" class="form-register uk-width-1-2@m uk-align-center uk-foreground-primary uk-border-rounded-10 uk-margin-large-top uk-margin-large-bottom uk-padding uk-padding-remove-bottom" style="display: none;">
    <h3 class="uk-text-center uk-text-background-primary uk-article-title uk-margin-small uk-margin-bottom">@lang('auth.register')</h3>

    <input class="uk-input uk-margin-bottom" type="text" id="verification"  placeholder="@lang('auth.verification_code')">
    <button type="button" class=" uk-button uk-button-primary uk-width-1-1 uk-margin-bottom uk-flex uk-flex-center" onclick="module.verifyOTP()">
      Verify code &nbsp;
      <div id="countdown-button" class="uk-inline uk-flex-middle" uk-countdown="">
            <span style="font-size:1em" class="uk-countdown-number uk-countdown-seconds"></span>
      </div>
      &nbsp; (@lang('general.time.second'))
    </button>
  </form>

  <form id="p3" class="form-register uk-width-1-2@m uk-align-center uk-foreground-primary uk-border-rounded-10 uk-margin-large-top uk-margin-large-bottom uk-padding uk-padding-remove-bottom" 
        action="" method="POST" style="display: none;">
    @csrf
    <div class="uk-margin-bottom">
      <h3 class="uk-text-center uk-text-background-primary uk-article-title uk-margin-small uk-margin-bottom">@lang('auth.register')</h3>
      <input name="phone" id="newphonenumber" type="hidden">
      <input class="uk-input uk-margin-bottom" type="text" name="name" placeholder="@lang('auth.msg.type_name')">
      <input class="uk-input uk-margin-bottom" name="password" type="password" placeholder="@lang('auth.msg.type_newpassword')">
      <input class="uk-input uk-margin-bottom" name="passwordconfirm" type="password" placeholder="@lang('auth.msg.type_newpasswordconfirm')">
      <button class="uk-button uk-button-primary uk-width-1-1" >@lang('auth.register')</button>
    </div>
    
  </form>
@endsection
@section('js')
<script type="text/javascript">
  var module = {};
</script>
<script type="module">
  import {sendOTP, verifyOTP, renderCaptcha} from '{{asset('js/phoneauth.js')}}';
  module.sendOTP = sendOTP;
  module.verifyOTP = verifyOTP;
  module.renderCaptcha = renderCaptcha;
</script>
<script>
  window.onload = function () {
    $('#sendotp-button').attr('disabled', 'true');
    module.renderCaptcha();
    showP1();
  };
  function showP1(){
    $('#p2').hide();
    $('#p3').hide();
    $('#p1').show();
  }
  function showP2(){
    $('#p1').hide();
    $('#p3').hide();
    $('#p2').show();
  }
  function showP3(){
    $('#p1').hide();
    $('#p2').hide();
    $('#p3').show();
  }

  $('#phone-number-check-button').on('click', function(){
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'get',
      url: '{{route("checkphone")}}',
      data: {
        'phone' : $('#phone-number').val(),
      },
      success:function(obj){ 
        result = JSON.parse(obj);
        $('#phone-number-check-result').html(result.result);
        if(result.status == 1){
          $('#sendotp-button').removeAttr('disabled');
          $('#newphonenumber').val($('#phone-number').val());
        } else {
          $('#sendotp-button').attr('disabled', 'true');
        }
      }
    });
  });
</script>
@endsection