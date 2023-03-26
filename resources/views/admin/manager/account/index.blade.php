@extends('admin.layouts.app')
@section('css')
	<style>
		:root{
			--foreground1: #240077;
			--foreground1-table: #392c57;
			--foreground2: #8d7f00;
			--foreground2-table: #3e3800;

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
	{{-- <h4 class="uk-padding-remove uk-margin-large-bottom">@lang('admin.account.title',['type' => trans('admin.banner.banner')])</h4> --}}
		

	<div id="a" class="uk-flex uk-flex-row uk-flex-between ">
		<div id="list" class="uk-width-expand uk-border-rounded-10 uk-box-shadow-small">
			
			<div class="table-header uk-card-title uk-width-1-2" style="background-color: var(--foreground1)">
				@lang('admin.account.title')
			</div>
			<div class="uk-flex uk-flex-between">
				<div class="search-field">
					<div class="uk-inline">
						<a class="uk-form-icon" uk-icon="icon: search"></a>
						<input id="search" class="uk-input" autocomplete="off" type="text" placeholder="@lang('admin.account.button.search')">
					</div>
					<div id="search-results" class="uk-position-bottom-center-out uk-background-default uk-box-shadow-small uk-margin-remove uk-border-rounded-10" style="display: none"></div>
				</div>
				<a  class="uk-margin-left uk-button uk-button-primary" style="background-color: var(--foreground1);" href="{{ route('admin.account.create') }}" uk-toggle>@lang('admin.account.button.addnew')</a>
			</div>

			<div>
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
						<div class="row" data-id="{{ $row->id }}" data-name="{{ $row->name }}" data-phone="{{ $row->phone }}" data-role="{{ $row->role }}">
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
						<a href="#change-password-modal" disabled id="button-change-password" onclick="document.getElementById('cpf-id').value = document.getElementById('id').value"  class="uk-button uk-button-primary" type="button" uk-toggle>@lang('admin.account.button.changepassword')</a>
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
									<div>
										<input type="hidden" name="id" id="gaf-id">
										@php $i=0; @endphp
										@foreach ($available_roles as $item)
											<input hidden data-index="{{ $i++ }}" id="per-{{ strtolower($item) }}" value="{{ strtoupper($item) }}" type="radio" name="permission">
										@endforeach
									</div>
									<div class=" uk-flex uk-flex-row">
										
										<div>
											@foreach ($available_roles as $item)
												<label for="per-{{ strtolower($item) }}" class="role-item uk-flex">{{ $item }}</label>
											@endforeach
										</div>
										<div class="uk-width-expand uk-padding-small uk-padding-remove-right uk-padding-remove-top uk-switcher">
											@php $i=0; @endphp
											@foreach ($available_roles as $item)
											<div data-index="{{ $i++ }}"  id="roledescription"><span uk-icon="icon: info"></span> &nbsp; @lang('enum.accesspermission.'.strtolower($item))</div>
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

				<div id="change-password-modal" uk-modal>
					<div class="uk-modal-dialog">
						<div class="uk-modal-header">
							<button class="uk-modal-close-default" type="button" uk-close></button>
							<h4>@lang('admin.account.button.changepassword')</h4>
						</div>
						<form id="change-password-form" action="{{ route('admin.account.changepassword') }}" method="POST">
							@csrf
							<div class="uk-modal-body">

								<input type="hidden" name="id" id="cpf-id">

								@if(Auth::user()->id != 1)
								<div class="uk-margin-small">
									<label class="uk-form-label" for="form-horizontal-text">@lang('admin.account.button.confirmpassword'):</label>
									<div class="uk-form-controls">
											<input class="uk-input" name="oldpassword" id="oldpassword" type="password" placeholder="@lang('admin.account.button.oldpassword')">
									</div>
								</div>
								@endif
								
								<div class="uk-margin-small">
									<label class="uk-form-label" for="form-horizontal-text">@lang('admin.account.button.newpassword'):</label>
									<div class="uk-form-controls">
											<input class="uk-input" name="newpassword" id="newpassword" type="password" placeholder="@lang('admin.account.button.newpassword')">
									</div>
								</div>

								@if(Auth::user()->id != 1)
								<div class="uk-margin-small">
									<label class="uk-form-label" for="form-horizontal-text">@lang('admin.account.button.confirmpassword'):</label>
									<div class="uk-form-controls">
											<input class="uk-input" name="confirmpassword" id="confirmpassword" type="password" placeholder="@lang('admin.account.button.confirmpassword')">
									</div>
								</div>
								@endif

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
		// var grantAccessRoute = {{ route('admin.account.grantaccess') }};
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
			output+='<div class="cell">@lang('admin.account.button.name')</div>';
			output+='<div class="cell">@lang('admin.account.button.phone')</div>';
			output+='<div class="cell">@lang('admin.account.button.role')</div>';
			output+='</div>	';

			a.list.forEach(item => {
				output+='<div class="row on-search" data-id="'+item.id+'" data-name="'+item.name+'" data-phone="'+item.phone+'" data-role="'+item.role+'">';
				output+='<div class="cell">'+highlight(item.name, s)+'</div>';
				output+='<div class="cell">'+highlight(item.phone, s)+'</div>';
				output+='<div class="cell">'+highlight(item.role, s)+'</div>';
				output+='</div>	';
			});
			
			output+='</div>';
			output+='</div>';
			return  output;
		}

		function addClickPreview(){
			$('.row').on('click', function() {
				document.getElementById('delete-form').setAttribute('action', '{{ URL::to("/admin/account") }}/'+$(this).data('id'));
				document.getElementById('id').value = $(this).data('id');
				document.getElementById('name').value = $(this).data('name');
				document.getElementById('phone').value = $(this).data('phone');
				document.getElementById('role').value = $(this).data('role');
				document.getElementById('button-grant-access').removeAttribute('disabled');
				document.getElementById('delete-button').removeAttribute('disabled');
				document.getElementById('preview').removeAttribute('style');
			});
		}

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

		$(document).ready(()=>{
			addClickPreview();

			$('input[id*=per-]').on('change', function(){
				id= $(this).attr('id');
				dataindex = ($(this).data('index'));
				$('label[for*=per-]').removeClass('uk-active');
				$('label[for='+id+']').addClass('uk-active');
				UIkit.switcher('.uk-switcher').show(dataindex)
			});

			$('#search').on('input', (e)=>{
				let key = removeAccents(e.currentTarget.value);
				if(key){
					let route = "{{ URL::to('/admin/account/search') }}/"+key;
				
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