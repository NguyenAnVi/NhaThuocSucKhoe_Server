<tr>
	<td>{{$item->id}}</td>
	<td>{{$item->name}}</td>
	<td class="phone" data-phone="{{$item->phone}}">{{$item->phone}}</td>
	<td>{{$item->point}}</td>
	<td><button class="uk-button-primary uk-icon-button uk-form-small" type="submit" onclick="window.location.href='{{route('admin.customer.edit', $item->id)}}'"><span uk-icon="pencil"></span></button></td>
	<td>
		<form id="item-{{$item->id}}-destroy-form" method="POST" hidden action="/admin/customer/{{$item->id}}">
			@csrf
			@method('delete')
		</form>
		<button data-id="{{$item->id}}" class="confirm-delete uk-button-danger uk-icon-button uk-form-small" type="submit"><span uk-icon="close"></span></button></a>
	</td>
</tr>
