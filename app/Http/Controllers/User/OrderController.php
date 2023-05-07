<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\FakeEnums\PaymentMethod;
use App\FakeEnums\ShippingMethod;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
  public function index(){

    $user = User::find(\Auth::id());
    if($user){
      $pending = Order::where('user_id', $user->id)->Where('status', 'PENDING')->get();
      $processing = Order::where('user_id', $user->id)->where('status', 'PROCESSING')->get();
      $delivering = Order::where('user_id', $user->id)->where('status', 'DELIVERING')->get();
      $delivered = Order::where('user_id', $user->id)->where('status', 'DELIVERED')->get();
      $cancelled_by_user = Order::where('user_id', $user->id)->where('status', 'CANCELLED_BY_USER')->get();
      $cancelled_by_shop = Order::where('user_id', $user->id)->Where('status', 'CANCELLED_BY_SHOP')->get();
      return view('user.order.view', [
        'pending' => $pending,
        'processing' => $processing,
        'delivering' => $delivering,
        'delivered' => $delivered,
        'cancelled_by_user' => $cancelled_by_user,
        'cancelled_by_shop' => $cancelled_by_shop,
      ]);
    } else {
      return back()->withErrors([
        'warning' => 'Có lỗi xảy ra khi tìm người dùng',
      ]);
    }
  }

  public function detail($id){
    $order = Order::where('id', $id)->first();
    $items = OrderItem::where('order_id', $id)->get();
    if($order){
      return view('user.order.detail', ['order' => $order, 'items'=>$items]);
    } else {
      return back()->withErrors([
        'warning'=>'Không tìm thấy mã hóa đơn.',
      ]);
    }
  }

  public function cancel(Request $request)
  {
    $order = Order::where('id', $request->order_id)->first();
    $order->status = 'CANCELLED_BY_USER';
    $order->save();
    return redirect()->route('orders')->withErrors([
      'success' => 'Đã hủy đơn hàng.'
    ]);
  }
}

