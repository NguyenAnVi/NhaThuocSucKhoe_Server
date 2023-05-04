@extends('admin.layouts.app')
@section('css')
	<link href="{{asset('froala-editor/css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css" />
	@include('admin.manager.product.index-css')
	
@endsection
@section('js-head')
<script>
	var current = {
		'formstatus':'@error('any') {{ old('formstatus') }} @enderror',
		
		'id':'',
		'contentid':'',
		'contentname':'',
		'name':'',
		'detail':'',
		'images':'',
		'stock' : 0,
		'sold' : 0,
		'saleoffprice' : 0,
		'price' : 0,
		'weight' : 0,
		'classified' : '',
		'status':'',

		'image_index':0,
		'image_cur_index':0,

		'option_group_index': NaN,
		'cur_valueid':0,
		'cur_groupid':0
	};

	var options = [];
	let imageURLs = []
	var currentFile;
	
	var newOptVal = ()=>{
		return `<div class="uk-width-1-2 uk-flex" data-valueid="${current.cur_valueid}" data-groupid="${current.option_group_index}" data-role="values">
								<input class="uk-input uk-width-expand" name="opt-grp-${current.cur_groupid}-name-${current.cur_valueid}" placeholder="@lang('admin.product.button.optiongroupvaluesplaceholder')" type="text">
								<input class="uk-input uk-width-1-4" name="opt-grp-${current.cur_groupid}-price-${current.cur_valueid}" placeholder="@lang('admin.product.button.optionvalueprice')" type="number" min="0" max="2000000000">
								<input class="uk-input uk-width-1-4" name="opt-grp-${current.cur_groupid}-stock-${current.cur_valueid}" placeholder="@lang('admin.product.button.optionvaluestock')" type="number" min="0" max="65535">
								<button style="padding: 0px 10px" onclick="$(this).parent().remove()" class="uk-button uk-button-danger" type="button"><span uk-icon="icon:close"></span></button>
						</div>`;
	};
	var newOptGrp = ()=>{
		return `<div data-role="option-group" data-groupid="${current.option_group_index}" class="uk-width-1-1 uk-form-horizontal uk-padding-small uk-background-primary uk-border-rounded uk-margin">
							<div class="uk-width-1-1">
								<label for="opt-grp-${current.option_group_index}" class="uk-form-label">@lang('admin.product.button.optiongroupname') ${current.option_group_index+1}:</label>
								<div class="uk-flex uk-margin-small-bottom">
									<input placeholder="@lang('admin.product.button.optiongroupnameplaceholder')" class="uk-input" name="opt-grp-${current.option_group_index}" id="opt-grp-${current.option_group_index}" type="text">
									<button id="removeOptGrpBtn" style="padding: 0px 10px" class="uk-button uk-button-danger" type="button"><span uk-icon="icon:close"></span></button>
								</div>
							</div>
							<div class="uk-width-1-1">
								<label class="uk-form-label">@lang('admin.product.button.optiongroupvalues'):</label>
								<div class="uk-flex uk-flex-small uk-flex-wrap uk-form-stacked">
									<div class="uk-width-1-2 uk-flex" data-valueid="0" data-groupid="${current.option_group_index}" data-role="values">
											<input class="uk-input uk-width-expand" name="opt-grp-${current.option_group_index}-name-0" placeholder="@lang('admin.product.button.optiongroupvaluesplaceholder')" type="text">
											<input class="uk-input uk-width-1-4" name="opt-grp-${current.option_group_index}-price-0" placeholder="@lang('admin.product.button.optionvalueprice')" type="number" min="0" max="2000000000">
											<input class="uk-input uk-width-1-4" name="opt-grp-${current.option_group_index}-stock-0" placeholder="@lang('admin.product.button.optionvaluestock')" type="number" min="0" max="65535">
											<button style="padding: 0px 10px" disabled class="uk-button uk-button-danger" type="button"><span uk-icon="icon:close"></span></button>
									</div>

									<div class="uk-width-1-2">
										<button onclick="current.cur_valueid = (isNaN($(this).parent().prev().data('valueid')))?(0):($(this).parent().prev().data('valueid')+1); current.cur_groupid = $(this).parent().parent().parent().parent().data('groupid'); $(this).parent().before(newOptVal)" class="uk-width-expand uk-button uk-button-default vi-button-dash" type="button">@lang('admin.product.button.addoptionvalue')</button>
									</div>
								</div>

							</div>

					</div>`;
	};
	let dong = Intl.NumberFormat('vi-VN', {
			style: 'currency',
			currency: 'VND',
	});

	$('#weight').change(function(){
		$('[data-type="shipping-method-weight"]').text(" * "+$(this).val()+ " g = ");

		@foreach ($shipping_methods as $item)
			if((parseInt($(this).val()) <= parseInt({{ $item->max_weight }}))&&(parseInt($(this).val()) >= parseInt({{ $item->min_weight }}))){
				$('#shipping-method-subtotal-{{ $item->code }}').text(dong.format(parseInt($(this).val()) * parseInt($('#shipping-method-price-{{ $item->code }}').data('price'))));
			} else {
				$('#shipping-method-subtotal-{{ $item->code }}').html(`<span class="uk-text-danger">@lang('admin.product.message.shippingweightnotinrange',['min'=>$item->min_weight,'max'=>$item->max_weight])</span>`);
			}
		@endforeach
	});
	
	function clearEditForm(){
		$('option').show();
		$('option').removeAttr('selected');
		$('#name').val("");
		$('.fr-view').html("");
		$('#weight').val("");
		$('#stock').val("");
		$('#price').val("");
		$('#saleoffprice').val("");
		$('[data-groupid]').remove();
		$('#myImg').html("");
		$('#urlimage-list').html("");
	}

	function addShowOptionsEvent(){
		document.getElementById('addNewOptGrpBtn').addEventListener("click",function(){
			current.option_group_index = (isNaN($('#addNewOptGrpBtn').parent().prev().data('groupid')))?(0):($('#addNewOptGrpBtn').parent().prev().data('groupid')+1);
			$('#addNewOptGrpBtn').parent().before(newOptGrp);$('#addNewOptGrpBtn').hide();
			addHideOptionsEvent()
		});
	}

	function addHideOptionsEvent(){
		$('#removeOptGrpBtn').click(()=>{
			$('#removeOptGrpBtn').parent().parent().parent().remove();$('#addNewOptGrpBtn').show()
		})
	}

	function hideOption(){
		$('#removeOptGrpBtn').trigger('click');
	}

	function showOption(data){
		hideOption()
		$('#addNewOptGrpBtn').trigger('click')
		alert('here:'+data)
	}

	function makeCreateForm(){
		$('#preview').css('width', '0%');

		if(current.formstatus !="CREATE"){
			clearEditForm();
			document.getElementById('operate-form').setAttribute('action', '{{ route('admin.product.store') }}');
			current.formstatus = "CREATE";
			$('[name="formstatus"]').val('CREATE');
		}
	}

	function addClickPreview(){
		$('.getdetailable').on('click', function() {
			if(($('#preview').css('width') == '0px')||(current.id != $(this).data('id'))){
				clearEditForm();

				// set current:
				current.id = $(this).data('id')
				current.categoryid = $(this).data('categoryid')
				current.categoryname = $(this).data('categoryname')
				current.name = $(this).data('name')
				current.status = $(this).data('status')
				current.stock = $(this).data('stock')
				current.sold = $(this).data('sold')
				current.price = $(this).data('price')
				current.saleoffprice = $(this).data('saleoffprice')
				current.weight = $(this).data('weight')
				current.classified = $(this).data('classified')
				current.images_collection = $('.img-collection[data-id='+current.id+']').html()
				current.images = [];
				$('.img-collection[data-id='+current.id+']').children('li').map((key , liElement)=>{
					current.images.push($(liElement).children()[0].getAttribute('href'));
				})
				
				$.ajax({
					headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
					type: 'get',
					url: '{{ URL::to('/admin/product/detail') }}/'+current.id,
					success:function(obj){
						let r = JSON.parse(obj)
						if(r.status == 1){
							$('#froala-editor').html(r.content);
							$('.fr-view').html(r.content);
						}
						else UIkit.notification('@lang('admin.product.message.errorgetdetail')');
					}
				});
				current.detail = $('[name=detail]').html();

				$.ajax({
					headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
					type: 'get',
					url: '{{ URL::to('/admin/product/options') }}/'+current.id,
					success:function(obj){
						let r = JSON.parse(obj)
						if(r.status == 1){
							// create Options with Params
							current.options = r.content
							showOption(current.options);
						}
						else UIkit.notification(r.content);
					}
				});
				
				// set form action route
				current.formstatus = "EDIT";
				$('[name="formstatus"]').val('EDIT');
				$('#operate-form-opt').html('@method('put')')
				document.getElementById('operate-form').setAttribute('action', '{{ URL::to("/admin/product") }}/'+current.id);
				document.getElementById('delete-form').setAttribute('action', '{{ URL::to("/admin/product") }}/'+current.id);

				// detail side-bar
				$('.input-id').text(current.id)
				$('.input-categoryname').text(current.categoryname)
				$('.input-name').text(current.name)
				$('.input-price').text(current.price)
				$('.input-saleoffprice').text(current.saleoffprice)
				$('.input-stock').text(current.stock)
				$('.input-sold').text(current.sold)
				$('[for=input-images]').html(current.images_collection)

				// Fill Edit-form
				if(current.status === 1) 
					document.getElementById('status').setAttribute('checked', 'checked');
				else 
					document.getElementById('status').removeAttribute('checked');
				
				$('#name').val(current.name);
				$('option[value="'+current.categoryid+'"]').attr('selected', 'selected');
				$('#weight').val(current.weight);
				$('#stock').val(current.stock);
				$('#price').val(current.price);
				$('#saleoffprice').val(current.saleoffprice);
				$('.fr-view').html(current.detail);

				itera = 0;
				current.images.map((link)=>{
					$('#myImg').append(`<li data-imgid="${itera}" class="uk-active"><img src="http://127.0.0.1:8000/storage/images/no-image.png" style="width:100px; height:100px; object-fit:cover" alt=""></li>`);
					$('#urlimage-list').append(`<div data-imgid="${itera}" class="uk-width-1-1 uk-match uk-flex"><button role="deleteimg" class="uk-button uk-button-default" type="button">xóa</button><input oninput="updateImagePreview(${itera})" class="uk-input" name="imageurl" id="uploaded-image-url-${itera}" type="text" placeholder="Đường dẫn của ảnh" value="${link}"><button type="button" class="uk-button uk-button-default" onclick="openUploadImageModal(${itera})">upload</button></div>`);
					$('#uploaded-image-url-'+itera++).trigger('input')
					createDeleteButtonEvent();
				});

				$.ajax({
					headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
					type: 'get',
					url: '{{ URL::to('/admin/product/getoptions') }}/'+current.id,
					success:function(obj){
						let r = JSON.parse(obj)
						if(r.status == 1){
							current.options = r.content;
						}
						else UIkit.notification('@lang('admin.product.message.errorgetoptions'): '+r.content);
					}
				});
				
				// establishValidity();
				$('#preview').css('width', '25%');
			} else {
				$('#preview').css('width', '0%');
			}
		});
	}

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
					output+='<div class="cell">@lang('admin.product.button.name')</div>';
					output+='<div class="cell">@lang('admin.product.button.status')</div>';
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
		$('option[value='+current.categoryid+']').attr('selected', 'selected')
	}

	// make price input disabled when saleoffprice is valid
	$('#saleoffprice').on('input', function () {
		if ($('#saleoffprice').val().length > 0) {
			$('#price').css('text-decoration-line', 'line-through')
			console.log(typeof ($('#saleoffprice').val().length));
		} else {
			$('#price').css('text-decoration-line', 'none')
		}
	})

	// before submit operate form
	$('form#operate-form').on("submit", function(e){
		e.preventDefault()
		$('#images').val(JSON.stringify(imageURLs));
		$('#options').val(JSON.stringify(getOptions()));
		alert(JSON.stringify(getOptions()));
		$(this).unbind('submit').submit(); 
	});

	const getOptions = () => {
		var options = [];
		const optionElements = document.querySelectorAll("[data-role='option-group']");
		options = Array.from(optionElements).map((optionElement) => {
			const optionIndex = $(optionElement).data('groupid');
			var name = document.getElementById(`opt-grp-${optionIndex}`).value;
			var values = [];
			const valueElements = document.querySelectorAll(`[data-groupid="${optionIndex}"][data-role="values"]`);
			values = Array.from(valueElements).map((valueElement) => {
				var index = $(valueElement).data('valueid');
				const valueName = document.querySelector(`[name="opt-grp-${optionIndex}-name-${index}"]`).value;
				const valuePrice = document.querySelector(`[name="opt-grp-${optionIndex}-price-${index}"]`).value;
				const valueStock = document.querySelector(`[name="opt-grp-${optionIndex}-stock-${index}"]`).value;
				return { name: valueName, price: valuePrice, stock: valueStock };
			});
			return { name: name, values: values };
		});
		return options
	};

	function createDeleteButtonEvent(){
		$('button[role="deleteimg"]').off('click').click((e) => {
			const div = $(e.target).parent();
			const imgid = $(div).data('imgid')

			const li = $('li[data-imgid="'+imgid+'"]')
			const img = $('li[data-imgid="'+imgid+'"]').children('img')[0].src

			$(div).hide()
			$(li).hide()

			imageURLs = delEle(imgid, imageURLs)
			console.log(imageURLs);
		})
	}

	function addNewImageRow(){
		$('#urlimage-list').append('<div data-imgid="'+current.image_index+'" class="uk-width-1-1 uk-match uk-flex"><button role="deleteimg" class="uk-button uk-button-default" type="button">@lang('admin.product.button.delete')</button><input oninput="updateImagePreview('+current.image_index+')" class="uk-input" name="imageurl" id="uploaded-image-url-'+current.image_index+'" type="text" placeholder="@lang('admin.category.button.imageurl')"><button type="button" class="uk-button uk-button-default" onclick="openUploadImageModal('+current.image_index+')">upload</button></div>');
		$('#myImg').append('<li data-imgid="'+current.image_index+'"><img src="{{ asset('storage/images/no-image.png') }}"'+'style="width:100px; height:100px; object-fit:cover" alt=""></li>');
		createDeleteButtonEvent();
		current.image_index++;
	}

	function openUploadImageModal(id){
		current.image_cur_index = id;
		UIkit.modal('#uploadimage').show();
	}

	function updateImagePreview(id){
		const li = $('li[data-imgid="'+id+'"]')
		// add url to imageURLs
		const url = $('#uploaded-image-url-'+id).val()
		
		imageURLs[id] = url
		$(li).children('img')[0].src = url;

		//save to main input 
		$('#images').val(imageURLs);

	}
	
	function delEle(id, arr) {

		console.log("delEle");
		console.log("    before:"+arr)
		console.log("    type:"+typeof(arr))

		arr.splice(id, 1);
		console.log("    after:"+arr)
		return arr;
	}


</script>
@endsection
@section('content')
	<div id="a" class="uk-flex uk-flex-row uk-flex-between" uk-height-viewport="expand:true">
		<div id="list" class="uk-width-expand uk-border-rounded-10 uk-box-shadow-small">
			
			<div class="table-header uk-card-title" style="background-color: var(--foreground1)">
				@lang('admin.product.title')
			</div>
			<div class="uk-flex uk-flex-between">
				<div class="search-field uk-width-expand">
					<div class="uk-inline uk-width-expand">
						<a class="uk-form-icon" uk-icon="icon: search"></a>
						<input id="search" class="uk-input" autocomplete="off" type="text" placeholder="@lang('admin.product.button.search')">
					</div>
					<div id="search-results" class="uk-position-bottom-center-out uk-background-default uk-box-shadow-small uk-margin-remove uk-border-rounded-10" style="display: none"></div>
				</div>
				<div class="uk-flex uk-flex-right">
					<a uk-toggle href="#stock-modal" class="uk-button uk-button-primary" style="background-color: var(--foreground1);" type="button">@lang('admin.product.button.updatestock')</a>
					<a uk-toggle href="#edit-modal" onclick="makeCreateForm()" class="uk-button uk-button-primary" style="background-color: var(--foreground1);" type="button">@lang('admin.product.button.addnew')</a>
				</div>
			</div>
			<div class="">
				<div class="wrapper">
					<div class="table">
						<div class="row header">
							<div class="cell uk-table-shrink">
								@lang('admin.product.button.id')
							</div>
							<div class="cell uk-table-shrink">
								@lang('admin.product.button.categoryname')
							</div>
							<div class="cell">
								@lang('admin.product.button.name')
							</div>
							<div class="cell uk-table-shrink">
								@lang('admin.product.button.status')
							</div>
						</div>
						@foreach ($collection as $row)
						<div class="row getdetailable" data-id="{{ $row->id }}" data-name="{{ $row->name }}" data-categoryid="{{ $row->category_id }}" data-categoryname="{{ $row->category_name }}" data-price="{{ $row->price }}" data-saleoffprice="{{ $row->saleoff_price }}" data-stock="{{ $row->stock }}" data-sold="{{ $row->sold }}" data-classified="{{ $row->classified }}" data-status="{{ $row->status }}">
							<div class="cell">
								{{ $row->id }}
							</div>
							<div class="cell">
								{{ $row->category_name }}
							</div>
							<div class="cell">
								{{ $row->name }}
							</div>
							<div class="cell uk-text-center">
								{{ $row->status }}
							</div>
							<div data-id="{{ $row->id }}" class="img-collection" style="display: none">
								{!!getCollection($row->images)!!}
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

				<div class="uk-center" uk-slider="center:true; finite :true;">
					<ul for="input-images" class="uk-grid uk-slider-items uk-child-width-1-1" uk-lightbox="animation: scale" style=" height:200px;">
					</ul>
				</div>
				<div class="wrapper">
					<div class="table">
						<div class="row">
							<div class="cell uk-text-left uk-table-shrink">@lang('admin.product.button.id')</div>
							<div class="cell uk-text-right input-id"></div>
						</div>	
						<div class="row">
							<div class="cell uk-text-left">@lang('admin.product.button.categoryname')</div>
							<marquee class="cell uk-width-1-2 input-categoryname"></marquee>
						</div>
						<div class="row">
							<div class="cell uk-text-left">@lang('admin.product.button.name'):</div>
							<marquee class="cell uk-width-1-2 input-name"></marquee>
						</div>
						<div class="row">
							<div class="cell uk-text-left">@lang('admin.product.button.price'):</div>
							<div class="cell uk-text-right input-price"></div>
						</div>
						<div class="row">
							<div class="cell uk-text-left">@lang('admin.product.button.saleoffprice'):</div>
							<div class="cell uk-text-right input-saleoffprice"></div>
						</div>
						<div class="row">
							<div class="cell uk-text-left">@lang('admin.product.button.stock'):</div>
							<div class="cell uk-text-right input-stock"></div>
						</div>
						<div class="row">
							<div class="cell uk-text-left">@lang('admin.product.button.sold'):</div>
							<div class="cell uk-text-right input-sold"></div>
						</div>
					</div>
				</div>

				<div class="uk-flex-small uk-flex-row uk-margin uk-margin-remove-horiontal">
					<button id="delete-button" class="uk-button uk-button-danger uk-overflow-hidden" type="submit" form="delete-form">@lang('admin.product.button.delete')</button>
					<a href="#edit-modal" class="uk-button uk-button-primary uk-overflow-hidden" uk-toggle>@lang('admin.product.button.edit')</a>
				</div>
				
				<div id="edit-modal" class="uk-modal-full" uk-modal="bg-close:false">
					<div class="uk-modal-dialog">
						
						<div class="uk-modal-body">
							<form id="operate-form" action="" class="uk-form-small uk-form-vertical" method="POST" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name="formstatus" value="@error('any') {{ old('formstatus') }} @enderror">
								<div hidden id="operate-form-opt"></div>
								<div class="uk-flex">
									<div class="uk-width-1-2 uk-padding-small uk-padding-remove-vertical uk-padding-remove-left">
										<div class="uk-margin-small">
											<label class="uk-form-label" for="status">@lang('admin.product.button.status'):</label>
											<div class="uk-form-controls">
												<x-buttons.switch id="status" name="status" type="primary" switchtype="@error('any') @if(old('status')=true)old('status') checked @endif @else checked @enderror"></x-buttons.switch>
											</div>
										</div>
							
										<div class="uk-margin-small">
											<label class="uk-form-label" for="name">@lang('admin.product.button.name'):</label>
											<div class="uk-form-controls">
												<div class="uk-flex">
													<input id="name" class="uk-input" type="text" name="name" value="@error('any') {{ old('name') }} @enderror" required placeholder="@lang('admin.product.button.name')">
												</div>
											</div>
										</div>
							
										<div class="uk-margin-small">
											<label class="uk-form-label" for="category">@lang('admin.product.button.categoryname'):</label>
											<div class="uk-form-controls">
												<div class="uk-flex">
													<select class="uk-select" id="category" name="categoryid" required>
														<option value=""> * </option>
														@foreach($categories as $item)
														<option value="{{ $item->id }}">{{ $item->name }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
							
										<div class="uk-margin-small uk-flex uk-child-width-1-2">
											<div>
												<label class="uk-form-label" for="weight">@lang('admin.product.button.weight'):</label>
												<div class="uk-form-controls">
													<div class="uk-flex">
														<input id="weight" class="uk-input" type="number" min="0" max="60000" step="500" name="weight"
															required placeholder="@lang('admin.product.button.weight')">
													</div>
												</div>
											</div>
											<div>
												<label class="uk-form-label uk-text-warning" for="stock"
													uk-tooltip="title: Số lượng, có thể cập nhật sau">@lang('admin.product.button.stock'):</label>
												<div class="uk-form-controls">
													<div class="uk-flex">
														<input id="stock" class="uk-input" type="number" min="0" max="65535" step="1" name="stock"
															placeholder="@lang('admin.product.button.stock')">
													</div>
												</div>
											</div>
										</div>
							
										<div class="uk-margin-small uk-flex uk-child-width-1-2">
											<div><label class="uk-form-label" for="weight">@lang('admin.product.button.price'):</label>
												<div class="uk-form-controls">
													<div class="uk-flex">
														<input id="price" class="uk-input" type="number" min="0" max="2000000000" step="1" name="price"
															placeholder="@lang('admin.product.button.price')">
													</div>
												</div>
											</div>
											<div><label class="uk-form-label" for="saleoffprice">@lang('admin.product.button.saleoffprice'):</label>
												<div class="uk-form-controls">
													<div class="uk-flex">
														<input id="saleoffprice" class="uk-input" type="number" min="0" max="2000000000" step="1" name="saleoffprice" 
															placeholder="@lang('admin.product.button.saleoffprice')">
														
													</div>
												</div>
											</div>
										</div>
							
									</div>
							
									<div class="uk-width-1-2 uk-border-rounded-10 uk-padding-small uk-padding-remove-vertical uk-padding-remove-right">
										<div class="uk-margin-small">
											<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1"
												uk-slider="sets: true; finite: true; easing; velocity:3">
												<ul id="myImg" class="uk-grid uk-slider-items"></ul>
											</div>
										</div>
										
										<div class="uk-margin-small">
											<label class="uk-form-label" for="uploaded-image-url">@lang('admin.product.button.image'):</label>
											<div class="uk-form-controls" id="urlimage-list" style="max-height: 203px; overflow-Y:scroll"></div>
											<div class="uk-width-1-1 uk-match uk-flex">
												<input type="hidden" name="images" id="images">
												<button type="button" class="uk-width-expand uk-button uk-button-default"
													onclick="addNewImageRow()">@lang('admin.product.button.addnewimage')</button>
											</div>
										</div>
									</div>
							
								</div>
								<div class="uk-margin-small-top uk-padding-small uk-padding-remove-horizontal">
									<label class="uk-form-label">@lang('admin.product.button.options'):</label>
									<div class="uk-form-controls">
										<div>
										<button class="uk-button uk-width-expand uk-button-default vi-button-dash" type="button" id="addNewOptGrpBtn">@lang('admin.product.button.addnewoptiongroup')</button>
										
											<input type="hidden" value="@error('any') {{ old('options') }} @enderror" name="options" id="options">
										</div>
									</div>
								</div>
								<div class="uk-margin-small-top uk-flex uk-flex-column">
									<label for="shipping-method">@lang('admin.product.button.shippingmethod'):</label>
									<div class="uk-flex">
										@foreach ($shipping_methods as $item)
										<div class="uk-width-1-2 uk-flex uk-flex-middle uk-background-secondary uk-border-rounded uk-padding-small uk-margin-small-right">
											<x-buttons.switch id="shippingmethod-{{ $item->code }}" name="shippingmethods[]" type="primary" switchtype="value={{ $item->code }}"></x-buttons.switch>
											&nbsp;&nbsp;
											<label for="shippingmethod-{{ $item->code }}">{{ $item->name }}: &nbsp;<span data-price="{{ $item->fee }}" id="shipping-method-price-{{ $item->code }}">{{ toCurrency( $item->fee ) }}</span><span data-type="shipping-method-weight"></span><span id="shipping-method-subtotal-{{ $item->code }}" class="uk-text-bold"></span></label>
										</div>
										@endforeach
									</div>

								</div>
								<div class="uk-margin-small-top">
									<label class="uk-form-label" for="froala-editor">@lang('admin.product.button.detail'):</label>
									<div class="uk-form-controls">
										<div>
											<textarea tabindex="1" name='detail' id="froala-editor"></textarea>
										</div>
									</div>
								</div>
								
							</form>

							{{-- <x-admin.uploadimage.form></x-admin.uploadimage.form>	 --}}
							<div id="uploadimage" uk-modal="bg-close:false;stack: true">
								<div class="uk-modal-dialog">
										<button class="uk-modal-close-default" type="button" uk-close></button>
										<div class="uk-modal-header">
												<h2 class="uk-modal-title">@lang('admin.component.uploadimage.title')</h2>
										</div>
										<div class="uk-modal-body">
											<form action="{{ route('admin.image.upload') }}" enctype="multipart/form-data">
												<div class="js-upload uk-placeholder uk-text-center ">
													<div uk-form-custom="target:true" class="uk-flex uk-flex-row">
														
														<img class="uk-border-rounded-10 uk-box-shadow-small" id="upload-image-img" alt="">
														<div class="uk-flex uk-width-1-1">
															<span uk-icon="icon: cloud-upload"></span>
															<span class="uk-text-middle">@lang('admin.component.uploadimage.dropimagehere')</span>
															<input id="upload-image-input" name="image" type="file">
															
														</div>
													</div>
												</div>
											</form>
											
							
										</div>
										<div class="uk-modal-footer uk-text-right">
												<button class="uk-button uk-button-default uk-modal-close" type="button">@lang('admin.button.cancel')</button>
												<button id="upload-image-button-submit" class="uk-button uk-button-primary" type="button">@lang('admin.button.upload')</button>
										</div>
								</div>
							</div>
							

						</div>
						<div class="uk-modal-footer uk-text-right">
							<button class="uk-button uk-button-default" onclick="clearEditForm()" type="button">@lang('admin.product.button.clearform')</button>
							&nbsp;&nbsp;&nbsp;
							<button class="uk-button uk-button-default uk-modal-close" type="button">@lang('admin.button.cancel')</button>
							<button form="operate-form" class="uk-button uk-button-primary" type="submit">@lang('admin.product.button.apply')</button>
						</div>
					</div>
				</div>

				{{-- <div id="stock-modal" class="uk-modal-container" uk-modal="bg-close:false;stack: true">
					<div class="uk-modal-dialog">
						
						<div class="uk-modal-body">
							<form id="updatestock-form" action="{{ route('admin.product.updatestock') }}" class="uk-form-vertical" method="POST" enctype="multipart/form-data">
								<div class="uk-flex uk-flex-column">
									<div class="uk-width-1-2 uk-padding-small uk-padding-remove-vertical uk-padding-remove-left">
							
										<div class="uk-margin-small">
											<label class="uk-form-label" for="name">@lang('admin.product.button.name'):</label>
											<div class="uk-form-controls">
												<div class="uk-flex">
													<input id="name" class="uk-input" type="text" name="name" value="@error('any') {{ old('name') }} @enderror" required placeholder="@lang('admin.product.button.name')">
												</div>
											</div>
										</div>
							
										<div class="uk-margin-small">
											<label class="uk-form-label" for="category">@lang('admin.product.button.categoryname'):</label>
											<div class="uk-form-controls">
												<div class="uk-flex">
													<select class="uk-select" id="category" name="categoryid" required>
														<option value=""> * </option>
														@foreach($categories as $item)
														<option value="{{ $item->id }}">{{ $item->name }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>
							
										<div class="uk-margin-small uk-flex uk-child-width-1-2">
											<div>
												<label class="uk-form-label" for="weight">@lang('admin.product.button.weight'):</label>
												<div class="uk-form-controls">
													<div class="uk-flex">
														<input id="weight" class="uk-input" type="number" min="0" max="60000" step="500" name="weight"
															required placeholder="@lang('admin.product.button.weight')">
													</div>
												</div>
											</div>
											<div>
												<label class="uk-form-label uk-text-warning" for="stock"
													uk-tooltip="title: Số lượng, có thể cập nhật sau">@lang('admin.product.button.stock'):</label>
												<div class="uk-form-controls">
													<div class="uk-flex">
														<input id="stock" class="uk-input" type="number" min="0" max="65535" step="1" name="stock"
															placeholder="@lang('admin.product.button.stock')">
													</div>
												</div>
											</div>
										</div>
							
										<div class="uk-margin-small uk-flex uk-child-width-1-2">
											<div><label class="uk-form-label" for="weight">@lang('admin.product.button.price'):</label>
												<div class="uk-form-controls">
													<div class="uk-flex">
														<input id="price" class="uk-input" type="number" min="0" max="2000000000" step="1" name="price"
															placeholder="@lang('admin.product.button.price')">
													</div>
												</div>
											</div>
											<div><label class="uk-form-label" for="saleoffprice">@lang('admin.product.button.saleoffprice'):</label>
												<div class="uk-form-controls">
													<div class="uk-flex">
														<input id="saleoffprice" class="uk-input" type="number" min="0" max="2000000000" step="1" name="saleoffprice" 
															placeholder="@lang('admin.product.button.saleoffprice')">
														
													</div>
												</div>
											</div>
										</div>
							
									</div>
							
									<div class="uk-width-1-2 uk-border-rounded-10 uk-padding-small uk-padding-remove-vertical uk-padding-remove-right">
										
										<div>
											<label class="uk-form-label" for="saleoffprice">@lang('admin.product.button.saleoffprice'):</label>
											<div class="uk-form-controls">
												<div class="uk-flex">
													<input id="saleoffprice" class="uk-input" type="number" min="0" max="2000000000" step="1" name="saleoffprice" 
														placeholder="@lang('admin.product.button.saleoffprice')">
												</div>
											</div>
										</div>
										
									</div>
							
								</div>
									
							
								
							</form>
						</div>
						<div class="uk-modal-footer uk-text-right">
							<button class="uk-button uk-button-default uk-modal-close" type="button">@lang('admin.button.cancel')</button>
							<button form="operate-form" class="uk-button uk-button-primary" type="submit">@lang('admin.product.button.apply')</button>
						</div>
					</div>
				</div> --}}
				
				<form id="delete-form" action="" method="POST">@csrf @method('delete') </form>
			</div>
		</div>
	</div>
@endsection
@section('js')
	
	<script type="text/javascript" src="{{asset('froala-editor/js/froala_editor.pkgd.min.js')}}"></script>
	<script>
			$(document).ready(()=>{
			var editor = FroalaEditor('textarea#froala-editor', { editorClass: 'uk-width-expand',  heightMax: 210});
			addClickPreview()
			addShowOptionsEvent()

			Array.from(document.querySelectorAll('[id*=i-]')).map((domElement) => {
				domElement.addEventListener('change',(e) => {
					dataindex = (e.target.dataset.index);
					UIkit.switcher('.uk-switcher').show(dataindex-0);
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

			$('#upload-image-input').on('change',function(e){
				$('#upload-image-img').attr('src', URL.createObjectURL(e.target.files[0]));
				currentFile = e.target.files[0];
			});
	
			$('#upload-image-button-submit').on('click', function() {
				if (currentFile) {
					var formData = new FormData()
					formData.append('image', currentFile)
					formData.append('uid', '{{ Auth::user()->id }}')
					$.ajax({
						headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
						type: 'post',
						url: '{{route("admin.image.upload")}}',
						data: formData,
						dataType: 'json',
						enctype: 'multipart/form-data',
						processData: false,
						contentType: false,
						success:function(obj){
							console.log("Successfully upload image to server:"+obj.status);
							$('#uploaded-image-url-'+current.image_cur_index).val(obj.url);
							$('#uploaded-image-url-'+current.image_cur_index).trigger('oninput');
		
							UIkit.notification('@lang('admin.component.uploadimage.uploadsuccess')');
							UIkit.modal('#uploadimage').hide();
						}
					});
				}
			});

			// // Make search input unfocus when clicking outside
			// $(document).click(function(event) {
			// 	//Hide the #search-results if visible
			// 	var $target = $(event.target);
			// 	if(!$target.closest('#search-results').length && 
			// 	$('#search-results').is(":visible")) {
			// 		$('#search-results').hide();
			// 	}        
			// });
			// // Make search input unfocus when clicking outside
			// $('#search-results').on('click' ,function(){
			// 	event.stopPropagation(); 
			// });
			
		});
	</script>
@endsection