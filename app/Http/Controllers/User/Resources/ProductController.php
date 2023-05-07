<?php

namespace App\Http\Controllers\User\Resources;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
	public static function getProducts($num = -1){
		if($num < 0)
			return Product::get();
		else
			return Product::paginate($num);
	}

	public static function getSameCategory($category_id, $count = NULL){
		return ($count > 0)  ? 
			(Product::where('category_id','=',$category_id)->get()->count($count)) : (Product::where('category_id','=',$category_id)->get());
	}

	public static function getProduct($id=NULL){
		if($id)
			if(ProductController::hasProduct($id)){
				return Product::find($id);
			}
			else return NULL;
	}

	public static function getWithName($name){
		if($name)
			return Product::where('name','like','%'.$name.'%')->get();
		else return NULL;
	}

	public static function getWithCategory($categoryid_list){
		$result = [];
		foreach ($categoryid_list as $id) {
			$products = Product::where('category_id',$id->id)->get();
			foreach($products as $product){
				$result = array_merge($result,[$product]);
			}
		}
		return $result;
	}

	public static function hasProduct($id){
		return (Product::find($id)!=NULL);
	}

	public static function getSaleoffableProducts(){
		return Product::where('saleoff_price','!=',"0")->get();
	}

	public function search(Request $request)
	{
		if ($request->ajax()!== NULL) {
			return Response(json_encode(DB::table('products')->where('name', 'LIKE', '%' . $request->search . '%')->get()));
		}
	}
}
