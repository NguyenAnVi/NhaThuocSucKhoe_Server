{{-- <tr>
	<td>{{$item->id}}</td>
	<td>{{$item->name}}</td>
	<td class="phone" data-phone="{{$item->phone}}">{{$item->phone}}</td>
	<td>{{$item->point}}</td>
	<td><button class="uk-button-primary uk-icon-button uk-form-small" type="submit" onclick="window.location.href='{{route('admin.hr.edit', $item->id)}}'"><span uk-icon="pencil"></span></button></td>
	<form id="item-{{$item->id}}-destroy-form" method="POST" hidden action="/admin/hr/{{$item->id}}">
		@csrf
		@method('delete')
	</form>
	<td><button data-id="{{$item->id}}" class="confirm-delete uk-button-danger uk-icon-button uk-form-small" type="submit"><span uk-icon="close"></span></button></a></td>
</tr> --}}

<tr>
	<td>{{$item->id}}</td>
	<td>{{$item->name}}@if(1 === $item->id) (Tài khoản hiện tại)@endif</td>
	<td class="phone" data-phone="{{$item->phone}}">{{$item->phone}}</td>
	<td><button class="uk-button-primary uk-icon-button uk-form-small" type="submit" onclick="window.location.href='{{route('admin.hr.edit', $item->id)}}'"><span uk-icon="pencil"></span></button></td>
	@if(1 === $item->id)
	<td><button disabled data-id="{{$item->id}}" class="uk-button-danger uk-icon-button uk-form-small" type="submit"><span uk-icon="close"></span></button></a></td>
	@else
	<td>
		<form id="item-{{$item->id}}-destroy-form" method="POST" hidden action="/admin/hr/{{$item->id}}">
			@csrf
			@method('delete')
		</form>
		<button data-id="{{$item->id}}" class="confirm-delete uk-button-danger uk-icon-button uk-form-small" type="submit"><span uk-icon="close"></span></button></a>
	</td>
	@endif
</tr>
