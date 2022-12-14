<div class="uk-overflow-auto">
	<table class="uk-table uk-table-middle  uk-table-hover uk-table-divider uk-table-small">
		<thead>
			<tr>
				<th class="uk-table-shrink">ID</th>
				<th class="uk-width-small"></th>
				<th>Tên CTKM</th>
				<th class="uk-width-small">Giá giảm</th>
				<th class="">Ngày bắt đầu</th>
				<th class="">Ngày hết hạn</th>
				<th class="uk-table-shrink">Sửa</th>
				<th class="uk-table-shrink">Xóa</th>
		</tr>
		</thead>
		<tbody id="ajx" uk-scrollspy="cls: uk-animation-fade; target: tr; delay: 300;">
				@each('admin.manager.saleoff.saleoffTableRow', $collection, 'item')
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
				url: '{{route("admin.saleoff.search")}}',
				data: {
					'search': $value
				},
				success:function(obj){
					$('#ajx').html(row(JSON.parse(obj)));
					// $('.rm').remove();
					initialize();
				}
			});
		}
	});

	function row(collection){
		let o= '';
		collection.forEach(function (item) {
			o +=  '<tr>';
			o +=  '<td>'+item.id+'</td>';
			o +=  '<td>';
			if(item.imageurl!=""){
			o +=  '<img class="uk-comment-avatar uk-object-cover" width="100"  style="aspect-ratio: 3/1;" src="'+item.imageurl+'">';
			}
			o +=  '</td>';
			o +=  '<td>'+item.name+'</td>';
			if(item.amount > item.percent){
			o +=  '<td>'+item.amount+' vnđ</td>';
			} else {
			o +=  '<td>'+item.percent+'%</td>';
			}
			o +=  '<td>'+item.starttime+'</td>';
			o +=  '<td>'+item.endtime+'</td>';
			o += '<td><button class="uk-button-primary uk-icon-button uk-form-small" type="submit" onclick="window.location.href=\'/admin/saleoff/'+item.id+'/edit\'"><span uk-icon="pencil"></span></button></td>';
			o += '<td><form id="item-'+item.id+'-destroy-form" method="POST" hidden action="/admin/saleoff/'+item.id+'"><input type="hidden" name="_token" value="{{csrf_token()}}"><input type="hidden" name="_method" value="delete"></form><button data-id="'+ item.id +'" class="confirm-delete uk-button-danger uk-icon-button uk-form-small" type="submit"><span uk-icon="close"></span></button></a></td>';
			o +=  '</td>';
			o += '</tr>';
		});
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