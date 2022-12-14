@extends('user.layouts.app')
@section('css')
    <link rel="icon" type="image/x-icon" href="{{asset('logo/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('css/404.css')}}">
    <title>404</title>
@endsection
@section('content')
<div class="box-container">
    <span class="box"> </span>
    <span class="box"> </span>
    <span class="box"> </span>
    <span class="space"></span>
    <span class="box"> </span>
    <span class="space"></span>
    <span class="box"> </span>
    <span class="box"> </span>
    <span class="box"> </span>
    <span class="box"> </span>
    <span class="space"></span>
    <span class="box"> </span>
    <span class="box"></span>
    <span class="box"></span>
    <span class="space"></span>
    <span class="box"> </span>
    <span class="box"> </span>
    <span class="box"> </span>
    <span class="box"> </span>
    <span class="box"> </span>
    <span class="box"> </span>
</div>
<div class="click hover-click" onclick="window.location.href='/'">Quay lại trang chủ</div>
@endsection
@section('js')
<script src="{{asset('js/jquery-3.6.1.min.js') }}"></script>
<script src="{{asset('js/404.js')}}"></script>    
@endsection