@extends('user.layouts.app')
@section('css')
<style>
.login {
  overflow: hidden;
  background-color: var(--foregroundprimary);
  padding: 40px 30px 30px 30px;
  border-radius: 10px;
  position: absolute;
  top: 50%;
  left: 50%;
  width: 400px;
  -webkit-transform: translate(-50%, -50%);
  -moz-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  -o-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  -webkit-transition: -webkit-transform 300ms, box-shadow 300ms;
  -moz-transition: -moz-transform 300ms, box-shadow 300ms;
  transition: transform 300ms, box-shadow 300ms;
  box-shadow: 0px 5px 10px rgba(169, 169, 169, 0.367);
}
.login::before, .login::after {
  content: "";
  position: absolute;
  width: 600px;
  height: 600px;
  border-top-left-radius: 40%;
  border-top-right-radius: 45%;
  border-bottom-left-radius: 35%;
  border-bottom-right-radius: 40%;
  z-index: -1;
}
.login::before {
  left: 40%;
  bottom: -130%;
  background-color: rgb(255, 166, 175);
  -webkit-animation: wawes 6s infinite linear;
  -moz-animation: wawes 6s infinite linear;
  animation: wawes 6s infinite linear;
}
.login::after {
  left: 35%;
  bottom: -125%;
  background-color: rgba(255, 133, 155, 0.428);
  -webkit-animation: wawes 7s infinite;
  -moz-animation: wawes 7s infinite;
  animation: wawes 7s infinite;
}
.login > input {
  display: block;
  border-radius: 5px;
  font-size: 16px;
  background: white ;
  width: 100%;
  border: 0;
  padding: 10px 10px;
  margin: 15px -10px;
}
.login>button{
  background-color: white;
  color: #000;
}
.login>p{
  color: white;
}
.login>p>a{
  padding: 3px;
  background-color: white;
  border-radius: 5px;
  color:var(--foregroundprimary);
}
@-webkit-keyframes wawes {
  from {
    -webkit-transform: rotate(0);
  }
  to {
    -webkit-transform: rotate(360deg);
  }
}
@-moz-keyframes wawes {
  from {
    -moz-transform: rotate(0);
  }
  to {
    -moz-transform: rotate(360deg);
  }
}
@keyframes wawes {
  from {
    -webkit-transform: rotate(0);
    -moz-transform: rotate(0);
    -ms-transform: rotate(0);
    -o-transform: rotate(0);
    transform: rotate(0);
  }
  to {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>
@endsection
@section('content')
<form class="login" action="" method="POST">
  @csrf
  <input name="phone" type="text" placeholder="@lang('auth.msg.type_phone')">
  <input name="password" type="password" placeholder="@lang('auth.msg.type_password')">
  <button class="uk-button uk-button-primary uk-width-1-1" >@lang('auth.login')</button>
  <p class="uk-text-right">@lang('auth.msg.donthaveaccount') <a href="{{route('register')}}">@lang('auth.register')</a></p>
</form>


@endsection
