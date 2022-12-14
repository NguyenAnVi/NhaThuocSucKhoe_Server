<?php

namespace App\Http\Controllers\Admin\Manager;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\FakeEnums\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Manager\AdminProductController;

class AdminOrderController extends Controller
{
	public function getAll($item_per_page = null){
		if($item_per_page>0){
			return Order::paginate($item_per_page);
		} else {
			return Order::all();
		}
		
	}

	public function getAllWithStatus($status){
		return Order::where('status', $status)->get();
	}
	
	public function index($olddata=NULL)
	{
		$newdata = ([
			// 'collection' => ,
			'title' =>'Quản lý đơn hàng',
			// 'tableView' => '',
		]);
		if($olddata!=NULL) 
			$data = array_merge($olddata,$newdata);
		else 
			$data = $newdata;
		return view('admin.manager.order.index', $data);
	}

	public function all(Request $request)
	{
		if ($request->ajax()!== NULL) {
			$orders = $this->getAll();
			sleep(1);
			return Response(json_encode($orders));
		}
	}

	public function pending(Request $request){
		if ($request->ajax()!== NULL) {
			$orders = $this->getAllWithStatus('PENDING');
			return Response(json_encode($orders));
		}
	}

	public function detail(Request $request){
		if ($request->ajax()!== NULL) {
			$order = Order::where('id', $request->order_id)->first();
			$orderitems = OrderItem::where('order_id', $order->id)->get();
			$data=[];
			$data = array_merge($data, ['order' => $order]);
			$data = array_merge($data, ['orderitems' => $orderitems]);
			sleep(2);
			return Response(json_encode($data));
		}
	}

	/*
	*	Khi đổi trạng thái đơn hàng thành PROCESSING: 
	*		-Trừ trong kho
	*	Khi đổi trạng thái đơn hàng thành PENDING hoặc CANCELLED: 
	*		-Tìm trong kho các sản phẩm và khôi phục lại
	*/
	public function updateStock(Order $order, string $oldStatus){
		$pro = new AdminProductController();
		$items = OrderItem::where('order_id', $order->id)->get();
		$newStatus = $order->status;

		if ($oldStatus == "PENDING" && ($newStatus == "PROCESSING" || 
																		$newStatus == "DELIVERING" || 
																		$newStatus == "DELIVERED"))
		{
			$multiplier = -1;
		} else if($newStatus == "CANCELED_BY_USER"){
			$multiplier = 1;
		} else {
			error_log("nothing to change");
			return;
		}
		
		foreach ($items as $item){
			$pro->restock($item->product_id, $item->qty, $multiplier);
		}
		return;
	}

	public function switchStatus(Request $request){
		$order = Order::where('id',$request->order_id)->first();
		if($order){
			if(OrderStatus::isValidName($request->status)){
				$oldStatus = $order->status;
				$order->status = $request->status;

				// cập nhật Product.Stock:
				$this->updateStock($order, $oldStatus, $order->status);
				
				$order->save();
				return back()->withErrors([
					'success' => 'Thay đổi trạng thái đơn hàng thành công.',
				]);
			}
		}
		return back()->withErrors([
			'warning' => 'Có lỗi xảy ra khi đang thay đổi trạng thái đơn hàng.',
		]);
	}


	// public function index1($olddata=NULL)
	// {
	// 	$order = $this->getAll(10);
	// 	$newdata = ([
	// 		'collection' => $order,
	// 		'title' =>'Quản lý đơn hàng',
	// 		'tableView' => 'admin.manager.order',
	// 	]);
	// 	if($olddata!=NULL) 
	// 		$data = array_merge($olddata,$newdata);
	// 	else 
	// 		$data = $newdata;
	// 	return view('admin.layouts.index', $data);
	// }

}
