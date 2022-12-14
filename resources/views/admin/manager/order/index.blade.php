@extends('admin.layouts.app')
@section('css')
<style>
	tr {cursor: pointer;}
</style>
@endsection
@section('content')
  <div class="uk-flex-around uk-flex">
    <H3 class="uk-text-bold uk-text-center">{{$title}}</H3>
  </div>

	<div class="uk-flex uk-flex-wrap">
		<div class="uk-width-1-3@m" uk-scrollspy="target: > *; cls: uk-animation-fade; delay: 300">
			<table id="function-table" class="uk-table uk-table-hover uk-table-divider">
				<tbody>
					<tr data-type="all" data-route="{{route('admin.order.all')}}">
						<td class="uk-text-bold">Tra cứu hóa đơn</td>
					</tr>
					<tr data-type="pending" data-route="{{route('admin.order.getPending')}}">
						<td class="uk-text-bold">Hóa đơn chờ xác nhận</td>
          </tr>
				</tbody>
			</table>
		</div>
    <div id="ajax-loading" class="uk-flex uk-flex-center uk-flex-middle uk-width-2-3@m" style="display: none">
      <img class="uk-width-1-5 uk-object-scale-down" src="{{asset('logo/lazy.gif')}}">
    </div>
    <div id="ajax" class="uk-width-2-3@m uk-padding-small">
      
    </div>
    <div id="modal-group-1" class="uk-modal-container" uk-modal>
      <div class="uk-modal-dialog  uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div id="ajax-modal-loading" class="uk-flex uk-flex-center uk-flex-middle uk-width-expand uk-padding-large uk-padding-remove-bottom">
          <img class="uk-width-1-5 uk-object-scale-down" src="{{asset('logo/lazy.gif')}}">
        </div>
        <div id="modal-content" class="uk-modal-body uk-flex uk-flex-wrap">
          
        </div>
        <div class="uk-modal-footer uk-text-right">
          <button class="uk-button uk-button-default uk-modal-close" type="button">Ẩn đi</button>
          <button type="submit" form="switch-status-form" class="uk-button uk-button-primary" uk-toggle>Áp dụng</button>
        </div>
      </div>
    </div>




	</div>
  <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
	<script>
    $(document).ready(function (e) {
      $('#function-table > tbody > tr').on('click', function getSection(){
        $("#ajax").html('');
        $('#ajax-loading').show();
        let route = $(this).data('route');
        let type = $(this).data('type');
        $.ajax({
        	headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        	type: 'get',
        	url: route,
        	data: {},
        	success:function(obj){
            let o = ``;
            switch (type) {
              case 'all':
              case 'pending':
                o+='<form class="uk-width-1-1 uk-search uk-search-default">';
                  o+='<span class="uk-search-icon-flip" uk-search-icon></span>';
                  o+='<input id="search" data-filter="'+type+'" class="uk-search-input uk-form uk-icon-button" style="border-radius: 25px" type="search" placeholder="Tìm kiếm theo tên người nhận...">';
                o+='</form>';

                o+='<table id="content-table" class="uk-table uk-table-hover uk-table-divider uk-width-1-1">';
                  o+='<thead>';
                    o+='<td class="uk-table-shrink">ID</td><td class="uk-width-small">Người nhận</td><td class="uk-width-small">Tổng thanh toán</td><td class="uk-width-small">Trạng thái</td>'
                  o+='</thead>';
                  o+='<tbody>';
                    JSON.parse(obj).forEach(function(item) {
                      o+='<tr data-id = "'+item.id+'">';
                        o+='<td>'+item.id+'</td>';
                        o+='<td>'+item.receiver_name+'</td>';
                        o+='<td>'+toCurrency(item.total)+'</td>';
                        o+='<td>'+toStatus(item.status)+'</td>';
                      o+='</tr>';
                    });
                    
                  o+='</tbody>'
                o+='</table>'
                break;
            
              default:
                o = '';
                break;
            }
            $('#ajax-loading').hide();
        		$('#ajax').html(o);


            $('#content-table > tbody > tr').on('click', function (){
              UIkit.modal('#modal-group-1').show();
              order_id = $(this).data('id');

              $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: 'get',
                url: '{{route('admin.order.getDetail')}}',
                data: {
                  'order_id': order_id
                },
                success:function(obk){
                  orderitems = JSON.parse(obk).orderitems;
                  order = JSON.parse(obk).order;

                  let o = ``;
                  o+='<div class="uk-width-expand uk-width-2-3@m">';
                    o+='<table id="content-table" class="uk-table uk-table-hover uk-table-divider ">';
                      o+='<thead>';
                        o+='<td class="uk-width-expand">Tên SP</td><td class="uk-width-small uk-text-right">Đơn giá</td><td class="uk-table-shrink uk-text-right">SL</td>';
                      o+='</thead>';
                      o+='<tbody>';
                        orderitems.forEach(function(item) {
                          o+='<tr data-id = "'+item.id+'">';
                            o+='<td  class="uk-text-truncate">'+item.product_name+'</td>';
                            o+='<td  class="uk-text-right">'+item.price+'</td>';
                            o+='<td  class="uk-text-right">'+item.qty+'</td>';
                          o+='</tr>';
                        });
                        
                      o+='</tbody>';
                    o+='</table>';
                    o+='<div class="uk-width-expand uk-width-2-3@m uk-width-1-2@l uk-margin-auto-left uk-padding-small uk-padding-remove-vertical">';
                      o+='<div class="uk-flex uk-flex-between">';
                        o+='<div class="">Tiền hàng :</div><div> <i>'+toCurrency(order.subtotal)+'</i></div>';
                      o+='</div>';
                      o+='<div class="uk-flex uk-flex-between">';
                        o+='<div class="">Phí giao hàng :</div><div> <i>'+toCurrency(order.shipping_fee)+'</i></div>';
                      o+='</div>';
                      o+='<div class="uk-flex uk-flex-between">';
                        o+='<div class=" uk-text-bold">Tổng thanh toán :</div><div> <strong class="uk-text-primary">'+toCurrency(order.total)+'</strong></div>';
                      o+='</div>';
                    o+='</div>';
                  o+='</div>';

                  o+='<div class="uk-width-expand uk-width-1-3@m uk-padding uk-padding-remove-vertical">';
                    o+='<h4 class="uk-text-center uk-text-bold">Thông tin vận chuyển</h4>';
                    o+='<div class="uk-flex uk-flex-between">';
                      o+='<div class="">Người nhận :</div><div> <i>'+order.receiver_name+'</i></div>';
                    o+='</div>';
                    o+='<div class="uk-flex uk-flex-between">';
                      o+='<div class="">SDT :</div><div> <i>'+order.receiver_phone+'</i></div>';
                    o+='</div>';
                    o+='<div class="">';
                      o+='<div class="uk-width-1-1">Địa chỉ nhận :</div><div class="uk-width-1-1 uk-text-right"> <i>'+decodeURIComponent(order.address)+'</i></div>';
                    o+='</div>';
                    o+='<div class="uk-flex uk-flex-between">';
                      o+='<div class="">Hình thức vận chuyển :</div><div> <i>'+order.shipping_method+'</i></div>';
                    o+='</div>';

                    o+='<h4 class="uk-text-center uk-text-bold">Thông tin đơn hàng</h4>';
                    o+='<div class="uk-flex uk-flex-between">';
                      o+='<div class="">Phương thức thanh toán :</div><div> <i>'+order.payment_method+'</i></div>';
                    o+='</div>';
                    o+='<div class="uk-flex uk-flex-between">';
                      o+='<div class="">Trạng thái đơn hàng :</div><div> <i>'+toStatus(order.status)+'</i></div>';
                    o+='</div>';
                    o+='<div class="">';
                      o+='<div class="">Thay đổi trạng thái đơn hàng :</div>';
                      o+='<div class="uk-form-controls uk-width-expand">';
                        o+='<form id="switch-status-form" action="/admin/order/switchstatus" method="post">';
                          o+='<input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'">';
                          o+='<input type="hidden" name="order_id" value="'+order.id+'">';
                          
                          o+='<select class="uk-select uk-form-small" id="status" name="status">';
                            o+='<option value="PENDING">'+toStatus('PENDING')+'</option>';
                            o+='<option value="PROCESSING">'+toStatus('PROCESSING')+'</option>';
                            o+='<option value="DELIVERING">'+toStatus('DELIVERING')+'</option>';
                            o+='<option value="DELIVERED">'+toStatus('DELIVERED')+'</option>';
                            o+='<option value="CANCELLED_BY_SHOP">'+"Hủy đơn hàng"+'</option>';
                          o+='</select>';
                        o+='</form>';
                      o+='</div>';
                    o+='</div>';
                  o+='</div>';

                
                  

                  $('#modal-content').html(o);
                  $('#ajax-modal-loading').hide();
                }

              });

        	  });
          }
        });
      });

      $('#search').on('keyup',function(){
        $value = $(this).val();
        $filter = $(this).data('filter');
        if(!$value){
          location.reload();
        }
        else{
          $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: 'get',
            url: '{{route("admin.order.search")}}',
            data: {
              'filter': $filter,
              'search': $value
            },
            success:function(obj){
              $('#ajax').html(row(JSON.parse(obj)));
            }
          });
        }
      });

      function toStatus(stt){
        console.log('String.prototype.toUpperCase(stt) :>> ', stt.toUpperCase());
        switch (stt.toUpperCase()) {
          case 'PENDING':
            return 'Đang chờ xác nhận 📝';
            break;
          case 'DELIVERING':
            return 'Đang giao hàng 🚚';
            break;
          case 'PROCESSING':
            return 'Đang chuẩn bị hàng 🎁';
            break;
          case 'DELIVERED':
            return 'Đã giao hàng ✅';
            break;
          case 'CANCELLED_BY_USER':
            return 'Bị hủy bởi khách hàng ✖️';
            break;
          case 'CANCELLED_BY_SHOP':
            return 'Bị hủy bởi cửa hàng ✖️';
            break;
          default:
            return 'Không xác định';
            break;
        }
      }

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

    });
    
    
  </script>
	
@endsection
