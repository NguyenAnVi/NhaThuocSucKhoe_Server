<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\FakeEnums\PaymentMethod;
use App\FakeEnums\ShippingMethod;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
  public function index(Request $request){
    $user = User::where('id', $request->id)->first();
    Cart::restore($user->id);
    $cart = Cart::content();
    Cart::store($user->id);
    return view('user.checkout.view', [
      compact('user'),
      'cart' => $cart,
    ]);
  }

  public function order_place(Request $request){
    $payment_method = strtoupper($request->payment_method);
    $shipping_method = strtoupper($request->shipping_method);
    if (!PaymentMethod::isValidName($payment_method)){
      return back()->withInput()->withErrors([
        'warning' => 'Phương thức thanh toán không hợp lệ.', 
      ]);
    }
    if (!ShippingMethod::isValidName($shipping_method)){
      return back()->withInput()->withErrors([
        'warning' => 'Hình thức vận chuyển không hợp lệ.', 
      ]);
    }

    Cart::restore($request->user_id);

    $odata = array();
    $odata['user_id'] = $request->user_id;   // Tai khoan dat hang
    $odata['receiver_name'] = $request->name; // Ten nguoi nhan hang
    $odata['receiver_phone'] = $request->phone; // SDT nguoi nhan
    $odata['address'] = rawurlencode($request->address);
    $odata['shipping_method'] = $shipping_method;
    $odata['shipping_fee'] = ShippingMethod::fromString($shipping_method);
    $odata['payment_method'] = $payment_method;
    $odata['subtotal'] = Cart::total(0,"","");
    $odata['total'] = intval($odata['subtotal']) + intval($odata['shipping_fee']);
    $odata['status'] = 'PENDING';
    $odata['created_at'] = now();
    $odata['updated_at'] = now();

    $order_id =Order::insertGetId($odata);

    $cartCollection = Cart::content();
    $oidata = array();
    foreach ($cartCollection as $cartContent){
      $oidata['order_id'] = $order_id;
      $oidata['product_id'] = $cartContent->id;
      $oidata['product_name'] = $cartContent->name;
      $oidata['price'] = $cartContent->price;
      $oidata['qty'] = $cartContent->qty;
      DB::table('orderitems')->insert($oidata);
    }

    Cart::destroy($request->user_id);
    // Thong bao cho Admin biet


    return redirect()->route('home')->withErrors([
      'success' => 'Đặt hàng thành công'
    ]);
  }

  public function getShippingFeeFromEnum($str){
    switch(strtoupper($str)){
      case 'GHN':
        return 30000;
        break;
      case 'GHTK':
        return 15000;
        break;
      default:
        return 0;
        break;
    }
  }

  public function getShippingFee(Request $request){
    
    if($request->ajax()!==NULL){
      $method = strtoupper($request->shipping_method);
      if($method == 'NONE') return Response('Đang cập nhật...');
      $output = $this->getShippingFeeFromEnum($method);

      return Response(($output));
      
    }
  }

  public function getTotal(Request $request){
    
    if($request->ajax()!==NULL){
      $uid = strtoupper($request->user_id);
      if($uid == NULL) return Response('Đang cập nhật...');
      $user = User::find($uid);
      if($user){
        Cart::restore($uid);
        $output = (string)Cart::total(0,"","");
        Cart::store($uid);
      } else {
        $output = "An error occured when find user";
      }
      error_log($output);
      return Response(($output));
    }
  }
}

