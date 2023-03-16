@extends('admin.layouts.app')
@section('css')
	<style>
		:root{
			--foreground1: #240077;
			--foreground1-table: #392c57;
			--foreground2: #8d7f00;
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
		.row:hover:not(.header){
			background-color: rgb(156, 255, 179) !important;
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
	{{-- <h4 class="uk-padding-remove uk-margin-large-bottom">@lang('admin.image.title',['type' => trans('admin.banner.banner')])</h4> --}}
		

	<div id="a" class="uk-flex uk-flex-row uk-flex-between ">
		<div id="list" class="uk-width-3-4 uk-border-rounded-10 uk-box-shadow-small">
			
			<div class="table-header uk-width-1-2" style="background-color: var(--foreground1)">
				@lang('admin.image.imagelist', ['type' => trans('admin.image.image')])
			</div>
			<div class="uk-flex uk-flex-wrap-between">
				<div class="uk-inline uk-width-expand">
					<a class="uk-form-icon" href="#" uk-icon="icon: search"></a>
					<input class="uk-input" type="text" aria-label="Clickable icon" placeholder="@lang('admin.image.button.search')">
				</div>
				<a  class="uk-margin-left uk-button uk-button-primary" style="background-color: var(--foreground1);" href="#uploadimage" uk-toggle>@lang('admin.image.button.addnew', ['type'=> trans('admin.image.image')])</a>
			</div>
			<x-admin.uploadimage.form optional="window.location.reload()"></x-admin.uploadimage.form>	

			<div class="">
				<div class="wrapper">
		
					<div class="table">
						
						<div class="row header">
							<div class="cell">
								@lang('admin.image.button.id')
							</div>
							<div class="cell">
								@lang('admin.image.button.uid')
							</div>
							<div class="cell">
								@lang('admin.image.button.path')
							</div>
							<div class="cell">
								@lang('admin.image.button.created_at')
							</div>
						</div>
						@foreach ($collection as $row)
						<div class="row" data-bannerid="{{ $row->id }}">
							<div class="cell">
								{{ $row->id }}
							</div>
							<div class="cell">
								{{ $row->uid }}
							</div>
							<div class="cell">
								{{ $row->path }}
							</div>
							<div class="cell">
								{{ $row->created_at }}
							</div>

							<div class="cell" style="display:none">{{ $row->url }}</div>

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
				@lang('admin.image.tabletitle.preview')
			</div> --}}
			<div class="uk-flex uk-flex-center uk-flex-column">
				
				
				<div class="uk-border-rounded-10 uk-width-expand uk-box-shadow-small"  uk-lightbox="animation: scale">
					<a id="imgpreviewlightbox" href="{{ asset('storage/images/no-image.png') }}">
						<img id="imgpreview" src="{{ asset('storage/images/no-image.png') }}" class="uk-width-expand uk-border-rounded-10 ">
					</a>
				</div>
				<form id="edit-banner" class="uk-form-vertical uk-padding-small uk-border-rounded-10 uk-width-expand imgprvdesk uk-box-shadow-small" style="margin-top:16px;" action="" method="POST">
					<div class="uk-margin-small">
						<label class="uk-form-label" for="uploaded-image-url">@lang('admin.image.button.imageurl'):</label>
						<div class="uk-form-controls">
								<div class="uk-flex">
											<input class="uk-input" name="imageurl" id="uploaded-image-url" type="text" oninput="changeImage(this)" placeholder="@lang('admin.image.button.imageurl')">
											<button type="button" class="uk-button uk-button-default" onclick="copyChipboard()"><span uk-icon="icon: copy;"></span></button>
								</div>
								
							</div>
					</div>
					
					<div class="uk-margin-small">
						<label class="uk-form-label" for="form-horizontal-text">@lang('admin.image.button.path'):</label>
						<div class="uk-form-controls">
								<input class="uk-input" name="path" id="path" type="text" placeholder="@lang('admin.image.button.path')">
						</div>
					</div>
					<div class="uk-width-1-1 uk-margin-large-top uk-flex uk-flex-right">
						<button disabled id="delete-button" class="uk-button uk-button-danger uk-width-1-3" type="submit" form="delete-form">@lang('admin.image.button.delete')</button>
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
		Array.from(document.querySelectorAll('.row[data-bannerid]')).map((domElement) => {
			
			domElement.addEventListener('click',(e) => {
				const obj = e.currentTarget.children;
				//set form action route
				document.getElementById('delete-form').setAttribute('action', '{{ URL::to("/admin/image") }}/'+obj[0].innerText)

				//preview
				document.getElementById('path').value = obj[2].innerText;
				
				document.getElementById('uploaded-image-url').value = obj[4].innerText;
				changeImage(document.getElementById('uploaded-image-url'));
				
				document.getElementById('delete-button').removeAttribute('disabled');
			});
		
		});

		function copyChipboard() {
			// Get the text field
			var copyText = document.getElementById("uploaded-image-url");

			// Select the text field
			copyText.select();
			copyText.setSelectionRange(0, 99999); // For mobile devices

			// Copy the text inside the text field
			navigator.clipboard.writeText(copyText.value);

			// Alert the copied text
			UIkit.notification("@lang('admin.image.message.copied')");
		}
			
		const changeImage = (e) => {
			const url = e.value;
			document.getElementById('imgpreview').setAttribute('src',url);
			document.getElementById('imgpreviewlightbox').setAttribute('href',url);

		}
		
	</script>
@endsection