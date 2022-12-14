<?php

namespace App\Http\Controllers\User\Resources;

use App\Http\Controllers\Controller;
use App\Models\SaleOff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleoffController extends Controller
{
	public static function getSaleoffs($num = -1){
		if($num < 0)
			return Saleoff::get();
		else
			return Saleoff::paginate($num);
	}
	public static function getSaleoff($id=NULL){
		if($id)
			if(SaleoffController::hasSaleoff($id)){
				return Saleoff::find($id);
			}
			else return NULL;
	}

	public static function hasSaleoff($id){
		return (Saleoff::find($id)!=NULL);
	}



	// public function search(Request $request)
	// {
	// 	if ($request->ajax()!== NULL) {
	// 		return Response(json_encode(DB::table('Saleoffs')->where('name', 'LIKE', '%' . $request->search . '%')->get()));
	// 	}
	// }
}
