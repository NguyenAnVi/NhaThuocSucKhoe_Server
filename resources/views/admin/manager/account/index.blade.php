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
	{{-- <h4 class="uk-padding-remove uk-margin-large-bottom">@lang('admin.account.title',['type' => trans('admin.banner.banner')])</h4> --}}
		

	<div id="a" class="uk-flex uk-flex-row uk-flex-between ">
		<div id="list" class="uk-width-expand uk-border-rounded-10 uk-box-shadow-small">
			
			<div class="table-header uk-card-title uk-width-1-2" style="background-color: var(--foreground1)">
				@lang('admin.account.title')
			</div>
			<div class="uk-flex uk-flex-wrap-between">
				<div class="uk-inline uk-width-expand">
					<a class="uk-form-icon" href="#" uk-icon="icon: search"></a>
					<input class="uk-input" type="text" aria-label="Clickable icon" placeholder="@lang('admin.account.button.search')">
				</div>
				<a  class="uk-margin-left uk-button uk-button-primary" style="background-color: var(--foreground1);" href="{{ route('admin.account.create') }}" uk-toggle>@lang('admin.account.button.addnew')</a>
			</div>

			<div class="">
				<div class="wrapper">
		
					<div class="table">
						
						<div class="row header">
							<div class="cell">
								@lang('admin.account.button.id')
							</div>
							<div class="cell">
								@lang('admin.account.button.name')
							</div>
							<div class="cell">
								@lang('admin.account.button.phone')
							</div>
							<div class="cell">
								@lang('admin.account.button.role')
							</div>
						</div>
						@foreach ($collection as $row)
						<div class="row" data-bannerid="{{ $row->id }}">
							<div class="cell">
								{{ $row->id }}
							</div>
							<div class="cell">
								{{ $row->name }}
							</div>
							<div class="cell">
								{{ $row->phone }}
							</div>
							<div class="cell">
								{{ $row->role }}
							</div>

						</div>	
						@endforeach
						
					</div>
					
				</div>
				<div>
					{{$collection -> links()}}
				</div>
			</div>
		</div>
		<div id="preview" class="uk-width-1-4 uk-border-rounded-10" style="display:none">
			<div class="uk-flex uk-flex-center uk-flex-column">
				<form id="edit-banner" class="uk-form-vertical uk-padding-small uk-border-rounded-10 uk-width-expand uk-box-shadow-small" action="" method="POST">
					<div class="uk-border-rounded-10 uk-width-expand uk-flex uk-flex-center"  uk-lightbox="animation: scale">
						<a id="imgpreviewlightbox" href="{{ asset('storage/images/no-image.png') }}">
							<img style="width:150px; height:150px; border-radius:75px;" id="imgpreview" src="{{ asset('storage/images/no-avatar.png') }}" class="uk-width-expand uk-border-rounded-10 uk-box-shadow-small">
						</a>
					</div>
					{{-- <div class="uk-margin-small">
						<label class="uk-form-label" for="uploaded-image-url">@lang('admin.account.button.imageurl'):</label>
						<div class="uk-form-controls">
								<div class="uk-flex">
											<input class="uk-input" name="imageurl" id="uploaded-image-url" type="text" oninput="changeImage(this)" placeholder="@lang('admin.account.button.imageurl')">
											<button type="button" class="uk-button uk-button-default" onclick="copyChipboard()"><span uk-icon="icon: copy;"></span></button>
								</div>
								
							</div>
					</div> --}}
					<script>
						var name="";
					</script>
					<input name="id" id="id" type="hidden">
					
					<div class="uk-margin-small">
						<label class="uk-form-label" for="form-horizontal-text">@lang('admin.account.button.name'):</label>
						<div class="uk-form-controls">
								<input class="uk-input" name="name" id="name" type="text" placeholder="@lang('admin.account.button.name')">
						</div> 
					</div>
					<div class="uk-margin-small">
						<label class="uk-form-label" for="form-horizontal-text">@lang('admin.account.button.phone'):</label>
						<div class="uk-form-controls">
								<input class="uk-input" name="phone" id="phone" type="text" placeholder="@lang('admin.account.button.phone')">
						</div>
					</div>
					<div class="uk-margin-small">
						<label class="uk-form-label" for="form-horizontal-text">@lang('admin.account.button.role'):</label>
						<div class="uk-form-controls">
								<input class="uk-input" name="role" id="role" type="text" placeholder="@lang('admin.account.button.role')">
						</div>
					</div>
					<div class="uk-width-1-1 uk-margin-large-top uk-flex uk-flex-wrap">
						<a href="#grant-access-modal" disabled id="button-grant-access" onclick="document.getElementById('gaf-id').value = document.getElementById('id').value"  class="uk-button uk-button-primary" type="button" uk-toggle>@lang('admin.account.button.grantaccess')</a>
						<button disabled id="delete-button" class="uk-button uk-button-danger" type="submit" form="delete-form">@lang('admin.account.button.delete')</button>
					</div>

				</form>
				<form id="delete-form" action="" method="POST">@csrf @method('delete')</form>
				<style>
					.role-item{
						width: 100%;
						height: 1.5em;
						padding: 0 5px;
						margin: 5px 0;
						border-radius: 5px;
						box-sizing: border-box;
					}
					.role-item:hover{
						background-color: #a2a2a2;
					}
					.role-item[class*="uk-active"]{	
						background-color: var(--foreground1);
						color: white;
					}
					
				</style>
				<div id="grant-access-modal" uk-modal>
					<div class="uk-modal-dialog">
						<div class="uk-modal-header">
							<button class="uk-modal-close-default" type="button" uk-close></button>
							<h4>@lang('admin.account.button.selectrole')</h4>
						</div>
						<form id="grant-access-form" action="{{ route('admin.account.grantaccess') }}" method="POST">
							@csrf
							<div class="uk-modal-body">
								<div class="uk-margin-small">
									<div class="uk-flex">
										<div class="uk-width-1-2 uk-flex uk-flex-column uk-child-width-expand">
											<input type="hidden" name="id" id="gaf-id">
											@php
												$i=0;
											@endphp
											@foreach ($available_roles as $item)
											<div class="role-item uk-flex">
												<input data-index="{{ $i++ }}" id="i-{{ strtolower($item) }}" value="{{ $item }}" type="radio" name="permission">
												<label class="uk-width-expand" for="i-{{ strtolower($item) }}">{{ $item }}</label>
											</div>
														
											@endforeach
										</div>
										<hr class="uk-divider-vertical">
										<div class="uk-width-1-2 uk-switcher" id="abc">
											@php
												$i=0;
											@endphp
											@foreach ($available_roles as $item)
											<div data-index="{{ $i++ }}"  id="roledescription" class="uk-padding-small">@lang('enum.'.strtolower($item))</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>
							<div class="uk-modal-footer uk-flex uk-flex-right">
								<button type="submit" class="uk-button uk-button-primary">@lang('admin.button.apply')</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('js')
	<script>
		// var grantAccessRoute = {{ route('admin.account.grantaccess') }};
		Array.from(document.querySelectorAll('.row[data-bannerid]')).map((domElement) => {
			
			domElement.addEventListener('click',(e) => {
				const obj = e.currentTarget.children;
				//set form action route
				document.getElementById('delete-form').setAttribute('action', '{{ URL::to("/admin/account") }}/'+obj[0].innerText);
				//preview
				document.getElementById('id').value = obj[0].innerText;
				document.getElementById('name').value = obj[1].innerText;
				document.getElementById('phone').value = obj[2].innerText;
				document.getElementById('role').value = obj[3].innerText;
				// document.getElementById('uploaded-image-url').value = obj[4].innerText;
				// changeImage(document.getElementById('uploaded-image-url'));
				document.getElementById('button-grant-access').removeAttribute('disabled');
				document.getElementById('delete-button').removeAttribute('disabled');
				document.getElementById('preview').removeAttribute('style');
			});
		});

		Array.from(document.querySelectorAll('[id*=i-]')).map((domElement) => {
			domElement.addEventListener('change',(e) => {
				dataindex = (e.target.dataset.index);
				UIkit.switcher('.uk-switcher').show(dataindex-0);
				// document.querySelector('div[data-index='+dataindex+']').
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
			UIkit.notification("@lang('admin.account.message.copied')");
		}
			
		const changeImage = (e) => {
			const url = e.value;
			document.getElementById('imgpreview').setAttribute('src',url);
			document.getElementById('imgpreviewlightbox').setAttribute('href',url);
		}

		// document.getElementById('button-grant-access').addEventListener('click', (e)=>{
		// 	document.getElementById('')
		// });
		
	</script>
@endsection