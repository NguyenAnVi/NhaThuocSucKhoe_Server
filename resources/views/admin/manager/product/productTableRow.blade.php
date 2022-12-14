<?php use App\Models\SaleOff;?>
<tr>
	<td>{{$item->id}}</td>
 <td>{!!getCollection($item->images)!!}</td>
 <td>{{$item->name}}</td>
 <td>{{toCurrency($item->price)}}</td>
    <?php $item_saleoff = SaleOff::where('id', $item->saleoff_id)->first() ?>
 <td class="uk-text-truncate" uk-tooltip="@if(isset($item_saleoff->amount))Giảm @if($item_saleoff->amount != 0){{number_format($item_saleoff->amount, 0, ',', '.')}} đ @else {{$item_saleoff->percent}} % @endif @endif ">
@if(isset($item_saleoff->name)){{$item_saleoff->name}}@endif</td>
 <td>{{intval($item->stock)}}</td>
<td><button class="uk-button-primary uk-icon-button uk-form-small" type="submit" onclick="window.location.href='{{route('admin.product.edit', $item->id)}}'"><span uk-icon="pencil"></span></button></td>
<td>
   <form id="item-{{$item->id}}-destroy-form" method="POST" hidden action="/admin/product/{{$item->id}}">
      @csrf
      @method('delete')
   </form>
   <button data-id="{{$item->id}}" class="confirm-delete uk-button-danger uk-icon-button uk-form-small" type="submit"><span uk-icon="close"></span></button></a>
</td>
</tr>
