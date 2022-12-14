
@extends('admin.layouts.app')
@section('css')
<style>
	tr {cursor: pointer;}
</style>
@endsection
@section('content')
	<div class="uk-width-4-5@m uk-padding">
		<article class="uk-article" uk-scrollspy="target: > *; cls: uk-animation-fade; delay: 300">

			<h1 class="uk-article-title">Xin chào, {{Auth::guard('admin')->user()->name}}</h1>

			<p class="uk-article-meta">Danh sách các chức năng</p>
			<table class="uk-table uk-table-hover uk-table-divider">
				<thead>
					<tr>
						{{-- <th class="uk-width-1-3"></th> --}}
						<th class=""></th>
						{{-- <th class="uk-width-2-3"></th> --}}
					</tr>
				</thead>
				<tbody>
					<tr onclick="window.location.href='{{route('admin.category')}}'">
						<td class="uk-text-bold">QL Danh mục</td>
						{{-- <td><img src="{{asset('logo/ProductManager.jpg')}}" class="uk-width-1-1" style="max-height: 3rem; object-fit:cover;"></td> --}}
					</tr>
					<tr onclick="window.location.href='{{route('admin.product')}}'">
						<td class="uk-text-bold">QL Sản phẩm</td>
						{{-- <td><img src="{{asset('logo/ProductManager.jpg')}}" class="uk-width-1-1" style="max-height: 3rem; object-fit:cover;"></td> --}}
					</tr>
					<tr onclick="window.location.href='{{route('admin.saleoff')}}'">
						<td class="uk-text-bold">QL Chương trình khuyến mãi</td>
						{{-- <td><img src="{{asset('logo/sale-off.jpg')}}" class="uk-width-1-1" style="max-height: 3rem; object-fit:cover;"></td> --}}
					</tr>
					<tr onclick="window.location.href='{{route('admin.order')}}'">
						<td class="uk-text-bold">QL Hóa đơn</td>
						{{-- <td><img src="{{asset('logo/billing.png')}}" class="uk-width-1-1" style="max-height: 3rem; object-fit:cover;"></td> --}}
					</tr>
					@if(Auth::guard('admin')->user()->id === 1)
					<tr onclick="window.location.href='{{route('admin.hr')}}'">
						<td class="uk-text-bold">QL Nhân sự</td>
						{{-- <td><img src="{{asset('logo/hr.webp')}}" class="uk-width-1-1" style="max-height: 3rem; object-fit:cover;"></td> --}}
					</tr>
					
					<tr onclick="window.location.href='{{route('admin.customer')}}'">
						<td class="uk-text-bold">QL Tài khoản khách hàng</td>
						{{-- <td><img src="{{asset('logo/customer.jpg')}}" class="uk-width-1-1" style="max-height: 3rem; object-fit:cover;"></td> --}}
					</tr>
					@endif
				</tbody>
			</table>
		</article>
	</div>
	
	
@endsection
