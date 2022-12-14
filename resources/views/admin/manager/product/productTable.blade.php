<div class="uk-overflow-auto">
	<table class="uk-table uk-table-middle  uk-table-hover uk-table-divider uk-table-small">
		<thead>
			<tr>
				<th class="uk-table-shrink">ID</th>
				<th class="uk-width-small"></th>
				<th>Tên SP</th>
				<th class="uk-width-small rm" uk-tooltip="Giá bán (Chưa bao gồm khuyến mãi)">Giá</th>
				<th class="uk-width-small rm" uk-tooltip="Chương trình KM đang áp dụng">KM</th>
				<th class="uk-table-shrink">Kho</th>
				<th class="uk-table-shrink">Sửa</th>
				<th class="uk-table-shrink">Xóa</th>
			</tr>
		</thead>
		<tbody id="ajx" uk-scrollspy="cls: uk-animation-fade; target: tr; delay: 300;">
				@each('admin.manager.product.productTableRow', $collection, 'item')
		</tbody>
	</table>
</div>
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<script>
	$(document).ready(function(){
		initialize();
	});
	$('#search').on('keyup',function(){
		$value = $(this).val();
		if(!$value){
			location.reload();
		}
		else{
			$.ajax({
				headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
				type: 'get',
				url: '{{route("admin.product.search")}}',
				data: {
					'search': $value
				},
				success:function(obj){
					$('#ajx').html(row(JSON.parse(obj)));
					$('.rm').remove();
					initialize();
				}
			});
		}
	});

	function row(collection){
		let o= '';
		collection.forEach(function (item) {
			o +=  '<tr>';
			o += '<td>' +item.id +'</td>';
			o += getCollection(item.images);
			o += '<td>' + item.name + '</td>';
			o += '<td><button class="uk-button-primary uk-icon-button uk-form-small" type="submit" onclick="window.location.href=\'/admin/product/'+item.id+'/edit\'"><span uk-icon="pencil"></span></button></td>';
			o += '<td><form id="item-'+item.id+'-destroy-form" method="POST" hidden action="/admin/product/'+item.id+'"><input type="hidden" name="_token" value="{{csrf_token()}}"><input type="hidden" name="_method" value="delete"></form><button data-id="'+ item.id +'" class="confirm-delete uk-button-danger uk-icon-button uk-form-small" type="submit"><span uk-icon="close"></span></button></a></td>';
			o += '</tr>';
		});
		return o;
	}

	function getCollection(urls){
		o  = '<td><div style="width:10rem; height:5rem;overflow: hidden" uk-slider="center:true; finite :true; ">';
		o += '<ul class="uk-grid uk-slider-items uk-child-width-1-1">';
		if(urls){
			arr = JSON.parse(urls)
            // $js = json_decode(str_replace('\\','',$array));
			arr.forEach(function(item) {
				o += '<li><img style="object-fit: cover;width:10rem; height:5rem;" src="' + item + '"></li>';
			});
        }
		o += '</ul></div></td>';
        return o;
	}

	function initialize(){
		UIkit.util.on('.confirm-delete', 'click', function (e) {
				e.preventDefault();
				e.target.blur();
		let value = $(this).data('id');
				UIkit.modal.confirm('Xác nhận xóa').then(function () {
				//    console.log('Confirmed.')
					$('#item-'+value+'-destroy-form').submit();
				}, function () {/* console.log('Rejected.') */});
		});
	}
	
</script>