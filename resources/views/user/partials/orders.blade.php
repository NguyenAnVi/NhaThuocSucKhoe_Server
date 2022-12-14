@if (count($items)!=0)
  <table class="uk-table uk-table-hover uk-table-divider">
    <thead class="uk-text-bold">
      <td>Ngày đặt hàng</td>
      <td>Địa chỉ</td>
      <td class="uk-text-right">Thanh toán</td>
      <td class="uk-table-shrink">Trạng thái</td>
    </thead>
    <tbody>
      @foreach ($items as $item)
        <tr onclick="window.location.href='/order/detail/{{$item->id}}'">
          <td>{{$item->created_at}}</td>
          <td>{{urldecode($item->address)}}</td>
          <td class="uk-text-right" id="total"></td>
          <td class="uk-text-right">{{$item->status}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>  
  <script src="{{asset('js/jquery-3.6.1.min.js')}}"></script>
  <script>
    function toCurrency(num){
			if(!Number.isInteger(parseInt(num)))num = 0; 
			return(
				Number(num).toLocaleString(
					'vi-VN', 
					{
						style: 'currency',
						currency: 'VND',
					}
				)
			);
		}
    $("#total").html(toCurrency({{$item->total}}));
  </script>
@else
  <div class="uk-text-center uk-width-1-1 uk-padding-large" >
    Không có đơn hàng nào
  </div>
@endif
  