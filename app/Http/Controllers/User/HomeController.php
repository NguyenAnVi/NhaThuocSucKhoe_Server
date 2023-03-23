<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Resources\CategoryController;
use App\Http\Controllers\User\Resources\ProductController;
use App\Http\Controllers\User\Resources\BannerController;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function gethomepage($locale = null){
		if (isset($locale) && in_array($locale, config('app.available_locales'))) {
				app()->setLocale($locale);
		}
		
		// Lay cac san pham co CTKM
		// $saleoff_pro = Product::where('saleoff_id', '!=', '1')->get();

		// Lay cac danh muc lien quan cac san pham tren ^
		// $pro_cat_list = [];
		// foreach($saleoff_pro as $item){
		// 	if(!in_array($item->category_id, $pro_cat_list)){
		// 		$pro_cat_list = array_merge($pro_cat_list, [$item->category_id]);
		// 	}
				
		// }
		// $pro_cat = [];
		// foreach ($pro_cat_list as $item) {
		// 	$pro_cat = array_merge($pro_cat, [CategoryController::getCategory($item)]);
		// }

		$data = ([
			'banners' => BannerController::getActiveBanners(),
			// 'saleoffs' => SaleoffController::getSaleoffs(),
			'categories' => CategoryController::getCategories(),
			'products' => ProductController::getProducts(25),
			
			// 'saleoff_products' => $saleoff_pro,
			// 'productable_categories' => $pro_cat,
		]);
		return view('user.home', $data);
	}

	public function getcategoriesmenu(Request $request){
		if($request->ajax()!==NULL){
			return Response(json_encode(view('user.partials.category', ['categories' => CategoryController::getCategories()])->render()));
		}
	}

	public function show($what, $id)
	{
		switch($what){
			case 'product':
				$data = ([
					'item' => ProductController::getProduct($id),
					'view' => 'user.show.product',
				]);
				return view('user.show', $data);
				break;
			case 'category':
				//
				return view('tested');
				break;
			case 'saleoff':
				//
				break;
			default:
				//
		};

		return;
	}

	public function setlocate($locate){
		if (! in_array($locate, ['en', 'vi'])) {
			abort(400);
		}	

		app()->setLocale((string)$locate);
		session()->put('locale', $locate);

		return redirect()->back()->withErrors([
			'success' => __('notification.setlanguagesuccess'),
		]);
	}

	public function test(){
		return view('tested');
	}

	public function notFound(){
		if (ob_get_level()) {
			ob_end_clean();
		}
						
		http_response_code(404);
		return view('shared.errors.404');
	}
}

