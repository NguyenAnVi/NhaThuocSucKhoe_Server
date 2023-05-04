@extends('admin.layouts.app')
@section('css')
	<link href="{{asset('froala-editor/css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css" />

	<style>
		:root{
			--foreground1: #730000;
			--foreground1-table: #821521;
			--foreground2: #003067;
			--foreground2-table: #14007a;

		}
		#list{
			/* width: 55vw; */
			padding: 0 12px 12px 12px;
			margin: 0 12px 0 0;
			background-color: white;
		}
		#preview{
			overflow: hidden;
			background-color: white;
			width: 0%;
			transition: width 1s ease;
		}
		.table-header{
			width: 560px;
			height: calc(80px);
			color: white;
			transform: translateY(-24px);
			padding:12px;
			border-radius: 5px;
			display: flex;
			align-items: center;
		}
		.wrapper {
			max-width: 100%;
			box-sizing: border-box;
			display: flex;
			border-radius: 5px;
			overflow: auto;
		}
		.table {
			width: 100%;
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
		.cell {
			padding: 6px 12px;
			display: table-cell;
			white-space: nowrap; 
			text-overflow:ellipsis; 
			overflow: hidden;
		}
		#search{
			width: 500px;
		}
		#search-results{
			min-width: 750px;
		}
	
	</style>
@endsection
@section('content')
	{{-- <h4 class="uk-padding-remove uk-margin-large-bottom">@lang('admin.category.title',['type' => trans('admin.category.category')])</h4> --}}
		

	<div id="a" class="uk-flex uk-flex-row uk-flex-between" uk-height-viewport="expand:true">
		<div id="list" class="uk-width-expand uk-border-rounded-10 uk-box-shadow-small">
			
			<div class="table-header uk-card-title" style="background-color: var(--foreground1)">
				@lang('admin.category.title')
			</div>
			<div class="uk-flex uk-flex-between">
				<div class="search-field">
					<div class="uk-inline">
						<a class="uk-form-icon" uk-icon="icon: search"></a>
						<input id="search" class="uk-input" autocomplete="off" type="text" placeholder="@lang('admin.category.button.search')">
					</div>
					<div id="search-results" class="uk-position-bottom-center-out uk-background-default uk-box-shadow-small uk-margin-remove uk-border-rounded-10" style="display: none"></div>
				</div>
				<a uk-toggle href="#edit-modal" onclick="makeCreateForm()" class="uk-margin-left uk-button uk-button-primary" style="background-color: var(--foreground1);" type="button">@lang('admin.category.button.addnew')</a>
			</div>
			<div class="">
				<div class="wrapper">
					<div class="table">
						<div class="row header">
							<div class="cell uk-table-shrink">
								@lang('admin.category.button.id')
							</div>
							<div class="cell uk-table-shrink">
								@lang('admin.category.button.parent_id')
							</div>
							<div class="cell">
								@lang('admin.category.button.name')
							</div>
							<div class="cell uk-table-shrink">
								@lang('admin.category.button.status')
							</div>
						</div>
						@foreach ($collection as $row)
						<div class="row getdetailable" data-id="{{ $row->id }}" data-name="{{ $row->name }}" data-parentid="{{ $row->parent_id }}" data-imageurl="{{ $row->imageurl }}" data-status="{{ $row->status }}">
							<div class="cell">
								{{ $row->id }}
							</div>
							<div class="cell">
								{{ $row->parent_id }}
							</div>
							<div class="cell">
								{{ $row->name }}
							</div>
							<div class="cell uk-text-center">
								{{ $row->status }}
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
		<div id="preview" class=" uk-border-rounded-10 uk-box-shadow-small">
			<div class="uk-flex  uk-text-center uk-flex-column">
				<div for="input-imageurl"  uk-lightbox="animation: scale">
					<a class="imgpreviewlightbox" href="{{ asset('storage/images/no-image.png') }}">
						<img style="min-width: 300px; max-width:300px;" class="imgpreview" >
					</a>
				</div>
				<input hidden type="text" class="input-imageurl" id="input-imageurl"  oninput="changeImage(this)">
				<div class="wrapper">
					<div class="table">
						<div class="row">
							<div class="cell uk-text-left uk-table-shrink">@lang('admin.category.button.id')</div>
							<div class="cell uk-text-right input-id"></div>
						</div>	
						<div class="row">
							<div class="cell uk-text-left ">@lang('admin.category.button.parentid')</div>
							<div class="cell uk-text-right input-parentid"></div>
						</div>
						<div class="row">
							<div class="cell uk-text-left ">@lang('admin.category.button.name')</div>
							<div class="cell uk-text-right input-name"></div>
						</div>
						<div class="row">
							<div class="cell uk-text-left ">@lang('admin.category.button.status')</div>
							<div class="cell uk-text-right input-status"></div>
						</div>
					</div>
				</div>

				<div class="uk-flex-small uk-flex-row uk-margin-bottom">
					<button id="delete-button" class="uk-button uk-button-danger uk-overflow-hidden" type="submit" form="delete-form">@lang('admin.category.button.delete')</button>
					<a href="#edit-modal" class="uk-button uk-button-primary uk-overflow-hidden" uk-toggle>@lang('admin.category.button.edit')</a>
				</div>
				
				<x-admin.uploadimage.form></x-admin.uploadimage.form>	
				<div id="edit-modal" class="uk-modal-container" uk-modal="bg-close:false;stack: true">
					<div class="uk-modal-dialog">
							<div class="uk-modal-body">
								<form id="edit-form" action="" class="uk-form-small uk-form-horizontal" method="POST">
									@csrf
									<div id="edit-form-opt"></div>
									<div class="uk-flex">
										<div class="uk-width-3-4">
											<div class="uk-margin-small">
												<label class="uk-form-label" for="status">@lang('admin.category.button.status'):</label>
												<div class="uk-form-controls">
													<x-buttons.switch id="status" name="status" type="secondary" switchtype=""></x-buttons.switch>
												</div>
											</div>
											
											<div class="uk-margin-small">
												<label class="uk-form-label" for="parentidselect">@lang('admin.category.button.parentid'):</label>
												<div class="uk-form-controls">
													<div class="uk-flex">
														<select class="uk-select" id="parentidselect" name="parentid">
															<option value="0"> * </option>
															@foreach($categoryparentnodes as $item)
															<option value="{{ $item->id }}">{{ $item->name }}</option>
															@endforeach
														</select>
													</div>
												</div>
											</div>

											<div class="uk-margin-small">
												<label class="uk-form-label" for="name">@lang('admin.category.button.name'):</label>
												<div class="uk-form-controls">
													<div class="uk-flex">
														<input id="name" class="uk-input" type="text" name="name" placeholder="@lang('admin.category.button.name')">
													</div>
													</div>
											</div>

											<div class="uk-margin-small">
												<label class="uk-form-label" for="uploaded-image-url">@lang('admin.category.button.imageurl'):</label>
												<div class="uk-form-controls">
														<div class="uk-flex">
															<input oninput="changeImage(this)" class="uk-input" name="imageurl" id="uploaded-image-url" type="text" placeholder="@lang('admin.category.button.imageurl')">
															<x-admin.uploadimage.button></x-admin.uploadimage.button>	
														</div>
														
													</div>
											</div>
											
		
										</div>
										<div class="uk-width-1-4 uk-border-rounded-10 uk-box-shadow">
											<div for="uploaded-image-url" class="uk-width-expand uk-margin-small" uk-lightbox="animation: scale">
												<a class="imgpreviewlightbox" href="{{ asset('storage/images/no-image.png') }}">
													<img style="width:255px ;height: 191px; margin-left:5px; object-fit:cover; border-radius: 5px;">
												</a>
											</div>
											
										</div>

									</div>
									<div class="uk-margin-small-top uk-margin-right">
										<label class="uk-form-label" for="froala-editor">@lang('admin.category.button.detail'):</label>
										<div class="uk-form-controls">
												<div>
													<textarea tabindex="1" name='detail' id="froala-editor"></textarea>
												</div>
											</div>
									</div>
								</form>
							</div>
							<div class="uk-modal-footer uk-text-right">
									<button class="uk-button uk-button-default uk-modal-close" type="button">@lang('admin.button.cancel')</button>
									<button form="edit-form" class="uk-button uk-button-primary" type="submit">@lang('admin.category.button.apply')</button>
							</div>
					</div>
				</div>
				
				<form id="delete-form" action="" method="POST">@csrf @method('delete') </form>
			</div>
		</div>
	</div>
@endsection
@section('js')
	<script type="text/javascript" src="{{asset('froala-editor/js/froala_editor.pkgd.min.js')}}"></script>
	<script>
		var current = {
			'id':'',
			'parentid':'',
			'name':'',
			'detail':'',
			'imageurl':'',
			'status':0
		};

		function changeImage(element){
			let id = element.id;
			let val = element.value;
			var tester=new Image();
			tester.src=val;
			tester.onload= function(){
				$('div[for="'+id+'"]>a>img').attr('src',val);
				$('div[for='+id+']>a').attr('href',val);
			};
			tester.onerror=function(){
				$('div[for="'+id+'"]>a>img').attr('src','{{ asset("storage/images/no-image.png") }}');
				$('div[for='+id+']>a').attr('href', '{{ asset("storage/images/no-image.png") }}');
			};
		}
		
		function makeCreateForm(){
			document.getElementById('edit-form').setAttribute('action', '{{ route('admin.category.store') }}');

			$('#status').removeAttr('checked');
			$('option').show();
			$('option').removeAttr('selected');
			$('#name').val("");
			$('#uploaded-image-url').val("");
			$('#uploaded-image-url').trigger('oninput');
			$('.fr-view').html("");

		}

		$(document).ready(()=>{
			var editor = FroalaEditor('textarea#froala-editor', { editorClass: 'uk-width-1-1',  heightMax: 210});

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
					output+='<div class="cell">@lang('admin.category.button.name')</div>';
					output+='<div class="cell">@lang('admin.category.button.status')</div>';
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
			function establishValidity(){
				$('option').show();
				$('option[value='+current.id+']').hide();
				$('option').removeAttr('selected');
				$('option[value='+current.parentid+']').attr('selected', 'selected')
			}
			function addClickPreview(){
				$('.getdetailable').on('click', function() {
					// set current:
					current.id = $(this).data('id')
					current.parentid = $(this).data('parentid')
					current.name = $(this).data('name')
					$.ajax({
						headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
						type: 'get',
						url: '{{ URL::to('/admin/category/detail') }}/'+current.id,
						success:function(obj){
							let r = JSON.parse(obj)
							if(r.status == 1){
								$('#froala-editor').html(r.content);
								$('.fr-view').html(r.content);
							}
							else UIkit.notification('@lang('admin.category.message.errorgetdetail')');
						}
					});
					current.detail = $('[name=detail]').html();
					current.imageurl = $(this).data('imageurl')
					current.status = $(this).data('status')

					//set form action route
					$('#edit-form-opt').html('@method('put')')
					document.getElementById('edit-form').setAttribute('action', '{{ URL::to("/admin/category") }}/'+current.id);
					document.getElementById('delete-form').setAttribute('action', '{{ URL::to("/admin/category") }}/'+current.id);

					$('.input-id').text(current.id);
					$('.input-parentid').text(current.parentid);
					$('.input-name').text(current.name);
					$('.input-imageurl').val(current.imageurl); 
					$('.input-imageurl').trigger('oninput');
					$('.input-status').text((current.status === 1)?('@lang('admin.category.button.active')'):('@lang('admin.category.button.inactive')'));
					$('#preview').css('width', '30%');
					
					document.getElementById('name').value = $(this).data('name');
					document.getElementById('uploaded-image-url').value = current.imageurl; 
					$('#uploaded-image-url').trigger('oninput');

					if(current.status === 1) document.getElementById('status').setAttribute('checked', 'checked');
					else document.getElementById('status').removeAttribute('checked');

					establishValidity();
				});
			}
			
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
					let route = "{{ URL::to('/admin/category/search') }}/"+key;
				
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

		function checkOldParentId() {
			$('option[value='+current.parentid+']').attr('checked','checked')
		}

	</script>
@endsection