@extends('admin.layouts.app')
@section('css')
	<style>
		:root{
			--foreground1: #697700;
			--foreground1-table: #2c5732;
			--foreground2: #8d7f00;
		}
		#form{
			padding: 0 12px 12px 12px;
			margin: 0 12px 0 0;
			background-color: white;
		}
		
		.form-header{
			height: calc(80px);
			color: white;
			transform: translateY(-24px);
			padding:12px;
			border-radius: 5px;
			display: flex;
			align-items: center;
		}
		
	</style>
@endsection
@section('content')
	{{-- <h4 class="uk-padding-remove uk-margin-large-bottom">@lang('admin.account.title',['type' => trans('admin.account.account')])</h4> --}}
		

	<div id="a" class="uk-flex uk-flex-row uk-flex-between ">
		<div id="form" class="uk-width-1-1 uk-border-rounded-10 uk-box-shadow-small">
			
			<div class="form-header uk-card-title uk-width-1-2" style="background-color: var(--foreground1)">
				@lang('admin.account.button.addnew', ['type' => trans('admin.account.account')])
			</div>
			<div class="uk-flex uk-flex-wrap-between">
				<button onclick="window.location.href='{{ route('admin.account') }}';" class="uk-margin-left uk-button uk-button-primary" style="background-color: var(--foreground1);" type="button"><span uk-icon="icon: arrow-left"></span>@lang('admin.account.title', ['type'=> trans('admin.account.account')])</button>
			</div>
			<div>
				<form id="create-banner" class="uk-form uk-flex uk-flex-wrap uk-padding-small" style="margin-top:16px;" action="{{ route('admin.account.store') }}" method="POST">
					@csrf
					<div class="uk-width-2-3 uk-padding uk-padding-remove-left uk-flex uk-flex-between uk-flex-column uk-padding-remove-vertical">
						<div>
							<div class="uk-margin-small">
								<label class="uk-form-label" for="form-horizontal-text">@lang('admin.account.button.name'):</label>
								<div class="uk-form-controls">
										<input class="uk-input" name="name" id="name" type="text" placeholder="@lang('admin.account.button.name')">
								</div>
							</div>
							<div class="uk-margin-small">
								<label class="uk-form-label" for="form-horizontal-text">@lang('admin.account.button.link'):</label>
								
								<div class="uk-form-controls uk-flex">
									<input class="uk-input" name="link" id="link" type="text" placeholder="@lang('admin.account.button.link')">
									<button type="button" id="link-button" class="uk-button uk-button-default" uk-icon="icon: arrow-right"
													onclick="window.open(document.getElementById('link').value, '_blank')">
									</button>
								</div>
							</div>
							<div class="uk-margin-small">
								<label class="uk-form-label" for="form-horizontal-text">@lang('admin.account.button.status'):</label>
								<div class="uk-form-controls">
									<x-buttons.switch id="status" type="secondary" switchtype=""></x-buttons.switch> &nbsp;
								</div>
							</div>
						</div>
						<div class="uk-width-1-1 uk-margin-large-top uk-flex">
							<button class="uk-button uk-button-primary uk-width-expand" type="submit">@lang('admin.account.button.add')</button>
						</div>
					</div>

				<div class="uk-width-1-3 uk-flex uk-flex-between uk-flex-column uk-padding uk-padding-remove-horizontal uk-padding-remove-top">
					<div class="uk-border-rounded-10 uk-box-shadow-small">
						<img id="imgpreview" class="uk-width-expand uk-border-rounded-10 " src="{{ asset('storage/images/no-image.png') }}" alt="">
					</div>

					<div class="uk-margin-small">
						<label class="uk-form-label" for="uploaded-image-url">@lang('admin.account.button.imageurl'):</label>
						<div class="uk-form-controls">
								<div class="uk-flex">
											<input class="uk-input" name="imageurl" id="uploaded-image-url" type="text" oninput="changeImage(this)" placeholder="@lang('admin.account.button.imageurl')">
											<x-admin.uploadimage.button></x-admin.uploadimage.button>	
												{{-- <input class="uk-input uk-form-width-medium" type="text" placeholder="Select file" aria-label="Custom controls" disabled> --}}
								</div>
								
							</div>
					</div>
				</div>
					
					
					

				</form>
				<div class="uk-flex uk-flex-center uk-flex-column">
					
					<x-admin.uploadimage.form></x-admin.uploadimage.form>	
					
				</div>

			</div>
		</div>

	</div>
@endsection
@section('js')
	<script>
		document.getElementById('link-button').addEventListener('click', (e) => {
			
		});
		Array.from(document.querySelectorAll('.row[data-bannerid]')).map((domElement) => {
			
			domElement.addEventListener('click',(e) => {
				const obj = e.currentTarget.children;
				//set form action route
				document.getElementById('create-banner').setAttribute('action', '{{ URL::to("/admin/banner") }}/'+obj[0].innerText)

				//preview
				document.getElementById('name').value = obj[1].innerText;
				if(obj[2].innerText.toUpperCase() === 'ACTIVE'){
					document.getElementById('status').setAttribute('checked', 'checked');
				} else{
					document.getElementById('status').removeAttribute('checked');
				}
				document.getElementById('link').value = obj[3].innerText;
				

				document.getElementById('uploaded-image-url').value = obj[4].innerText;
				changeImage(document.getElementById('uploaded-image-url'));
				
			});
		
		});
			
		const changeImage = (e) => {
			const url = e.value;
			console.log("object");
			document.getElementById('imgpreview').setAttribute('src',url);
		}
		// document.getElementById('imageurl').addEventListener('input', (e) => {
		// });
		
		
	</script>
@endsection