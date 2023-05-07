<?php

namespace App\Http\Controllers\User\Resources;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
	public static function getCategories($num = 0){
		if($num <= 0)
			return Category::get();
		else
			return Category::paginate($num);
	}
	
	public static function getCategory($id=NULL){
		if($id)
			if(CategoryController::hasCategory($id)){
				return Category::find($id);
			}
			else return NULL;
	}

	public static function getSaleoffableCategories(){
		$saleoffable_products = ProductController::getSaleoffableProducts();

		$saleoffable_products_categoryid = [];
		foreach($saleoffable_products as $item){
			if(!in_array($item->category_id, $saleoffable_products_categoryid)){
				$saleoffable_products_categoryid = array_merge($saleoffable_products_categoryid , [$item->category_id]);
			}
		}
		
		$saleoffable_categories = [];
		foreach ($saleoffable_products_categoryid as $item) {
			$saleoffable_categories = array_merge($saleoffable_categories, [Category::find($item)]);
		}
		return $saleoffable_categories;
	}

	public static function getLeafs(){

		// SELECT leaf.node_id
		// FROM tree AS leaf
		// LEFT OUTER JOIN tree AS child on child.parent = leaf.node_id
		// WHERE child.node_id IS NULL

		return DB::table('categories as leaf')
			->select('leaf.*')
			->leftJoin('categories as child','child.parent_id', '=', 'leaf.id')
			->whereNull('child.id')
			->get();
	}

	public static function getAllIdWithName($name){
		if($name){
			return Category::where('name','LIKE','%'.$name.'%')->get('id');
		} else {
			return NULL;
		};
	}

	public static function hasCategory($id){
		return (Category::find($id)!=NULL);
	}



	// public function search(Request $request)
	// {
	// 	if ($request->ajax()!== NULL) {
	// 		return Response(json_encode(DB::table('products')->where('name', 'LIKE', '%' . $request->search . '%')->get()));
	// 	}
	// }
}
