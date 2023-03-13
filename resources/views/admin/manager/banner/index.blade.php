@extends('admin.layouts.app')
@section('css')
<style>
:root{
	--foreground1: #007710;
	--foreground1-table: #2c5732;
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
	padding: 12px 12px 12px 12px;
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
@media screen and (max-width: 570px) {
  .table {
    display: block;
  }
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
	/* max-width: 25px; */
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
		
		<div class="table-header uk-width-1-2" style="background-color: var(--foreground1)">
			@lang('admin.banner.bannerlist', ['type' => trans('admin.banner.banner')])
		</div>
		<div class="uk-flex uk-flex-wrap-between">
			<div class="uk-inline uk-width-expand">
				<a class="uk-form-icon" href="#" uk-icon="icon: search"></a>
				<input class="uk-input" type="text" aria-label="Clickable icon" placeholder="@lang('admin.banner.button.search')">
			</div>
			<button class="uk-margin-left uk-button uk-button-primary" style="background-color: var(--foreground1);" type="button">@lang('admin.banner.button.addnew', ['type'=> trans('admin.banner.banner')])</button>
		</div>
		<div>

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
					<div class="row" data-bannerid="{{ $row->id }}">
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
				
		</div>
	</div>
	<div id="preview" class="uk-width-1-4 uk-border-rounded-10 uk-box-shadow-small">
		{{-- <div class="table-header uk-width-expand" style="background-color: var(--foreground2)">
			@lang('admin.banner.tabletitle.preview')
		</div> --}}
		<div class="uk-flex uk-flex-center uk-flex-column">
			<div class="uk-border-rounded-10 uk-width-expand imgprvdesk uk-box-shadow-small">
				<img id="imgpreview" class="uk-width-expand uk-border-rounded-10 " src="https://i0.wp.com/traveler.gg/wp-content/uploads/Untitled-7-2.jpg?fit=1920%2C1080&ssl=1" alt="">
			</div>
			<x-admin.uploadimage.form></x-admin.uploadimage.form>	
			<form id="edit-banner" class="uk-form-vertical uk-padding-small uk-border-rounded-10 uk-width-expand imgprvdesk uk-box-shadow-small" style="margin-top:16px;" action="" method="POST">
				@csrf
				@method('put')
				<div class="uk-margin-small">
					<label class="uk-form-label" for="uploaded-image-url">@lang('admin.banner.button.imageurl'):</label>
					<div class="uk-form-controls">
							<div class="uk-flex">
										<input class="uk-input" name="imageurl" id="uploaded-image-url" type="text" oninput="changeImage(this)" placeholder="@lang('admin.banner.button.imageurl')">
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
					<div class="uk-form-controls">
							<input class="uk-input" name="link" id="link" type="text" placeholder="@lang('admin.banner.button.link')">
					</div>
				</div>
				<div class="uk-margin-small">
					<label class="uk-form-label" for="form-horizontal-text">@lang('admin.banner.button.status'):</label>
					<div class="uk-form-controls">
						<x-buttons.switch id="status" type="secondary" switchtype=""></x-buttons.switch> &nbsp;
					</div>
				</div>
				<div class="uk-width-1-1 uk-margin-large-top uk-flex uk-flex-right">
					<button class="uk-button uk-button-danger uk-width-1-3" type="submit" form="deleteform">@lang('admin.banner.button.delete')</button>
					<button class="uk-button uk-button-primary uk-width-expand" type="submit">@lang('admin.banner.button.apply')</button>
				</div>

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
			document.getElementById('edit-banner').setAttribute('action', '{{ URL::to("/admin/banner") }}/'+obj[0].innerText)

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