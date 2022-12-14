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
	public static function getProduct($id=NULL){
		if($id)
			if(ProductController::hasProduct($id)){
				return Product::find($id);
			}
			else return NULL;
	}

	public static function hasProduct($id){
		return (Product::find($id)!=NULL);
	}



	public function search(Request $request)
	{
		if ($request->ajax()!== NULL) {
			return Response(json_encode(DB::table('products')->where('name', 'LIKE', '%' . $request->search . '%')->get()));
		}
	}
}
