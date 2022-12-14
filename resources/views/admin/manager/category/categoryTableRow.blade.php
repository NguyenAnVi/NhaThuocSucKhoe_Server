<tr>
    <td>{{$item->parent_id}}</td>
    <td>{{$item->id}}</td>
    <td>{{$item->name}}</td>
    <td  class="uk-text-truncate" >{{$item->detail}}</td>
    <td data-id="{{$item->id}}">{!!checkStatus($item->id, $item->status)!!}</td>
    <td><button class="uk-button-primary uk-icon-button uk-form-small" type="submit" onclick="window.location.href='{{route('admin.category.edit', $item->id)}}'"><span uk-icon="pencil"></span></button></td>

        <form id="item-{{$item->id}}-destroy-form" 
            method="POST" hidden
            action="{{route('admin.category.destroy',$item->id)}}">
            @csrf @method('delete')
        </form>
        

    <td><button data-id="{{$item->id}}" class="confirm-delete uk-button-danger uk-icon-button uk-form-small" type="submit"><span uk-icon="close"></span></button></a></td>
</tr>
