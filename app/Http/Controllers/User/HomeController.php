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
		

		$data = ([
			'banners' => BannerController::getActiveBanners(),
			// 'saleoffs' => SaleoffController::getSaleoffs(),
			'categories' => CategoryController::getLeafs(),
			'products' => ProductController::getProducts(25),
			'saleoffable_categories' => CategoryController::getSaleoffableCategories(),
			'saleoffable_products' => ProductController::getSaleoffableProducts(),
			
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
				$product = ProductController::getProduct($id);
				if($product){
					$category_name = CategoryController::getCategory($product->category_id)->name;
					$data = ([
						'item' => $product,
						'category_name' => $category_name,
						'view' => 'user.show.product',
						'sameCat' => ProductController::getSameCategory($product->category_id)
					]);
					return view('user.show', $data);
				} else {
					return back()->withErrors(['danger' => trans('general.msg.invalidproductid')]);
				}

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

	public function search(Request $request){
		if($request->ajax() !== NULL){
			try {
				$key = $request->search;
				if(strlen($key)>0){
					// search for categories
					$cat_list = CategoryController::getAllIdWithName($key);

					// search for product which have category
					$categories = ProductController::getWithCategory($cat_list);

					$products = ProductController::getWithName($key);
					$result = [
						'categories' => $categories,
						'products' => $products
					];
					return Response(json_encode(['status'=>1,'content'=>$result]));
				} else {
					return Response(json_encode(['status'=>0,'content'=>'0 result']));
				}
			} catch (Exception $e) {
				return Response(json_encode(['status'=>0,'content' => $e->getMessage()]));
			}
		}
	}
}

