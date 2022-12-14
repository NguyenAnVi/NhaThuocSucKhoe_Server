<tr>
   <td>{{$item->id}}</td>
   <td>
       @if($item->imageurl!="")
       <img class="uk-comment-avatar uk-object-cover" width="100"  style="aspect-ratio: 3/1;" src="{{$item->imageurl}}">
       @endif
   </td>
   <td>{{$item->name}}</td>
   @if($item->amount>$item->percent)
   <td>{{$item->amount}} vnđ</td>
   @else
   <td>{{$item->percent}}%</td>
   @endif
   <td>{{$item->starttime}}</td>
   <td>{{$item->endtime}}</td>
   
   <td><button class="uk-button-primary uk-icon-button uk-form-small" type="submit" onclick="window.location.href='{{route('admin.saleoff.edit', $item->id)}}'"><span uk-icon="pencil"></span></button></td>
   <td>
      <form id="item-{{$item->id}}-destroy-form" method="POST" hidden action="/admin/saleoff/{{$item->id}}">
         @csrf
         @method('delete')
      </form>
      <button data-id="{{$item->id}}" class="confirm-delete uk-button-danger uk-icon-button uk-form-small" type="submit"><span uk-icon="close"></span></button></a>
   </td>
</tr>

