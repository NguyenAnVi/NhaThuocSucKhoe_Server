<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Cart;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Exceptions\CartAlreadyStoredException;
use Illuminate\Http\Request;
use \Illuminate\Contracts\Events\Dispatcher;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            Cart::restore(Auth::id());

            return $next($request);
        });

    }

    public function __destruct()
    {
        Cart::store(Auth::id());
    }

    /**
     * Kiểm tra tính hợp lệ của số lượng
     * trong giỏ hàng so với tồn kho
     * @param $quantity
     * @param $product (Model)
     */
    public function checkValidQty($quantity, $product){
        error_log($quantity== $product->stock);
        return ($quantity== $product->stock);
    }

    public function save_cart(Request $request)
    {
        $user_id = $request->user_id;
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        
        $product = Product::find($product_id);

        $this->checkValidQty($quantity, $product);
        
        $product_name = $product->name;
        $product_image = $product->images;
        $product_price = $product->price;

        $data = [
            'id' => $product_id,
            'qty' => $quantity,
            'name' => $product_name,
            'price' => $product_price,
            'weight' => '1',
            'options' => [
                'image' => $product_image,
            ],
        ];
        try {
            error_log("1");
            Cart::add($data);
            Cart::store($user_id);
        } catch (CartAlreadyStoredException $th) {
            Cart::merge($user_id,$data);
        }
        
        unset($data);
        return redirect()->back()->withErrors([
            'success' => 'Đã thêm vào giỏ hàng.',
        ]);
    }
    public static function get_cart_partial(){
        $o='';
        Cart::restore(Auth::id());
        if(Cart::count()>0){
            $o.="<div class=\"uk-width-1-1\">";
                $o.="<strong>Sản phẩm vừa thêm</strong>";
            $o.="</div>";
            $o.="<div class=\"uk-width-1-1 uk-padding-small uk-padding-remove-horizontal\">";
                $o.="<table class=\"uk-table uk-table-small\">";
                    $o.="<thead class=\"uk-text-bold\" style=\"color:black\">";
                        $o.="<tr>";
                            $o.="<th></th>";
                            $o.="<th>Tên sản phẩm</th>";
                            $o.="<th>Số lượng</th>";
                            $o.="<th class=\"uk-width-small\">Đơn giá</th>";
                        $o.="</tr>";
                    $o.="</thead>";
                    $o.="<tbody>";

                    foreach (Cart::content() as $item){
                    $o.="<tr onclick=\"window.location.href='/show/product/".$item->id."'\">";
                        $o.="<td>";
                        $o.="<img src=\"".getImageAt($item->options->image, 0)."\"class=\"uk-object-cover\" width=\"50\" height=\"50\" style=\"aspect-ratio: 1 / 1\">";
                        $o.="</td>";
                        $o.="<td>";
                        $o.=$item->name;
                        $o.="</td>";
                        $o.="<td class=\"uk-text-right\">";
                        $o.=$item->qty;
                        $o.="</td>";
                        $o.="<td  class=\"uk-text-right\">";
                        $o.="<p>".number_format($item->price)."đ</p>";
                        $o.="</td>";
                    $o.="</tr>";
                    }

                    $o.="</tbody>";
                    $o.="<tfoot>";
                        $o.="<tr>";
                            $o.="<td></td>";
                            $o.="<td><strong>Tổng tiền hàng:</strong></td>";
                            $o.="<td></td>";
                            $o.="<td class=\"uk-text-right uk-text-bold\">";
                            $o.=Cart::subTotal()."<i style=\"margin:0 auto\">đ</i>";
                            $o.="</td>";    
                        $o.="</tr>";
                    $o.="</tfoot>";
                $o.="</table>";
            $o.="</div>";

        }
        else{
            $o.= "<div class=\"cart-main uk-width-expand uk-flex uk-flex-row\">";
            $o.= "<div>";
            $o.= "Chưa có sản phẩm trong giỏ";
            $o.= "</div>";
            $o.= "</div>";
        }
        
        Cart::store(Auth::id());
        return $o;
    }
    public function show_cart()
    {
        return view('user.cart.view');
    }

    public function delete_cart(Request $request)
    {
        $user_id = $request->user_id;
        Cart::restore($user_id);
        
        $rowId = $request->rowId;
        Cart::remove($rowId);
        Cart::store($user_id);
        return redirect()->back()->withErrors([
            'success' => 'Xóa thành công.',
        ]);
    }

    public function update_quantity(Request $request, $rowId)
    {
        Cart::update($rowId, $request->input('new_qty'));
        return redirect()->back()->withErrors([
            'success' => 'Cập nhật thành công.',
        ]);
    }
}
