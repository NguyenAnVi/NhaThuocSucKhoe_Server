<?php

namespace App\Http\Controllers\User\Resources;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
	public static function getBanners($num = -1){
		if($num < 0)
			return Banner::get();
		else
			return Banner::paginate($num);
	}
	public static function getActiveBanners(){
		return Banner::where('status', 'ACTIVE')->get();
	}
	public static function getSaleoff($id=NULL){
		if($id)
			if(SaleoffController::hasSaleoff($id)){
				return Banner::find($id);
			}
			else return NULL;
	}

	public static function hasSaleoff($id){
		return (Banner::find($id)!=NULL);
	}



	// public function search(Request $request)
	// {
	// 	if ($request->ajax()!== NULL) {
	// 		return Response(json_encode(DB::table('Saleoffs')->where('name', 'LIKE', '%' . $request->search . '%')->get()));
	// 	}
	// }
}
