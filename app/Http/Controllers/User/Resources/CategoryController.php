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
