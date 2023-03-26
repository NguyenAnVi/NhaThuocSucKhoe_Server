@extends('admin.layouts.app')
@section('css')
	<style>
		:root{
			--foreground1: #007710;
			--foreground1-table: #2c5732;
			--foreground2: #8d7f00;
			--foreground2-table: #3c3600;

		}
		#list{
			/* width: 55vw; */
			padding: 0 12px 12px 12px;
			margin: 0 12px 0 0;
			background-color: white;
		}
		#preview{
			/* width: 30vw; */
			/* padding: 12px 12px 12px 12px; */
			background-color: white;
		}
		.table-header{
			height: calc(80px);
			color: white;
			transform: translateY(-24px);
			padding:12px;
			border-radius: 5px;
			display: flex;
			align-items: center;
		}
		.wrapper {
			margin: 16px 0 0 0;
			/* padding: 40px; */
			max-width: 100%;
			box-sizing: border-box;
			display: flex;
		}
		.table {
			margin: 0 0 40px 0;
			width: 100%;
			box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
			display: table;
		}
		.row {
			display: table-row;
			background: #f6f6f6;
			cursor: pointer;
		}
		.row:nth-of-type(odd) {
			background: #e9e9e9;
		}
		.row.header {
			font-weight: 900;
			color: #ffffff;
			background: var(--foreground1-table);
		}
		.row.search.header {
			font-weight: 900;
			color: #ffffff;
			background: var(--foreground2-table);
		}
		.row:hover:not(.header){
			background-color: rgb(156, 255, 179);
		}
		.row.on-search:hover:not(.header){
			background-color: rgb(255, 252, 156) !important;
		}
		#search{
			width: 750px;
		}
		#search-results{
			min-width: 750px;
		}
		@media screen and (max-width: 570px) {
			.table {
				display: block;
			}
			.row {
				padding: 14px 0 7px;
				display: block;
			}
			.row.header {
				padding: 0;
				height: 6px;
			}
			.row.header .cell {
				display: none;
			}
			.row .cell {
				margin-bottom: 10px;
			}
			.row .cell:before {
				margin-bottom: 3px;
				content: attr(data-title);
				min-width: 48px;
				font-size: 10px;
				line-height: 10px;
				font-weight: bold;
				text-transform: uppercase;
				color: #969696;
				display: block;
			}
		}

		.cell {
			padding: 6px 12px;
			display: table-cell;
			white-space: nowrap; 
			text-overflow:ellipsis; 
			overflow: hidden;
		}
		/* .cell:last-child{
			max-width: 100px;
		} */
		.cell:nth-child(2){
			max-width: calc(500px - 25px - 100px);
		}
		@media screen and (max-width: 570px) {
			.cell {
				padding: 2px 16px;
				display: block;
			}
		}
	</style>
@endsection
@section('content')
	{{-- <h4 class="uk-padding-remove uk-margin-large-bottom">@lang('admin.banner.title',['type' => trans('admin.banner.banner')])</h4> --}}
		

	<div id="a" class="uk-flex uk-flex-row uk-flex-between ">
		<div id="list" class="uk-width-3-4 uk-border-rounded-10 uk-box-shadow-small">
			
			<div class="table-header uk-card-title uk-width-1-2" style="background-color: var(--foreground1)">
				@lang('admin.banner.bannerlist', ['type' => trans('admin.banner.banner')])
			</div>
			<div class="uk-flex uk-flex-between">
				<div class="search-field">
					<div class="uk-inline">
						<a class="uk-form-icon" uk-icon="icon: search"></a>
						<input id="search" class="uk-input" autocomplete="off" type="text" placeholder="@lang('admin.banner.button.search')">
					</div>
					<div id="search-results" class="uk-position-bottom-center-out uk-background-default uk-box-shadow-small uk-margin-remove uk-border-rounded-10" style="display: none"></div>
				</div>
				<button onclick="window.location.href='{{ route('admin.banner.create') }}'" class="uk-margin-left uk-button uk-button-primary" style="background-color: var(--foreground1);" type="button">@lang('admin.banner.button.addnew', ['type'=> trans('admin.banner.banner')])</button>
			</div>
			{{-- <div class="uk-flex uk-flex-wrap-between">
				<div class="uk-inline uk-width-expand">
					<a class="uk-form-icon" href="#" uk-icon="icon: search"></a>
					<input class="uk-input" type="text" aria-label="Clickable icon" placeholder="@lang('admin.banner.button.search')">
				</div>
				<button onclick="window.location.href='{{ route('admin.banner.create') }}'" class="uk-margin-left uk-button uk-button-primary" style="background-color: var(--foreground1);" type="button">@lang('admin.banner.button.addnew', ['type'=> trans('admin.banner.banner')])</button>
			</div> --}}
			<div class="">
				<div class="wrapper">
		
					<div class="table">
						
						<div class="row header">
							<div class="cell">
								@lang('admin.banner.button.id')
							</div>
							<div class="cell">
								@lang('admin.banner.button.name')
							</div>
							<div class="cell">
								@lang('admin.banner.button.status')
							</div>
						</div>
						@foreach ($collection as $row)
						<div class="row" data-id="{{ $row->id }}" data-name="{{ $row->name }}" data-status="{{ $row->status }}" data-link="{{ $row->link }}" data-imageurl="{{ $row->imageurl }}">
							<div class="cell">
								{{ $row->id }}
							</div>
							<div class="cell">
								{{ $row->name }}
							</div>
							<div class="cell">
								{{ $row->status }}
							</div>
							<div class="row" style="display:none">{{ $row->link }}</div>
							<div class="row" style="display:none">{{ $row->imageurl }}</div>

						</div>	
						@endforeach
						
					</div>
					
				</div>
				<div>
					{{$collection -> links()}}
				</div>
			</div>
		</div>
		<div id="preview" class="uk-width-1-4 uk-border-rounded-10">
			{{-- <div class="table-header uk-width-expand" style="background-color: var(--foreground2)">
				@lang('admin.banner.tabletitle.preview')
			</div> --}}
			<div class="uk-flex uk-flex-center uk-flex-column">


				<div class="uk-border-rounded-10 uk-width-expand uk-box-shadow-small"  uk-lightbox="animation: scale">
					<a id="imgpreviewlightbox" href="{{ asset('storage/images/no-image.png') }}">
						<img id="imgpreview" class="uk-width-expand uk-border-rounded-10 ">
					</a>
				</div>
				
				<x-admin.uploadimage.form></x-admin.uploadimage.form>	

				<form id="edit-banner" class="uk-form-vertical uk-padding-small uk-border-rounded-10 uk-width-expand uk-box-shadow-small" style="margin-top:16px;" action="" method="POST">
					@csrf
					@method('put')
					<div class="uk-margin-small">
						<label class="uk-form-label" for="uploaded-image-url">@lang('admin.banner.button.imageurl'):</label>
						<div class="uk-form-controls">
								<div class="uk-flex">
											<input class="uk-input" name="imageurl" id="imageurl" type="text" oninput="changeImage(this)" placeholder="@lang('admin.banner.button.imageurl')">
											<x-admin.uploadimage.button></x-admin.uploadimage.button>	
												{{-- <input class="uk-input uk-form-width-medium" type="text" placeholder="Select file" aria-label="Custom controls" disabled> --}}
								</div>
								
							</div>
					</div>
					
					<div class="uk-margin-small">
						<label class="uk-form-label" for="form-horizontal-text">@lang('admin.banner.button.name'):</label>
						<div class="uk-form-controls">
								<input class="uk-input" name="name" id="name" type="text" placeholder="@lang('admin.banner.button.name')">
						</div>
					</div>
					<div class="uk-margin-small">
						<label class="uk-form-label" for="form-horizontal-text">@lang('admin.banner.button.link'):</label>
						
							
						
						<div class="uk-form-controls uk-flex">
							<input class="uk-input" name="link" id="link" type="text" placeholder="@lang('admin.banner.button.link')">
							<button type="button" id="link-button" class="uk-button uk-button-default" uk-icon="icon: arrow-right"
											onclick="window.open(document.getElementById('link').value, '_blank')">
							</button>
						</div>
					</div>
					<div class="uk-margin-small">
						<label class="uk-form-label" for="form-horizontal-text">@lang('admin.banner.button.status'):</label>
						<div class="uk-form-controls">
							<x-buttons.switch id="status" type="secondary" switchtype=""></x-buttons.switch>
						</div>
					</div>
					<div class="uk-width-1-1 uk-margin-large-top uk-flex uk-flex-right">
						<button disabled id="delete-button" class="uk-button uk-button-danger uk-width-1-3" type="submit" form="delete-form">@lang('admin.banner.button.delete')</button>
						<button disabled id="edit-button" class="uk-button uk-button-primary uk-width-expand" type="submit">@lang('admin.banner.button.apply')</button>
					</div>

				</form>
				<form id="delete-form" action="" method="POST">
					@csrf
					@method('delete')
				</form>
			</div>
		</div>
	</div>
@endsection
@section('js')
	<script>
		function removeAccents(str) {
			var AccentsMap = [
				"aàảãáạăằẳẵắặâầẩẫấậ",
				"AÀẢÃÁẠĂẰẲẴẮẶÂẦẨẪẤẬ",
				"dđ", "DĐ",
				"eèẻẽéẹêềểễếệ",
				"EÈẺẼÉẸÊỀỂỄẾỆ",
				"iìỉĩíị",
				"IÌỈĨÍỊ",
				"oòỏõóọôồổỗốộơờởỡớợ",
				"OÒỎÕÓỌÔỒỔỖỐỘƠỜỞỠỚỢ",
				"uùủũúụưừửữứự",
				"UÙỦŨÚỤƯỪỬỮỨỰ",
				"yỳỷỹýỵ",
				"YỲỶỸÝỴ"    
			];
			for (var i=0; i<AccentsMap.length; i++) {
				var re = new RegExp('[' + AccentsMap[i].substr(1) + ']', 'g');
				var char = AccentsMap[i][0];
				str = str.replace(re, char);
			}
			return str;
		}
		function highlight(str1, str2){
			let pos = removeAccents(str1.toUpperCase()).indexOf(str2.toUpperCase());
			let qty = str2.length;
			console.log(str1,':',str2);
			console.log(pos,':',qty);
			let result = str1.split('');
			if(pos>=0)
				for (let i = 0; i < result.length; i++) {
					if(i>=pos && i<=pos+qty-1) result[i] = '<span class="uk-text-warning">'+result[i]+'</span>';
					else result[i] = '<span>'+result[i]+'</span>';
				}
			return result.join("");
		}

		function parseList(a, s){
			let output="";
			output+='<div class="wrapper">';
			output+='<div class="table">';
			output+='<div class="row search header">';
			output+='<div class="cell">@lang('admin.banner.button.name')</div>';
			output+='<div class="cell">@lang('admin.banner.button.status')</div>';
			output+='</div>	';

			a.list.forEach(item => {
				output+='<div class="row on-search" data-id="'+item.id+'" data-name="'+item.name+'"  data-link="'+item.link+'"  data-imageurl="'+item.imageurl+'"  data-status="'+item.status+'">';
				output+='<div class="cell">'+highlight(item.name, s)+'</div>';
				output+='<div class="cell">'+highlight(item.status, s)+'</div>';
				output+='</div>	';
			});
			
			output+='</div>';
			output+='</div>';
			return  output;
		}

		function addClickPreview(){
			$('.row').on('click', function() {

				//set form action route
				document.getElementById('edit-banner').setAttribute('action', '{{ URL::to("/admin/banner") }}/'+$(this).data('id'));
				document.getElementById('delete-form').setAttribute('action', '{{ URL::to("/admin/banner") }}/'+$(this).data('id'));
				
				document.getElementById('name').value = $(this).data('name');
				document.getElementById('link').value = $(this).data('link');
				document.getElementById('imageurl').value = $(this).data('imageurl');
				changeImage(document.getElementById('imageurl'));

				
				if($(this).data('status').toUpperCase() === 'ACTIVE')
					document.getElementById('status').setAttribute('checked', 'checked');
				else
					document.getElementById('status').removeAttribute('checked');

				document.getElementById('delete-button').removeAttribute('disabled');
				document.getElementById('edit-button').removeAttribute('disabled');

			});
		}
			
		const changeImage = (e) => {
			const url = e.value;
			console.log("object");
			document.getElementById('imgpreview').setAttribute('src',url);
			document.getElementById('imgpreviewlightbox').setAttribute('href',url);

		}

		$(document).ready(()=>{
			addClickPreview();

			Array.from(document.querySelectorAll('[id*=i-]')).map((domElement) => {
				domElement.addEventListener('change',(e) => {
					dataindex = (e.target.dataset.index);
					UIkit.switcher('.uk-switcher').show(dataindex-0);
					// document.querySelector('div[data-index='+dataindex+']').
				});
			});

			$('#search').on('input', (e)=>{
				let key = removeAccents(e.currentTarget.value);
				if(key){
					let route = "{{ URL::to('/admin/banner/search') }}/"+key;
				
					$.ajax({
						headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
						type: 'get',
						url: route,
						success:function(obj){ 
							result = JSON.parse(obj);
							if (result.error) UIkit.notification(result.error);
							$('#search-results').html(parseList(result, key));
							addClickPreview();
							$('#search-results').show();
						}
					});
				} else $('#search-results').hide();

			});

			$(document).click(function(event) {
				//Hide the #search-results if visible
				var $target = $(event.target);
				if(!$target.closest('#search-results').length && 
				$('#search-results').is(":visible")) {
					$('#search-results').hide();
				}        
			});

			$('#search-results').on('click' ,function(){
				event.stopPropagation();
			});
			
		});
		
	</script>
@endsection