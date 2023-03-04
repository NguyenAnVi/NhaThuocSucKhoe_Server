@extends('admin.layouts.app')

@section('content')
<h4 class="uk-text-bold uk-text-center">{{$title}}</h4>
	@include('admin.partials.index-title')
	@include('admin.partials.index-body')
@endsection